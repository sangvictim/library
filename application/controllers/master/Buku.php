<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_buku');
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
		$data['buku']      = $this->m_buku->orderByDesc('th_terbit')->getbuku();
		$this->load->view('header', $data);
		$this->load->view('buku/index');
		$this->load->view('footer');

	}

	public function add()
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$rak['rak']        = $this->m_rak->all();
		$rak['buku']       = '';
		$this->load->view('header', $data);
		$this->load->view('buku/add', $rak);
		$this->load->view('footer');

	}

	public function insert()
	{
		$config['upload_path']   = './assets/gambar/buku/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '1024';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('gambar'))
        {
            $this->session->set_flashdata('sf', 'Data Gagal Disimpan !');
			redirect('master/buku','refresh');
        }
        else
        {
			$gambar         = $this->upload->data();
			$data           = $this->input->post();
			$data['gambar'] = $gambar['file_name'];
			$this->m_buku->insert($data);
			$this->session->set_flashdata('sf', 'Data Buku berhasil disimpan!');
			redirect('master/buku','refresh');
    	}

	}

	public function delete($id)
	{

		$data_lama = $this->m_buku->find($id);
		unlink('assets/gambar/buku/'.$data_lama->gambar);
		$this->m_buku->delete($id);
		$this->session->set_flashdata('sf', 'Data Buku berhasil dihapus!');
		redirect('master/buku','refresh');

	}

	public function edit($id)
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$buku['buku']      = $this->m_buku->find($id);
		$buku['rak']       = $this->m_rak->all();
		$this->load->view('header', $data);
		$this->load->view('buku/add', $buku);
		$this->load->view('footer');
	}

	public function update($id)
	{
		$config['upload_path']   = './assets/gambar/buku/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '1024';

        $this->load->library('upload', $config);

		$data = $this->input->post();

    	if ($_FILES['gambar']['name']) {
    		if ($this->upload->do_upload('gambar'))
			{
				$ttg = $this->m_buku->find($id);
	        	if ($ttg->gambar != '') {
	        		unlink('./assets/gambar/buku/'.$ttg->gambar);
					$gambar         = $this->upload->data();
					$data['gambar'] = $gambar['file_name'];

					$this->m_buku->update($data, $id);
					$this->session->set_flashdata('sf', 'Buku berhasil diupdate!');
					redirect('master/buku','refresh');
				}
			}else{
				$this->session->set_flashdata('gagal', 'Upload Gambar Gagal Atau Ukuran Gambar Terlalu Besar, Ukuran Maximal 1MB');
				redirect('master/buku','refresh');
			}
    	} else {
    		$this->m_buku->update($data, $id);
			$this->session->set_flashdata('sf', 'Buku berhasil diupdate!');
			redirect('master/buku','refresh');
    	}
	}

}

/* End of file buku.php */
/* Location: ./application/controllers/master/buku.php */