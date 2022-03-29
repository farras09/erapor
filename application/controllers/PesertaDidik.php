<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesertaDidik extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		if ($this->session->userdata("level") > 2) {
			redirect(base_url("Dashboard"));
		}
		$this->load->library('upload');
		$this->load->model('Model_PesertaDidik', 'peserta_didik');
		$this->load->model('Model_KelasSiswa', 'kelas_siswa');
		date_default_timezone_set('Asia/Jakarta');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//peserta_didik	
	public function tampil()
	{

		$this->session->set_userdata("judul", "Data Peserta Didik");
		$ba = [
			'judul' => "Data Peserta Didik",
			'subjudul' => "Peserta Didik",
		];
		$d = [];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('peserta_didik', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_peserta_didik()
	{
		$list = $this->peserta_didik->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $peserta_didik) {
			$hapus = "";
			$cek_siswa = $this->kelas_siswa->cek_siswa($peserta_didik->pd_id);
			if ($cek_siswa) {
				$hapus = "<a href='#' onClick='hapus_peserta_didik(" . $peserta_didik->pd_id . ")' class='btn btn-danger btn-sm disabled' title='Hapus data Peserta Didik' style='margin-bottom: 5px;'><i class='fa fa-trash-alt'></i></a>";
			} else {
				$hapus = "<a href='#' onClick='hapus_peserta_didik(" . $peserta_didik->pd_id . ")' class='btn btn-danger btn-sm' title='Hapus data Peserta Didik' style='margin-bottom: 5px;'><i class='fa fa-trash-alt'></i></a>";
			}

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $peserta_didik->pd_nisn;
			$row[] = "<a href='#' onClick='lihat_peserta_didik(" . $peserta_didik->pd_id . ")'>$peserta_didik->pd_nama</a>";
			$row[] = $peserta_didik->pd_jk == 1 ? "Laki-laki" : "Perempuan";
			$row[] = $peserta_didik->pd_tpt_lahir . ", " . $this->peserta_didik->tanggal($peserta_didik->pd_tgl_lahir);
			$row[] = $peserta_didik->pd_hp;
			$row[] = "<a href='" . base_url('OrtuWali/tampil/' . $peserta_didik->pd_id) . "' class='btn btn-info btn-sm' title='Orangtua / Wali' style='margin-bottom: 5px;'><i class='fa fa-user-friends'></i></a>
			<a href='#' onClick='ubah_peserta_didik(" . $peserta_didik->pd_id . ")' class='btn btn-info btn-sm' title='Ubah data Peserta Didik' style='margin-bottom: 5px;'><i class='fa fa-edit'></i></a> {$hapus}";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->peserta_didik->count_all(),
			"recordsFiltered" => $this->peserta_didik->count_filtered(),
			"data" => $data,
			"query" => $this->peserta_didik->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('pd_id');
		$data = $this->peserta_didik->cari_peserta_didik($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('pd_id');
		$data = $this->input->post();
		$tgl = explode("/", $data['pd_tgl_lahir']);
		$data['pd_tgl_lahir'] = "{$tgl[2]}-{$tgl[1]}-{$tgl[0]}";

		if (!empty($_FILES['pd_foto']['name'])) {
			if (!is_dir('assets/files/siswa')) {
				mkdir('assets/files/siswa', 0777, TRUE);
			}
			$path = $_FILES['pd_foto']['name'];
			$ext =  pathinfo($path, PATHINFO_EXTENSION);
			$config['upload_path'] = 'assets/files/siswa/'; //path folder
			$config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
			$config['overwrite'] = TRUE; //Gantikan file dengan nama yang sama
			$config['file_name'] = "foto-" . microtime(true) . "." . $ext; //ganti nama file

			$this->upload->initialize($config);
		}

		if (!empty($_FILES['pd_foto']['name'])) {
			if ($this->upload->do_upload('pd_foto')) {
				$foto = $this->upload->data();
				$data['pd_foto'] = $foto['file_name'];
			}
		}

		if ($id == 0) {
			$insert = $this->peserta_didik->simpan("skl_peserta_didik", $data);
		} else {
			$insert = $this->peserta_didik->update("skl_peserta_didik", array('pd_id' => $id), $data);
		}
		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}
		if ($insert) {
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}

	public function hapus($id)
	{
		$delete = $this->peserta_didik->delete('skl_peserta_didik', 'pd_id', $id);
		if ($delete) {
			$resp['status'] = 1;
			$resp['desc'] = "<i class='fa fa-exclamation-circle text-success'></i>&nbsp;&nbsp;&nbsp; Berhasil menghapus data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Gagal menghapus data !";
		}
		echo json_encode($resp);
	}
}
