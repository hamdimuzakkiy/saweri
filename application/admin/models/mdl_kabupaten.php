<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_kabupaten extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->order_by("kabupaten", "asc");
		return $this->db->get('kabupaten', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_kabupaten', $id);
		return $this->db->get('kabupaten');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('kabupaten', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_kabupaten', $id);
		$this->db->update('kabupaten', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('kabupaten', array('id_kabupaten' => $id));
	}
	
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('kabupaten');
		return $this->db->get();
	}
	
}