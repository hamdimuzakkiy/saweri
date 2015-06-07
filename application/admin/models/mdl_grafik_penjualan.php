<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_grafik_penjualan extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.*,supplier.nama AS nama_supplier, cabang.nama_cabang, sum(detail_penjualan.total) as total_harga,sum(detail_penjualan.qty) as qty');
		$this->db->from('penjualan');
		$this->db->group_by('penjualan.id_penjualan'); 
		$this->db->join('supplier', 'supplier.id_supplier = penjualan.id_supplier');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');
		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan = penjualan.id_penjualan');
		$this->db->where("penjualan.tanggal BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		return $this->db->get('penjualan');
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

	
	function get_gfk_penjualan_cabang($periode_awal,$periode_akhir){		
		$sql="SELECT `penjualan`.*,sum(dp.qty)  as jumlah_penjualan, `dp`.`id_barang`, `dp`.`qty`, `brg`.`nama_barang`, `sp`.`nama` as nama_pelanggan,
		`cbg`.`nama_cabang`, `dp`.`total` 
		FROM (`penjualan`) 
		JOIN `detail_penjualan` dp ON `dp`.`id_penjualan` = `penjualan`.`id_penjualan` 
		JOIN `barang` brg ON `brg`.`id_barang` = `dp`.`id_barang` 
		JOIN `pelanggan` sp ON `sp`.`id_pelanggan` = `penjualan`.`id_pelanggan` 
		JOIN `cabang` cbg ON `cbg`.`id_cabang` = `penjualan`.`id_cabang` 
		WHERE `penjualan`.`tanggal` BETWEEN '" .  $periode_awal . "' AND '" . $periode_akhir . "'";
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$sql.=" and cbg.id_cabang= '" . $get_id_cabang . "'"; 
		}			
		$sql.="group by penjualan.id_cabang ORDER BY `brg`.`nama_barang` ASC";

		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function get_gfk_penjualan_barang($periode_awal,$periode_akhir){		
		$sql="SELECT `penjualan`.*,sum(dp.qty)  as jumlah_penjualan, `dp`.`id_barang`, `dp`.`qty`, 
		`brg`.`nama_barang`, `sp`.`nama` as nama_pelanggan, `cbg`.`nama_cabang`, `dp`.`total` 
		FROM (`penjualan`) JOIN `detail_penjualan` dp ON `dp`.`id_penjualan` = `penjualan`.`id_penjualan` 
		JOIN `barang` brg ON `brg`.`id_barang` = `dp`.`id_barang` 
		JOIN `pelanggan` sp ON `sp`.`id_pelanggan` = `penjualan`.`id_pelanggan` 
		JOIN `cabang` cbg ON `cbg`.`id_cabang` = `penjualan`.`id_cabang` 
		WHERE `penjualan`.`tanggal` BETWEEN '" .  $periode_awal . "' AND '" . $periode_akhir . "'";
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$sql.=" and cbg.id_cabang= '" . $get_id_cabang . "'"; 
		}		
		$sql.="group by dp.id_barang ORDER BY `brg`.`nama_barang` ASC";
		
		$query=$this->db->query($sql);
		return $query->result();
	}

}