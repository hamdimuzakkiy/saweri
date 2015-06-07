<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_golongan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('golongan.id_golongan, golongan.golongan,jenis.jenis');
		$this->db->from('golongan');
		$this->db->join('jenis','jenis.id_jenis = golongan.jenis');		
		$this->db->order_by("golongan.golongan", "asc");
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('golongan.id_golongan, golongan.golongan,jenis.jenis');
		$this->db->from('golongan');
		$this->db->join('jenis','jenis.id_jenis = golongan.jenis');		
		$this->db->order_by("golongan", "asc");
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_golongan', $id);
		return $this->db->get('golongan');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('golongan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_golongan', $id);
		$this->db->update('golongan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('golongan', array('id_golongan' => $id));
	}
	
}