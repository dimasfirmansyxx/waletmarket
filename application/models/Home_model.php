<?php 

class Home_model extends CI_Model {
	public function user_info($id_user,$show = null)
	{
		$get = $this->Func_model->get_data("tbluser","id_user",$id_user);
		if ( $show == null ) {
			return $get;
		} else {
			return $get[$show];
		}
	}

	public function get_notification($id_user)
	{
		$this->db->order_by("id_notif","desc");
		$this->db->where("id_user",$id_user);
		$this->db->where("status","unread");
		return $this->db->get("tblnotification")->result_array();
	}

	public function user_rekening($id_user)
	{
		return $this->Func_model->get_data("tblrekening","id_user",$id_user);
	}

	public function edit_profil($general = null, $rekening = null,$id_user = null)
	{
		if ( !($general == null) ) {
			$this->db->where("id_user",$id_user);
			$updategeneral = $this->db->update("tbluser",$general);
		} 

		if ( !($rekening == null) ) {
			$check = $this->Func_model->check_availability("tblrekening","id_user",$id_user);
			if ( $check == 2 ) {
				$this->db->where("id_user",$id_user);
				$this->db->update("tblrekening",$rekening);
			} else {
				$rekening["id_user"] = $id_user;
				$this->db->insert("tblrekening",$rekening);
			}
		}

		if ( $updategeneral > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function clear_notif($id_notif)
	{
		$this->db->where("id_notif",$id_notif);
		$this->db->set("status","read");
		$this->db->update("tblnotification");
	}

	public function get_page($link)
	{
		return $this->Func_model->get_data("tblpage","link",$link);
	}
}