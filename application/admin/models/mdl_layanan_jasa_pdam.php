<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_layanan_jasa_pdam extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('layanan_jasa.*,jenis_layanan.jenis_layanan as jenis_layanan');
		$this->db->from('layanan_jasa');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jlayanan = layanan_jasa.jenis_layanan');
		$this->db->where('layanan_jasa.jenis_layanan', '3');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_layanan_jasa', $id);
		return $this->db->get('layanan_jasa');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('layanan_jasa', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_layanan_jasa', $id);
		$this->db->update('layanan_jasa', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('layanan_jasa', array('id_layanan_jasa' => $id));
	}
	
}