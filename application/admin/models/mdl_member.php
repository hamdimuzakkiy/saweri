<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_member extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('id_pelanggan, kode_pelanggan, nama, alamat, jenis_pengenal, no_pengenal, tgl_lahir, agama, pekerjaan, tel, saldo_piutang, point');
		$this->db->where('status', "member");
		$this->db->from('pelanggan');
		$this->db->order_by("pelanggan.nama", "asc");
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function getallItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('id_pelanggan, kode_pelanggan, nama, alamat, jenis_pengenal, no_pengenal, tgl_lahir, agama, pekerjaan, tel, saldo_piutang, point');
		$this->db->where('status', "member");
		$this->db->from('pelanggan');
		$this->db->order_by("pelanggan.nama", "asc");
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pelanggan', $id);
		$this->db->where('status', "member");
		return $this->db->get('pelanggan');
	}
        
        function getItemByKode($kode)
	{
		$this->db->flush_cache();
		$this->db->where('kode_pelanggan', $kode);
		$this->db->where('status', "member");
		return $this->db->get('pelanggan');
	}
        
	function insert($data)
	{
		$this->db->flush_cache();
		$data['status'] = "member";
		$this->db->insert('pelanggan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_pelanggan', $id);
		$this->db->where('status', "member");
		$this->db->update('pelanggan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('pelanggan', array('id_pelanggan' => $id));
	}
	
	# untuk meng-generate nomer PO
	function get_kode_pelanggan()
	{
		# ambil nomer running berdasarkan
		$this->db->flush_cache();
		$this->db->from('pelanggan');
		$this->db->like('kode_pelanggan', 'S', 'after');
		$query = $this->db->get();
		
		$kode_pelanggan = $query->num_rows();
		$kode_pelanggan = (int) $kode_pelanggan + 1;
		$kode_pelanggan = str_pad($kode_pelanggan, 4, '0', STR_PAD_LEFT);
		
		return 'S'.$kode_pelanggan;
		
	}
	
}