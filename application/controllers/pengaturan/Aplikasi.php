<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_aplikasi');
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
			$this->update();
		}

		$sesi               = $this->session->userdata('sesilogin');
		$data['data_user']  = $this->master->getuser($sesi);
		$setting['setting'] = $this->m_aplikasi->find($id);
		$this->load->view('header', $data);
		$this->load->view('aplikasi/index', $setting);
		$this->load->view('footer');
	}

	public function update()
	{
		$id = str_replace('%', '-' ,urlencode($this->encrypt->encode(1)));
		$data = array(
			'instansi' => $this->input->post('instansi'),
			'alamat'   => $this->input->post('alamat'),
			'kepsek'   => $this->input->post('kepsek'),
			'petugas'  => $this->input->post('petugas'),
			'prov'     => $this->input->post('prov'),
			'kab'      => $this->input->post('kab'),
			'kec'      => $this->input->post('kec'),
			);
		$this->m_aplikasi->update($data, $id);
		$this->session->set_flashdata('sf', 'Pengaturan berhasil Disimpan !');
		redirect('pengaturan/aplikasi','refresh');
	}

}

/* End of file aplikasi.php */
/* Location: ./application/controllers/pengaturan/aplikasi.php */