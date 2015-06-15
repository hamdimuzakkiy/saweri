<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_master_saldo_elektrik extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('master_saldo_elektrik');		
//		$this->db->order_by('AKUNID');		
		$this->db->limit($num, $offset);		
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('*');		
		$this->db->from('master_saldo_elektrik');		
		//$this->db->order_by('AKUNID');		
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_saldo', $id);
		return $this->db->get('master_saldo_elektrik');
	}

        function getItemByName($name)
	{
		$this->db->flush_cache();
		$this->db->where('nama_masterSaldo', $name);
		return $this->db->get('master_saldo_elektrik');
	}
        
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('master_saldo_elektrik', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_saldo', $id);
		$this->db->update('master_saldo_elektrik', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('master_saldo_elektrik', array('id_saldo' => $id));
	}
	
}
