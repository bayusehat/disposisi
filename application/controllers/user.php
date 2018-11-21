<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('suratmodel');
	}

	public function index(){
		if($this->session->userdata('logged_in') == TRUE){
			redirect('surat');
		}else{
			$this->load->view('login');
		}
	}

	public function login_user(){

		$this->form_validation->set_rules('nik','NIK','required|trim|numeric');
		$this->form_validation->set_rules('password','Password','required|trim');

		if($this->form_validation->run() == TRUE){
			if($this->usermodel->login() == TRUE){
				redirect('surat');
			}else{
				redirect('user');
			}
		}else{
			$this->session->set_flashdata('notif',validation_errors());
			redirect('user');
		}
	}

	public function logout(){
		if($this->session->userdata('logged_in') == TRUE){
			$this->session->sess_destroy();
			redirect('user');
		}else{
			redirect('surat');
		}
	}
}