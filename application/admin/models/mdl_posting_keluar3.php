<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_posting_keluar extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('pembelian.*, supplier.kode_supplier, supplier.nama AS nama_supplier, cabang.nama_cabang');
		$this->db->from('pembelian');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('pembelian.posting','0');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
		function count_getItem()	{		$this->db->flush_cache();		$this->db->select('pembelian.id_pembelian, pembelian.po_no, supplier.kode_supplier, supplier.nama AS nama_supplier, cabang.nama_cabang, 		pembelian.tanggal,pembelian.kd_akun,daftar_hutang.glid,daftar_hutang.id,daftar_hutang.TANGGAL,daftar_hutang.JUMLAH,daftar_hutang.GLID,		daftar_hutang.KODE_PARTNER,daftar_hutang.KOUNIT,daftar_hutang.KET_TRANSASKSI');		$this->db->from('pembelian');		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');		$this->db->join('daftar_hutang', 'daftar_hutang.po_no = pembelian.po_no');		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('pembelian.posting','0');				return $this->db->count_all_results();		}		function get_datafordetailjurnal($po_no){		$this->db->flush_cache();				$this->db->select('jurnal.PO_NO,jurnal.GLID,detail_pembelian.id_pembelian,detail_pembelian.harga,barang.id_kategori,						barang.id_barang,						kategori.kategori,						kategori.akunid,						detail_pembelian.id_barang');		$this->db->from('jurnal');		$this->db->join('pembelian', 'pembelian.po_no = jurnal.PO_NO');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('jurnal.PO_NO',$po_no);		return $this->db->get();	}		function insert($data)	{		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	}		function insert_detailJ($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function update($id, $data)	{		$this->db->flush_cache();		$this->db->where('po_no', $id);		$this->db->update('pembelian', $data);	}		function get_detail_pembelian($po_no){		$this->db->flush_cache();		$this->db->select('pembelian.po_no,						pembelian.id_pembelian,						detail_pembelian.id_barang,						detail_pembelian.harga,						detail_pembelian.qty,						detail_pembelian.total,						barang.nama_barang,						barang.id_kategori,						kategori.akunid,						kategori.kategori');		$this->db->from('pembelian');		$this->db->join('detail_pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('pembelian.po_no',$po_no);		return $this->db->get();	}		function get_glid(){		$this->db->flush_cache();		//$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		// ngambil no autoincrement dan akhirnya jadi-> '000x'		$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 5, '0', STR_PAD_LEFT);		return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;		//return 'KKM-'.$no;	}
}