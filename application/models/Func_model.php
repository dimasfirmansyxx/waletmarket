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

	public function check_availability_edit($table,$key,$value,$verif,$verifvalue)
	{
		$this->db->where($key,$value);
		$count = $this->db->count_all_results($table);
		if ( $count > 0 ) {
			$get = $this->get_data($table,$key,$value);
			if ( $get[$verif] == $verifvalue ) {
				return 3;
			} else {
				return 2;
			}
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

	public function get_all_jenis()
	{
		return $this->db->get("tbljenis")->result_array();
	}

}