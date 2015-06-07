<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_internal_memo extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->order_by("tanggal", "desv");
		return $this->db->get('internal_memo', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_internal_memo', $id);
		return $this->db->get('internal_memo');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('internal_memo', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_internal_memo', $id);
		$this->db->update('internal_memo', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('internal_memo', array('id_internal_memo' => $id));
	}
}