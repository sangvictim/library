<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Model {

	public function getuser($id)
	{
		$this->db->select('id, nama, username, akses');
		$this->db->where('id', $id);
		return $this->db->get('user_login')->row();
	}

	public function getbook()
	{
		return $this->db->get('t_buku')->result();
	}

	public function inspengunjung($data)
	{
		$this->db->insert('t_daftar_hadir', $data);
	}

	public function pengunjung_hari_ini()
	{
		$this->db->where('created_at', date('Y-m-d'));
		return $this->db->count_all_results('t_daftar_hadir');
	}

	public function total_pengunjung()
	{
		return $this->db->count_all_results('t_daftar_hadir');
	}

	public function total_buku()
	{
		return $this->db->count_all_results('t_buku');
	}

	public function total_anggota()
	{
		return $this->db->count_all_results('t_anggota');
	}

	public function grafik_pengunjung()
	{
		$this->db->select('created_at, count(created_at) as jumlah');
		$this->db->group_by('created_at');
		return $this->db->get('t_daftar_hadir')->result();

	}

	public function FindAnggotaByNim($nim)
	{
		if ($nim != '') {
			$this->db->like('nim', $nim);
			return $this->db->get('t_anggota')->row();
		}
	}

	public function FindBookByNim($nim)
	{
		if ($nim != '') {
			$this->db->select('*, SUM(jumlah) as jumlah');
			$this->db->where('nim', $nim);
			$this->db->where('status', '1');
			$this->db->group_by('kode_buku');
			return $this->db->get('t_peminjaman')->result();
		}
	}

	public function LstokBuku()
	{
		$this->db->select('tb.*, ts.stok as stok2');
		$this->db->join('t_stok as ts', 'ts.kode_buku = tb.id', 'left');
		return $this->db->get('t_buku as tb')->result();
	}
	public function LpinjamBuku()
	{
		$this->db->select('*, SUM(jumlah) as jumlah');
		$this->db->where('status', '1');
		$this->db->group_by('kode_buku');
		$this->db->group_by('nim');
		$this->db->order_by('nim', 'asc');
		return $this->db->get('t_peminjaman')->result();
	}

	public function FindBookByCode($nim, $kode)
	{
		$this->db->select('*, SUM(jumlah) as jumlah');
		$this->db->where('status', '1');
		$this->db->where('kode_buku',$kode);
		$this->db->where('nim',$nim);
		$this->db->group_by('kode_buku');
		$this->db->group_by('nim');
		return $this->db->get('t_peminjaman')->row();
	}

	public function LkembaliBuku()
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get('t_pengembalian')->result();
	}
}

/* End of file master.php */
/* Location: ./application/models/master.php */