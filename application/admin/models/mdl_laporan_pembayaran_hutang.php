<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_pembayaran_hutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		$this->db->select('*','cabang.nama_cabang','supplier.nama as nama_supplier,detail_pembelian.jatuh_tempo');
		$this->db->from('daftar_hutang');				$this->db->join('angsuran_hutang', 'angsuran_hutang.GLID = daftar_hutang.GLID');		$this->db->join('pembelian', 'pembelian.po_no = daftar_hutang.po_no');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		$this->db->join('cabang', 'cabang.id_cabang = daftar_hutang.KODE_PARTNER');		$this->db->join('supplier', 'supplier.id_supplier = daftar_hutang.KOUNIT');
		$this->db->where("(daftar_hutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "')&&(daftar_hutang.JUMLAH != 0)");
		return $this->db->get();
	}
	function getItem_periode($periode_awal,$periode_akhir)	{									$query = "SELECT								pembelian.po_no, 				daftar_hutang.GLID as ref_hutang,				daftar_hutang.TANGGAL as tanggal_hutang,				pembelian.id_supplier,				supplier.nama as nama_supplier,				pembelian.id_cabang,				angsuran_hutang.pembayaran,				angsuran_hutang.angsuran,				angsuran_hutang.sisa,				angsuran_hutang.total as total_hutang,				cabang.nama_cabang as nama_cabang,				pembelian.total,				pembelian.tanggal				FROM				pembelian				Inner Join daftar_hutang ON pembelian.po_no = daftar_hutang.po_no				Inner Join supplier ON supplier.id_supplier = pembelian.id_supplier				Inner Join cabang ON cabang.id_cabang = pembelian.id_cabang,				angsuran_hutang								WHERE (`pembelian`.`tanggal` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "'  ) && angsuran_hutang.glid = daftar_hutang.glid				 				 				ORDER BY angsuran_hutang.tanggal				";			$this->db->flush_cache();		return $this->db->query($query);	}		function get_angsuran_hutang($glid){		$query = "SELECT angsuran_hutang.GLID,  angsuran_hutang.TOTAL, angsuran_hutang.ANGSURAN, angsuran_hutang.SISA 			FROM (`angsuran_hutang`) 			JOIN `daftar_hutang` ON `daftar_hutang`.`GLID` = `angsuran_hutang`.`GLID` 			WHERE `angsuran_hutang`.GLID='" . $glid . "'";			$this->db->flush_cache();		return $this->db->query($query);	}
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