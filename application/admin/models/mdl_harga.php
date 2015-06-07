<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_harga extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('harga', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_harga', $id);
		return $this->db->get('harga');
	}
	
}