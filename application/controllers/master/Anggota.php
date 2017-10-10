<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_anggota');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
        if ($this->session->userdata('akses') != '0') {
        	redirect();
        }
	}

	public function index()
	{
		$sesi                   = $this->session->userdata('sesilogin');
		$data['data_user']      = $this->master->getuser($sesi);
		$anggota['anggota']     = $this->m_anggota->orderByDesc('th_angkatan')->all();
		$anggota['th_angkatan'] = $this->m_anggota->select('th_angkatan')->groupBy('th_angkatan')->all();
		$this->load->view('header', $data);
		$this->load->view('anggota/index', $anggota);
		$this->load->view('footer');
	}

	public function add()
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$data['anggota']   = '';
		$this->load->view('header', $data);
		$this->load->view('anggota/add', $data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$this->m_anggota->insert($this->input->post());
		$this->session->set_flashdata('sf', 'Data Anggota berhasil disimpan!');
		redirect('master/anggota/add','refresh');
	}

	public function delete()
	{
		$th = $this->input->post('th_angkatan');
		$this->m_anggota->where('th_angkatan', $th)->_delete();
		$this->session->set_flashdata('sf', 'Data Anggota Tahun '.$th.' berhasil dihapus!');
		redirect('master/anggota','refresh');
	}

	public function edit($id)
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$data['anggota']   = $this->m_anggota->find($id);
		$this->load->view('header', $data);
		$this->load->view('anggota/add', $data);
		$this->load->view('footer');
	}

	public function update($id)
	{
		$data = $this->input->post();
		$this->m_anggota->update($data, $id);
		$this->session->set_flashdata('sf', 'Data Anggota berhasil diupdate!');
		redirect('master/anggota','refresh');
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/master/Anggota.php */