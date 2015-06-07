<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_grafik_pembelian extends CI_Model{
	
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
	
	function get_gfk_pembelian_cabang($periode_awal,$periode_akhir){		
		$sql="SELECT `pembelian`.*,sum(dp.qty)  as jumlah_pembelian, `dp`.`id_barang`, `dp`.`qty`, `brg`.`nama_barang`,
		`sp`.`nama` as nama_supplier, `cbg`.`nama_cabang`, `dp`.`total` 
		FROM (`pembelian`) 
		JOIN `detail_pembelian` dp ON `dp`.`id_pembelian` = `pembelian`.`id_pembelian` 
		JOIN `barang` brg ON `brg`.`id_barang` = `dp`.`id_barang` 
		JOIN `supplier` sp ON `sp`.`id_supplier` = `pembelian`.`id_supplier` 
		JOIN `cabang` cbg ON `cbg`.`id_cabang` = `pembelian`.`id_cabang`"; 
		$sql.="WHERE `pembelian`.`tanggal` BETWEEN '" .  $periode_awal . "' AND '" . $periode_akhir . "'"; 
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$sql.=" and cbg.id_cabang= '" . $get_id_cabang . "'"; 
		}		
		$sql.=" group by dp.id_pembelian ORDER BY `brg`.`nama_barang` ASC";
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function get_gfk_pembelian_barang($periode_awal,$periode_akhir){		
		$sql="SELECT `pembelian`.*,sum(dp.qty)  as jumlah_pembelian, `dp`.`id_barang`, `dp`.`qty`, `brg`.`nama_barang`,
		`sp`.`nama` as nama_supplier, `cbg`.`nama_cabang`, `dp`.`total` FROM (`pembelian`) 
		JOIN `detail_pembelian` dp ON `dp`.`id_pembelian` = `pembelian`.`id_pembelian` 
		JOIN `barang` brg ON `brg`.`id_barang` = `dp`.`id_barang` 
		JOIN `supplier` sp ON `sp`.`id_supplier` = `pembelian`.`id_supplier` 
		JOIN `cabang` cbg ON `cbg`.`id_cabang` = `pembelian`.`id_cabang` 
		WHERE `pembelian`.`tanggal` BETWEEN '" .  $periode_awal . "' AND '" . $periode_akhir . "'"; 
		$get_id_cabang=get_idcabang();
		if ($get_id_cabang!='1'){
			$sql.=" and cbg.id_cabang= '" . $get_id_cabang . "'"; 
		}	
		$sql.="group by dp.id_barang ORDER BY `brg`.`nama_barang` ASC";
		
		$query=$this->db->query($sql);
		return $query->result();
	}

}