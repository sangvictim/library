<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_denda');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
        if ($this->session->userdata('akses') != '0') {
        	redirect();
        }
	}

	public function index()
	{
		$id = str_replace('%', '-' ,urlencode($this->encrypt->encode(1)));
		if (isset($_POST['simpan'])) {
			$this->save($id);
		}
		$sesi               = $this->session->userdata('sesilogin');
		$data['data_user']  = $this->master->getuser($sesi);
		$data['denda'] = $this->m_denda->find($id);
		$this->load->view('header', $data);
		$this->load->view('denda/index', $data);
		$this->load->view('footer');
	}

	public function save($id)
	{
		$data = array(
			'denda' => $this->input->post('denda'),
			'hari' => $this->input->post('hari')
			);
		$this->m_denda->update($data, $id);
		$this->session->set_flashdata('sf', 'Denda Berhasil Disimpan !');
		redirect('master/denda','refresh');
	}

}

/* End of file Denda.php */
/* Location: ./application/controllers/master/Denda.php */