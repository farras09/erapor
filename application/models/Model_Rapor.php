<?php
class Model_Rapor extends CI_Model
{
	var $table = 'skl_peserta_didik';
	var $column_order = array('pd_id', 'pd_nipd', 'pd_nama', 'pd_jk', 'pd_hp'); //set column field database for datatable orderable
	var $column_search = array('pd_id', 'pd_nipd', 'pd_nama', 'pd_jk', 'kls_nama', 'pd_hp'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('pd_nama' => 'asc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($filter)
	{
		$idpeg = $this->session->userdata('peg_id');
		$this->db->from("skl_peserta_didik");
		$this->db->join("skl_kelas_siswa", "kss_pd_id = pd_id", "left");
		$this->db->join("skl_kelas", "kls_id = kss_kls_id", "left");
		$this->db->join("skl_nilai_rapor", "rpr_pd_id = pd_id", "left");
		$this->db->join("skl_tahun_ajaran", "ta_id = kss_ta_id", "left");
		$this->db->join("skl_guru_mapel", "gmp_gru_id = gmp_ta", "left");
		$this->db->join("skl_mata_pelajaran", "mpl_id = gmp_mapel", "left");
		$this->db->where("ta_status", 1);
		$this->db->group_by('pd_id');
		$this->db->order_by('rpr_nilai_akhir', 'asc');

		if ($this->session->userdata('level') > 1) {
			if ($this->session->userdata('level') == 3) {
				$this->db->where("kls_wali_kelas", $idpeg);
			}
		}

		if ($filter != 'null') {
			$this->db->where("kls_id", $filter);
		}
		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			foreach ($this->order as $key => $order) {
				$this->db->order_by($key, $order);
			}
		}
	}

	function get_datatables($filter)
	{
		$this->_get_datatables_query($filter);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($filter)
	{
		$this->_get_datatables_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function get_rapor($id)
	{
		$this->db->from("skl_guru_mapel");
		$this->db->join("skl_kelas", "kls_id = gmp_kelas", "left");
		$this->db->join("skl_tahun_ajaran", "ta_id = gmp_ta", "left");
		$this->db->join("skl_guru", "gru_id = gmp_gru_id", "left");
		$this->db->where("gru_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function cetak_rapor($id)
	{
		$this->db->from("skl_peserta_didik");
		$this->db->join("skl_kelas_siswa", "kss_pd_id = pd_id", "left");
		$this->db->join("skl_kelas", "kls_id = kss_kls_id", "left");
		$this->db->join("skl_tahun_ajaran", "ta_id = kss_ta_id", "left");
		$this->db->join("skl_guru", "gru_id = kls_wali_kelas", "left");
		$this->db->where("ta_status", 1);
		$this->db->where("pd_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function ambil_rapor($id)
	{
		$this->db->from("skl_mata_pelajaran");
		$this->db->join("skl_nilai_rapor", "rpr_mpl_id = mpl_id", "left");
		$this->db->join("skl_tahun_ajaran", "ta_id = rpr_ta_id", "left");
		$this->db->join("skl_peserta_didik", "pd_id = rpr_pd_id", "left");
		$this->db->where("ta_status", 1);
		$this->db->where("pd_id", $id);
		$query = $this->db->get();

		return $query->result();
	}

	public function nilai_rata_rapor($id)
	{
		$this->db->from("skl_nilai_rapor");
		$this->db->join("skl_tahun_ajaran", "ta_id = rpr_ta_id", "left");
		$this->db->where("ta_status", 1);
		$this->db->where("rpr_pd_id", $id);
		$query = $this->db->get();

		return $query->result();
	}

	public function jumlah_mapel($tingkat)
	{
		$this->db->from("skl_mata_pelajaran");
		$this->db->where("mpl_tingkat", $tingkat);
		$query = $this->db->get();

		return $query->result();
	}

	public function tanggal($a)
	{
		$arrBulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tgls = explode("-", $a);
		$tgl = $tgls[2];
		$bln = $arrBulan[(int) $tgls[1]];
		$thn = $tgls[0];
		return "$tgl $bln $thn";
	}

	public function getlastquery()
	{
		$query = str_replace(array("\r", "\n", "\t"), '', trim($this->db->last_query()));

		return $query;
	}

	public function update($tbl, $where, $data)
	{
		$this->db->update($tbl, $data, $where);
		return $this->db->affected_rows();
	}

	public function simpan($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function delete($table, $field, $id)
	{
		$this->db->where($field, $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}
}
