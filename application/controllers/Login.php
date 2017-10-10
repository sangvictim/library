<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		if (isset($_POST['login'])) {
			$this->login();
		}
		$this->load->view('login');
	}

	function login()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password') );
		$data_login = $this->m_login->cekuser($data);
		if ($data_login) {
			foreach ($data_login as $dl) {
				$this->session->set_userdata('sesilogin', $dl->id);
				$this->session->set_userdata('akses', $dl->akses);
				redirect(site_url(''),'refresh');
			}
		}else{
			$this->session->set_flashdata('gagal', 'Username atau password Salah !');
            redirect(base_url('login'));
		}
	}

	function logout()
	{

		$this->session->sess_destroy();
        redirect('login','refresh');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */