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
			$get_transaksi = $this->Lelang_model->get_transaksi($data['id_transaksi']);
			$get_bid = $this->Lelang_model->bid_info($get_transaksi['id_bid']);

			if ( $data['jumlah'] < $get_bid['jumlah'] ) {
				return 5;
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
			"pesan" => "Tagihan pada <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> sudah dibayar oleh Buyer. Silahkan siapkan produk, setelah mengirim barang, ubah status menjadi 'deliver'",
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		// give notification to buyer
		$data = [
			"id_user" => $get_transaksi['id_buyer'],
			"pesan" => "Tagihan pada <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> telah diterima oleh admin. Produk akan disiapkan oleh seller",
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
			"pesan" => "Tagihan pada <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> ditolak. Karena tidak memenuhi kriteria",
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
		$bid_info = $this->Lelang_model->bid_info($get_transaksi['id_bid']);
		$get_posting = $this->Lelang_model->get_lelang($get_transaksi['id_posting']); 
		$posting_detail = $this->Lelang_model->get_all_lelang_detail($get_transaksi['id_posting']);

		$harga = 0;
		$berat = 0;
		$fee = 0;
		$ongkir = 0;

		foreach ($posting_detail as $get) {
			if ( $get['id_jenis'] == 6 ) {
				$harga = $get['jumlah'] * $get['harga'];
				$berat = $get['jumlah'];
			}
		}

		if ( $harga >= 100000000 ) {
			$fee = 3;
		} else {
			if ( $berat >= 10 ) {
				$fee = 3;
			} else {
				$fee = 5;
			}
		}
		$fee = $harga * $fee / 100;

		$ongkir = ($berat * 1.3) * 34000;

		$total = $bid_info['jumlah'];

		$totalpencairan = $total - $fee;

		$notif = [
			"id_user" => $get_transaksi['id_seller'],
			"pesan" => "Dana pada postingan <a href='". base_url() ."bid/conversation/". $get_transaksi['id_bid'] ."' target='_blank'>". $get_posting['judul'] ."</a> sudah dikirimkan oleh admin sebesar Rp." . number_format($totalpencairan) . ",- dan telah di potong fee sebesar Rp." . number_format($fee) . ",-.",
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