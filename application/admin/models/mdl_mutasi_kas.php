<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_mutasi_kas extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*function getItem($num=0, $offset=0)
	{
		$query = 'SELECT sum(detail_pembelian.qty) AS qty, barang.nama_barang, barang.id_barang, jenis.jenis, kategori.kategori, supplier.nama FROM (`pembelian`) 
					JOIN `supplier` ON `supplier`.`id_supplier` = `pembelian`.`id_supplier` 
					JOIN `detail_pembelian` ON `detail_pembelian`.`id_pembelian` = `pembelian`.`id_pembelian` 
					JOIN `barang` ON `barang`.`id_barang` = `detail_pembelian`.`id_barang` 
					JOIN `jenis` ON `jenis`.`id_jenis` = `barang`.`id_jenis` 
					JOIN `kategori` ON `kategori`.`id_kategori` = `barang`.`id_kategori` 
					group by barang.id_barang, barang.nama_barang, jenis.jenis, kategori.kategori, supplier.nama ';
	
		$this->db->flush_cache();
		return $this->db->query($query);
	}*/		
	function getItem($num=0, $offset=0){		$query = "SELECT					jurnal.GLID_PARENT,					jurnal.GLID,					jurnal.TANGGAL,					jurnal.PO_NO,					detail_jurnal.DEBET,					detail_jurnal.KREDIT,					detail_jurnal.AKUNID,					LEFT(jurnal.GLID_PARENT,3) as mutasi					FROM					jurnal					Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					where LEFT(jurnal.GLID_PARENT,3)='MKK'					GROUP BY					jurnal.GLID_PARENT,					jurnal.GLID,					jurnal.PO_NO,					detail_jurnal.DEBET,					detail_jurnal.KREDIT,					detail_jurnal.AKUNID,					jurnal.GLID_ANGSURAN ";		$this->db->flush_cache();		return $this->db->query($query);	}
	function get_master_akun(){		$this->db->flush_cache();		$this->db->select('distinct(AKUNID),NAKUN');		$this->db->from('master_akun');		$this->db->like('AKUNID','11','after');		return $this->db->get();	}		function get_total_tiap_akun($akunid,$num=false){		$this->db->flush_cache();		$this->db->select('detail_jurnal.ID,			detail_jurnal.GLID,			detail_jurnal.AKUNID,			Sum(detail_jurnal.DEBET) as total_debet,			Sum(detail_jurnal.KREDIT) as total_kredit,			Sum(detail_jurnal.DEBET)-Sum(detail_jurnal.KREDIT) as total_kas');		$this->db->from('detail_jurnal');		$this->db->group_by('detail_jurnal.AKUNID');		$this->db->where('detail_jurnal.AKUNID', $akunid);		if($num)		{		    return $this->db->count_all_results();		}		return $this->db->get();			/*			SELECT			master_akun.NAKUN,			detail_jurnal.ID,			detail_jurnal.GLID,			detail_jurnal.AKUNID,			Sum(detail_jurnal.DEBET),			Sum(detail_jurnal.KREDIT),			Sum(detail_jurnal.KREDIT)-Sum(detail_jurnal.DEBET)			FROM			detail_jurnal			Inner Join master_akun ON detail_jurnal.AKUNID = master_akun.AKUNID			group by detail_jurnal.AKUNID		*/	}			function insert($data)	{		$this->db->flush_cache();		$this->db->insert('mutasi_kas', $data);	}		function insert_J($data)	{		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	}		function insert_detail($data)	{		$this->db->flush_cache();		$this->db->insert('detail_mutasi', $data);	}		function insert_detail_J($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function get_glid(){		$this->db->flush_cache();		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'mutasi_kas'");				
	// ngambil no autoincrement dan akhirnya jadi-> '000x'		
	$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		return 'MKK/'.substr(date('Y'),2,2).date('md').'/'.$no;		
	//return 'KKM-'.$no;	
	}		function get_glid_jurnal(){		$this->db->flush_cache();		
	//$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");		
	$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		
	// ngambil no autoincrement dan akhirnya jadi-> '000x'		
	$tmp_no = $query1->row()->Auto_increment;		
	$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		
	return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;		
	//return 'KKM-'.$no;	
	}		function getItem_posting(){		$this->db->flush_cache();		$this->db->select('*');		$this->db->from('mutasi_kas');		$this->db->where('mutasi_kas.status_posting', '0');		return $this->db->get();	}
	
}