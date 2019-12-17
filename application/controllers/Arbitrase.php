<?php 

class Arbitrase extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Lelang_model");
		$this->load->model("Payment_model");
		$this->load->model("Home_model");

		if ( !$this->session->user_logged ) {
			redirect( base_url() . "home" );
		}
	}

	public function index()
	{
		redirect( base_url() . "home" );
	}

	public function conversation($id_arbitrase)
	{
		$data['page_title'] = "Chat";
		$data['convers_data'] = $this->Home_model->get_conversation($id_arbitrase);
		$data['arbitrase_data'] = $this->Home_model->get_arbitrase_content($id_arbitrase);
		$data['transaksi_info'] = $this->Lelang_model->get_transaksi($data['arbitrase_data']['id_transaksi']);
		$data['buyer_info'] = $this->Home_model->user_info($data['transaksi_info']['id_buyer']);
		$data['seller_info'] = $this->Home_model->user_info($data['transaksi_info']['id_seller']);
		$data['jumbo_title'] = "Arbitrase";
		$data['media'] = $this->Home_model->get_arbitrase_media($id_arbitrase);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/templates/aside");
		$this->load->view("home/arbitrase_conversation");
		$this->load->view("home/templates/footer");
	}

	public function chat_conversation($id_arbitrase)
	{
		$data['page_title'] = "chat_conversation";
		$data['arbitrase_data'] = $this->Home_model->get_arbitrase_content($id_arbitrase);
		$data['transaksi_info'] = $this->Lelang_model->get_transaksi($data['arbitrase_data']['id_transaksi']);
		$data['convers_data'] = $this->Home_model->get_conversation($id_arbitrase);
		$data['jumbo_title'] = "Arbitrase";
		$data['buyer_info'] = $this->Home_model->user_info($data['transaksi_info']['id_buyer']);
		$data['seller_info'] = $this->Home_model->user_info($data['transaksi_info']['id_seller']);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/arbitrase_conversation_show");
	}

	public function sendchat()
	{
		$data = [
			"id_user" => $this->input->post("id_user",true),
			"id_arbitrase" => $this->input->post("id_arbitrase",true),
			"remarks" => $this->input->post("remarks")
		];

		echo $this->Home_model->send_chat($data);
	}
}