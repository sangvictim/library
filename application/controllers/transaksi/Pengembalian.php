<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_anggota');
		$this->load->model('m_peminjaman');
		$this->load->model('m_pengembalian');
		$this->load->model('m_denda');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
	}

	public function index()
	{
		$id_denda = str_replace('%', '-' ,urlencode($this->encrypt->encode(1)));
		$sesi              = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$nim               = $this->input->get('nim');
		$pinjam['user']    = $this->master->FindAnggotaByNim($nim);
		$pinjam['buku']    = $this->master->FindBookByNim($nim);
		$pinjam['hukuman'] = $this->m_denda->find($id_denda);

		// print_r($pinjam);
		// die();

		$this->load->view('header', $data);
		$this->load->view('t_pengembalian/index', $pinjam);
		$this->load->view('footer');
	}

	public function kembalikan()
	{
		//get data from ajax
		$head = $this->input->post('head');
		$kode = $this->input->post('buku');

		foreach ($kode as $data) {
			//find buku where kode buku count jumlah from t_pinjam
			$buku['buku']         = $this->master->FindBookByCode($head['nim'], $data['kode_buku']);
			$data['nim']          = $head['nim'];
			$data['nama_anggota'] = $head['nama_anggota'];
			$data['th_angkatan']  = $head['th_angkatan'];
			$data['nama_buku']    = $buku['buku']->nama_buku;
			$data['jumlah']       = $buku['buku']->jumlah;

			//aksi insert into t_pengembalian
			$this->m_pengembalian->insert($data);

		}
		$this->session->set_flashdata('sf', 'Buku berhasil Dikembalikan!');
		redirect('transaksi/pengembalian','refresh');
	}

}

/* End of file pengembalian.php */
/* Location: ./application/controllers/transaksi/pengembalian.php */