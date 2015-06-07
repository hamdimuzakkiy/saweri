<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_detail_pembelian extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('detail_pembelian', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_detail_pembelian', $id);
		return $this->db->get('detail_pembelian');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_pembelian', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_detail_pembelian', $id);
		$this->db->update('detail_pembelian', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('detail_pembelian', array('id_detail_pembelian' => $id));
	}
	
}