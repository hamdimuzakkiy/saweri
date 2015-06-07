<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_hutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		/*$this->db->select('pembelian.po_no,pembelian.TANGGAL,daftar_hutang.KET_TRANSASKSI,cabang.id_cabang,cabang.nama_cabang,		supplier.id_supplier,supplier.nama as nama_supplier,		angsuran_hutang.GLID,detail_pembelian.jatuh_tempo,		daftar_hutang.JUMLAH as hutang');
		$this->db->from('daftar_hutang');				$this->db->join('angsuran_hutang', 'angsuran_hutang.GLID = daftar_hutang.GLID');		$this->db->join('pembelian', 'pembelian.po_no = daftar_hutang.po_no');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		$this->db->join('cabang', 'cabang.id_cabang = daftar_hutang.KODE_PARTNER');		$this->db->join('supplier', 'supplier.id_supplier = daftar_hutang.KOUNIT');
		$this->db->where("daftar_hutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'"); */				/*		$this->db->select('pembelian.po_no,pembelian.TANGGAL,daftar_hutang.KET_TRANSASKSI,cabang.id_cabang,cabang.nama_cabang,		supplier.id_supplier,supplier.nama as nama_supplier,supplier.saldo_hutang, 		angsuran_hutang.GLID,daftar_hutang.JUMLAH as hutang');		$this->db->from('daftar_hutang');				$this->db->join('angsuran_hutang', 'angsuran_hutang.GLID = daftar_hutang.GLID');		$this->db->join('pembelian', 'pembelian.po_no = daftar_hutang.po_no');		$this->db->join('cabang', 'cabang.id_cabang = daftar_hutang.KODE_PARTNER');				$this->db->join('supplier', 'supplier.id_supplier = daftar_hutang.KOUNIT','right');		$this->db->where("daftar_hutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");		
		return $this->db->get();*/				 $query="SELECT lap_hutang.po_no,lap_hutang.TANGGAL,lap_hutang.KET_TRANSASKSI,			get_supplier.nama_supplier as nama_supplier,get_supplier.saldo_hutang,get_supplier.id_supplier,			lap_hutang.id_cabang,lap_hutang.nama_cabang,lap_hutang.GLID,			lap_hutang.hutang		FROM (SELECT 		`pembelian`.`po_no`, `pembelian`.`TANGGAL`, `daftar_hutang`.`KET_TRANSASKSI`,		`cabang`.`id_cabang`, `cabang`.`nama_cabang`, `supplier`.`id_supplier`,		`supplier`.`nama` , `supplier`.`saldo_hutang`, 		`angsuran_hutang`.`GLID`, `pembelian`.`total` as hutang 		FROM (`daftar_hutang`) 		JOIN `angsuran_hutang` ON `angsuran_hutang`.`GLID` = `daftar_hutang`.`GLID` 		JOIN `pembelian` ON `pembelian`.`po_no` = `daftar_hutang`.`po_no` 		JOIN `cabang` ON `cabang`.`id_cabang` = `daftar_hutang`.`KOUNIT` 		RIGHT JOIN `supplier` ON `supplier`.`id_supplier` = `daftar_hutang`.`KODE_PARTNER` 		WHERE `daftar_hutang`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "' group by `angsuran_hutang`.`GLID`) as lap_hutang		right join (select supplier.nama as nama_supplier,supplier.id_supplier,supplier.saldo_hutang from supplier) as get_supplier 		on (get_supplier.id_supplier=lap_hutang.id_supplier) order by get_supplier.id_supplier,lap_hutang.TANGGAL";				$this->db->flush_cache();		return $this->db->query($query);
	}
	function getItem_periode($periode_awal,$periode_akhir)	{					$query="SELECT DISTINCT pembelian.po_no,			daftar_hutang.GLID,			daftar_hutang.TANGGAL,			daftar_hutang.po_no,			pembelian.po_no,			cabang.nama_cabang,			supplier.nama AS nama_supplier,			pembelian.total AS total_hutang,			angsuran_hutang.ANGSURAN,			angsuran_hutang.SISA,			angsuran_hutang.TANGGAL AS tanggal_angsuran,			sum(angsuran_hutang.ANGSURAN) as jumlah_angsuran 			FROM (`daftar_hutang`) LEFT JOIN `angsuran_hutang` ON `angsuran_hutang`.`GLID` = `daftar_hutang`.`GLID` 			LEFT JOIN `pembelian` ON `pembelian`.`po_no` = `daftar_hutang`.`po_no` 			JOIN `cabang` ON `cabang`.`id_cabang` = `daftar_hutang`.`KOUNIT` 			JOIN `supplier` ON `supplier`.`id_supplier` = `daftar_hutang`.`KODE_PARTNER`			WHERE `daftar_hutang`.`TANGGAL` BETWEEN '2012-04-01' AND '2012-12-31'			group by (angsuran_hutang.GLID)";					$this->db->flush_cache();		return $this->db->query($query);	}		function get_angsuran_hutang($glid){		$query = "SELECT angsuran_hutang.GLID,  angsuran_hutang.TOTAL, angsuran_hutang.ANGSURAN, angsuran_hutang.SISA 			FROM (`angsuran_hutang`) 			JOIN `daftar_hutang` ON `daftar_hutang`.`GLID` = `angsuran_hutang`.`GLID` 			WHERE `angsuran_hutang`.GLID='" . $glid . "'";		$this->db->flush_cache();		return $this->db->query($query);	}
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		return $this->db->get('pembelian');
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