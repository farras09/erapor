<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrtuWali extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		$this->load->library('upload');
		$this->load->model('Model_OrtuWali', 'ortu_wali');
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

	//ortu_wali	
	public function tampil($id)
	{

		$this->session->set_userdata("judul", "Data Orang Tua / Wali");
		$ba = [
			'judul' => "Data Orang Tua / Wali",
			'subjudul' => "Orang Tua / Wali",
		];
		$d = [
			'pd_id' => $id,
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('ortu_wali', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_ortu_wali($id)
	{
		$list = $this->ortu_wali->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $ortu_wali) {
			$no++;
			$status = "";
			$edit = "";
			if ($ortu_wali->otw_jenis == 3) $edit = "<a href='#' onClick='ubah_wali(" . $ortu_wali->otw_id . ")' class='btn btn-info btn-sm' title='Ubah data Wali'><i class='fa fa-edit'></i></a>";
			$hapus = "<a href='#' onClick='hapus_ortu_wali(" . $ortu_wali->otw_id . ")' class='btn btn-danger btn-sm' title='Hapus data ortu_wali'><i class='fa fa-trash-alt'></i></a>";
			switch ($ortu_wali->otw_jenis) {
				case 1:
					$status = "Ayah";
					break;
				case 2:
					$status = "Ibu";
					break;
				case 3:
					$status = "Wali";
					break;
			}
			$row = array();
			$row[] = $no;
			$row[] = $status;
			$row[] = $ortu_wali->otw_nama;
			$row[] = $ortu_wali->otw_thn_lahir;
			$row[] = $ortu_wali->otw_pekerjaan;
			$row[] = $ortu_wali->otw_alamat;
			$row[] = $ortu_wali->otw_nohp;
			$row[] = $ortu_wali->otw_agama;
			$row[] = $edit . " " . $hapus;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ortu_wali->count_all($id),
			"recordsFiltered" => $this->ortu_wali->count_filtered($id),
			"data" => $data,
			"query" => $this->ortu_wali->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('otw_pd_id');
		$jenis = $this->input->post('otw_jenis');
		$data = $this->ortu_wali->cari_ortu_wali($id, $jenis);
		echo json_encode($data);
	}

	public function cari_wali()
	{
		$id = $this->input->post('otw_id');
		$data = $this->ortu_wali->cari_wali($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('otw_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->ortu_wali->simpan("skl_ortu_wali", $data);
		} else {
			$insert = $this->ortu_wali->update("skl_ortu_wali", array('otw_id' => $id), $data);
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
		$delete = $this->ortu_wali->delete('skl_ortu_wali', 'otw_id', $id);
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
