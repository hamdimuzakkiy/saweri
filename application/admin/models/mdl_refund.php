<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_refund extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{		$this->db->flush_cache();
		$this->db->select('jurnal.*,supplier.nama as nama_supplier,pelanggan.nama as nama_pelanggan');		
		$this->db->from('jurnal');		$this->db->join('supplier', 'supplier.id_supplier = jurnal.KOUNIT');		
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = jurnal.PARTNERID');		return $this->db->get();
	}	function getItemById($id){		$this->db->flush_cache();		$this->db->select('*');		$this->db->from('jurnal');		$this->db->where('jurnal.ID', $id);		return $this->db->get();	}
	function get_master_akun($filter){		$this->db->flush_cache();		$this->db->select('distinct(AKUNID),NAKUN');		$this->db->from('master_akun');		if ($filter=='kas'){			$this->db->like('akunid', '11', 'after'); 		}else if($filter=='transaksi'){			$this->db->like('akunid', '4', 'after'); 			$this->db->or_like('akunid', '5', 'after'); 		}		
	$this->db->order_by('AKUNID');		
	//$this->db->limit($num, $offset);		
	return $this->db->get();	
	}		function insert_J($data)	{		$this->db->flush_cache();		
	$this->db->insert('jurnal', $data);	}		
	function insert_R($data)	{		
	$this->db->flush_cache();		$this->db->insert('refund', $data);	}		function insert_detailJ($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function insert_detailR($data)	{		$this->db->flush_cache();		$this->db->insert('detail_refund', $data);	}		function get_item_jurnal_detail($glid){		$this->db->flush_cache();		
	$this->db->select('*');		
	//$this->db->select('detail_jurnal.*,master_akun.NAKUN');		
	$this->db->from('detail_jurnal');		
	//$this->db->join('master_akun', 'master_akun.AKUNID = detail_jurnal.AKUNID');		
	//$this->db->join('jurnal', 'jurnal.GLID = detail_jurnal.GLID');		
	$this->db->where('detail_jurnal.GLID', $glid);		return $this->db->get();	}	function get_item_jurnal($glid){		$query="SELECT 			jurnal.PO_NO,jurnal.GLID,LEFT(jurnal.PO_NO,2) as PO_ID,jurnal.KOUNIT,jurnal.PARTNERID  			FROM			jurnal			where jurnal.GLID = '" . $glid . "'			";						$this->db->flush_cache();		return $this->db->query($query);	}			function get_glid(){		$this->db->flush_cache();		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'daftar_hutang'");				
	// ngambil no autoincrement dan akhirnya jadi-> '000x'		
	$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		return 'MKK/'.substr(date('Y'),2,2).date('md').'/'.$no;		
	//return 'KKM-'.$no;	
	}		
	function get_glid_jurnal(){		$this->db->flush_cache();		
	//$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'detail_jurnal'");		
	$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'jurnal'");		
	// ngambil no autoincrement dan akhirnya jadi-> '000x'		
	$tmp_no = $query1->row()->Auto_increment;		
	$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		
	return 'AR/'.substr(date('Y'),2,2).date('md').'/'.$no;		
	//return 'KKM-'.$no;	
	}	
}