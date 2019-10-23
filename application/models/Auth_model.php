<?php 

class Auth_model extends CI_Model {
	public function user_register($data)
	{
		$username = $data['username'];
		$email = $data['email'];

		$username_check = $this->Func_model->check_availability("tbluser","username",$username);
		if ( $username_check == 3 ) {
			$email_check = $this->Func_model->check_availability("tbluser","email",$email);
			if ( $email_check == 3 ) {
				$insert = $this->db->insert("tbluser",$data);
				if ( $insert > 0 ) {
					return 0;
				} else {
					return 1;
				}
			} else {
				return 202;
			}
		} else {
			return 2;
		}
	}

	public function user_login($data)
	{
		$check = $this->Func_model->check_availability("tbluser","username",$data['username']);
		if ( $check == 2 ) {
			$get = $this->Func_model->get_data("tbluser","username",$data['username']);
			if ( password_verify($data['password'], $get['password']) ) {
				$this->session->set_userdata("user_logged",true);
				$this->session->set_userdata("user_id",$get['id_user']);
				return 0;
			} else {
				return 5;
			}
		} else {
			return 3;
		}
	}
}