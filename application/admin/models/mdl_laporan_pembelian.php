<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_pembelian extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		$this->db->select('pembelian.*,supplier.nama AS nama_supplier, cabang.nama_cabang, sum(detail_pembelian.total) as total_harga,sum(detail_pembelian.qty) as qty, detail_pembelian.jatuh_tempo');
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
	
	function get_lap_pembelian_barang($periode_awal,$periode_akhir,$nama_barang,$num=false){
		$this->db->flush_cache();
		$this->db->select('pembelian.*,dp.id_barang,dp.qty,brg.nama_barang,sp.nama as nama_supplier,cbg.nama_cabang,dp.total');
		$this->db->from('pembelian');
		$this->db->join('detail_pembelian dp', 'dp.id_pembelian = pembelian.id_pembelian');
		$this->db->join('barang brg', 'brg.id_barang = dp.id_barang');
		$this->db->join('supplier sp', 'sp.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang cbg', 'cbg.id_cabang = pembelian.id_cabang');
		$this->db->where("pembelian.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		$this->db->where_in('brg.id_barang', $nama_barang);
		$this->db->order_by('brg.nama_barang','pembelian.tanggal');
		
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
	
	function get_supplier($num=false){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('supplier');
		$this->db->order_by('nama');
		if($num)
		{
		    return $this->db->count_all_results();
		}
		
		return $this->db->get();
	}
	
	function get_supplier_like($key,$num=false){
		$this->db->select('*');
		$this->db->from('supplier');
		if($key!='')
			$this->db->like('nama',$key);
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		$this->db->order_by('supplier.nama','asc');
		return $this->db->get();
	}
	
	function get_lap_pembelian_supplier($periode_awal,$periode_akhir,$id_supplier,$num=false){
		$this->db->flush_cache();
		$this->db->select('pembelian.*,dp.id_barang,dp.qty,brg.nama_barang,sp.nama as nama_supplier,cbg.nama_cabang,dp.total');
		$this->db->from('pembelian');
		$this->db->join('detail_pembelian dp', 'dp.id_pembelian = pembelian.id_pembelian');
		$this->db->join('barang brg', 'brg.id_barang = dp.id_barang');
		$this->db->join('supplier sp', 'sp.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang cbg', 'cbg.id_cabang = pembelian.id_cabang');
		$this->db->where("pembelian.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		$this->db->where_in('sp.id_supplier', $id_supplier);
		$this->db->order_by('sp.nama','pembelian.tanggal');
		
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
	
	function get_lap_retur_pembelian($periode_awal,$periode_akhir,$num=false){
		$this->db->flush_cache();
		$this->db->select('retur_pembelian.*, barang.nama_barang, pembelian.*,cabang.nama_cabang,supplier.nama as nama_supplier');
		$this->db->from('retur_pembelian');
		$this->db->join('barang', 'barang.id_barang = retur_pembelian.id_barang');
		
		//$this->db->join('pembelian', 'pembelian.id_pembelian  = retur_pembelian.id_pembelian');
		
		$this->db->join('detail_pembelian', 'detail_pembelian.id_detail_pembelian  = retur_pembelian.id_detail_pembelian');		
		$this->db->join('pembelian', 'pembelian.id_pembelian   = detail_pembelian.id_pembelian');	
		
		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->where("pembelian.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$this->db->where('cabang.id_cabang',$get_id_cabang);
		}
		
		if($num)
		{
		    return $this->db->count_all_results();
		}
		return $this->db->get();
	}
	
	function get_lap_saldo_stok($periode_awal,$periode_akhir,$num=false){
		$this->db->flush_cache();
		// $this->db->select('stok.*, barang.nama_barang,cabang.nama_cabang,supplier.nama as nama_supplier');
		// $this->db->from('stok');
		// $this->db->join('barang', 'barang.id_barang = stok.id_barang');
		// $this->db->join('cabang', 'cabang.kode_cabang = stok.kode_cabang');
		// $this->db->join('supplier', 'supplier.id_supplier = stok.id_supplier');
		// $this->db->where("stok.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		
		// $get_id_cabang=get_idcabang();
		// if ($get_id_cabang!='1'){
			// $this->db->where('cabang.id_cabang',$get_id_cabang);
		// }
		
		// if($num)
		// {
		    // return $this->db->count_all_results();
		// }
		$query = 'SELECT sum(detail_pembelian.qty) AS qty, barang.nama_barang, pembelian.tanggal, supplier.nama AS nama_supplier, barang.id_barang, jenis.jenis, kategori.kategori, supplier.nama FROM (`pembelian`) 
					JOIN `supplier` ON `supplier`.`id_supplier` = `pembelian`.`id_supplier` 
					JOIN `detail_pembelian` ON `detail_pembelian`.`id_pembelian` = `pembelian`.`id_pembelian` 
					JOIN `barang` ON `barang`.`id_barang` = `detail_pembelian`.`id_barang` 
					JOIN `jenis` ON `jenis`.`id_jenis` = `barang`.`id_jenis` 
					JOIN `kategori` ON `kategori`.`id_kategori` = `barang`.`id_kategori` 
					group by barang.id_barang, barang.nama_barang, jenis.jenis, kategori.kategori, supplier.nama ';
	
		return $this->db->query($query);
	}
}