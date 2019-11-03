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

	public function get_user_lelang($id_user)
	{
		$this->db->order_by("id_posting","desc");
		$this->db->where("id_user",$id_user);
		return $this->db->get("tblposting")->result_array();
	}

	public function get_bidder_lelang($id_posting)
	{
		$this->db->order_by("id_bid","desc");
		$this->db->where("id_posting",$id_posting);
		return $this->db->get("tblbid")->result_array();
	}

	public function count_bidder($id_posting)
	{
		$this->db->where("id_posting",$id_posting);
		return $this->db->get("tblbid")->num_rows();
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
		$postingdata["status"] = "not";

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

	public function hapus($id_posting)
	{
		// hapus chat
		$bidder = $this->get_bidder_lelang($id_posting);
		foreach ($bidder as $row) {
			$this->db->where("id_bid",$row['id_bid']);
			$this->db->delete("tblconversation");
		}

		// hapus bid
		$this->db->where("id_posting",$id_posting);
		$this->db->delete("tblbid");

		// hapus detail
		$this->db->where("id_posting",$id_posting);
		$this->db->delete("tblpostingdetail");

		// hapus posting
		$this->db->where("id_posting",$id_posting);
		$delete = $this->db->delete("tblposting");

		if ( $delete > 0 ) {
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

	public function get_user_bid($id_user)
	{
		$this->db->where("id_user",$id_user);
		return $this->db->get("tblbid")->result_array();
	}

	public function accept_bid($id_bid)
	{
		$get_bid = $this->bid_info($id_bid);
		$get_posting = $this->get_lelang($get_bid['id_posting']);

		if ( $get_posting['jenis'] == "jual" ) {
			$id_seller = $get_posting['id_user'];
			$id_buyer = $get_bid['id_user'];
			$id_posting = $get_posting['id_posting'];
			$id_bid = $id_bid;
			$pesan = "Bid anda pada postingan <a href='". base_url() ."bid/conversation/". $id_bid ."' target='_blank'>". $get_posting['judul'] ."</a> dipilih sebagai pemenang. Silahkan lakukan pembayaran melalui menu 'Transaksi' diatas";
		} elseif ( $get_posting['jenis'] == "beli" ) {
			$id_seller = $get_bid['id_user'];
			$id_buyer = $get_posting['id_user'];
			$id_posting = $get_posting['id_posting'];
			$id_bid = $id_bid;
			$pesan = "Lelang anda <a href='". base_url() ."bid/conversation/". $id_bid ."' target='_blank'>". $get_posting['judul'] ."</a> sudah dipilih pemenangnya. Silahkan lakukan pembayaran melalui menu 'Transaksi' diatas";
		}

		// change posting status to 'sold'
		$this->db->set("status","sold");
		$this->db->where("id_posting",$id_posting);
		$this->db->update("tblposting");

		// give notification for buyer to do payment
		$data = [
			"id_user" => $id_buyer,
			"pesan" => $pesan,
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		// insert data to 'tbltransaksi'
		$data = [
			"id_seller" => $id_seller,
			"id_buyer" => $id_buyer,
			"id_posting" => $id_posting,
			"id_bid" => $id_bid,
			"status" => "waiting"
		];
		$insert = $this->db->insert("tbltransaksi",$data);
		
		if ( $insert > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function get_user_transaksi($id_user)
	{
		$this->db->order_by("id_transaksi","desc");
		$this->db->where("id_buyer",$id_user);	
		return $this->db->get("tbltransaksi")->result_array();
	}

	public function do_payment($data)
	{
		$conditioncheck = [
			"id_transaksi" => $data['id_transaksi'],
			"id_user" => $data['id_user'],
			"status" => "waiting"
		];
		$check = $this->Func_model->check_availability_multicondition("tblpayment",$conditioncheck);
		if ( $check == 2 ) {
			return 2;
		} else {
			$this->db->set("status","verifying");
			$this->db->where("id_transaksi",$data['id_transaksi']);
			$this->db->update("tbltransaksi");

			$insert = $this->db->insert("tblpayment",$data);

			if ( $insert > 0  ) {
				return 0;
			} else {
				return 1;
			}
		}
	}

}