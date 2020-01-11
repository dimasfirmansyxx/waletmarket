<?php 

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->model("Home_model");
		$this->load->model("Payment_model");
		$this->load->model("Lelang_model");

		if ( $this->uri->segment(1) == null ) {
			redirect( base_url() . "home" );
		}
	}

	public function index()
	{
		$data['page_title'] = "Beranda";
		$data['infoharga'] = $this->Func_model->get_last_infoharga();
		$data['posting'] = $this->Lelang_model->get_all_lelang();
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/templates/aside");
		$this->load->view("home/home");
		$this->load->view("home/templates/footer");
	}

	public function page($link)
	{
		$data['artikel'] = $this->Home_model->get_page($link);
		$data['page_title'] = $data['artikel']['judul'];
		$data['jumbo_title'] = $data['artikel']['judul'];
		$data['infoharga'] = $this->Func_model->get_last_infoharga();
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/templates/aside");
		$this->load->view("home/page");
		$this->load->view("home/templates/footer");
	}

	public function register()
	{
		$data = [
			"nama" => $this->input->post("nama",true),
			"username" => strtolower($this->input->post("username",true)),
			"password" => password_hash($this->input->post("password",true), PASSWORD_DEFAULT),
			"email" => $this->input->post("email",true),
			"nohp" => $this->input->post("nohp",true),
			"alamat" => $this->input->post("alamat",true),
			"kota" => $this->input->post("kota",true),
			"provinsi" => $this->input->post("provinsi",true)
		];

		echo $this->Auth_model->user_register($data);
	}

	public function login()
	{
		$data = [
			"username" => $this->input->post("username",true),
			"password" => $this->input->post("password",true),
			"jenis" => $this->input->post("jenis",true)
		];

		echo $this->Auth_model->user_login($data);
	}

	public function logout()
	{
		$this->session->unset_userdata("user_logged");
		$this->session->unset_userdata("user_id");
		$this->session->unset_userdata("user_jenis");
		redirect( base_url() . "home" );
	}

	public function lelang()
	{
		$url = $this->uri->segment(3);
		if ( $url == "buat" ) {
			$photo = $this->Func_model->upload_files("photo","img/post/",["jpg","jpeg","png","bmp"]);
			if ( $photo == 4 ) {
				echo 401;
			} else {
				$video = $this->Func_model->upload_files("video","video/post/",["mp4","mkv","avi","3gp"]);
				if ( $video == 4 ) {
					echo 402;
				} else {
					$data = [
						"judul" => $this->input->post("judul",true),
						"id_user" => $this->session->user_id,
						"warna" => $this->input->post("warna",true),
						"kadar" => $this->input->post("kadar",true),
						"remarks" => $this->input->post("remarks",true),
						"photo" => $photo,
						"video" => $video,
						"status" => "nonverif",
						"jenis" => "jual"
					];
					foreach ($this->Func_model->get_all_jenis() as $jenis) {
						$data[$jenis['id_jenis'] . "0001"] = $this->input->post($jenis['id_jenis'] . "0001",true);
						$data[$jenis['id_jenis'] . "0002"] = $this->input->post($jenis['id_jenis'] . "0002",true);
					}

					echo $this->Lelang_model->buat($data);
				}
			}
		} elseif ( $url == "bid" ) {
			$data = [
				"id_user" => $this->input->post("id_user",true),
				"id_posting" => $this->input->post("id_posting",true),
				"jumlah" => str_replace(".", "", $this->input->post("jumlah",true)),
				"remarks" => $this->input->post("remarks",true)
			];

			echo $this->Lelang_model->bid($data);
		} elseif ( $url == "hapus" ) {
			$id_posting = $this->input->post("id_posting",true);
			echo $this->Lelang_model->hapus($id_posting);
		}
	}

	public function transaksi($param)
	{
		if ( $param == "pesan" ) {
			$data = [
				"id_user" => $this->input->post("id_user",true),
				"id_posting" => $this->input->post("id_posting",true),
				"jumlah" => "",
				"remarks" => ""
			];

			echo $this->Lelang_model->bid($data);
		}
	}

	public function get_my_lelang($id_user)
	{
		$data["page_title"] = "my_lelang";
		$data["get_data"] = $this->Lelang_model->get_user_lelang($id_user);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/lelang_show");
	}

	public function get_bidder($id_posting)
	{
		$data["page_title"] = "get_bidder";
		$data["get_data"] = $this->Lelang_model->get_bidder_lelang($id_posting);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/bid_show");
	}

	public function get_my_bid($id_user)
	{
		$data["page_title"] = "my_bid";
		$data["get_data"] = $this->Lelang_model->get_user_bid($id_user);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/mybid_show");
	}

	public function transaksi_show($id_user)
	{
		$data["page_title"] = "transaksi_show";
		$data["get_data"] = $this->Lelang_model->get_user_transaksi($id_user);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/transaksi_show");
	}

	public function do_payment()
	{
		$bukti = $this->Func_model->upload_files("bukti","img/payment/",["jpg","jpeg","png","bmp"]);
		if ( $bukti == 4 ) {
			echo 4;
		} else {
			$data = [
				"id_transaksi" => $this->input->post("id_transaksi",true),
				"id_user" => $this->input->post("id_user",true),
				"bankname" => $this->input->post("bankname",true),
				"norek" => $this->input->post("norek",true),
				"an" => $this->input->post("an",true),
				"jumlah" => str_replace(".", "", $this->input->post("jumlah",true)),
				"bukti" => $bukti,
				"status" => "waiting"
			];
			echo $this->Payment_model->do_payment($data);
		}
	}

	public function order_show($id_user)
	{
		$data["page_title"] = "order_show";
		$data["get_data"] = $this->Lelang_model->get_list_order($id_user);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/order_show");
	}

	public function change_status_transaksi($status)
	{
		$id_transaksi = $this->input->post("id_transaksi",true);
		echo $this->Lelang_model->change_status_transaksi($id_transaksi,$status);
	}

	public function change_todeliver()
	{
		$noresi_photo = $this->Func_model->upload_files("noresi_photo","img/resi/",["jpg","jpeg","png","bmp"]);
		if ( $noresi_photo == 4 ) {
			echo 401;
		} else {
			$timbangan = $this->Func_model->upload_files("timbangan","img/timbangan/",["jpg","jpeg","png","bmp"]);
			if ( $timbangan == 4 ) {
				echo 401;
			} else {
				$video = $this->Func_model->upload_files("video","video/bahan/",["mp4","3gp","mkv","mov"]);
				if ( $video == 4 ) {
					echo 402;
				} else {
					$data = [
						"id_transaksi" => $this->input->post("id_transaksi",true),
						"noresi" => $this->input->post("noresi",true),
						"noresi_photo" => $noresi_photo,
						"timbangan" => $timbangan,
						"video" => $video
					];	
					echo $this->Lelang_model->change_todeliver($data);
				}
			}
		}
	}

	public function keranjang_show($id_user)
	{
		$data["page_title"] = "order_show";
		$data["get_data"] = $this->Lelang_model->get_list_keranjang($id_user);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/keranjang_show");
	}

	public function delete_keranjang()
	{
		$id_transaksi = $this->input->post("id_transaksi",true);
		echo $this->Lelang_model->hapus_keranjang($id_transaksi);
	}

	public function infopengiriman_show($id_transaksi)
	{
		$data["page_title"] = "infopengiriman_show";
		$data["get_data"] = $this->Lelang_model->get_info_pengiriman($id_transaksi);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/infopengiriman_show");
	}

	public function save_user_profil()
	{
		$general = [
			"nama" => $this->input->post("nama",true),
			"nohp" => $this->input->post("nohp",true),
			"alamat" => $this->input->post("alamat",true),
			"kota" => $this->input->post("kota",true),
			"provinsi" => $this->input->post("provinsi",true)
		];

		$bank = [
			"bankname" => $this->input->post("bankname",true),
			"norek" => $this->input->post("norek",true),
			"an" => $this->input->post("an",true)
		];

		$id_user = $this->input->post("id_user",true);

		echo $this->Home_model->edit_profil($general,$bank,$id_user);
	}

	public function clear_notif()
	{
		$id_notif = $this->input->post("id_notif",true);
		$this->Home_model->clear_notif($id_notif);
	}

	public function get_detail_price()
	{
		$id_transaksi = $this->input->post("id_transaksi",true);

		$transaksi_info = $this->Lelang_model->get_transaksi($id_transaksi);
		$bid_info = $this->Lelang_model->bid_info($transaksi_info['id_bid']);
		$posting_info = $this->Lelang_model->get_lelang($transaksi_info['id_posting']);
		$posting_detail = $this->Lelang_model->get_all_lelang_detail($transaksi_info['id_posting']);

		$harga = 0;
		$berat = 0;
		$fee = 0;
		$ongkir = 0;

		foreach ($posting_detail as $get) {
			if ( $get['id_jenis'] == 6 ) {
				$harga = round($get['jumlah']) * $get['harga'];
				$berat = round($get['jumlah']);
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

		$return = ["subtotal" => $harga, "fee" => $fee, "ongkir" => $ongkir, "berat" => $berat, "total" => $total];
		echo json_encode($return);
	}

	public function edit($id_posting)
	{
		$data['page_title'] = "Beranda";
		$data['infoharga'] = $this->Func_model->get_last_infoharga();
		$data['posting'] = $this->Lelang_model->get_lelang($id_posting);
		$data['posting_detail'] = $this->Lelang_model->get_all_lelang_detail($id_posting);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/templates/aside");
		$this->load->view("home/home_penjual_edit");
		$this->load->view("home/templates/footer");
	}

	public function arbitrase($param)
	{
		if ( $param == "claim" ) {
			$photo = $this->Func_model->multipleupload_files("bukti","img/arbitrase/",["jpg","jpeg","png","bmp"]);
			$id_transaksi = $this->input->post("id_transaksi",true);

			if ( $photo == 4 ) {
				echo 4;
			} else {
				if ( $this->Func_model->check_availability("tblarbitrase","id_transaksi",$id_transaksi) == 2 ) {
					echo 2;
				} else {
					$data = [
						"id_transaksi" => $this->input->post("id_transaksi",true),
						"remarks" => $this->input->post("remarks",true)
					];

					echo $this->Home_model->claim_arbitrase($data);

					$this->Home_model->upload_arbitrase_media($photo);
				}
			}
		} elseif ( $param == "view" ) {
			$data["page_title"] = "arbitrase_show";
			$data["get_data"] = $this->Home_model->get_arbitrase($this->session->user_id,$this->session->user_jenis);
			$this->load->view("home/templates/head",$data);
			$this->load->view("home/arbitrase_show");
		}
	}
}