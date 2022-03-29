<?php
class Model_Dashboard extends CI_Model
{
	public function get_guru()
	{
		$this->db->from("skl_guru");
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_peserta_didik()
	{
		$this->db->from("skl_peserta_didik");
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_kelas()
	{
		$this->db->from("skl_kelas");
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_mapel()
	{
		$this->db->from("skl_mata_pelajaran");
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function getlastquery()
	{
		$query = str_replace(array("\r", "\n", "\t"), '', trim($this->db->last_query()));

		return $query;
	}
}
