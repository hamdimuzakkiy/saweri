<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_kas_awal extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$query = "SELECT distinct(AKUNID),NAKUN FROM `master_akun` where AKUNID LIKE '11%'";		
		$this->db->flush_cache();		
		return $this->db->query($query);
	}		
	function count_getItem(){				
		$query = "SELECT distinct(AKUNID),NAKUN FROM `master_akun` where AKUNID LIKE '1%'";		$this->db->flush_cache();				return $this->db->count_all_results();		}		function get_datafordetailjurnal($so_no){		$this->db->flush_cache();				$this->db->select('jurnal.PO_NO,						jurnal.GLID,						detail_penjualan.id_penjualan,						detail_penjualan.harga,						barang.id_kategori,						kategori.kategori,						kategori.akunid,						detail_penjualan.id_barang');		$this->db->from('jurnal');		$this->db->join('penjualan', 'penjualan.so_no = jurnal.PO_NO');		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan = penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('jurnal.PO_NO',$so_no);		return $this->db->get();	}
	function insert($data)	{
		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	
	}		function insert_detailJ($data)	{
		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	
	}		function update($id, $data)	{		
		$this->db->flush_cache();		
		$this->db->where('so_no', $id);		$this->db->update('penjualan', $data);	
	}
	function get_detail_penjualan($so_no){
			$this->db->flush_cache();		
			$this->db->select('penjualan.so_no,penjualan.id_penjualan,detail_penjualan.id_barang,
			detail_penjualan.harga,detail_penjualan.qty,detail_penjualan.total,barang.nama_barang,
			barang.id_kategori,kategori.akunid,kategori.kategori');		
			$this->db->from('penjualan');		
			$this->db->join('detail_penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');		
			$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		
			$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		
			$this->db->where('penjualan.so_no',$so_no);		return $this->db->get();	
			}		
			function get_glid(){		
			$this->db->flush_cache();		
			/*$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");		*/
			$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		
			/* ngambil no autoincrement dan akhirnya jadi-> '000x'		*/
			$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		
			return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;		
			/*return 'KKM-'.$no;	*/
			}			
		function get_sum_kas(){			
		$query = "SELECT DISTINCT detail_jurnal.DEBET,master_akun.NAKUN,master_akun.AKUNID FROM detail_jurnal 
		JOIN jurnal ON detail_jurnal.GLID = jurnal.GLID				
		JOIN master_akun ON detail_jurnal.AKUNID = master_akun.AKUNID				
		where jurnal.KAS_AWAL=1				";		$this->db->flush_cache();		
		return $this->db->query($query);						return $this->db->get();	
	}
}