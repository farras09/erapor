<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapor extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		if ($this->session->userdata("level") > 3) {
			redirect(base_url("Dashboard"));
		}
		$this->load->model('Model_PesertaDidik', 'peserta_didik');
		$this->load->model('Model_Kelas', 'kelas');
		$this->load->model('Model_SikapSiswa', 'sikap_siswa');
		$this->load->model('Model_Ekstrakurikuler', 'ekstrakurikuler');
		$this->load->model('Model_Absensi', 'absensi');
		$this->load->model('Model_OrtuWali', 'ortu');
		$this->load->model('Model_Rapor', 'rapor');
		$this->load->model('Model_GuruMapel', 'guru_mapel');
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

		$idpeg = $this->session->userdata('peg_id');
		$this->session->set_userdata("judul", "Data Rapor");
		$ba = [
			'judul' => "Data Rapor",
			'subjudul' => "Rapor",
		];
		$d = [
			'rapor' => $this->rapor->get_rapor($idpeg),
			'filterkelas' => $this->guru_mapel->get_filter_kelas(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('rapor', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_peserta_didik($filter)
	{
		$list = $this->rapor->get_datatables($filter);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $peserta_didik) {
			$no++;
			$medali = "";
			$aksi = "";
			if ($this->session->userdata('level') > 2) {
				if ($no == 1) $medali = "<i class='fas fa-crown' style='color: orange;'></i>";
				$aksi = "<a href='#' onClick='sikap_siswa({$peserta_didik->pd_id},{$peserta_didik->ta_id})' class='btn btn-info btn-sm' title='Nilai Sikap'><i class='fa fa-user-edit'></i></a> <a href='#' onClick='ekstrakurikuler({$peserta_didik->pd_id},{$peserta_didik->ta_id})' class='btn btn-info btn-sm' title='Nilai Ekstrakurikuler'><i class='fa fa-drum'></i></a> <a href='#' onClick='absensi({$peserta_didik->pd_id},{$peserta_didik->ta_id})' class='btn btn-info btn-sm' title='Absensi Siswa'><i class='fa fa-calendar-alt'></i></a> <a href='" . base_url('Rapor/cetak_rapor/' . $peserta_didik->pd_id . '/' . $peserta_didik->ta_id) . "' class='btn btn-success btn-sm' target='_blank' title='Cetak Rapor Siswa'><i class='fa fa-print'></i></a>";
			} elseif ($this->session->userdata('level') < 3) {
				$aksi = "<a href='" . base_url('Rapor/cetak_rapor/' . $peserta_didik->pd_id . '/' . $peserta_didik->ta_id) . "' class='btn btn-success btn-sm' target='__blank' title='Cetak Rapor Siswa'><i class='fa fa-print'></i></a>";
			}

			$ambil_jml_mapel = $this->rapor->jumlah_mapel($peserta_didik->kls_tingkat);
			$jml_mapel = count($ambil_jml_mapel);

			$nilai_rata_rapor = 0;
			$total_nilai_rapor = 0;
			$nilai_rapor = $this->rapor->nilai_rata_rapor($peserta_didik->pd_id);
			foreach ($nilai_rapor as $nr) {
				$total_nilai_rapor += $nr->rpr_nilai_akhir;
			}
			$nilai_rata_rapor = $total_nilai_rapor / $jml_mapel;


			$row = array();
			$row[] = $medali . "&nbsp;&nbsp;&nbsp;" . $no;
			$row[] = $peserta_didik->pd_nisn;
			$row[] = $peserta_didik->pd_nama;
			$row[] = $peserta_didik->pd_jk == 1 ? "Laki-laki" : "Perempuan";
			$row[] = $peserta_didik->kls_nama;
			$row[] = $nilai_rata_rapor;
			$row[] = "{$aksi}";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rapor->count_all(),
			"recordsFiltered" => $this->rapor->count_filtered($filter),
			"data" => $data,
			"query" => $this->rapor->getlastquery(),
		);
		//output to json format
		echo json_encode($output);
	}

	public function cari_eskul($id, $ta)
	{
		$data = $this->ekstrakurikuler->cari_ekstrakurikuler($id, $ta);
		if (!$data) $data = 0;
		echo json_encode($data);
	}

	public function cari_absensi($id, $ta)
	{
		$data = $this->absensi->cari_absensi($id, $ta);
		if (!$data) $data = 0;
		echo json_encode($data);
	}

	public function cari_sikap($id, $ta)
	{
		$data = $this->sikap_siswa->cari_sikap($id, $ta);
		if (!$data) $data = 0;
		echo json_encode($data);
	}

	public function simpan_eskul()
	{
		$id = $this->input->post('eks_pd_id');
		$ta = $this->input->post('eks_ta_id');
		$data = $this->input->post();

		$this->ekstrakurikuler->delete('skl_ekstrakurikuler', $id, $ta);
		foreach ($data['eks_nama'] as $idx => $kd) {
			$detail = [
				"eks_nama" => $kd,
				"eks_nilai" => $data['eks_nilai'][$idx],
				"eks_keterangan" => $data['eks_keterangan'][$idx],
				"eks_pd_id" => $data['eks_pd_id'],
				"eks_ta_id" => $data['eks_ta_id'],
			];
			if ($data['eks_nama']) $insert = $this->ekstrakurikuler->simpan("skl_ekstrakurikuler", $detail);
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

	public function simpan_absensi()
	{
		$id = $this->input->post('abs_id');
		$ta = $this->input->post('abs_ta_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->absensi->simpan("skl_absensi_siswa", $data);
		} else {
			$insert = $this->absensi->update("skl_absensi_siswa", array('abs_id' => $id, 'abs_ta_id' => $ta), $data);
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

	public function simpan_nilai_sikap()
	{
		$id = $this->input->post('sks_id');
		$ta = $this->input->post('sks_ta_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->absensi->simpan("skl_sikap_siswa", $data);
		} else {
			$insert = $this->absensi->update("skl_sikap_siswa", array('sks_id' => $id, 'sks_ta_id' => $ta), $data);
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

	public function cetak_rapor($id, $ta)
	{
		$rapor = $this->rapor->cetak_rapor($id);
		$sikap = $this->sikap_siswa->cari_sikap($id, $ta);
		$ekstrakurikuler = $this->ekstrakurikuler->cari_ekstrakurikuler($id, $ta);
		$absensi = $this->absensi->cari_absensi($id, $ta);
		$ortu = $this->ortu->cari_ortu_wali($id, 1);
		$mapel = $this->rapor->ambil_rapor($id);

		$d = [
			'nama_siswa' => $rapor->pd_nama,
			'kelas' => $rapor->kls_nama,
			'wali_kelas' => $rapor->gru_nama,
			'nik_guru' => $rapor->gru_nip,
			'nisn' => $rapor->pd_nisn,
			'semester' => $rapor->ta_semester,
			'tahun_ajaran' => $rapor->ta_tahun,
			'mapel' => $mapel,
			'sikap' => $sikap,
			'ekstrakurikuler' => $ekstrakurikuler,
			'absensi' => $absensi,
			'ortu' => $ortu,
		];
		$this->load->view("cetak_rapor", $d);
	}
}
