<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_perusahaan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function countallItem()
	{
		$this->db->flush_cache();
		$this->db->select('karyawan.*, cabang.nama_cabang, users.username, users.password, users.level_id');
		$this->db->from('karyawan');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->join('users','users.userid = karyawan.userid');
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->select('karyawan.*, cabang.nama_cabang, users.username, users.password, users.level_id');
		$this->db->from('karyawan');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->join('users','users.userid = karyawan.userid');
		$this->db->where('karyawan.id_karyawan', $id);
		return $this->db->get();
	}
    
	function update($id, $data)
	{		
		$this->db->flush_cache();		
		$this->db->where('id_karyawan', $id);
		$this->db->update('karyawan', $data);
	}
	
	function delete_users($id)
	{
		$this->db->flush_cache();
		$this->db->delete('users', array('userid' => $id));
	}
	
}