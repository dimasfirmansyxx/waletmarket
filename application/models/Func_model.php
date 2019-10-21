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

	public function get_jenis($id_jenis)
	{
		return $this->get_data("tbljenis","id_jenis",$id_jenis);
	}

	public function get_all_infoharga()
	{
		$this->db->order_by("id_info","desc");
		return $this->db->get("tblinfoharga")->result_array();
	}

	public function get_info_harga($id_info)
	{
		$this->db->where("id_info",$id_info);
		return $this->db->get("tblinfohargadetail")->result_array();
	}

	public function get_last_infoharga()
	{
		$this->db->order_by("id_info","desc");
		$get = $this->db->get("tblinfoharga")->result_array()[0];
		$result = [
			"tanggal" => $get['tanggal']
		];

		$detail = $this->get_info_harga($get['id_info']);
		foreach ($detail as $row) {
			$getjenis = $this->get_jenis($row['id_jenis']);
			$result[$getjenis['jenis']] = $row['harga'];
		}

		return $result;
	}

}