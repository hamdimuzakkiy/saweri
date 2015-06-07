<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_penerimaan_kas extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0,$date_now)
	{
		/*$this->db->flush_cache();
		$this->db->select('penjualan.id_penjualan, penjualan.so_no, pelanggan.kode_pelanggan, pelanggan.nama AS nama_pelanggan, cabang.nama_cabang, 		penjualan.tanggal,penjualan.kd_akun,penjualan.id_pelanggan,penjualan.total,penjualan.cara_bayar,penjualan.id_cabang');
		$this->db->from('penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('penjualan.posting','0');
		$this->db->limit($num, $offset);
		return $this->db->get();*/					
		$query = "SELECT					jurnal.GLID_PARENT,					jurnal.GLID,					jurnal.TANGGAL,					jurnal.PO_NO,					detail_jurnal.DEBET,					detail_jurnal.KREDIT,					detail_jurnal.AKUNID,					detail_jurnal.KETERANGAN,					LEFT(jurnal.GLID_PARENT,3) as penerimaan_kas					FROM					jurnal					Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					where (LEFT(jurnal.GLID_PARENT,3)='BKM') and (jurnal.TANGGAL = '" . $date_now . "')					GROUP BY					jurnal.GLID_PARENT,					jurnal.GLID,					jurnal.PO_NO,					detail_jurnal.DEBET,					detail_jurnal.KREDIT,					detail_jurnal.AKUNID,					jurnal.GLID_ANGSURAN";		$this->db->flush_cache();		return $this->db->query($query);
	}		
	function count_getItem(){			
	$this->db->flush_cache();		$this->db->select('penjualan.id_penjualan, penjualan.so_no, pelanggan.kode_pelanggan, pelanggan.nama AS nama_pelanggan, cabang.nama_cabang, 		penjualan.tanggal,penjualan.kd_akun,penjualan.id_pelanggan,penjualan.id_cabang');		$this->db->from('penjualan');		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');		$this->db->join('daftar_piutang', 'daftar_piutang.so_no = penjualan.so_no');		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('penjualan.posting','0');					return $this->db->count_all_results();		}		function get_total_tiap_akun($akunid,$num=false){		$this->db->flush_cache();		$this->db->select('detail_jurnal.ID,			detail_jurnal.GLID,			detail_jurnal.AKUNID,			Sum(detail_jurnal.DEBET) as total_debet,			Sum(detail_jurnal.KREDIT) as total_kredit,			Sum(detail_jurnal.DEBET)-Sum(detail_jurnal.KREDIT) as total_kas');		$this->db->from('detail_jurnal');		$this->db->group_by('detail_jurnal.AKUNID');		$this->db->where('detail_jurnal.AKUNID', $akunid);				if($num)		{		    return $this->db->count_all_results();		}		return $this->db->get();	}		function get_datafordetailjurnal($so_no){		$this->db->flush_cache();				$this->db->select('jurnal.PO_NO,						jurnal.GLID,						detail_penjualan.id_penjualan,						detail_penjualan.harga,						barang.id_kategori,						kategori.kategori,						kategori.akunid,						detail_penjualan.id_barang');		$this->db->from('jurnal');		$this->db->join('penjualan', 'penjualan.so_no = jurnal.PO_NO');		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan = penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('jurnal.PO_NO',$so_no);		return $this->db->get();	}		function get_master_akun(){		$query = "SELECT distinct(AKUNID), NAKUN from master_akun where AKUNID LIKE '42%'";		$this->db->flush_cache();		return $this->db->query($query);	}
		function insert($data)	{	
		$this->db->flush_cache();	
		$this->db->insert('jurnal', $data);	}	
		function insert_penerimaan($data){	
		$this->db->flush_cache();		
		$this->db->insert('penerimaan_kas', $data);	}	
		function insert_detail_penerimaan($data){	
		$this->db->flush_cache();	
		$this->db->insert('detail_penerimaan_kas', $data);	}	
		function insert_detailJ($data)	{		
		$this->db->flush_cache();	
		$this->db->insert('detail_jurnal', $data);	}	
		function update($id, $data)	{	
		$this->db->flush_cache();	
		$this->db->where('so_no', $id);	
		$this->db->update('penjualan', $data);	}	
		function get_detail_penjualan($so_no){		$this->db->flush_cache();		
		$this->db->select('penjualan.so_no,						penjualan.id_penjualan,						detail_penjualan.id_barang,						detail_penjualan.harga,						detail_penjualan.qty,						detail_penjualan.total,						barang.nama_barang,						barang.id_kategori,						kategori.akunid,						kategori.kategori');		$this->db->from('penjualan');		$this->db->join('detail_penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		
		$this->db->where('penjualan.so_no',$so_no);		return $this->db->get();	}		
		function get_glid(){		$this->db->flush_cache();		
		/*$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");	*/
		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		
		/*ngambil no autoincrement dan akhirnya jadi-> '000x'		*/
		$tmp_no = $query1->row()->Auto_increment;	
		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);	
		return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;	
		/*return 'KKM-'.$no;*/
		}		
		function get_glid_penerimaan(){	
		$this->db->flush_cache();		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'penerimaan_kas'");	
		/* ngambil no autoincrement dan akhirnya jadi-> '000x'	*/
		$tmp_no = $query1->row()->Auto_increment;		
		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);	
		return 'BKM/'.substr(date('Y'),2,2).date('md').'/'.$no;	
		/*return 'KKM-'.$no;	*/
		}
}