<?php 

class Bid extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Lelang_model");
		$this->load->model("Home_model");

		if ( !$this->session->user_logged ) {
			redirect( base_url() . "home" );
		}
	}

	public function index()
	{
		redirect( base_url() . "home" );
	}

	public function conversation($id_bid)
	{
		$data['page_title'] = "Conversation";
		$data['bid_data'] = $this->Lelang_model->bid_info($id_bid);
		$data['post_data'] = $this->Lelang_model->get_lelang($data['bid_data']['id_posting']);
		$data['convers_data'] = $this->Lelang_model->get_conversation($id_bid);
		$data['jumbo_title'] = $data['post_data']['judul'];
		$data['buyer_info'] = $this->Home_model->user_info($data['bid_data']['id_user']);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/templates/aside");
		$this->load->view("home/bid_conversation");
		$this->load->view("home/templates/footer");
	}

	public function chat_conversation($id_bid)
	{
		$data['page_title'] = "chat_conversation";
		$data['bid_data'] = $this->Lelang_model->bid_info($id_bid);
		$data['post_data'] = $this->Lelang_model->get_lelang($data['bid_data']['id_posting']);
		$data['convers_data'] = $this->Lelang_model->get_conversation($id_bid);
		$data['jumbo_title'] = $data['post_data']['judul'];
		$data['buyer_info'] = $this->Home_model->user_info($data['bid_data']['id_user']);
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/bid_conversation_show");
	}

	public function conversation_act($act)
	{
		if ( $act == "sendchat" ) {
			$data = [
				"id_user" => $this->input->post("id_user",true),
				"id_bid" => $this->input->post("id_bid",true),
				"remarks" => $this->input->post("remarks")
			];

			echo $this->Lelang_model->send_chat($data);
		}
	}

	public function accept()
	{
		$id_bid = $this->input->post("id_bid",true);
		echo $this->Lelang_model->accept_bid($id_bid);
	}

}