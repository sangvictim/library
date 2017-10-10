<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
	}
	public function index()
	{
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$pinjam['pinjam']  = $this->master->LkembaliBuku();
		$this->load->view('header', $data);
		$this->load->view('laporan/pengembalian/index', $pinjam);
		$this->load->view('footer');
	}

}

/* End of file pengembalian.php */
/* Location: ./application/controllers/laporan/pengembalian.php */