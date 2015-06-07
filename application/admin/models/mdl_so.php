<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_so extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.*, pelanggan.nama AS nama_pelanggan');
		$this->db->from('penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		return $this->db->get('penjualan');
	}
	
	
	
}