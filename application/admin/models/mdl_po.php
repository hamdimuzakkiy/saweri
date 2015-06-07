<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_po extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('pembelian.*, supplier.nama AS nama_supplier, cabang.*');
		$this->db->from('pembelian');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');
		
		if(get_kodecabang() == '001'){	// jika masuk sebagai pusat
			if(get_userlevel() != 'ADM'){ # jika bukan super admin
				$this->db->where('cabang.kode_cabang', get_kodecabang());
			}
			
		}else{							// jika masuk sebagai cabang
			$this->db->where('cabang.kode_cabang', get_kodecabang());
		}
		
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		return $this->db->get('pembelian');
	}
	
	
	
}