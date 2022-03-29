<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
		$this->load->model('Model_Login', 'pengguna');
		$this->load->model('Model_Guru', 'guru');
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

	//Pengguna	
	public function tampil()
	{
		$this->session->set_userdata("judul", "Data Pengguna");
		$ba = [
			'judul' => "Data Pengguna",
			'subjudul' => "Pengguna",
		];
		$d = [
			'guru' => $this->guru->get_namaguru(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('pengguna', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_pengguna()
	{
		$list = $this->pengguna->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pengguna) {

			$hapus = " <a href='#' onClick='hapus_pengguna(" . $pengguna->log_id . ")' class='btn btn-danger btn-sm' title='Hapus data Pengguna'><i class='fa fa-trash-alt'></i></a>";
			if ($this->session->userdata("level") == 2) {
				if ($pengguna->log_level == 2) {
					$hapus = "";
				}
			}
			$no++;
			$level = "";
			switch ($pengguna->log_level) {
				case 2:
					$level = "Admin Sekolah";
					break;
				case 3:
					$level = "Wali Kelas";
					break;
				case 4:
					$level = "Guru";
					break;
			}
			$row = array();
			$row[] = $no;
			$row[] = $pengguna->log_nama;
			$row[] = $pengguna->log_user;
			$row[] = $level;
			$row[] = "<a href='#' onClick='ubah_pengguna(" . $pengguna->log_id . ")' class='btn btn-info btn-sm' title='Ubah data Pengguna'><i class='fa fa-edit'></i></a> {$hapus}";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengguna->count_all(),
			"recordsFiltered" => $this->pengguna->count_filtered(),
			"data" => $data,
			"query" => $this->pengguna->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('log_id');
		$data = $this->pengguna->cari_pengguna($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('log_id');
		$idpeg = $this->input->post('log_peg_id');
		$pass = $this->input->post('log_pass');
		$data = $this->input->post();

		$guru = $this->guru->cari_guru($idpeg);

		$data['log_user'] = $guru->gru_nip;
		$data['log_nama'] = $guru->gru_nama;

		if (!empty($pass)) {
			$data['log_pass'] = md5($pass);
		}

		if ($id == 0) {
			if (empty($pass)) {
				$data['log_pass'] = md5("user123");
			}
			$insert = $this->pengguna->simpan("skl_login", $data);
		} else {
			$insert = $this->pengguna->update("skl_login", array('log_id' => $id), $data);
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
		$delete = $this->pengguna->delete('skl_login', 'log_id', $id);
		if ($delete) {
			$resp['status'] = 1;
			$resp['desc'] = "<i class='fa fa-exclamation-circle text-success'></i>&nbsp;&nbsp;&nbsp; Berhasil menghapus data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "<i class='fa fa-exclamation-triangle text-warning'></i>&nbsp;&nbsp;&nbsp; Administrator tidak dapat dihapus";
		}
		echo json_encode($resp);
	}
}
