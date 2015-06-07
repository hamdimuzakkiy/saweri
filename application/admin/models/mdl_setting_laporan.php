<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_setting_laporan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('setting_laporan', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		return $this->db->get('setting_laporan');
	}
	

	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update('setting_laporan', $data);
	}


}