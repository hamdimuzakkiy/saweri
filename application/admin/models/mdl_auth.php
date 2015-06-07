<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_auth extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function get_user($username, $password){
		$this->db->flush_cache();
		$this->db->select('users.*, cabang.id_cabang, cabang.kode_cabang, cabang.nama_cabang, cabang.alamat');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		return $this->db->get();
	}
	
	function get_userByToken($token){
		$this->db->flush_cache();
		$this->db->where('token', $token);
		return $this->db->get('users_token');
	}
	
	function get_logged_as($id){
		$this->db->flush_cache();
		$this->db->select('karyawan.nama AS `nama`, users_level.nama AS level');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('users_level', 'users_level.level_id = users.level_id', 'INNER');
		$this->db->where('users.userid', $id);
		
		$query = $this->db->get();
		
		return $query->row()->nama.' ('.$query->row()->level.')';
	}
	
	function set_token($userid, $token){
		$this->db->flush_cache();
		$this->db->where('userid', $userid);
		$this->db->delete('users_token');
		$this->db->flush_cache();
		$this->db->set('userid', $userid);
		$this->db->set('token', $token);
		$this->db->insert('users_token');
	}
	
	
}
