<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_setting_view extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('setting_view', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		return $this->db->get('setting_view');
	}
	


	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('setting_view', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update('setting_view', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('setting_view', array('id' => $id));
	}
	
	function get_kode_setting_view()
	{
		/* ambil nomer running berdasarkan */
		
		
		$this->db->flush_cache();
		$this->db->from('setting_view');
		$this->db->like('kode_setting_view', 'P', 'after');
		$query = $this->db->get();
		
		$kode_setting_view = $query->num_rows();
		$kode_setting_view = (int) $kode_setting_view + 1;
		$kode_setting_view = str_pad($kode_setting_view, 4, '0', STR_PAD_LEFT);
		
		return 'P'.$kode_setting_view;
		
	}
}