<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends MY_Model {

	protected $table = 't_anggota';

	public function cari($nim)
	{
		$this->db->select('*');
		$this->db->where('nim', $nim);
		return $this->db->get('t_anggota')->row();
	}

}

/* End of file M_anggota.php */
/* Location: ./application/models/M_anggota.php */