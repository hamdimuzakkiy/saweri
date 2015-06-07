<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_posting_masuk extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.id_penjualan, penjualan.so_no, pelanggan.kode_pelanggan, pelanggan.nama AS nama_pelanggan, cabang.nama_cabang, 		penjualan.tanggal,penjualan.kd_akun,penjualan.id_pelanggan,penjualan.total,penjualan.cara_bayar,penjualan.id_cabang');
		$this->db->from('penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('penjualan.posting','0');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}		function count_getItem(){				$this->db->flush_cache();		$this->db->select('penjualan.id_penjualan, penjualan.so_no, pelanggan.kode_pelanggan, pelanggan.nama AS nama_pelanggan, cabang.nama_cabang, 		penjualan.tanggal,penjualan.kd_akun,penjualan.id_pelanggan,penjualan.id_cabang');		$this->db->from('penjualan');		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');		$this->db->join('daftar_piutang', 'daftar_piutang.so_no = penjualan.so_no');		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('penjualan.posting','0');					return $this->db->count_all_results();		}		function get_datafordetailjurnal($so_no){		$this->db->flush_cache();				$this->db->select('jurnal.PO_NO,						jurnal.GLID,						detail_penjualan.id_penjualan,						detail_penjualan.harga,						penjualan.diskon,						penjualan.total as total_penjualan,						barang.id_kategori,						kategori.kategori,						kategori.akunid_pendapatan,						kategori.akunid_diskon,						detail_penjualan.id_barang');		$this->db->from('jurnal');		$this->db->join('penjualan', 'penjualan.so_no = jurnal.PO_NO');		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan = penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('jurnal.PO_NO',$so_no);		return $this->db->get();	}
		function insert($data)	{		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	}		function insert_detailJ($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function update($id, $data)	{		$this->db->flush_cache();		$this->db->where('so_no', $id);		$this->db->update('penjualan', $data);	}		function get_detail_penjualan($so_no){		$this->db->flush_cache();		$this->db->select('penjualan.so_no,						penjualan.id_penjualan,						penjualan.diskon,						penjualan.total as total_penjualan,						detail_penjualan.id_barang,						detail_penjualan.harga,						detail_penjualan.qty,						detail_penjualan.total,						barang.nama_barang,						barang.id_kategori,						kategori.akunid_pendapatan,						kategori.akunid_diskon_biaya,						kategori.kategori');		$this->db->from('penjualan');		$this->db->join('detail_penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('penjualan.so_no',$so_no);		return $this->db->get();	}		function get_glid(){		$this->db->flush_cache();		//$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		// ngambil no autoincrement dan akhirnya jadi-> '000x'		$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;		//return 'KKM-'.$no;	}
}