<?php if(!defined('BASEPATH')) exit('No direct script allowed');
class mdl_master_pulsa extends CI_Model
{		function __construct()	
	{		
		parent::__construct();	
	}		
	function getItem($num=0, $offset=0)	
	{		
		$this->db->flush_cache();		
		$this->db->select('master_pulsa.id_pulsa, master_pulsa.kode_pulsa, master_pulsa.nama_pulsa, master_saldo_elektrik.nama_mastersaldo AS nama_mastersaldo, kategori.kategori AS nama_kategori, master_pulsa.hpp, master_pulsa.harga_toko, master_pulsa.harga_partai, master_pulsa.harga_cabang');		
		$this->db->from('master_pulsa');		
		$this->db->join('jenis', 'jenis.id_jenis = master_pulsa.id_jenis');				
		$this->db->join('master_saldo_elektrik', 'master_saldo_elektrik.id_saldo = master_pulsa.id_saldo');				
		$this->db->join('kategori', 'kategori.id_kategori = master_pulsa.id_kategori');		
		// $this->db->where('master_pulsa.id_jenis !=', '3');		
		$this->db->order_by("master_pulsa.nama_pulsa", "asc");		
		$this->db->limit($num, $offset);		
		return $this->db->get();	
	}		

	function getallItem()
	{
		$this->db->flush_cache();		
		$this->db->select('master_pulsa.id_pulsa, master_pulsa.kode_pulsa, master_pulsa.nama_pulsa, master_saldo_elektrik.nama_mastersaldo AS nama_mastersaldo, kategori.kategori AS nama_kategori, master_pulsa.hpp, master_pulsa.harga_toko, master_pulsa.harga_partai, master_pulsa.harga_cabang');		
		$this->db->from('master_pulsa');		
		$this->db->join('jenis', 'jenis.id_jenis = master_pulsa.id_jenis');				
		$this->db->join('master_saldo_elektrik', 'master_saldo_elektrik.id_saldo = master_pulsa.id_saldo');				
		$this->db->join('kategori', 'kategori.id_kategori = master_pulsa.id_kategori');		
		// $this->db->where('master_pulsa.id_jenis !=', '3');		
		$this->db->order_by("master_pulsa.nama_pulsa", "asc");	
		return $this->db->count_all_results();
	}

	function get_saldo_elektrik($id)
	{		
		$this->db->flush_cache();				
		$this->db->where('id_saldo', $id);		
		return $this->db->get('master_saldo_elektrik');			
	}		

	function update_saldo_transaksi($id, $data)	
	{		
		$this->db->flush_cache();		
		$this->db->where('id_saldo', $id);		
		$this->db->update('master_saldo_elektrik', $data);	
	}			

	function getItemById($id)	
	{		
		$this->db->flush_cache();		
		$this->db->where('id_pulsa', $id);		
		return $this->db->get('master_pulsa');	
	}	function insert($data)	

	{		
		$this->db->flush_cache();		
		$this->db->insert('master_pulsa', $data);	
	}

	function update($id, $data)	
	{		
		$this->db->flush_cache();		
		$this->db->where('id_pulsa', $id);		
		$this->db->update('master_pulsa', $data);	
	}		

	function delete($id)	
	{		
		$this->db->flush_cache();		
		$this->db->delete('master_pulsa', array('id_pulsa' => $id));	
	}	
}