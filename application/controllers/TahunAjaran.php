<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunAjaran extends CI_Controller
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

	//tahun_ajaran	
	public function tampil()
	{

		$this->session->set_userdata("judul", "Data Tahun Ajaran");
		$ba = [
			'judul' => "Data Tahun Ajaran",
			'subjudul' => "Tahun Ajaran",
		];
		$d = [];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('tahun_ajaran', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_tahun_ajaran()
	{
		$list = $this->tahun_ajaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $tahun_ajaran) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $tahun_ajaran->ta_tahun;
			$row[] = $tahun_ajaran->ta_semester == 1 ? "Ganjil" : "Genap";
			$row[] = $tahun_ajaran->ta_status == 0 ? "Tidak Aktif" : "Aktif";
			$row[] = "<a href='#' onClick='ubah_tahun_ajaran(" . $tahun_ajaran->ta_id . ")' class='btn btn-info btn-sm' title='Ubah data tahun_ajaran'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' onClick='hapus_tahun_ajaran(" . $tahun_ajaran->ta_id . ")' class='btn btn-danger btn-sm' title='Hapus data tahun_ajaran'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tahun_ajaran->count_all(),
			"recordsFiltered" => $this->tahun_ajaran->count_filtered(),
			"data" => $data,
			"query" => $this->tahun_ajaran->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('ta_id');
		$data = $this->tahun_ajaran->cari_tahun_ajaran($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('ta_id');
		$data = $this->input->post();

		$data1 = [
			'ta_status' => 0,
		];
		$id1 = $this->tahun_ajaran->get_ta_id($id);
		if ($id == 0) {
			if ($data['ta_status'] == 1) {
				$this->tahun_ajaran->update("skl_tahun_ajaran", null, $data1);
			}
			$insert = $this->tahun_ajaran->simpan("skl_tahun_ajaran", $data);
		} else {
			if ($data['ta_status'] == 1) {
				$this->tahun_ajaran->update("skl_tahun_ajaran", null, $data1);
			}
			$insert = $this->tahun_ajaran->update("skl_tahun_ajaran", array('ta_id' => $id), $data);
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
		$delete = $this->tahun_ajaran->delete('skl_tahun_ajaran', 'ta_id', $id);
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
