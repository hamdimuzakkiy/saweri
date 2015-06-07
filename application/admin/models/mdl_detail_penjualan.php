<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_detail_penjualan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('detail_penjualan', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_detail_penjualan', $id);
		return $this->db->get('detail_penjualan');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_penjualan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_detail_penjualan', $id);
		$this->db->update('detail_penjualan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('detail_penjualan', array('id_detail_penjualan' => $id));
	}
	
}