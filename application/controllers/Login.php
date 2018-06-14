<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model('mod_admin');
			$this->load->library('encryption');
	}

	public function index()
	{
		$data = $this->mod_admin->get_setting();
		$this->session->set_userdata( 'datalog', $data );
		$user = $this->session->userdata('log');
		if ($user['id_guru']=="") {
			$this->load->view('login');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}

	public function proses_login()
	{
		$this->form_validation->set_rules('uname', 'uname', 'required');
		$this->form_validation->set_rules('pwd', 'pwd', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('gagal', 'Silahkan Masukkan Username dan Password. Ulangi lagi.');
			redirect(base_url().'login/','refresh');
		} else {
			$uname = $this->input->post('uname');
			$pwd = md5($this->input->post('pwd'));
			$hasil = $this->mod_admin->cek_login($uname, $pwd)->row_array();
			if ($hasil) {
				$this->session->set_flashdata('sukses', 'Selamat datang <b>'.$uname.'</b>.');
				$data1 = array(
						'id_guru' => $hasil['id_guru'], 
						'user' => $hasil['username'],
						'tipe' => $hasil['login_type'],
				);
				$this->session->set_userdata( 'log', $data1 );
				$data = $this->mod_admin->get_setting();
				$this->session->set_userdata( 'datalog', $data );
				redirect(base_url().'admin','refresh');
			}else{
				$this->session->set_flashdata('error', 'Username/Password salah/tidak ditemukan. Silahkan login lagi.');
				redirect(base_url().'login/','refresh');
			}
		}
	}


}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */