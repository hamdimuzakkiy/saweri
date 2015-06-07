<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_penukaran_point extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		/*$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('penukaran_point'); */
		
		$this->db->select('penukaran_point.*, pelanggan.point AS point_pelanggan, pelanggan.nama AS nama_pelanggan, barang.nama_barang, barang.point_barangpoint');
		$this->db->from('penukaran_point');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penukaran_point.id_pelanggan');	
		$this->db->join('barang', 'barang.id_barang = penukaran_point.id_barang');			
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->select('penukaran_point.*, pelanggan.point AS point_pelanggan, pelanggan.nama AS nama_pelanggan, barang.nama_barang, barang.point_barangpoint');
		$this->db->from('penukaran_point');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penukaran_point.id_pelanggan');	
		$this->db->join('barang', 'barang.id_barang = penukaran_point.id_barang');			
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('penukaran_point', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_penukaranpoint', $id);
		$this->db->update('penukaran_point', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('penukaran_point', array('id_penukaranpoint' => $id));
	}
	
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('penukaran_point');
		return $this->db->get();
	} 
	
	/*
	// function get_detail($id_request)
	// {
		// $this->db->flush_cache();
		// $this->db->select('detail_penjualan.*, barang.*');
		// $this->db->from('detail_penjualan');
		// $this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');
		// $this->db->where('id_penjualan', $id_request);
		// return $this->db->get();
	// }
	
	# untuk di list barang pada fancyBox
	// function get_barang()
	// {
		// $this->db->flush_cache();
		// $this->db->select('*, jenis.jenis AS jenis_barang, kategori.kategori AS kategori_barang');
		// $this->db->from('barang');
		// $this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		// $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		// $this->db->join('harga', 'harga.id_barang = barang.id_barang');
		// $this->db->where('harga_jual >', '0');
		// $this->db->where('curdate() >= harga.periode_start');
		// $this->db->where('curdate() <= harga.periode_end');
		// return $this->db->get();
	// }*/
	
}