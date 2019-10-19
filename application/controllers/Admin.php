<?php 

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Admin_model");
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


}