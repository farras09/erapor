<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		$this->load->model('Model_Dashboard', 'dashboard');
		$this->load->model('Model_TahunAjaran', 'ta');
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
	public function index()
	{
		redirect(base_url("Dashboard/tampil"));
	}
	public function tampil()
	{
		$userr = $this->session->userdata('log_nama');
		$ba = [
			'judul' => "Dashboard",
			'subjudul' => "",
		];

		$d = [
			'guru' => $this->dashboard->get_guru(),
			'peserta_didik' => $this->dashboard->get_peserta_didik(),
			'kelas' => $this->dashboard->get_kelas(),
			'mapel' => $this->dashboard->get_mapel(),
			'ta' => $this->ta->get_all_tahun_ajaran(),
		];

		$this->load->view('background_atas', $ba);
		$this->load->view('dashboard', $d);
		$this->load->view('background_bawah');
	}

	public function get_siswa($thn)
	{
		$dsiswa = $this->dashboard->grafik_siswa($thn);
		$data1 = array();
		$data2 = array();
		$label = array();

		foreach ($dsiswa["siswa"] as $sw) {
			$data1[] = $sw['jml_siswa'];
			$label[] = "Kelas " . $sw['kelas'];
		}
		echo json_encode(array("data1" => $data1, "label" => $label));
	}

	public function get_gurubidang($thn)
	{
		$dguru = $this->dashboard->grafik_guru($thn);
		$data1 = array();
		$data2 = array();
		$label = array();

		foreach ($dguru["guru"] as $g) {
			$data1[] = $g['jml_guru'];
			$label[] = $g['bidang_study'];
		}
		echo json_encode(array("data1" => $data1, "label" => $label));
	}
}
