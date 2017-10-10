<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

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
		$stok['stok_buku'] = $this->master->LstokBuku();
		$this->load->view('header', $data);
		$this->load->view('laporan/stok/index', $stok);
		$this->load->view('footer');
	}

	public function cetak()
	{
		$stok['stok_buku'] = $this->master->LstokBuku();
		$this->load->view('laporan/stok/print', $stok);
	}

	public function excel()
	{
		$rawData = $this->master->LstokBuku();

        // Pengganti Foreach
        $data = array_map(function ($val) {
			return array(
				$val->id,
				$val->nama,
				$val->penerbit,
				$val->th_terbit,
				$val->stok,
				$val->stok2,
				);
		}, $rawData);

		// add data to excel
		$excel = array(
			'filename' => 'Master_Stok',
			'header'   => 'Master Stok Buku Perpustakaan',
			'field'    => ['Kode Buku', 'Nama Buku', 'Penerbit', 'Tahun Terbit', 'Jumlah', 'Stok'],
			'data'     => $data,
			);

		// load template & add data to excel 
		$this->load->view('v_excel_base', $excel);
		
	}

}

/* End of file stok.php */
/* Location: ./application/controllers/laporan/stok.php */