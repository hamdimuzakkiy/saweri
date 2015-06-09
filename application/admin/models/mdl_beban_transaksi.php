<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_beban_transaksi extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}

	function count()
	{
		$this->db->flush_cache();		
		$this->db->from('beban_transaksi');		
		return $this->db->get();
	}

	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();		
		$this->db->from('beban_transaksi');		
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		return $this->db->get('beban_transaksi');
	}

	function update($id,$data)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update('beban_transaksi', $data);
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('beban_transaksi', $data);
	}

	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('beban_transaksi', array('id' => $id));
	}
}