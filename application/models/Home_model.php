<?php 

class Home_model extends CI_Model {
	public function user_info($id_user,$show)
	{
		$get = $this->Func_model->get_data("tbluser","id_user",$id_user);
		return $get[$show];
	}
}