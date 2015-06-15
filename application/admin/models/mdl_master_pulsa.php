<?php if(!defined('BASEPATH')) exit('No direct script allowed');
class mdl_master_pulsa extends CI_Model
{		function __construct()	
	{		
		parent::__construct();	
	}		
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('barang.id_barang, barang.nama_barang, jenis.jenis AS nama_jenis, kategori.kategori AS nama_kategori, satuan.satuan AS nama_satuan, golongan.golongan AS nama_golongan, barang.point_barangpoint AS point_barangpoint,barang.kode');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		$this->db->join('satuan', 'satuan.id_satuan = barang.id_satuan');
		$this->db->join('golongan', 'golongan.id_golongan = barang.id_golongan');		
		$this->db->order_by("barang.nama_barang", "asc");
		$this->db->where('barang.jenis_barang', 'pulsa');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function getallItem()
	{
		$this->db->flush_cache();
		$this->db->select('barang.id_barang, barang.nama_barang, jenis.jenis AS nama_jenis, kategori.kategori AS nama_kategori, satuan.satuan AS nama_satuan, golongan.golongan AS nama_golongan, barang.point_barangpoint AS point_barangpoint');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		$this->db->join('satuan', 'satuan.id_satuan = barang.id_satuan');
		$this->db->join('golongan', 'golongan.id_golongan = barang.id_golongan');
		$this->db->where('barang.jenis_barang', 'pulsa');
		return $this->db->count_all_results();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_barang', $id);
		$this->db->where('barang.jenis_barang', 'pulsa');
		return $this->db->get('barang');
	}

        function getItemByKode($kode)
	{
		$this->db->flush_cache();
		$this->db->where('barang.kode', $kode);
                $this->db->where('barang.jenis_barang', 'pulsa');
		return $this->db->get('barang');
	}
        
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_barang', $id);
		$this->db->update('barang', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('barang', array('id_barang' => $id));
	}	


	function get_saldo_elektrik($id)
	{		
		$this->db->flush_cache();				
		$this->db->where('id_saldo', $id);		
		return $this->db->get('master_saldo_elektrik');			
	}		

	function update_saldo_transaksi($id, $data)	
	{		
		$this->db->flush_cache();		
		$this->db->where('id_saldo', $id);		
		$this->db->update('master_saldo_elektrik', $data);	
	}			

		
	function insert($data)	
	{		
		$data['jenis_barang'] = 'pulsa';
		$this->db->flush_cache();		
		$this->db->insert('master_pulsa', $data);	
	}

		
}