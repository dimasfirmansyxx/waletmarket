<?php 

class Home extends CI_Controller {
	public function index()
	{
		$data['page_title'] = "Beranda";
		$data['infoharga'] = $this->Func_model->get_last_infoharga();
		$this->load->view("home/templates/head",$data);
		$this->load->view("home/templates/header");
		$this->load->view("home/home");
		$this->load->view("home/templates/footer");
	}
}