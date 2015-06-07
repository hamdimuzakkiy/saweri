<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_service extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();		
		$this->db->select("*");		
		$this->db->from('service');		
		$this->db->join('service_status', 'service.status = service_status.id');		
		$this->db->order_by("service.tanggal", "desc");		
		$this->db->limit($num, $offset);
		
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_service', $id);
		return $this->db->get('service');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('service', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_service', $id);
		$this->db->update('service', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('service', array('id_service' => $id));
	}
	
}