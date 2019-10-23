<?php 

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->model("Home_model");
		
		if ( $this->uri->segment(1) == null ) {
			redirect( base_url() . "home" );
		}
	}

	public function index()
	{
		$data['page_title'] = "Beranda";
		$data['infoharga'] = $this->Func_model->get_last_infoharga();
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
}