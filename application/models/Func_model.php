<?php 

class Func_model extends CI_Model {
	public function check_availability($table,$key,$value)
	{
		$this->db->where($key,$value);
		$row = $this->db->count_all_results($table);
		if ( $row > 0 ) {
			return 2;
		} else {
			return 3;
		}
	}

	public function get_data($table,$key,$value)
	{
		$this->db->where($key,$value);
		return $this->db->get($table)->result_array()[0];
	}

	public function site_info($show)
	{
		$this->db->where("info",$show);
		return $this->db->get("tblsiteinfo")->result_array()[0]['value'];
	}
}