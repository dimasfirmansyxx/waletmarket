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
		return $this->db->get("tblnotification")->result_array();
	}
}