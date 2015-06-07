<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_master_akun extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('master_akun');		
		$this->db->order_by('AKUNID');		
		$this->db->limit($num, $offset);		
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('master_akun');		
		$this->db->order_by('AKUNID');		
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('AKUNID', $id);
		return $this->db->get('master_akun');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('master_akun', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('AKUNID', $id);
		$this->db->update('master_akun', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('master_akun', array('AKUNID' => $id));
	}
	
}