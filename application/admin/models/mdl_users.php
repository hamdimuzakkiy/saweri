<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_users extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('users.userid AS userid, users.username AS username, karyawan.nama AS nama, users.id_cabang AS cabang, users_level.nama AS level, cabang.nama_cabang AS nama_cabang');
		$this->db->from('users');
		$this->db->join('users_level', 'users_level.level_id = users.level_id', 'INNER');
		$this->db->join('cabang', 'cabang.id_cabang = users.id_cabang');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		return $this->db->get('', $num, $offset);
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('userid', $id);
		return $this->db->get('users');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('users', $data);
	}
        
	function checkPass($username,$password){
        $this->db->flush_cache();
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return $this->db->get("users");
        }
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('userid', $id);
		$this->db->update('users', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('users', array('userid' => $id));
	}
	
}
