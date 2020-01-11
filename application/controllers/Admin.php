<?php 

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Admin_model");
		$this->load->model("Payment_model");
		$this->load->model("Home_model");
		$this->load->model("Lelang_model");

		if ( !$this->session->admin_logged ) {
			if ( !$this->uri->segment(2) == "login" ) {
				redirect( base_url() . "admin/login" );
			}
		}

		if ( $this->session->admin_logged ) {
			if ( $this->uri->segment(2) == "login" ) {
				redirect( base_url() . "admin" );
			}
		}
	}

	public function index()
	{
		$data['page_title'] = "Beranda";
		$data['statistic_info'] = $this->Admin_model->get_home_statistics();
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/templates/header");
		$this->load->view("admin/home");
		$this->load->view("admin/templates/footer");
	}

	public function login()
	{
		$data['page_title'] = "Login";
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/login");
	}

	public function login_check()
	{
		$data = [
			"username" => $this->input->post("username",true),
			"password" => $this->input->post("password",true)
		];

		echo $this->Admin_model->login_check($data);
	}

	public function logout()
	{
		$this->session->unset_userdata("admin_logged");	
		$this->session->unset_userdata("admin_id");
		redirect( base_url() . "admin/login" );	
	}

	public function infoharga()
	{
		$url = $this->uri->segment(3);
		$data['jenis'] = $this->Func_model->get_all_jenis();
		if ( $url == "tambah" ) {
			$data = [
				"tanggal" => $this->input->post("tanggal",true),
			];
			foreach ($this->Func_model->get_all_jenis() as $jenis) {
				$rangeawal =  $this->input->post($jenis['id_jenis'] . "awal",true);
				$rangeakhir =  $this->input->post($jenis['id_jenis'] . "akhir",true);
				$finalrange = "Rp." . $rangeawal . " - " . "Rp." . $rangeakhir;
				$data[$jenis['id_jenis']] = $finalrange;
			}

			echo $this->Admin_model->tambah_info_harga($data);
		} else {
			$data['page_title'] = "Update Info Harga";
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/templates/header");
			$this->load->view("admin/infoharga",$data);
			$this->load->view("admin/templates/footer");
		}
	}

	public function infoharga_data()
	{
		$data['page_title'] = "get_all_infoharga";
		$data['datas'] = $this->Func_model->get_all_infoharga();
		$data['jenis'] = $this->Func_model->get_all_jenis();
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/infoharga_data",$data);
	}

	public function jenis()
	{
		$url = $this->uri->segment(3);
		if ( $url == "tambah" ) {
			$data = [
				"jenis" => strtolower($this->input->post("jenis",true)),
				"satuan" => $this->input->post("satuan",true)
			];
			echo $this->Admin_model->tambah_jenis($data);
		} elseif ( $url == "get_jenis" ) {
			$id_jenis = $this->input->post("id",true);
			echo json_encode($this->Func_model->get_data("tbljenis","id_jenis",$id_jenis));
		} elseif ( $url == "edit" ) {
			$data = [
				"id_jenis" => $this->input->post("id_jenis",true),
				"jenis" => strtolower($this->input->post("jenis",true)),
				"satuan" => $this->input->post("satuan",true)
			];

			echo $this->Admin_model->edit_jenis($data);
		} elseif ( $url == "delete" ) {
			$id_jenis = $this->input->post("id",true);
			echo $this->Admin_model->delete_jenis($id_jenis);
		} else {
			$data['page_title'] = "Jenis";
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/templates/header");
			$this->load->view("admin/jenis");
			$this->load->view("admin/templates/footer");
		}
	}

	public function jenis_data()
	{
		$data['page_title'] = "get_all_jenis";
		$data['datas'] = $this->Func_model->get_all_jenis();
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/jenis_data");
	}

	public function payment()
	{
		$data['page_title'] = "Konfirmasi Pembayaran";
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/templates/header");
		$this->load->view("admin/payment");
		$this->load->view("admin/templates/footer");
	}

	public function payment_data()
	{
		$data['page_title'] = "get_all_jenis";
		$data['datas'] = $this->Payment_model->get_all_payment("waiting");
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/payment_data");
	}

	public function payment_check($status)
	{
		if ( $status == "accept" ) {
			$id_payment = $this->input->post("id_payment",true);
			echo $this->Payment_model->accept_payment($id_payment);
		} elseif ( $status == "decline" ) {
			$id_payment = $this->input->post("id_payment",true);
			echo $this->Payment_model->decline_payment($id_payment);
		}
	}

	public function pencairan($param = null)
	{
		if ( $param == null ) {
			$data['page_title'] = "Pencairan dana";
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/templates/header");
			$this->load->view("admin/pencairan");
			$this->load->view("admin/templates/footer");
		} elseif ( $param == "selesai" ) {
			$id_transaksi = $this->input->post("id_transaksi",true);
			echo $this->Payment_model->pencairan($id_transaksi);
		}
	}

	public function pencairan_data()
	{
		$data['page_title'] = "get_pencairan";
		$data['datas'] = $this->Lelang_model->get_all_transaksi("status","received");
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/pencairan_data");
	}

	public function pencairan_info($info,$param)
	{
		if ( $info == "user" ) {
			$id_user = $param;
			$data['page_title'] = "get_user_info";
			$data['user_info'] = $this->Home_model->user_info($id_user);
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/pencairan_user_info");
		} elseif ( $info == "rekening" ) {
			$id_user = $param;
			$data['page_title'] = "get_user_rekening";
			$data['user_info'] = $this->Home_model->user_rekening($id_user);
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/pencairan_rek_info");
		}
	}

	public function pengguna($param = null)
	{
		if ( $param == "resetpassword" ) {
			$data = [
				"id_user" => $this->input->post("id_user",true),
				"password" => password_hash($this->input->post("password",true), PASSWORD_DEFAULT)
			];

			echo $this->Admin_model->reset_password($data);
		} elseif ( $param == "bankinfo" ) {
			echo json_encode($this->Home_model->user_rekening($this->input->post("id_user",true)));
		} else {
			$data['page_title'] = "Pengguna";
			$data['get_data'] = $this->Admin_model->get_all_user();
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/templates/header");
			$this->load->view("admin/pengguna");
			$this->load->view("admin/templates/footer");
		}
	}

	public function arbitrase($param = null, $id_arbitrase = null)
	{
		if ( $param == null ) {
			$data['page_title'] = "Komplain";
			$this->load->view("admin/templates/head",$data);
			$this->load->view("admin/templates/header");
			$this->load->view("admin/arbitrase");
			$this->load->view("admin/templates/footer");
		} elseif ( $param == "chat" ) {
			if ( $id_arbitrase == null ) {
				redirect( base_url() . "admin/arbitrase" );
			} else {
				$data['page_title'] = "Komplain";
				$data['convers_data'] = $this->Home_model->get_conversation($id_arbitrase);
				$data['arbitrase_data'] = $this->Home_model->get_arbitrase_content($id_arbitrase);
				$data['transaksi_info'] = $this->Lelang_model->get_transaksi($data['arbitrase_data']['id_transaksi']);
				$data['buyer_info'] = $this->Home_model->user_info($data['transaksi_info']['id_buyer']);
				$data['seller_info'] = $this->Home_model->user_info($data['transaksi_info']['id_seller']);
				$data['media'] = $this->Home_model->get_arbitrase_media($id_arbitrase);
				$this->load->view("admin/templates/head",$data);
				$this->load->view("admin/templates/header");
				$this->load->view("admin/arbitrase_chat");
				$this->load->view("admin/templates/footer");
			}
		} elseif ( $param == "chat_conversation" ) {
			if ( $id_arbitrase == null ) {
				redirect( base_url() . "admin/arbitrase" );
			} else {
				$data['page_title'] = "chat_conversation";
				$data['arbitrase_data'] = $this->Home_model->get_arbitrase_content($id_arbitrase);
				$data['transaksi_info'] = $this->Lelang_model->get_transaksi($data['arbitrase_data']['id_transaksi']);
				$data['convers_data'] = $this->Home_model->get_conversation($id_arbitrase);
				$data['buyer_info'] = $this->Home_model->user_info($data['transaksi_info']['id_buyer']);
				$data['seller_info'] = $this->Home_model->user_info($data['transaksi_info']['id_seller']);
				$this->load->view("admin/templates/head",$data);
				$this->load->view("admin/chat_conversation");
			}
		} elseif ( $param == "finish" ) {
			$data = [
				"id_arbitrase" => $this->input->post("id_arbitrase",true),
				"danabuyer" => str_replace(".", "", $this->input->post("buyer",true)),
				"danaseller" => str_replace(".", "", $this->input->post("seller",true))
			];

			echo $this->Admin_model->arbitrase_final($data);
		}
	}

	public function arbitrase_data()
	{
		$data['page_title'] = "arbitrase_data";
		$data['datas'] = $this->Admin_model->get_all_arbitrase();
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/arbitrase_data");
	}
}