<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelasSiswa extends CI_Controller
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
		$this->load->model('Model_Kelas', 'kelas');
		$this->load->model('Model_KelasSiswa', 'kelas_siswa');
		$this->load->model('Model_PesertaDidik', 'peserta_didik');
		$this->load->model('Model_TahunAjaran', 'tahun_ajaran');
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

	//kelas_siswa	
	public function tampil()
	{
		$this->session->set_userdata("judul", "Data Kelas Siswa");
		$ba = [
			'judul' => "Data Kelas Siswa",
			'subjudul' => "Kelas Siswa",
		];
		$d = [
			'ta' => $this->tahun_ajaran->get_all_tahun_ajaran(),
			'siswa' => $this->peserta_didik->ambil_peserta_didik(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('kelas_siswa', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_kelas_siswa()
	{
		$list = $this->kelas->get_kelas();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelas) {
			$jml_siswa = 0;
			$siswa = $this->kelas_siswa->get_jml_siswa($kelas->kls_id);
			if ($siswa) $jml_siswa = $siswa;

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kelas->kls_nama;
			$row[] = $kelas->kls_tingkat;
			$row[] = $jml_siswa . " Orang";
			$row[] = "<a href='#' onClick='ubah_kelas({$kelas->kls_id},{$jml_siswa})' class='btn btn-info btn-sm' title='Ubah Data'><i class='fa fa-edit'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelas->count_all(),
			"recordsFiltered" => $this->kelas->count_filtered(),
			"data" => $data,
			"query" => $this->kelas->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_siswa($id, $ta_id)
	{
		$list = $this->kelas_siswa->get_datatables($id, $ta_id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pd) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pd->pd_nisn;
			$row[] = $pd->pd_nama;
			$row[] = "<a href='#' onClick='hapus_siswa(" . $pd->kss_id . ")' class='btn btn-danger btn-sm' title='Hapus'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelas_siswa->count_all($id),
			"recordsFiltered" => $this->kelas_siswa->count_filtered($id, $ta_id),
			"data" => $data,
			"query" => $this->kelas_siswa->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('kls_id');
		$data = $this->kelas->cari_kelas($id);
		echo json_encode($data);
	}

	public function get_tahun_ajaran($id, $ta)
	{
		$data = $this->kelas_siswa->ambil_siswa($id, $ta);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('kss_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->kelas_siswa->simpan("skl_kelas_siswa", $data);
		} else {
			$insert = $this->kelas_siswa->update("skl_kelas_siswa", array('kss_id' => $id), $data);
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
		$delete = $this->kelas_siswa->delete('skl_kelas_siswa', 'kss_id', $id);
		if ($delete) {
			$resp['status'] = 1;
			$resp['desc'] = "<i class='fa fa-exclamation-circle text-success'></i>&nbsp;&nbsp;&nbsp; Berhasil menghapus data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Gagal menghapus data !";
		}
		echo json_encode($resp);
	}

	public function get_kelas($id)
	{
		$data = $this->kelas->ambil_kelas($id);
		if ($data) {
			$result = "<option Pilih {$id}";
			foreach ($data as $d) {
				$result .= "<option value={$d->kls_id}>{$d->kls_nama}</option>";
			}
		}
		echo $result;
	}
}
