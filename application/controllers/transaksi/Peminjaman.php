<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_anggota');
		$this->load->model('m_buku');
		$this->load->model('m_peminjaman');
		if (!$this->session->userdata('sesilogin')) {
            redirect();
        }
	}

	public function index()
	{
		$sesi = $this->session->userdata('sesilogin');
		$data['data_user'] = $this->master->getuser($sesi);
		$pinjam['nim']     = $this->m_anggota->select('nim')->all();
		$pinjam['buku']    = $this->m_buku->select('id')->all();

		$this->load->view('header', $data);
		$this->load->view('t_peminjaman/index', $pinjam);
		$this->load->view('footer');
	}

	public function cari()
	{
		$nim  = $this->input->post('nim');
		$data = $this->m_anggota->cari($nim);
		echo json_encode($data);
	}

	public function caribuku()
	{
		$id = $this->input->post('kode_buku');
		$data = $this->m_buku->cari_kode_buku($id);
		echo json_encode($data);
	}

	public function pinjam()
	{
		$form1 = $this->input->post('form1');

		$form2 = $this->input->post('form2');

		foreach ($form2 as $data) {

			$data['nim']          = $form1['nim'];
			$data['nama_anggota'] = $form1['nama'];
			$data['th_angkatan']  = $form1['th_angkatan'];

			$this->m_peminjaman->insert($data);

		}
		$this->session->set_flashdata('sf', 'Buku berhasil dipinjam!');
	}

}

/* End of file peminjaman.php */
/* Location: ./application/controllers/transaksi/peminjaman.php */