<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_penjualan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.id_penjualan, penjualan.diskon,  penjualan.so_no, 					
		pelanggan.kode_pelanggan AS kode_pelanggan, pelanggan.nama AS nama_pelanggan, pelanggan.saldo_piutang,pelanggan.max_piutang,
		cabang.nama_cabang, penjualan.tanggal, penjualan.jatuh_tempo');
		$this->db->from('penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = substring(penjualan.id_pelanggan,5,1)');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		
		$this->db->where('penjualan.posting', '0');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}

	function counts()
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.id_penjualan, penjualan.diskon,  penjualan.so_no, 								
		pelanggan.kode_pelanggan AS kode_pelanggan, pelanggan.nama AS nama_pelanggan, pelanggan.saldo_piutang,pelanggan.max_piutang,
		cabang.nama_cabang, penjualan.tanggal, penjualan.jatuh_tempo');
		$this->db->from('penjualan');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = substring(penjualan.id_pelanggan,5,1)');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		
		$this->db->where('penjualan.posting', '0');		
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		return $this->db->get('penjualan');
	}		
	
	function get_kd_awal()
	{		
		$this->db->flush_cache();		
		$this->db->select('kd_trans');		
		$this->db->from('setting_kode_trans');		
		$this->db->where('transaksi', 'penjualan');		
		return $this->db->get();	
	}
	
	function get_total_penjualan_by_pelanggan($id_pelanggan)
	{		
		$this->db->select('sum(total) as sum_total');		
		$this->db->from('penjualan');		
		$this->db->where('id_pelanggan', $id_pelanggan);		
		$this->db->group_by('id_pelanggan');		
		return $this->db->get();	
	}
	
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('penjualan', $data);
	}
	
	function insert_detail($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_penjualan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		$this->db->update('penjualan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('penjualan', array('id_penjualan' => $id));
	}
	
	
	function get_detail($id_request)
	{
		$this->db->flush_cache();
		$this->db->select('detail_penjualan.*, barang.*');
		$this->db->from('detail_penjualan');
		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');
		$this->db->where('id_penjualan', $id_request);
		return $this->db->get();
	}
	
	
	function get_so($kode_transaksi)
	{
		
		$code_user = get_userid();
		$code_user = str_pad($code_user, 3, '0', STR_PAD_LEFT);
		
		
		$this->db->flush_cache();
		$this->db->select('users.*, cabang.*, karyawan.*');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->where('users.userid', get_userid());
		$kode_cabang = $this->db->get()->row()->kode_cabang;
		
		
		$tanggal = date('ymd');
		
		
		$this->db->flush_cache();
		$this->db->from('penjualan');
		$this->db->like('so_no', $kode_transaksi . '-'.$kode_cabang.$code_user, 'after');
		$query = $this->db->get();
		
		$no_so = $query->num_rows();
		$no_so = (int) $no_so + 1;
		$no_so = str_pad($no_so, 6, '0', STR_PAD_LEFT);
		
		return  $kode_transaksi . '-'.$kode_cabang.$code_user.$tanggal.$no_so; 
		/*return  $kode_transaksi . '-'.$tanggal.$no_so; */
		
	}
	
	
	function get_barang($posisibarang, $nilaiposisi)
	{		
		$this->db->flush_cache();				/*
		$this->db->select('pembelian.id_pembelian, detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, jenis.*, kategori.*, barang.nama_barang, detail_pembelian.harga, detail_pembelian.sn, barang.is_hargatoko, barang.is_hargapartai, barang.is_hargajual');
		$this->db->from('pembelian');
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		$this->db->group_by('detail_pembelian.id_barang');
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		$this->db->where('pembelian.id_cabang', get_idcabang()); */				
		/*		$this->db->select('pembelian.id_pembelian,					
		detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, 						
		jenis.*, kategori.*,barang.id_barang, barang.nama_barang, detail_pembelian.harga, detail_pembelian.sn, sum(detail_pembelian.qty) as qty, 						barang.is_hargatoko, barang.is_hargapartai, barang.is_hargajual, barang.harga_cabang, barang.harga_toko, barang.harga_partai');					$this->db->from('pembelian');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');						$this->db->join('detail_penjualan','detail_penjualan.id_detail_pembelian = detail_pembelian.id_detail_pembelian');				$this->db->join('penjualan', 'penjualan.id_penjualan=detail_penjualan.id_penjualan');				$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');		$this->db->where('detail_pembelian.soldout != ', '1');				$this->db->where('penjualan.id_pelanggan', 'cbg-' . get_idcabang());			$this->db->group_by('detail_pembelian.id_barang'); */						
		$this->db->select('pembelian.id_pembelian,					
		detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, 						
		jenis.*, kategori.*,barang.id_barang, barang.nama_barang, detail_pembelian.harga, detail_pembelian.sn, sum(detail_pembelian.qty) as qty, 						
		barang.is_hargatoko, barang.is_hargapartai, barang.is_hargajual, barang.harga_cabang, barang.harga_toko, barang.harga_partai');					
		$this->db->from('pembelian');		
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');		
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');		
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');				
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');		
		$this->db->where($posisibarang, $nilaiposisi);			
		$this->db->group_by('detail_pembelian.id_barang');

		//print $this->db->_compile_select();

		return $this->db->get();
	}
	
	function h_get_items($id_pembelian, $id_barang, $posisibarang, $nilaiposisi)
	{
		$this->db->flush_cache();		
		$this->db->select('pembelian.id_pembelian,detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, 			
			jenis.*, kategori.*, barang.nama_barang, detail_pembelian.harga, barang.sn, detail_pembelian.qty, 			
			barang.is_hargatoko, pembelian.diskon, satuan.satuan, barang.is_hargapartai, barang.is_hargajual, barang.harga_cabang, barang.harga_toko, barang.harga_partai');		
		$this->db->from('pembelian');		
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');		
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');			
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		$this->db->where('detail_pembelian.id_barang', $id_barang);		
		$this->db->where($posisibarang, $nilaiposisi);									
		return $this->db->get();
	}	
	
	function get_items($id_pembelian, $id_barang, $posisibarang, $nilaiposisi){
		$this->db->flush_cache();
		$this->db->select('pembelian.id_pembelian,			detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, 			jenis.*, kategori.*, barang.nama_barang, detail_pembelian.harga, detail_pembelian.sn, sum(detail_pembelian.qty) as qty, 			barang.is_hargatoko, barang.is_hargapartai, barang.is_hargajual, barang.harga_cabang, barang.harga_toko, barang.harga_partai');
		$this->db->from('pembelian');
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');				
		/*$this->db->join('detail_penjualan','detail_penjualan.id_detail_pembelian = detail_pembelian.id_detail_pembelian');				
		$this->db->join('penjualan','penjualan.id_penjualan = detail_penjualan.id_penjualan');*/		
		/*/*$this->db->group_by('detail_pembelian.id_barang'); */
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		/*/*$this->db->where('detail_pembelian.id_pembelian', $id_pembelian);*/
		$this->db->where('detail_pembelian.id_barang', $id_barang);
		$this->db->where($posisibarang, $nilaiposisi);				/*$this->db->where('penjualan.id_pelanggan', get_idcabang());*/				
		$this->db->group_by('detail_pembelian.id_barang');						
		return $this->db->get();
	}

	function get_items_hp($id_pembelian, $id_barang, $posisibarang, $nilaiposisi)
	{		
		$this->db->flush_cache();		
		$this->db->select('pembelian.id_pembelian,detail_pembelian.id_barang, detail_pembelian.id_detail_pembelian, 			
			jenis.*, kategori.*, barang.nama_barang, detail_pembelian.harga, barang.sn, detail_pembelian.qty, 			
			barang.is_hargatoko, pembelian.diskon, satuan.satuan, barang.is_hargapartai, barang.is_hargajual, barang.harga_cabang, barang.harga_toko, barang.harga_partai');		
		$this->db->from('pembelian');		
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');		
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');			
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		$this->db->where('detail_pembelian.id_barang', $id_barang);		
		$this->db->where($posisibarang, $nilaiposisi);									
		return $this->db->get();
	}
		
	function updateBarangPembelian($id_detailpembelian, $idcabang, $posisibarang, $nilaiposisi)
	{		
		$this->db->flush_cache();		
		/*$this->db->where('id_detail_pembelian', $id_detailpembelian);		$this->db->update('detail_pembelian', array('soldout'=> $nilai)); */
		$this->db->where('id_detail_pembelian', $id_detailpembelian);		
		$this->db->update('detail_pembelian', array($idcabang=> '0', $posisibarang=>$nilaiposisi));						

	}		

	function get_detail_send_ro($id_request)	{		
		$this->db->flush_cache();		$this->db->select('detail_request_order.*, barang.*');		
		$this->db->from('detail_request_order');		$this->db->join('barang', 'barang.id_barang = detail_request_order.id_barang');		
		$this->db->where('id_request', $id_request);				return $this->db->get();	
	}
	
}