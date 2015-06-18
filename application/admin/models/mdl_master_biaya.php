<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_master_biaya extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('master_biaya');				
		$this->db->limit($num, $offset);		
		return $this->db->get();
	}
	function getItemById($data)
	{
		$this->db->flush_cache();
		$this->db->where('id_biaya',$data);
		return $this->db->get('master_biaya');
	}
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('master_biaya', $data);
		$this->db->_error_message();
	}

	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_biaya', $id);
		$this->db->update('master_biaya', $data);
	}

	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('master_biaya', array('id_biaya' => $id));
	}
}