<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_kategori extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('kategori.id_kategori, kategori.kategori, jenis.jenis');
		$this->db->from('kategori');
		$this->db->join('jenis','jenis.id_jenis = kategori.jenis');
		$this->db->order_by("kategori.kategori", "asc");
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('kategori.id_kategori, kategori.kategori, jenis.jenis');
		$this->db->from('kategori');
		$this->db->join('jenis','jenis.id_jenis = kategori.jenis');		
		$this->db->order_by("kategori.kategori", "asc");
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_kategori', $id);
		return $this->db->get('kategori');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('kategori', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_kategori', $id);
		$this->db->update('kategori', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('kategori', array('id_kategori' => $id));
	}
	
}