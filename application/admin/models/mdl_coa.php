<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_coa extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('coa', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_coa', $id);
		return $this->db->get('coa');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('coa', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_coa', $id);
		$this->db->update('coa', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('coa', array('id_coa' => $id));
	}
	
}