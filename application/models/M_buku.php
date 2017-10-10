<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buku extends MY_Model {

	protected $table = 't_buku';

	public function cari_buku($nama)
	{
		$this->db->select('*, t_stok.stok as jumlah');
		$this->db->join('t_stok', 't_stok.kode_buku = t_buku.id', 'left');
		$this->db->like('nama', $nama);
		return $this->db->get('t_buku')->result();
	}

	public function getbuku()
	{
		$this->db->select('b.*, r.rak as nama_rak');
		$this->db->join('t_rak as r', 'r.id = b.rak', 'left');
		return $this->db->get('t_buku as b')->result();
	}

	public function cari_kode_buku($id)
	{
		$this->db->select('id,nama');
		$this->db->where('id', $id);
		return $this->db->get('t_buku')->row();
	}
}

/* End of file m_buku.php */
/* Location: ./application/models/m_buku.php */