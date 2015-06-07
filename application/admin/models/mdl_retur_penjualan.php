<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_retur_penjualan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{		
		$this->db->flush_cache();
		$this->db->select('retur_penjualan.id_retur_penjualan, penjualan.so_no, supplier.kode_supplier,pelanggan.kode_pelanggan, pelanggan.nama AS nama_pelanggan, detail_penjualan.sn, supplier.nama AS nama_supplier, retur_penjualan.tanggal, barang.nama_barang, retur_penjualan.qty');
		$this->db->from('retur_penjualan');
		$this->db->join('detail_penjualan', 'retur_penjualan.id_detail_penjualan = detail_penjualan.id_detail_penjualan');
		$this->db->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('detail_pembelian', 'detail_pembelian.id_detail_pembelian = detail_penjualan.id_detail_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->where('penjualan.id_cabang', get_idcabang());
		$this->db->limit($num, $offset);

		return $this->db->get();
	}

	
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_penjualan', $id);
		return $this->db->get('retur_penjualan');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('retur_penjualan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_penjualan', $id);
		$this->db->update('retur_penjualan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('retur_penjualan', array('id_retur_penjualan' => $id));
	}
	
}