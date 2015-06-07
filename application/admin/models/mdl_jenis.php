<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_jenis extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->order_by("jenis", "asc");
		return $this->db->get('jenis', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_jenis', $id);
		return $this->db->get('jenis');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('jenis', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_jenis', $id);
		$this->db->update('jenis', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('jenis', array('id_jenis' => $id));
	}
	
}