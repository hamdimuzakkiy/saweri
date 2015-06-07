<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_request_order extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('request_order.id_request, request_order.tanggal, cabang.nama_cabang, cabang.kode_cabang');
		$this->db->from('request_order');
		$this->db->join('cabang', 'cabang.id_cabang = request_order.id_cabang');
		
		if(get_kodecabang() == '001'){	// jika masuk sebagai pusat
			if(get_userlevel() != 'ADM'){ # jika bukan super admin
				$this->db->where('cabang.kode_cabang', get_kodecabang());
			}
			
		}else{							// jika masuk sebagai cabang
			$this->db->where('cabang.kode_cabang', get_kodecabang());
		}
		
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function count()
	{
		$this->db->flush_cache();
		$this->db->select('request_order.id_request, request_order.tanggal, cabang.nama_cabang, cabang.kode_cabang');
		$this->db->from('request_order');
		$this->db->join('cabang', 'cabang.id_cabang = request_order.id_cabang');
		
		if(get_kodecabang() == '001'){	// jika masuk sebagai pusat
			if(get_userlevel() != 'ADM'){ # jika bukan super admin
				$this->db->where('cabang.kode_cabang', get_kodecabang());
			}
			
		}else{							// jika masuk sebagai cabang
			$this->db->where('cabang.kode_cabang', get_kodecabang());
		}
		
		
		return sizeof($this->db->get()->result());
	}

	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->select('request_order.*, cabang.nama_cabang, cabang.kode_cabang');
		$this->db->from('request_order');
		$this->db->join('cabang', 'cabang.id_cabang = request_order.id_cabang');
		$this->db->where('id_request', $id);
		return $this->db->get();
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('request_order', $data);
	}
	
	function insert_detail($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_request_order', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_request', $id);
		$this->db->update('request_order', $data);
	}
	
	function delete($id)
	{
		# delete reques order
		$this->db->flush_cache();
		$this->db->delete('request_order', array('id_request' => $id));
		
		# delete detail reques order
		$this->db->flush_cache();
		$this->db->delete('detail_request_order', array('id_request' => $id));
	}
	
	
	function get_detail($id_request)
	{
		$this->db->flush_cache();
		$this->db->select('detail_request_order.*, barang.*');
		$this->db->from('detail_request_order');
		$this->db->join('barang', 'barang.id_barang = detail_request_order.id_barang');
		$this->db->where('detail_request_order.id_request', $id_request);
		return $this->db->get();
	}
	
	
	# untuk di list barang pada fancyBox
	function get_barang()
	{
		$this->db->flush_cache();
		$this->db->select('barang.id_barang AS id_barang, barang.nama_barang AS nama_barang, barang.harga_toko AS harga_barang, jenis.jenis AS jenis_barang, kategori.kategori AS kategori_barang');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		return $this->db->get();
	}		
	
}