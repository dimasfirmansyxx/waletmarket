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
			"password" => $this->input->post("password",true)
		];

		echo $this->Auth_model->user_login($data);
	}

	public function logout()
	{
		$this->session->unset_userdata("user_logged");
		$this->session->unset_userdata("user_id");
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
						"jenis" => $this->input->post("jenis",true)
					];
					foreach ($this->Func_model->get_all_jenis() as $jenis) {
						$data[$jenis['id_jenis']] = $this->input->post($jenis['id_jenis'],true);
					}

					echo $this->Lelang_model->buat($data);
				}
			}
		} elseif ( $url == "bid" ) {
			$data = [
				"id_user" => $this->input->post("id_user",true),
				"id_posting" => $this->input->post("id_posting",true),
				"jumlah" => $this->input->post("jumlah",true),
				"remarks" => $this->input->post("remarks",true)
			];

			echo $this->Lelang_model->bid($data);
		} elseif ( $url == "hapus" ) {
			$id_posting = $this->input->post("id_posting",true);
			echo $this->Lelang_model->hapus($id_posting);
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
				"jumlah" => $this->input->post("jumlah",true),
				"bukti" => $bukti,
				"status" => "waiting"
			];
			echo $this->Payment_model->do_payment($data);
		}
	}
}