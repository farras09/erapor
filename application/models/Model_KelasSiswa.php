<?php
class Model_KelasSiswa extends CI_Model
{
	var $table = 'skl_kelas_siswa';
	var $column_order = array('kss_id', 'kss_pd_id', 'kss_kls_id', 'kss_ta_id'); //set column field database for datatable orderable
	var $column_search = array('kss_id', 'kss_pd_id', 'kss_kls_id', 'kss_ta_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('kss_id' => 'asc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($id, $id_ta)
	{
		$this->db->from($this->table);
		$this->db->join("skl_peserta_didik", "pd_id = kss_pd_id", "left");
		$this->db->join("skl_kelas", "kls_id = kss_kls_id", "left");

		$this->db->where("kss_kls_id", $id);
		if ($id_ta != 'null') {
			$this->db->where("kss_ta_id", $id_ta);
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

	function get_datatables($id, $id_ta)
	{
		$this->_get_datatables_query($id, $id_ta);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id, $id_ta)
	{
		$this->_get_datatables_query($id, $id_ta);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		return $this->db->count_all_results();
	}

	public function ambil_data($ta, $kls)
	{
		$this->db->from("skl_kelas_siswa");
		$this->db->where("kss_ta_id", $ta);
		$this->db->where("kss_kls_id", $kls);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_kelas_siswa($id)
	{
		$this->db->from("skl_kelas_siswa");
		$this->db->join("skl_peserta_didik", "pd_id = kss_pd_id", "left");
		$this->db->where("kss_kls_id", $id);
		$query = $this->db->get();

		return $query->result();
	}

	public function cek_kelas_siswa()
	{
		$this->db->from("skl_kelas_siswa");
		$query = $this->db->get();

		return $query->row();
	}

	public function cek_siswa($id)
	{
		$this->db->select("kss_pd_id");
		$this->db->from("skl_kelas_siswa");
		$this->db->where("kss_pd_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function cari_kelas_siswa($id)
	{
		$this->db->from("skl_kelas_siswa");
		$this->db->where('kss_id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_jml_siswa($id)
	{
		$this->db->from("skl_kelas_siswa");
		$this->db->join("skl_tahun_ajaran", "ta_id = kss_ta_id", "left");
		$this->db->where("kss_kls_id", $id);
		$this->db->where("ta_status", 1);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function ambil_siswa($id, $ta)
	{
		$this->db->from("skl_kelas_siswa");
		$this->db->join("skl_tahun_ajaran", "ta_id = kss_ta_id", "left");
		$this->db->where("kss_kls_id", $id);
		$this->db->where("ta_id", $ta);
		$query = $this->db->get();

		return $query->num_rows();
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
