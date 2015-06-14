<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_cabang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('cabang.id_cabang, cabang.kode_cabang, cabang.nama_cabang, cabang.alamat, cabang.telepon, cabang.max_piutang, cabang.saldo_piutang');
		$this->db->from('cabang');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('cabang.id_cabang, cabang.kode_cabang, cabang.nama_cabang, cabang.alamat, cabang.telepon, cabang.max_piutang, cabang.saldo_piutang');
		$this->db->from('cabang');
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
                //$this->db->select('*');
		$this->db->where('id_cabang', $id);
		return $this->db->get('cabang');
	}

	function getItemByKode($id)
	{
		$this->db->flush_cache();
                //$this->db->select('*');
		$this->db->where('kode_cabang', $id);
		return $this->db->get('cabang');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('cabang', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_cabang', $id);
		$this->db->update('cabang', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('cabang', array('id_cabang' => $id));
	}
	
}