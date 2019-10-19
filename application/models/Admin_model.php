<?php 

class Admin_model extends CI_Model {
	public function login_check($data)
	{
		$check = $this->Func_model->check_availability("tbladmin","username",$data['username']);
		if ( $check == 2 ) {
			$get = $this->Func_model->get_data("tbladmin","username",$data['username']);
			if ( password_verify($data['password'], $get['password']) ) {
				$this->session->set_userdata("admin_logged",true);
				$this->session->set_userdata("admin_id",$get['id']);
				return 0;
			} else {
				return 5;
			}
		} else {
			return 3;
		}
	}

	public function admin_info($id_admin,$show)
	{
		$get = $this->Func_model->get_data("tbladmin","id",$id_admin);
		return $get[$show];
	}
}