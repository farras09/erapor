<?php
class Model_NilaiSiswa extends CI_Model
{
	var $table = 'skl_nilai';
	var $column_order = array('nli_id', 'ta_tahun', 'ta_semester', 'mpl_nama', 'jsn_nama', 'tgs_nama', 'nli_nilai_angka', 'nli_nilai_huruf'); //set column field database for datatable orderable
	var $column_search = array('nli_id', 'ta_tahun', 'ta_semester', 'mpl_nama', 'jsn_nama', 'tgs_nama', 'nli_nilai_angka', 'nli_nilai_huruf'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('nli_id' => 'asc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($id, $filter)
	{
		$this->db->from($this->table);
		$this->db->join("skl_peserta_didik", "pd_id = nli_pd_id", "left");
		$this->db->join("skl_tugas", "tgs_id = nli_tgs_id", "left");
		$this->db->join("skl_tahun_ajaran", "ta_id = tgs_ta_id", "left");
		$this->db->join("skl_mapel_semester", "mps_id = tgs_mps_id", "left");
		$this->db->join("skl_mata_pelajaran", "mpl_id = mps_mpl_id", "left");
		$this->db->join("skl_jenis_nilai", "jsn_id = tgs_jsn_id", "left");
		$this->db->where("nli_pd_id", $id);
		if ($filter != 'null') {
			$this->db->where("ta_id", $filter);
		} else {
			$this->db->where("ta_status", 1);
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

	function get_datatables($id, $filter)
	{
		$this->_get_datatables_query($id, $filter);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id, $filter)
	{
		$this->_get_datatables_query($id, $filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function getlastquery()
	{
		$query = str_replace(array("\r", "\n", "\t"), '', trim($this->db->last_query()));

		return $query;
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function simpan($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function delete($field, $id)
	{
		$this->db->where($field, $id);
		$this->db->delete($this->table);

		return $this->db->affected_rows();
	}
}
