<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_area extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		
		$this->db->flush_cache();		
		$this->db->order_by("kecamatan", "asc");
		$this->db->order_by("kabupaten", "asc");
		$this->db->select('area.id_area, area.area, kecamatan.kecamatan, kabupaten.kabupaten, count(pelanggan.id_area) as jumlah_pelanggan');
		$this->db->from('area');		
		$this->db->join('pelanggan', 'pelanggan.id_area = area.id_area','left');		
		$this->db->join('kecamatan', 'area.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'area.id_kabupaten = kabupaten.id_kabupaten');				
		$this->db->group_by('area.id_area');		
		$this->db->limit($num, $offset);				
		return $this->db->get();		
	}

	function getallItem()
	{
		
		$this->db->flush_cache();		
		$this->db->order_by("kecamatan", "asc");
		$this->db->order_by("kabupaten", "asc");
		$this->db->select('area.id_area, area.area, kecamatan.kecamatan, kabupaten.kabupaten, count(pelanggan.id_area) as jumlah_pelanggan');
		$this->db->from('area');		
		$this->db->join('pelanggan', 'pelanggan.id_area = area.id_area','left');		
		$this->db->join('kecamatan', 'area.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'area.id_kabupaten = kabupaten.id_kabupaten');								
		return $this->db->count_all_results();		
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_area', $id);
		return $this->db->get('area');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('area', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_area', $id);
		$this->db->update('area', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('area', array('id_area' => $id));
	}
	
	function getAll()
	{
		$this->db->select('area.*, kecamatan.*, kabupaten.*');
		$this->db->from('area', 'kecamatan', 'kabupaten');
		$this->db->where('id_cabang', 'kecamatan', 'kabupaten', $id);
		return $this->db->get('cabang', 'kecamatan', 'kabupaten');
		
		return $this->db->get();
	}
	
}