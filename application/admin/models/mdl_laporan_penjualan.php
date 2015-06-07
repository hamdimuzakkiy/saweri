<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_penjualan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		$this->db->select('pembelian.*,supplier.nama AS nama_supplier, cabang.nama_cabang, sum(detail_pembelian.total) as total_harga,sum(detail_pembelian.qty) as qty');
		$this->db->from('pembelian');
		$this->db->group_by('pembelian.id_pembelian'); 
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');
		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');
		$this->db->where("pembelian.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
	
		
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		return $this->db->get('pembelian');
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('pembelian', $data);
	}
	
	function insert_detail($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_pembelian', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		$this->db->update('pembelian', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('pembelian', array('id_pembelian' => $id));
	}
	
	function get_detail($id_request)
	{
		$this->db->flush_cache();
		$this->db->select('detail_pembelian.*, barang.*');
		$this->db->from('detail_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
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
	
	function get_lap_penjualan_periode($periode_awal,$periode_akhir,$num=false){
		$this->db->flush_cache();
		$this->db->select('penjualan.*,pelanggan.nama AS nama_pelanggan, cabang.nama_cabang, sum(detail_penjualan.total) as total_harga,sum(detail_penjualan.qty) as qty');
		$this->db->from('penjualan');
		$this->db->group_by('penjualan.id_penjualan'); 
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan= penjualan.id_penjualan');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('penjualan.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,$num=false){
		$this->db->flush_cache();
		$this->db->select('penjualan.*,dp.id_barang,dp.qty,brg.nama_barang,p.nama as nama_pelanggan,cbg.nama_cabang,dp.total');
		$this->db->from('penjualan');
		$this->db->join('detail_penjualan dp', 'dp.id_penjualan = penjualan.id_penjualan');
		$this->db->join('barang brg', 'brg.id_barang = dp.id_barang');
		$this->db->join('pelanggan p', 'p.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('cabang cbg', 'cbg.id_cabang = penjualan.id_cabang');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		$this->db->where_in('brg.id_barang', $nama_barang);
		$this->db->order_by('brg.nama_barang','penjualan.tanggal');
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('penjualan.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_item_barang($num=false){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->order_by('nama_barang');
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_barang_like($key,$num=false){
		$this->db->select('*');
		$this->db->from('barang');
		if($key!='')
			$this->db->like('nama_barang',$key);
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		$this->db->order_by('barang.nama_barang','asc');
		return $this->db->get();
	}
	
	function get_pelanggan($num=false){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('pelanggan');
		$this->db->order_by('nama');
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_pelanggan_like($key,$num=false){
		$this->db->select('*');
		$this->db->from('pelanggan');
		if($key!='')
			$this->db->like('nama',$key);
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		$this->db->order_by('pelanggan.nama','asc');
		return $this->db->get();
	}
	
	function get_lap_penjualan_pelanggan($periode_awal,$periode_akhir,$id_pelanggan,$num=false){
		$this->db->flush_cache();
		$this->db->select('penjualan.*,dp.id_barang,dp.qty,brg.nama_barang,p.nama as nama_pelanggan,cbg.nama_cabang,dp.total');
		$this->db->from('penjualan');
		$this->db->join('detail_penjualan dp', 'dp.id_penjualan = penjualan.id_penjualan');
		$this->db->join('barang brg', 'brg.id_barang = dp.id_barang');
		$this->db->join('pelanggan p', 'p.id_pelanggan = penjualan.id_pelanggan');
		$this->db->join('cabang cbg', 'cbg.id_cabang = penjualan.id_cabang');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		$this->db->where_in('p.id_pelanggan', $id_pelanggan);
		$this->db->order_by('p.nama','penjualan.tanggal');
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('penjualan.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
		
	function get_lap_retur_penjualan($periode_awal,$periode_akhir,$num=false){
		$this->db->flush_cache();
		$this->db->select('retur_penjualan.*, barang.nama_barang, penjualan.*,cabang.nama_cabang,pelanggan.nama as nama_pelanggan');
		$this->db->from('retur_penjualan');
		$this->db->join('barang', 'barang.id_barang = retur_penjualan.id_barang');
		$this->db->join('detail_penjualan', 'detail_penjualan.id_detail_penjualan  = retur_penjualan.id_detail_penjualan');		
		$this->db->join('penjualan', 'penjualan.id_penjualan   = detail_penjualan.id_penjualan');		
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('penjualan.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		return $this->db->get();
	}
	
	function get_lap_service($periode_awal,$periode_akhir,$num=false){
		$this->db->flush_cache();
		$this->db->select('service.*');
		$this->db->from('service');
		$this->db->where("service.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		if($num)
		{
		    return $this->db->count_all_results();
		}
		return $this->db->get();
	}
	
		
	function get_lap_point_member($kode_pelanggan,$num=false){
		$this->db->flush_cache();
		$this->db->select('pelanggan.*,cbg.nama_cabang,area.area as nama_area,sum(point) as point');
		$this->db->from('pelanggan');
		$this->db->join('cabang cbg', 'cbg.id_cabang = pelanggan.id_cabang');
		$this->db->join('area', 'area.id_area = pelanggan.id_area');
		$this->db->where_in('pelanggan.kode_pelanggan', $kode_pelanggan);
		$this->db->group_by('pelanggan.kode_pelanggan');
		$this->db->order_by('pelanggan.kode_pelanggan', 'asc');
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('cbg.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}

	
	function get_karyawan($num=false){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->order_by('nama');
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_karyawan_like($key,$num=false){
		$this->db->select('*');
		$this->db->from('karyawan');
		if($key!='')
			$this->db->like('nama',$key);
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		$this->db->order_by('karyawan.nama','asc');
		return $this->db->get();
	}
	
	
	function get_lap_point_karyawan($kode_karyawan,$num=false){
		$this->db->flush_cache();
		$this->db->select('karyawan.*,cbg.nama_cabang,sum(point) as point');
		$this->db->from('karyawan');
		$this->db->join('cabang cbg', 'cbg.id_cabang = karyawan.id_cabang');
		$this->db->where_in('karyawan.kode_karyawan', $kode_karyawan);
		$this->db->group_by('karyawan.kode_karyawan');
		$this->db->order_by('karyawan.kode_karyawan', 'asc');
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('cbg.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_area($num=false)
	{
		
		$this->db->flush_cache();
		$this->db->select('area.id_area, area.area');
		$this->db->from('area');
		//$this->db->join('kecamatan', 'area.id_kecamatan = kecamatan.id_kecamatan');
		//$this->db->join('kabupaten', 'area.id_kabupaten = kabupaten.id_kabupaten');
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_area_like($key,$num=false){
		$this->db->flush_cache();
		$this->db->select('area.id_area, area.area, kecamatan.kecamatan, kabupaten.kabupaten');
		$this->db->from('area');
		$this->db->join('kecamatan', 'area.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'area.id_kabupaten = kabupaten.id_kabupaten');
		if($key!='')
			$this->db->like('area.area',$key);
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		$this->db->order_by('area.area','asc');
		return $this->db->get();
	}
	
	function get_lap_penjualan_area($periode_awal,$periode_akhir,$id_area,$num=false){
		$this->db->flush_cache();
		$this->db->select('penjualan.*,pelanggan.id_area,pelanggan.nama as nama_pelanggan,area.area,dp.id_barang,dp.qty,dp.total');
		$this->db->from('penjualan');
		$this->db->join('detail_penjualan dp', 'dp.id_penjualan = penjualan.id_penjualan');
		$this->db->join('pelanggan', 'penjualan.id_pelanggan = pelanggan.id_pelanggan');
		$this->db->join('area', 'pelanggan.id_area = area.id_area');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		$this->db->where_in('area.id_area', $id_area);	
		       
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('penjualan.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
}