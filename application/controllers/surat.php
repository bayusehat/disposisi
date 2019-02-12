<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('suratmodel');
		$this->load->model('usermodel'); 
	}

	public function index(){
	if($this->session->userdata('logged_in') == TRUE){	
		if($this->session->userdata('jabatan') == 'Sekretaris'){
		$data['main_view'] = 'dashboard';
		$data['title'] = 'Dashboard';
		$this->load->view('template',$data);

		}else{
			$data['main_view'] = 'disposisi_masuk';
			$data['title'] = 'Disposisi Masuk';
			$data['data_surat'] = $this->suratmodel->get_surat_masuk_id($this->uri->segment(3));
			$data['data_disposisi'] = $this->suratmodel->get_all_dis_masuk($this->session->userdata('id_pegawai'));
			$this->load->view('template',$data);
			}
		}else{
			$this->load->view('login');
			}
		}

	public function surat_masuk(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$data['main_view'] = 'data_surat_masuk';
		$data['title'] = 'Surat Masuk';
		$data['surat_masuk'] = $this->suratmodel->get_surat_masuk();
		$this->load->view('template',$data);
	}else{
		redirect('user');
	}
}else{
	redirect('user');
}
	}

	public function get_surat_masuk_id($id_surat){
		
		$data_masuk = $this->suratmodel->get_surat_masuk_id($id_surat);

		echo json_encode($data_masuk);
	}

	public function tambah_surat_masuk(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$this->form_validation->set_rules('no_surat','Nomor Surat','required|trim');
		$this->form_validation->set_rules('tgl_kirim', 'Tgl.kirim' ,'required|trim');
		$this->form_validation->set_rules('tgl_terima','Tgl.penerima','required|trim');
		$this->form_validation->set_rules('pengirim','Pengirim','required|trim');
		$this->form_validation->set_rules('penerima','Penerima','required|trim');
		$this->form_validation->set_rules('perihal','Perihal','required|trim');

		if($this->form_validation->run()==TRUE){

		$config['upload_path'] 		= './uploads/';
		$config['max_size'] = 3000;
		$config['allowed_types'] = 'pdf|jpg|png';
		$this->load->library('upload',$config);

		if($this->upload->do_upload('file')){
			if($this->suratmodel->tambah_surat_masuk($this->upload->data())==TRUE){
				$this->session->set_flashdata('notif','Tambah surat berhasil!');
				redirect('surat/surat_masuk');
			}else{
				$this->session->set_flashdata('notif','Tambah surat gagal!');
				redirect('surat/surat_masuk');
			}
		}else{
			$this->session->set_flashdata('notif',$this->upload->display_errors());
			redirect('surat/surat_masuk');
	}
	}else{
		$this->session->set_flashdata('notif',validation_errors());
		redirect('surat/surat_masuk');
	}
	}else{
		redirect('user');
	}
  }else{
  	redirect('user');
  }
}

	public function ubah_surat_masuk(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$this->form_validation->set_rules('no_surat','Nomor Surat','required|trim');
		$this->form_validation->set_rules('tgl_kirim', 'Tgl.kirim' ,'required|trim');
		$this->form_validation->set_rules('tgl_terima','Tgl.penerima','required|trim');
		$this->form_validation->set_rules('pengirim','Pengirim','required|trim');
		$this->form_validation->set_rules('penerima','Penerima','required|trim');
		$this->form_validation->set_rules('perihal','Perihal','required|trim');

		if($this->form_validation->run()==TRUE){
			if($this->suratmodel->ubah_surat_masuk()==TRUE){
				$this->session->set_flashdata('notif','Ubah berhasil!');
				redirect('surat/surat_masuk');
			}else{
				$this->session->set_flashdata('notif','Ubah gagal!');
				redirect('surat/surat_masuk');
			}
	}
}else{
	redirect('user');
}
}else{
	redirect('user');
}
}

	public function hapus_surat_masuk($id_surat){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		if($this->suratmodel->hapus_surat_masuk($id_surat) == TRUE){
			$this->session->set_flashdata('notif','Hapus surat berhasil!');
			redirect('surat/surat_masuk');
		}else{
			$this->session->set_flashdata('notif','Hapus surat gagal!');
			redirect('surat/surat_masuk');
		}
	}else{
		redirect('user');
	}
}else{
	redirect('user');
}
	}


	public function surat_keluar(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$data['main_view'] = 'data_surat_keluar';
		$data['title'] = 'Surat Keluar';
		$data['surat_keluar'] = $this->suratmodel->get_surat_keluar();
		$this->load->view('template',$data);
	}else{
		redirect('user');
	}
}else{
	redirect('user');
}
	}

	public function get_surat_keluar_id($id_surat_keluar){

		$data_keluar = $this->suratmodel->get_surat_keluar_id($id_surat_keluar);

		echo json_encode($data_keluar);
	}

	public function tambah_surat_keluar(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$this->form_validation->set_rules('no_surat','Nomor Surat','required|trim');
		$this->form_validation->set_rules('tgl_kirim','Tgl.Kirim','required|trim');
		$this->form_validation->set_rules('tujuan','Tujuan','required|trim');
		$this->form_validation->set_rules('perihal','Perihal','required|trim');

		if($this->form_validation->run()==TRUE){

		$config['upload_path'] 		= './uploads/';
		$config['max_size'] = 3000;
		$config['allowed_types'] = 'pdf|jpg|png';
		$this->load->library('upload',$config);

		if($this->upload->do_upload('filesurat')){
			if($this->suratmodel->tambah_surat_keluar($this->upload->data())==TRUE){
				$this->session->set_flashdata('notif','Tambah surat berhasil!');
				redirect('surat/surat_keluar');
			}else{
				$this->session->set_flashdata('notif','Tambah surat gagal!');
				redirect('surat/surat_keluar');
			}
		}else{
			$this->session->set_flashdata('notif',$this->upload->display_errors());
			redirect('surat/surat_keluar');
	}
	}else{
		$this->session->set_flashdata('notif',validation_errors());
		redirect('surat/surat_keluar');
	}
}else{
	redirect('user');
}
}else{
	redirect('user');
}
	}

	public function ubah_surat_keluar(){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
		$this->form_validation->set_rules('no_surat','Nomor Surat','required|trim');
		$this->form_validation->set_rules('tgl_kirim','Tgl.Kirim','required|trim');
		$this->form_validation->set_rules('tujuan','Tujuan','required|trim');
		$this->form_validation->set_rules('perihal','Perihal','required|trim');

		if($this->form_validation->run()==TRUE){
			if($this->suratmodel->ubah_surat_keluar()==TRUE){
				$this->session->set_flashdata('notif','Ubah surat berhasil!');
				redirect('surat/surat_keluar');
			}else{
				$this->session->set_flashdata('notif','Ubah surat gagal!');
				redirect('surat/surat_keluar');
			}
		}else{
				$this->session->set_flashdata('notif',validation_errors());
				redirect('surat/surat_keluar');
		}
	}else{
	redirect('user');

	}
}else{
	redirect('user');
}
}

	public function hapus_surat_keluar($id_surat_keluar){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				if($this->suratmodel->hapus_surat_keluar($id_surat_keluar) == TRUE){
					$this->session->set_flashdata('notif','Hapus surat berhasil!');
					redirect('surat/surat_keluar');
				}else{
					$this->session->set_flashdata('notif','Hapus surat gagal!');
					redirect('surat/surat_keluar');
				}
			}
		}else{
			redirect('surat');
		}
	}


	public function get_jabatan(){

		if($this->session->userdata('logged_in') == TRUE){

		$data['data_jabatan'] = $this->suratmodel->get_jabatan();
		}else{
		redirect('user');
		}
	}


	public function get_pegawai_by_jabatan($id_jabatan){
		if($this->session->userdata('logged_in') == TRUE)
		{
		$data_pegawai = $this->suratmodel->get_pegawai_by_jabatan($id_jabatan);

		echo json_encode($data_pegawai);
	}else{
		redirect('user');
	}
	}

	public function add_disposisi($id_surat){
		if($this->session->userdata('logged_in') == TRUE){
		$this->form_validation->set_rules('tujuan_pegawai','Tujuan Pegawai','required|trim');
		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == TRUE){			
			if($this->suratmodel->add_disposisi($this->uri->segment(3)) == TRUE){
			$this->session->set_flashdata('notif','Tambha disposisi berhasil!');
			if($this->session->userdata('jabatan') == 'Sekretaris'){		
				redirect('surat/disposisi/'.$this->uri->segment(3));
			}else{
				redirect('surat/dis_keluar'.$this->uri->segment(3));
			}
		
	}else{
			$this->session->set_flashdata('notif','Tambha disposisi gagal!');
			if($this->session->userdata('jabatan') == 'Sekretaris'){		
				redirect('surat/disposisi/'.$this->uri->segment(3));
			}else{
				redirect('surat/dis_keluar/'.$this->uri->segment(3));
			}
		}

	}else{
		$this->session->set_flashdata('notif',validation_errors());
		if($this->session->userdata('jabatan') == 'Sekretaris'){		
			redirect('surat/disposisi/'.$this->uri->segment(3));
		}else{
			redirect('surat/dis_keluar/'.$this->uri->segment(3));
		}
	}
	}else{
			redirect('user');
		}
	}

	public function hapus_disposisi($id_surat,$id_disposisi){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				if($this->suratmodel->hapus_disposisi($id_disposisi) == TRUE){
					$this->session->set_flashdata('notif', 'Hapus disposisi Berhasil!');
					redirect('surat/disposisi/'.$id_surat);
				}else{
					$this->session->set_flashdata('notif', 'Hapus disposisi gagal!');
					redirect('surat/disposisi/'.$id_surat);
				}
				
			}
		}else{
			redirect('user');
		}
	}

	public function disposisi($id_surat){
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){

				$data['main_view'] = 'data_disposisi';
				$data['title'] = 'Data Disposisi';
				$data['data_surat'] = $this->suratmodel->get_surat_masuk_id($this->uri->segment(3));
				$data['dropdown'] = $this->suratmodel->get_jabatan();
				$data['data_disposisi'] = $this->suratmodel->get_all_disposisi($id_surat);

				$this->load->view('template',$data);

			}else{
				$data['main_view'] = 'disposisi_masuk';
				$this->load->view('template',$data);
			}
		}else{
			redirect('surat');
		}
	}

	public function dis_keluar($id_pegawai_pengirim){
		if($this->session->userdata('logged_in') == TRUE){

			$data['main_view'] = 'disposisi_keluar';
			$data['title'] = 'Disposisi Keluar';
			$data['data_disposisi'] = $this->suratmodel->get_all_dis_keluar($id_pegawai_pengirim);
			$data['data_surat'] = $this->suratmodel->get_surat_masuk_id($this->uri->segment(3));
			$data['dropdown'] = $this->suratmodel->get_jabatan();

			$this->load->view('template',$data);
		}else{
			redirect('login');
		}
	}

}
