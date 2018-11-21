<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function login(){
		$query = $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan')
						  ->where('nik',$this->input->post('nik'))
						  ->where('password',md5($this->input->post('password')))
						  ->get('pegawai');

		if($query->num_rows() == 1 ){
			$data = $query->row();
			$sess = array(
				'logged_in' 			=> TRUE,
				'nik' 					=> $data->nik,
				'id_pegawai' 			=> $data->id_pegawai,
				'nama_pegawai' 			=> $data->nama_pegawai,
				'id_jabatan' 			=> $data->id_jabatan,
				'jabatan' 				=> $data->nama_jabatan,
				'level' 				=> $data->level);

			$this->session->set_userdata($sess);
			return TRUE;
		}else{
			return FALSE;
		}
	}


}
