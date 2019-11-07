<?php 

class Payment_model extends CI_Model {
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

	public function get_all_payment($status)
	{
		$this->db->where("status",$status);
		return $this->db->get("tblpayment")->result_array();
	}

	public function get_payment($id_payment)
	{
		$this->db->order_by("id_payment","desc");
		$this->db->where("id_payment",$id_payment);
		return $this->db->get("tblpayment")->result_array()[0];
	}

	public function accept_payment($id_payment)
	{
		$get_payment = $this->get_payment($id_payment);
		$get_transaksi = $this->Lelang_model->get_transaksi($get_payment['id_transaksi']);
		$get_bid = $this->Lelang_model->bid_info($get_transaksi['id_bid']);
		$get_posting = $this->Lelang_model->get_lelang($get_bid['id_posting']);

		// set payment to accepted
		$this->db->set("status","accepted");
		$this->db->where("id_payment",$id_payment);
		$this->db->update("tblpayment");

		// give notification to seller
		$data = [
			"id_user" => $get_transaksi['id_seller'],
			"pesan" => "Tagihan pada bid <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> sudah dibayar oleh Buyer. Silahkan siapkan produk, setelah mengirim barang, ubah status menjadi 'deliver'",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		// give notification to buyer
		$data = [
			"id_user" => $get_transaksi['id_buyer'],
			"pesan" => "Tagihan pada bid <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> telah diterima oleh admin. Produk akan disiapkan oleh seller",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		// set status to prepare
		$this->db->set("status","prepare");
		$this->db->where("id_transaksi",$get_transaksi['id_transaksi']);
		$update = $this->db->update("tbltransaksi");

		if ( $update > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function decline_payment($id_payment)
	{
		$get_payment = $this->get_payment($id_payment);
		$get_transaksi = $this->Lelang_model->get_transaksi($get_payment['id_transaksi']);
		$get_bid = $this->Lelang_model->bid_info($get_transaksi['id_bid']);
		$get_posting = $this->Lelang_model->get_lelang($get_bid['id_posting']);

		// set payment to declined
		$this->db->set("status","declined");
		$this->db->where("id_payment",$id_payment);
		$this->db->update("tblpayment");

		// give notification to seller
		$data = [
			"id_user" => $get_transaksi['id_buyer'],
			"pesan" => "Tagihan pada bid <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> ditolak. Karena tidak memenuhi kriteria",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		// set status to prepare
		$this->db->set("status","waiting");
		$this->db->where("id_transaksi",$get_transaksi['id_transaksi']);
		$update = $this->db->update("tbltransaksi");

		if ( $update > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function pencairan($id_transaksi)
	{
		$get_transaksi = $this->Lelang_model->get_transaksi($id_transaksi);
		$get_posting = $this->Lelang_model->get_lelang($get_transaksi['id_posting']); 

		$notif = [
			"id_user" => $get_transaksi['id_seller'],
			"pesan" => "Dana pada lelang <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> sudah dikirimkan oleh admin.",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$notif);

		$this->db->set("status","success");
		$this->db->where("id_transaksi",$id_transaksi);
		$update = $this->db->update("tbltransaksi");

		if ( $update > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}
}