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
		$arbitrase = $this->Func_model->num_rows("tbltransaksi","status","arbitrase");

		$arr = [
			"req_pencairan" => $requestpencairan,
			"lelang" => $lelang,
			"payment_waiting_confirm" => $paymentwaitingconfirm,
			"arbitrase" => $arbitrase
		];

		return $arr;
	}

	public function get_all_user()
	{
		return $this->db->get("tbluser")->result_array();
	}

	public function reset_password($data)
	{
		$this->db->set("password",$data['password']);
		$this->db->where("id_user",$data['id_user']);
		$update = $this->db->update("tbluser");
		if ( $update > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function get_all_arbitrase()
	{
		$get = $this->db->get("tblarbitrase")->result_array();
		return $get;
	}

	public function arbitrase_final($data)
	{
		$arbitrase = $this->Home_model->get_arbitrase_content($data['id_arbitrase']);
		$transaksi = $this->Lelang_model->get_transaksi($arbitrase['id_transaksi']);
		$postingan = $this->Lelang_model->get_lelang($transaksi['id_posting']);
		$buyer = $this->Home_model->user_info($transaksi['id_buyer']);
		$seller = $this->Home_model->user_info($transaksi['id_seller']);

		$notif = [
			"id_user" => $buyer['id_user'],
			"pesan" => "Komplain pada postingan " . $postingan['judul'] . " telah dinyatakan selesai oleh admin. Dana yang dikembalikan sebesar Rp." . number_format($data['danabuyer']),
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$notif);

		$notif = [
			"id_user" => $seller['id_user'],
			"pesan" => "Komplain pada postingan " . $postingan['judul'] . " telah dinyatakan selesai oleh admin. Dana yang diberikan sebesar Rp." . number_format($data['danaseller']),
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$notif);

		$this->db->set("status","success");
		$this->db->where("id_transaksi",$transaksi['id_transaksi']);
		$this->db->update("tbltransaksi");

		$this->db->where("id_arbitrase",$data['id_arbitrase']);
		$this->db->delete("tblconfirmarbitrase");

		$this->db->where("id_arbitrase",$data['id_arbitrase']);
		$this->db->delete("tblarbitrasemedia");

		$this->db->where("id_arbitrase",$data['id_arbitrase']);
		$this->db->delete("tblconversation");

		$this->db->where("id_arbitrase",$data['id_arbitrase']);
		$delete = $this->db->delete("tblarbitrase");

		if ( $delete > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}
}