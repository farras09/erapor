<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
		$this->load->model('Model_Guru', 'guru');
		$this->load->model('Model_GuruMapel', 'gurumapel');
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

	//guru	
	public function tampil()
	{

		$this->session->set_userdata("judul", "Data guru");
		$ba = [
			'judul' => "Data guru",
			'subjudul' => "guru",
		];
		$d = [];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('guru', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_guru()
	{
		$list = $this->guru->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $guru) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img width="100" src="' . base_url("assets/files/guru/{$guru->gru_foto}") . '" alt="">';
			$row[] = $guru->gru_nip;
			$row[] = $guru->gru_nama;
			$row[] = $guru->gru_jk == 1 ? "Laki - Laki" : "Perempuan";
			$row[] = $guru->gru_nohp;
			$row[] = $guru->gru_alamat;
			$row[] = $guru->gru_status == 1 ? "Aktif" : "Sudah Berhenti";
			$row[] = "<a href='#' onClick='ubah_guru(" . $guru->gru_id . ")' class='btn btn-info btn-sm' title='Ubah data guru'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' onClick='hapus_guru(" . $guru->gru_id . ")' class='btn btn-danger btn-sm' title='Hapus data guru'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru->count_all(),
			"recordsFiltered" => $this->guru->count_filtered(),
			"data" => $data,
			"query" => $this->guru->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('gru_id');
		$data = $this->guru->cari_guru($id);
		echo json_encode($data);
	}

	public function cari_guru_mapel()
	{
		$id_guru = $this->input->post('id');
		$cek = $this->gurumapel->cari($id_guru);

		$data = $this->mapelsemester->list_guru_mapel();
		$list_mapel = "";
		$checked = [];
		if ($cek) {
			foreach ($cek as $k) {
				array_push($checked, $k->gmp_mps_id);
			}
		}

		foreach ($data as $e) {
			$check = "";
			if ($checked) {
				$check = in_array($e->mps_id, $checked) ? 'checked' : '';
			}
			$list_mapel .= "
			<div class='col-sm-4'>
				<div class='custom-control custom-checkbox'>
					<input name='gmp_mps_id[]' class='custom-control-input' type='checkbox' id='customCheckbox{$e->mps_id}' value='{$e->mps_id}' {$check}>
					<label for='customCheckbox{$e->mps_id}' class='custom-control-label'>{$e->mpl_nama} {$e->mps_tingkat}</label>
				</div>
			</div>";
		}
		echo ($list_mapel);
	}

	public function simpan_mapel()
	{
		$gmp_gru_id = $this->input->post('gmp_gru_id');
		$cek = $this->gurumapel->cari($gmp_gru_id);
		$berhasil = null;

		if ($cek) {
			$berhasil = $this->gurumapel->delete('skl_guru_mapel', 'gmp_gru_id', $gmp_gru_id);
		}
		if ($this->input->post('gmp_mps_id') != null) {
			foreach ($_POST['gmp_mps_id'] as $value) {
				$berhasil = $this->gurumapel->simpan(['gmp_mps_id' => $value, 'gmp_gru_id' => $gmp_gru_id]);
			}
		}

		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}
		if ($berhasil) {
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}

	public function cari_guru_bidang_study()
	{
		$id_guru = $this->input->post('id');
		$cek = $this->gurubidangstudy->cari($id_guru);

		$data = $this->bidangstudy->list_bidang_study();
		$list_bidang_study = "";
		$checked = [];
		if ($cek) {
			foreach ($cek as $k) {
				array_push($checked, $k->gbs_std_id);
			}
		}

		foreach ($data as $e) {
			$check = "";
			if ($checked) {
				$check = in_array($e->std_id, $checked) ? 'checked' : '';
			}
			$list_bidang_study .= "
			<div class='col-sm-4'>
				<div class='custom-control custom-checkbox'>
					<input name='gbs_std_id[]' class='custom-control-input' type='checkbox' id='customCheckbox{$e->std_id}' value='{$e->std_id}' {$check}>
					<label for='customCheckbox{$e->std_id}' class='custom-control-label'>{$e->std_nama}</label>
				</div>
			</div>";
		}
		echo ($list_bidang_study);
	}

	public function simpan_bidang_study()
	{
		$gbs_gru_id = $this->input->post('gbs_gru_id');
		$cek = $this->gurubidangstudy->cari($gbs_gru_id);
		$berhasil = null;

		if ($cek) {
			$berhasil = $this->gurubidangstudy->delete('skl_guru_bidang_study', 'gbs_gru_id', $gbs_gru_id);
		}
		if ($this->input->post('gbs_std_id') != null) {
			foreach ($_POST['gbs_std_id'] as $value) {
				$berhasil = $this->gurubidangstudy->simpan(['gbs_std_id' => $value, 'gbs_gru_id' => $gbs_gru_id]);
			}
		}

		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}
		if ($berhasil) {
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}

	public function simpan()
	{
		$id = $this->input->post('gru_id');
		$data = $this->input->post();
		$tgl = explode("/", $data['gru_tgl_lahir']);
		$data['gru_tgl_lahir'] = "{$tgl[2]}-{$tgl[1]}-{$tgl[0]}";

		$nmfile = "foto_" . time();

		$config['upload_path']          = 'assets/files/guru/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['file_name']						= $nmfile;

		$this->load->library('upload', $config);
		// $this->upload->initialize($config);

		if ($_FILES['gru_foto']['name']) {
			if (!$this->upload->do_upload('gru_foto')) {
				$error = array('error' => $this->upload->display_errors());
				$resp['errorFoto'] = $error;
			} else {
				$data['gru_foto'] = $this->upload->data('file_name');
			}
		}

		if ($id == 0) {
			$insert = $this->guru->simpan("skl_guru", $data);
		} else {
			$insert = $this->guru->update("skl_guru", array('gru_id' => $id), $data);
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
		$foto = $this->guru->cari_guru($id);
		$delete = $this->guru->delete('skl_guru', 'gru_id', $id);

		if ($delete) {
			unlink("assets/files/simela/" . $foto->gru_foto);
			$resp['status'] = 1;
			$resp['desc'] = "<i class='fa fa-exclamation-circle text-success'></i>&nbsp;&nbsp;&nbsp; Berhasil menghapus data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Gagal menghapus data !";
		}
		echo json_encode($resp);
	}
}
