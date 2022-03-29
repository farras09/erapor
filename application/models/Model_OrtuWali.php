<?php
class Model_OrtuWali extends CI_Model
{
	var $table = 'skl_ortu_wali';
	var $column_order = array('otw_id', 'otw_nama', 'otw_thn_lahir', 'otw_pendidikan', 'otw_penghasilan'); //set column field database for datatable orderable
	var $column_search = array('otw_id', 'otw_nama', 'otw_thn_lahir', 'otw_pendidikan', 'otw_penghasilan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('otw_nama' => 'asc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($id)
	{
		$this->db->from($this->table);
		$this->db->where("otw_pd_id", $id);
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

	function get_datatables($id)
	{
		$this->_get_datatables_query($id);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id)
	{
		$this->_get_datatables_query($id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function get_ortu_wali()
	{
		$this->db->from("skl_ortu_wali");
		$query = $this->db->get();

		return $query->result();
	}

	public function cari_ortu_wali($id, $jenis)
	{
		$this->db->from("skl_ortu_wali");
		$this->db->where('otw_pd_id', $id);
		$this->db->where('otw_jenis', $jenis);
		$query = $this->db->get();

		return $query->row();
	}

	public function cari_wali($id)
	{
		$this->db->from("skl_ortu_wali");
		$this->db->where('otw_id', $id);
		$query = $this->db->get();

		return $query->row();
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
