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

	public function tambah_jenis($data)
	{
		$check = $this->Func_model->check_availability("tbljenis","jenis",$data['jenis']);
		if ( $check == 3 ) {
			$insert = $this->db->insert("tbljenis",$data);
			if ( $insert > 0 ) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 2;
		}
	}

	public function edit_jenis($data)
	{
		$check = $this->Func_model->check_availability_edit("tbljenis","jenis",$data['jenis'],"id_jenis",$data['id_jenis']);
		if ( $check == 3 ) {
			$setdata = [
				"jenis" => $data['jenis'],
				"satuan" => $data['satuan']
			];
			$this->db->set($setdata);
			$this->db->where("id_jenis",$data['id_jenis']);
			$update = $this->db->update("tbljenis");
			if ( $update > 0 ) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 2;
		}
	}

	public function delete_jenis($id_jenis)
	{
		$check = $this->Func_model->check_availability("tbljenis","id_jenis",$id_jenis);
		if ( $check == 2 ) {
			$this->db->where("id_jenis",$id_jenis);
			$delete = $this->db->delete("tbljenis");
			if ( $delete > 0 ) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 3;
		}
	}
}