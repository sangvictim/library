<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_rak');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        };
        if ($this->session->userdata('akses') != '0') {
        	redirect();
        }
	}

	public function index()
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$kelasrak          = array(
			'rak' => $this->m_rak->all(),
			'editrak' => ''
			);
		$this->load->view('header', $data);
		$this->load->view('rak/index', $kelasrak);
		$this->load->view('footer');
	}

	public function insertrak()
	{
		$data = $this->input->post();
		$this->m_rak->insert($data);
		$this->session->set_flashdata('sf', 'Data Rak Buku berhasil disimpan!');
		redirect('master/rak','refresh');
	}

	public function deleterak($id)
	{
		$this->m_rak->delete($id);
		$this->session->set_flashdata('sf', 'Data Rak Buku berhasil dihapus!');
		redirect('master/rak','refresh');
	}

	public function editrak($id)
	{
		$sesi = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);

		$kelasrak = array(
			'rak' => $this->m_rak->all(),
			'editrak' => $this->m_rak->find($id)
			);
		$this->load->view('header', $data);
		$this->load->view('rak/index', $kelasrak);
		$this->load->view('footer');
	}

	public function updaterak($id)
	{
		$data = $this->input->post();
		$this->m_rak->update($data, $id);
		$this->session->set_flashdata('sf', 'Data Rak Buku berhasil diupdate!');
		redirect('master/rak','refresh');
	}

}

/* End of file Kelas_rak.php */
/* Location: ./application/controllers/master/Kelas_rak.php */