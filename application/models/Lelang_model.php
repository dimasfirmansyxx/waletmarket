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
					"jumlah" => str_replace(",", ".", $data[$row["id_jenis"] . "0001"]),
					"harga" => preg_replace("/[^A-Za-z0-9]/", "", $data[$row["id_jenis"] . "0002"]),
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

	public function hapus_keranjang($id_transaksi)
	{
		$this->db->where("id_transaksi",$id_transaksi);
		$this->db->delete("tblpayment");

		$transaksi_info = $this->get_transaksi($id_transaksi);

		$this->db->where("id_transaksi",$id_transaksi);
		$this->db->delete("tbltransaksi");

		$this->db->set("status","not");
		$this->db->where("id_posting",$transaksi_info['id_posting']);
		$this->db->update("tblposting");

		$this->db->where("id_bid",$transaksi_info['id_bid']);
		$delete = $this->db->delete("tblbid");

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
			$postingdetail = $this->get_all_lelang_detail($data['id_posting']);

			$jumlah = 0;
			$berat = 0;
			$ongkir = 0;

			foreach ($postingdetail as $get) {
				if ( $get['id_jenis'] == 6 ) {
					$jumlah = round($get['jumlah']) * $get['harga'];
					$berat = round($get['jumlah']);
				}
			}

			$ongkir = ($berat * 1.3) * 34000;

			$total = $jumlah + $ongkir;

			$input = [
				"id_user" => $data['id_user'],
				"id_posting" => $data['id_posting'],
				"jumlah" => $total,
				"remarks" => ""
			];

			$insert = $this->db->insert("tblbid",$input);

			$this->db->order_by("id_bid","desc");
			$get_id_bid = $this->db->get("tblbid")->result_array()[0]['id_bid'];

			$this->Lelang_model->accept_bid($get_id_bid);

			if ( $insert > 0 ) {
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
		} elseif ( $get_posting['jenis'] == "beli" ) {
			$id_seller = $get_bid['id_user'];
			$id_buyer = $get_posting['id_user'];
			$id_posting = $get_posting['id_posting'];
			$id_bid = $id_bid;
		}

		// change posting status to 'sold'
		$this->db->set("status","sold");
		$this->db->where("id_posting",$id_posting);
		$this->db->update("tblposting");

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

	public function get_all_transaksi($key = null, $value = null)
	{
		if ( !($key == null && $value == null) ) {
			$this->db->where($key,$value);
		}

		return $this->db->get("tbltransaksi")->result_array();
	}

	public function get_transaksi($id_transaksi)
	{
		return $this->Func_model->get_data("tbltransaksi","id_transaksi",$id_transaksi);
	}

	public function get_list_order($id_user)
	{
		$this->db->order_by("id_transaksi","desc");
		$this->db->where("id_seller",$id_user);
		return $this->db->get("tbltransaksi")->result_array();
	}

	public function change_status_transaksi($id_transaksi,$status,$noresi = null,$attach = null)
	{
		$get_transaksi = $this->get_transaksi($id_transaksi);
		$get_bid = $this->bid_info($get_transaksi['id_bid']);
		$get_posting = $this->get_lelang($get_transaksi['id_posting']);

		if ( $status == "deliver" ) {
			$pesan = "Produk " . $get_posting['judul'] . " sedang dalam pengiriman dengan nomor resi $noresi. Berikut dilampirkan Resi, Foto Bahan, serta Video Bahan";
			$id_user = $get_transaksi['id_buyer'];
			$getuser = $this->Home_model->user_info($id_user);
			$media = [
				base_url() . "assets/img/resi/" . $attach[0],
				base_url() . "assets/img/timbangan/" . $attach[1],
				base_url() . "assets/video/bahan/" . $attach[2],
			];
			$this->Func_model->send_mail($getuser['email'],$getuser['nama'],"Produk dalam pengiriman",$pesan,$media);
		} elseif ( $status == "received" ) {
			$pesan = "Produk " . $get_posting['judul'] . " sudah sampai ke buyer, harap tunggu pencairan dana dari Admin";
			$id_user = $get_transaksi['id_seller'];
			$getuser = $this->Home_model->user_info($id_user);

			$this->Func_model->send_mail($getuser['email'],$getuser['nama'],"Produk sudah sampai ke buyer",$pesan);
		}

		$data = [
			"id_user" => $id_user,
			"pesan" => $pesan,
			"link" => "",
			"section" => "",
			"status" => "unread"
		];
		$this->db->insert("tblnotification",$data);

		$this->db->set("status",$status);
		$this->db->where("id_transaksi",$id_transaksi);
		$update = $this->db->update("tbltransaksi");
		if ( $update > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}

	public function change_todeliver($data)
	{
		$this->db->insert("tblpengiriman",$data);
		$attach = [ $data['noresi_photo'], $data['timbangan'], $data['video'] ];
		return $this->change_status_transaksi($data['id_transaksi'],"deliver",$data['noresi'],$attach);
	}

	public function get_info_pengiriman($id_transaksi)
	{
		return $this->Func_model->get_data("tblpengiriman","id_transaksi",$id_transaksi);
	}

	public function get_list_keranjang($id_user)
	{
		$this->db->where("id_buyer",$id_user);
		return $this->db->get("tbltransaksi")->result_array();
	}

	public function get_all_keranjang()
	{
		return $this->db->get("tbltransaksi")->result_array();
	}
}