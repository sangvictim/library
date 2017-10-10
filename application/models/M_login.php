<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {

	function cekuser($data)
	{
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));

		$sql = $this->db->get();

		if ($sql->num_rows() > 0) {
			return $sql->result();
		}else
		{
			return false;
		}

	}

}

/* End of file m_login.php */
/* Location: ./application/models/m_login.php */