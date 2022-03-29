<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuruMapel extends CI_Controller
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
		$this->load->model('Model_GuruMapel', 'guru_mapel');
		$this->load->model('Model_Guru', 'guru');
		$this->load->model('Model_MataPelajaran', 'matapelajaran');
		$this->load->model('Model_TahunAjaran', 'ta');
		$this->load->model('Model_Kelas', 'kelas');
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

	//mapel	
	public function tampil()
	{

		$this->session->set_userdata("judul", "Data Guru Mata Pelajaran");
		$ba = [
			'judul' => "Data Guru Mata Pelajaran",
			'subjudul' => "Guru Mata Pelajaran",
		];
		$d = [
			'ta' => $this->ta->get_tahun_ajaran(),
			'guru' => $this->guru->get_guru(),
			'mapel' => $this->matapelajaran->get_mapel(),
			'kelas' => $this->kelas->get_kelas(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('guru_mapel', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_mapel()
	{
		$list = $this->guru_mapel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mapel) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $mapel->gru_nama;
			$row[] = $mapel->kls_nama;
			$row[] = $mapel->mpl_nama;
			$row[] = $mapel->ta_tahun;
			$row[] = "<a href='#' onClick='ubah_mapel(" . $mapel->gmp_id . ")' class='btn btn-info btn-sm' title='Ubah data mapel'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' onClick='hapus_mapel(" . $mapel->gmp_id . ")' class='btn btn-danger btn-sm' title='Hapus data mapel'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru_mapel->count_all(),
			"recordsFiltered" => $this->guru_mapel->count_filtered(),
			"data" => $data,
			"query" => $this->guru_mapel->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('gmp_id');
		$data = $this->guru_mapel->cari_guru_mapel($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('gmp_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->guru_mapel->simpan($data);
		} else {
			$insert = $this->guru_mapel->update(array('gmp_id' => $id), $data);
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
		$delete = $this->guru_mapel->delete('skl_guru_mapel', 'gmp_id', $id);
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
