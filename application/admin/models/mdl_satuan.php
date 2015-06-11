<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_satuan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->order_by("satuan", "asc");
		return $this->db->get('satuan', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_satuan', $id);
		return $this->db->get('satuan');
	}
        
        function getItemByName($id)
	{
		$this->db->flush_cache();
		$this->db->where('satuan', $id);
		return $this->db->get('satuan');
	}
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('satuan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_satuan', $id);
		$this->db->update('satuan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('satuan', array('id_satuan' => $id));
	}
	
}