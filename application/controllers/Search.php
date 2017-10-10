<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_buku');
	}
	public function index()
	{
		$sesi = $this->session->userdata('sesilogin');
		if ($sesi == '') {
			$filter['filter'] = $this->m_buku->cari_buku($this->input->get('nama'));
			$this->load->view('index', $filter);

		}else{
			$data = array(
				'data_user'           => $this->master->getuser($sesi),
				'pengunjung_hari_ini' => $this->master->pengunjung_hari_ini(), 
				'total_pengunjung'    => $this->master->total_pengunjung(),
				'total_buku'          => $this->master->total_buku(),
				'total_anggota'       => $this->master->total_anggota(),
				);
			$this->load->view('header', $data);
			$this->load->view('home/dashboard', $data);
			$this->load->view('footer');
		}
		
	}

	public function daftarhadir()
	{
		$data = array(
			'nama'       => $this->input->post('nama'),
			'created_at' => date('Y-m-d')
			);
		$this->master->inspengunjung($data);
		$this->session->set_flashdata('sf', 'Terimakasih Telah Berkunjung!');
	}

	public function grafik()
	{
		$data = $this->master->grafik_pengunjung();
		echo json_encode($data);
	}
}
