<?php 

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->model("Home_model");
		$this->load->model("Lelang_model");

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
						"status" => "nonverif"
					];
					foreach ($this->Func_model->get_all_jenis() as $jenis) {
						$data[$jenis['id_jenis']] = $this->input->post($jenis['id_jenis'],true);
					}

					echo $this->Lelang_model->buat($data);
				}
			}
		}
	}
}