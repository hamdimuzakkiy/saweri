<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_master_kas extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('kas');				
		$this->db->limit($num, $offset);		
		return $this->db->get();
	}
	function getItemById($data)
	{
		$this->db->flush_cache();
		$this->db->where('kode',$data);
		return $this->db->get('kas');
	}
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('kas', $data);
		$this->db->_error_message();
	}

	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('kode', $id);
		$this->db->update('kas', $data);
	}

	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('kas', array('kode' => $id));
	}
}