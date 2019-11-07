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
			$delete = $this->db->delete("tblinfohargadetail");
			if ( $delete > 0 ) {
				$this->db->where("id_jenis",$id_jenis);
				$delete = $this->db->delete("tbljenis");
				if ( $delete > 0 ) {
					return 0;
				}
			} else {
				return 1;
			}
		} else {
			return 3;
		}
	}

	public function tambah_info_harga($data)
	{
		$tanggal = $data['tanggal'];
		$this->db->insert("tblinfoharga",[ "tanggal" => $tanggal ]);

		$this->db->order_by("id_info","desc");
		$id_info = $this->db->get("tblinfoharga")->result_array()[0]['id_info'];

		foreach ($data as $key => $value) {
			if ( $key != "tanggal" ) {
				$insertdata = [
					"id_info" => $id_info,
					"id_jenis" => $key,
					"harga" => $value
				];
				$insert = $this->db->insert("tblinfohargadetail",$insertdata);
			}
		}

		if ( $insert > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function get_home_statistics()
	{
		$requestpencairan = $this->Func_model->num_rows("tbltransaksi","status","received");
		$lelang = $this->Func_model->num_rows("tblposting","status","not");
		$paymentwaitingconfirm = $this->Func_model->num_rows("tblpayment","status","waiting");

		$arr = [
			"req_pencairan" => $requestpencairan,
			"lelang" => $lelang,
			"payment_waiting_confirm" => $paymentwaitingconfirm
		];

		return $arr;
	}
}