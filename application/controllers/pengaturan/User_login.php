<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
        if ($this->session->userdata('akses') != '0') {
        	redirect();
        }
	}

	public function index()
	{
		if (isset($_POST['simpan'])) {
			$this->insert();
		}

		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$user['user']      = $this->m_user->all();
		$user['find']      = '';
		$this->load->view('header', $data);
		$this->load->view('user_login/index', $user);
		$this->load->view('footer');
	}

	public function insert()
	{
		if ($this->input->post('password') != $this->input->post('re_password')) {
			$this->session->set_flashdata('sf', 'Password Tidak Cocok !');
			redirect('pengaturan/user_login','refresh');
		}else{
			$data = array(
				'nik'      => $this->input->post('nik'),
				'nama'     => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'akses'    => $this->input->post('akses'),
				 );
			$this->m_user->insert($data);
			$this->session->set_flashdata('sf', 'User berhasil ditambahkan !');
			redirect('pengaturan/user_login','refresh');
		}
	}

	public function delete($id)
	{
		$aidi = $this->encrypt->decode(urldecode(str_replace("-", "%", $id)));
		if ($aidi == '1')
		{
			$this->session->set_flashdata('sf', 'User Tidak Dapat Dihapus !');
			redirect('pengaturan/user_login','refresh');
		}else
		{
			$this->m_user->delete($id);
			$this->session->set_flashdata('sf', 'User Berhasil Dihapus !');
			redirect('pengaturan/user_login','refresh');
		}
	}

	public function edit($id)
	{
		$aidi = $this->encrypt->decode(urldecode(str_replace("-", "%", $id)));
		if ($aidi == '1') {
			$this->session->set_flashdata('sf', 'User Tidak Dapat Diubah !');
			redirect('pengaturan/user_login','refresh');
		}else{
			if (isset($_POST['simpan'])) {
				$this->update($id);
			}

			$sesi              = $this->session->userdata('sesilogin');
			$data['data_user'] = $this->master->getuser($sesi);
			$user['user']      = $this->m_user->all();
			$user['find']      = $this->m_user->find($id);
			$this->load->view('header', $data);
			$this->load->view('user_login/index', $user);
			$this->load->view('footer');
		}
	}

	public function update($id)
	{
		$post = $this->input->post();

		if ($post['password'] != $post['re_password']) {
			$this->session->set_flashdata('sf', 'Password Tidak Cocok');
			redirect('pengaturan/user_login/edit/'.$id,'refresh');
		}else{
			if ($post['password'] == '') {
				$data = array(
					'nik'      => $post['nik'],
					'nama'     => $post['nama'],
					'username' => $post['username'],
					'akses'    => $post['akses'],
					 );
				$this->m_user->update($data,$id);
				$this->session->set_flashdata('sf', 'User Berhasil Diupdate');
				redirect('pengaturan/user_login','refresh');
			}else{
				$data = array(
					'nik'      => $post['nik'],
					'nama'     => $post['nama'],
					'username' => $post['username'],
					'password' => md5($post['password']),
					'akses'    => $post['akses'],
					 );
				$this->m_user->update($data, $id);
				$this->session->set_flashdata('sf', 'User Berhasil Diupdate');
				redirect('pengaturan/user_login','refresh');

			}
		}
	}

	public function changepass($id)
	{
		$post = $this->input->post();

		if ($post['password'] != $post['repassword']) {
			$this->session->set_flashdata('sf', 'Password Tidak Cocok !');
			redirect('','refresh');
		}else{
			$password = array('password' => md5($post['password']));
			$this->m_user->update($password, $id);
			$this->session->set_flashdata('sf', 'Password Berhasil Diupdate');
			redirect('','refresh');
		}
	}

}

/* End of file user_login.php */
/* Location: ./application/controllers/pengaturan/user_login.php */