<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_setting_login extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('setting_login', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		return $this->db->get('setting_login');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('setting_login', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update('setting_login', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('setting_login', array('id' => $id));
	}
	
	function get_kode_setting_login()
	{
		# ambil nomer running berdasarkan
		$this->db->flush_cache();
		$this->db->from('setting_login');
		$this->db->like('kode_setting_login', 'P', 'after');
		$query = $this->db->get();
		
		$kode_setting_login = $query->num_rows();
		$kode_setting_login = (int) $kode_setting_login + 1;
		$kode_setting_login = str_pad($kode_setting_login, 4, '0', STR_PAD_LEFT);
		
		return 'P'.$kode_setting_login;
		
	}
}