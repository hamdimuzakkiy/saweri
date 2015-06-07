<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_users_level extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('users_level', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('level_id', $id);
		return $this->db->get('users_level');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('users_level', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('level_id', $id);
		$this->db->update('users_level', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('users_level', array('level_id' => $id));
	}
	
}