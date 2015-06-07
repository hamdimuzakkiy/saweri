<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_kode_trans extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		return $this->db->get('setting_kode_trans', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		return $this->db->get('setting_kode_trans');
	}
	
	function get_kd_awal($nama_transaksi)
	{
		$this->db->flush_cache();
		$this->db->select('kd_trans');
		$this->db->from('setting_kode_trans');
		$this->db->where('transaksi', $nama_transaksi);
		return $this->db->get();
	}
	
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('setting_kode_trans', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id', $id);
		$this->db->update('setting_kode_trans', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('setting_kode_trans', array('id' => $id));
	}
	
	function get_kode_setting_kode_trans()
	{
		# ambil nomer running berdasarkan
		$this->db->flush_cache();
		$this->db->from('setting_kode_trans');
		$this->db->like('kode_setting_kode_trans', 'P', 'after');
		$query = $this->db->get();
		
		$kode_setting_kode_trans = $query->num_rows();
		$kode_setting_kode_trans = (int) $kode_setting_kode_trans + 1;
		$kode_setting_kode_trans = str_pad($kode_setting_kode_trans, 4, '0', STR_PAD_LEFT);
		
		return 'P'.$kode_setting_kode_trans;
		
	}
}