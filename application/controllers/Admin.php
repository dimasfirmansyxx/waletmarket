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

	public function logout()
	{
		$this->session->unset_userdata("admin_logged");	
		$this->session->unset_userdata("admin_id");
		redirect( base_url() . "admin/login" );	
	}

	public function infoharga()
	{
		$data['page_title'] = "Update Info Harga";
		$this->load->view("admin/templates/head",$data);
		$this->load->view("admin/templates/header");
		$this->load->view("admin/infoharga");
		$this->load->view("admin/templates/footer");
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
}