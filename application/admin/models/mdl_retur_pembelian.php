<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_retur_pembelian extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('retur_pembelian.id_retur_pembelian, pembelian.po_no, supplier.kode_supplier, detail_pembelian.sn, supplier.nama AS nama_supplier, retur_pembelian.tanggal, barang.nama_barang, retur_pembelian.qty');
		$this->db->from('retur_pembelian');
		$this->db->join('detail_pembelian', 'retur_pembelian.id_detail_pembelian = detail_pembelian.id_detail_pembelian');
		$this->db->join('pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->where('pembelian.id_cabang', get_idcabang());
		$this->db->limit($num, $offset);
		return $this->db->get();

	}

	function count()
	{
		$this->db->flush_cache();
		$this->db->select('retur_pembelian.id_retur_pembelian, pembelian.po_no, supplier.kode_supplier, detail_pembelian.sn, supplier.nama AS nama_supplier, retur_pembelian.tanggal, barang.nama_barang, retur_pembelian.qty');
		$this->db->from('retur_pembelian');
		$this->db->join('detail_pembelian', 'retur_pembelian.id_detail_pembelian = detail_pembelian.id_detail_pembelian');
		$this->db->join('pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->where('pembelian.id_cabang', get_idcabang());
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_pembelian', $id);
		return $this->db->get('retur_pembelian');
	}

	function insert($data)
	{
		$data['id_retur_pembelian'] = $this->getID();
		$this->db->flush_cache();
		$this->db->insert('retur_pembelian', $data);
	}

	function getID()
	{
		$kd_awal = 'RPB';
		$code_user = get_userid();		
		$code_user = str_pad($code_user, 3, '0', STR_PAD_LEFT);
		
		$this->db->flush_cache();
		$this->db->select('users.*, cabang.*, karyawan.*');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->where('users.userid', get_userid());
		$kode_cabang = $this->db->get()->row()->kode_cabang;
		
		$tanggal = date('dmy');
		
		$this->db->flush_cache();
		$this->db->from('retur_pembelian');
		//$this->db->like('po_no', $kd_awal . '-'.$kode_cabang.$code_user.$tanggal, 'after');
		$this->db->like('id_retur_pembelian', $kd_awal . '-'.$kode_cabang.$tanggal, 'after');
		$query = $this->db->get();
		
		//print $this->db->last_query();

		$no_po = $query->num_rows();
		$no_po = (int) $no_po + 1;
		$no_po = str_pad($no_po, 4, '0', STR_PAD_LEFT);
		
		/*return $kd_awal . '-'.$kode_cabang.$code_user.$tanggal.$no_po; */
		return $kd_awal . '-'.$kode_cabang.$tanggal.$no_po; 
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_pembelian', $id);
		$this->db->update('retur_pembelian', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('retur_pembelian', array('id_retur_pembelian' => $id));
	}
	
}