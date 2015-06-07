<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_privilege extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('privilege', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_privilege', $id);
		return $this->db->get('privilege');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('privilege', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_privilege', $id);
		$this->db->update('privilege', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('privilege', array('id_privilege' => $id));
	}
	
}