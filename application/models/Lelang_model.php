<?php 

class Lelang_model extends CI_Model {
	public function get_all_lelang()
	{
		$this->db->where("status","not");
		$this->db->order_by("id_posting","desc");
		return $this->db->get("tblposting")->result_array();
	}

	public function get_lelang($id_posting)
	{
		return $this->Func_model->get_data("tblposting","id_posting",$id_posting);
	}

	public function get_all_lelang_detail($id_posting)
	{
		$this->db->where("id_posting",$id_posting);
		return $this->db->get("tblpostingdetail")->result_array();
	}

	public function get_conversation($id_bid)
	{
		return $this->Func_model->get_query("tblconversation","id_bid",$id_bid);
	}

	public function buat($data)
	{
		$postingdata = [];
		foreach ($data as $key => $value) {
			if ( !is_numeric($key) ) {
				$postingdata[$key] = $value;
			}
		}

		$insert = $this->db->insert("tblposting",$postingdata);
		if ( $insert > 0 ) {
			$this->db->order_by("id_posting","desc");
			$id_info = $this->db->get("tblposting")->result_array()[0]['id_posting'];
			$getjenis = $this->Func_model->get_all_jenis();
			foreach ($getjenis as $row) {
				$postingdetaildata = [
					"id_posting" => $id_info,
					"id_jenis" => $row["id_jenis"],
					"jumlah" => $data[$row["id_jenis"]]
				];
				$insert = $this->db->insert("tblpostingdetail",$postingdetaildata);
			}
			return 0;
		} else {
			return 1;
		}
	}

	public function bid($data)
	{
		$conditioncheck = [
			"id_user" => $data['id_user'],
			"id_posting" => $data['id_posting']
		];
		$check = $this->Func_model->check_availability_multicondition("tblbid",$conditioncheck);
		if ( $check == 3 ) {
			$insert = $this->db->insert("tblbid",$data);
			if ( $insert > 0 ) {
				$get_seller_id = $this->Func_model->get_posting($data['id_posting']);

				return 0;
			} else {
				return 1;
			}
		} else {
			return 2;
		}
	}

	public function bid_info($id_bid)
	{
		return $this->Func_model->get_data("tblbid","id_bid",$id_bid);
	}

	public function send_chat($data)
	{
		$insert = $this->db->insert("tblconversation",$data);
		if ( $insert > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

}