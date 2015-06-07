<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_harga_beli extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('harga.id_harga, barang.nama_barang AS nama_barang, harga.periode_start, harga.periode_end, harga.harga_beli');
		$this->db->from('harga');
		$this->db->join('barang', 'barang.id_barang = harga.id_barang');
		//$this->db->join('supplier', 'supplier.id_supplier = harga.id_supplier');	
		$this->db->where('harga.harga_beli >', '0');
		$this->db->order_by("barang.nama_barang", "asc");		
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_harga', $id);
		return $this->db->get('harga');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('harga', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_harga', $id);
		$this->db->update('harga', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('harga', array('id_harga' => $id));
	}
	
}