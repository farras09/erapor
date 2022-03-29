<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NilaiMapel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		// if ($this->session->userdata("level") > 3) {
		// 	redirect(base_url("Dashboard"));
		// }
		$this->load->model('Model_PesertaDidik', 'peserta_didik');
		$this->load->model('Model_Kelas', 'kelas');
		$this->load->model('Model_NilaiMapel', 'rapor');
		$this->load->model('Model_GuruMapel', 'guru_mapel');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$ba = [];
		$d = [
			'filterkelas' => $this->guru_mapel->get_filter_kelas(),
			'filtermapel' => $this->guru_mapel->get_filter_mapel(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('nilai_mapel', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_peserta_didik($kelas, $mapel)
	{
		$list = $this->rapor->get_datatables($kelas, $mapel);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $peserta_didik) {
			$no++;

			$tambah = "";
			$edit = "";
			$status = "";
			$cek_rapor = $this->rapor->cari_nilai_mapel($peserta_didik->pd_id, $peserta_didik->mpl_id);
			if ($cek_rapor) {
				$edit = "<a href='#' onClick='edit_nilai_hasil_belajar({$peserta_didik->pd_id},{$peserta_didik->mpl_id})' class='btn btn-info btn-sm' title='Ubah Nilai'><i class='fa fa-edit'></i></a>";
				$status = "<span class='badge badge-success'>Sudah Diinput</sapn>";
			} else {
				$tambah = "<a href='#' onClick='nilai_hasil_belajar({$peserta_didik->pd_id},{$peserta_didik->ta_id},{$peserta_didik->kls_id},{$peserta_didik->mpl_id})' class='btn btn-warning btn-sm' title='Input Nilai'><i class='fa fa-edit'></i></a>";
				$status = "<span class='badge badge-danger'>Nilai Belum Diinput</span>";
			}

			$row = array();
			$row[] = $no;
			$row[] = $peserta_didik->pd_nisn;
			$row[] = $peserta_didik->pd_nama;
			$row[] = $peserta_didik->kls_nama;
			$row[] = $peserta_didik->mpl_nama;
			$row[] = $status;
			$row[] = "{$tambah}{$edit}";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rapor->count_all(),
			"recordsFiltered" => $this->rapor->count_filtered($kelas, $mapel),
			"data" => $data,
			"query" => $this->rapor->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('rpr_pd_id');
		$idmpl = $this->input->post('rpr_mpl_id');
		$data = $this->rapor->cari_nilai_mapel($id, $idmpl);
		echo json_encode($data);
	}

	public function simpan()
	{
		try {
			$id = $this->input->post('rpr_id');
			$data = $this->input->post();

			$data['rpr_rata_ph'] = ($data['rpr_ph1'] + $data['rpr_ph2'] + $data['rpr_ph3']) / 3;
			$data['rpr_rata_tgs'] = ($data['rpr_tgs1'] + $data['rpr_tgs2'] + $data['rpr_tgs3']) / 3;
			$data['rpr_rata_nph'] = ($data['rpr_rata_ph'] + $data['rpr_rata_tgs']) / 2;
			$data['rpr_nilai_akhir'] = ($data['rpr_rata_nph'] + $data['rpr_pts'] + $data['rpr_pas']) / 3;

			if ($data['rpr_nilai_akhir'] < 70) {
				$data['rpr_predikat'] = 'D';
			} elseif ($data['rpr_nilai_akhir'] < 80) {
				$data['rpr_predikat'] = 'C';
			} elseif ($data['rpr_nilai_akhir'] < 90) {
				$data['rpr_predikat'] = 'B';
			} elseif ($data['rpr_nilai_akhir'] < 100) {
				$data['rpr_predikat'] = 'A';
			}
			$data['rpr_status'] = 1;
			if ($id == 0) {
				$insert = $this->rapor->simpan("skl_nilai_rapor", $data);
			} else {
				$insert = $this->rapor->update("skl_nilai_rapor", array('rpr_id' => $id), $data);
			}
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";

			echo json_encode($resp);
		} catch (Exception $e) {
			throw new Exception('Gagal Menyimpan, terjadi error');
			$resp['status'] = 0;
			$resp['desc'] = $e->getMessage();
			$resp['error'] = '';
			echo json_encode($resp);
		}
	}
}
