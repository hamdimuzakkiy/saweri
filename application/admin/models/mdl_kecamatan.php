<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_kecamatan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('kabupaten');
		$this->db->join('kecamatan','kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function count($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('kabupaten');
		$this->db->join('kecamatan','kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_kecamatan', $id);
		return $this->db->get('kecamatan');
	}
        function getNama($nama,$id_kabupaten){
            $this->db->flush_cache();
            $this->db->where('kecamatan', $nama);
            $this->db->where('id_kabupaten',$id_kabupaten);
            return $this->db->get('kecamatan');
        }
        
        function getKabupaten($id){
		$this->db->flush_cache();
		$this->db->where('id_kecamatan', $id);
		return $this->db->get('kecamatan');            
        }
        

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('kecamatan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_kecamatan', $id);
		$this->db->update('kecamatan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('kecamatan', array('id_kecamatan' => $id));
	}
	
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('kecamatan');
		return $this->db->get();
	}
	
}