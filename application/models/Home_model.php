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

	public function claim_arbitrase($data)
	{
		$transaksi = $this->Lelang_model->get_transaksi($data['id_transaksi']);
		$postingan = $this->Lelang_model->get_lelang($transaksi['id_posting']);
		$buyerinfo = $this->user_info($transaksi['id_buyer']);

		$notif = [
			"id_user" => $transaksi['id_seller'],
			"pesan" => "Buyer ". $buyerinfo['nama'] ." telah melakukan arbitrase pada postingan " . $postingan['judul'] . ". Silahkan lakukan negosiasi pada menu arbitrase di atas",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$notif);


		$this->db->set("status","arbitrase");
		$this->db->where("id_transaksi",$transaksi['id_transaksi']);
		$this->db->update("tbltransaksi");

		$insert = $this->db->insert("tblarbitrase",$data);
		if ( $insert > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function upload_arbitrase_media($photo)
	{
		$id_arbitrase = $this->Func_model->get_last_id("tblarbitrase","id_arbitrase");

		foreach ($photo as $item) {
			$data = [
				"id_arbitrase" => $id_arbitrase,
				"image" => $item
			];

			$this->db->insert("tblarbitrasemedia",$data);
		}
	}

	public function get_arbitrase($id_user,$jenis)
	{
		$returnresult = [];

		$get = $this->db->get("tblarbitrase")->result_array();

		foreach ($get as $row) {
			$get_transaksi = $this->Lelang_model->get_transaksi($row['id_transaksi']);

			if ( $jenis == "penjual" ) {
				if ( $get_transaksi['id_seller'] == $id_user ) {
					array_push($returnresult, $row);
				}
			} elseif ( $jenis == "pembeli" ) {
				if ( $get_transaksi['id_buyer'] == $id_user ) {
					array_push($returnresult, $row);
				}
			}
		}

		return $returnresult;
	}

	public function get_arbitrase_content($id_arbitrase)
	{
		return $this->Func_model->get_data("tblarbitrase","id_arbitrase",$id_arbitrase);
	}

	public function get_conversation($id_arbitrase)
	{
		return $this->Func_model->get_query("tblconversation","id_arbitrase",$id_arbitrase);
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

	public function get_arbitrase_media($id_arbitrase)
	{
		$this->db->where("id_arbitrase",$id_arbitrase);
		return $this->db->get("tblarbitrasemedia")->result_array();
	}
}