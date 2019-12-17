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

	public function accept()
	{
		$id_bid = $this->input->post("id_bid",true);
		echo $this->Lelang_model->accept_bid($id_bid);
	}

	
}