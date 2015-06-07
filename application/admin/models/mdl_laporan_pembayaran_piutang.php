<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_pembayaran_piutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($periode_awal,$periode_akhir)
	{
		$this->db->flush_cache();
		$this->db->select('*','cabang.nama_cabang','supplier.nama as nama_supplier,detail_penjualan.jatuh_tempo');
		$this->db->from('daftar_piutang');				$this->db->join('angsuran_piutang', 'angsuran_piutang.GLID = daftar_piutang.GLID');		$this->db->join('penjualan', 'penjualan.so_no = daftar_piutang.so_no');		$this->db->join('detail_penjualan', 'detail_penjualan.id_penjualan = penjualan.id_penjualan');		$this->db->join('cabang', 'cabang.id_cabang = daftar_piutang.KODE_PARTNER');		$this->db->join('supplier', 'supplier.id_pelanggan = daftar_piutang.KOUNIT');
		$this->db->where("daftar_piutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");		$this->db->where("daftar_piutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");
		return $this->db->get();
	}
	function getItem_periode($periode_awal,$periode_akhir)	{		$query = "SELECT				sum(angsuran_piutang.ANGSURAN) as total_bayar,				penjualan.so_no,				daftar_piutang.GLID,				daftar_piutang.TANGGAL as tanggal_piutang,				angsuran_piutang.pembayaran,				penjualan.id_pelanggan,				pelanggan.nama as nama_pelanggan,				penjualan.id_cabang,				cabang.nama_cabang as nama_cabang,				penjualan.total,				penjualan.tanggal 				FROM				penjualan				Inner Join daftar_piutang ON penjualan.so_no = daftar_piutang.so_no				Inner Join cabang ON cabang.id_cabang = penjualan.id_cabang				Inner Join pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan,				angsuran_piutang				WHERE (`penjualan`.`tanggal` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "') && (angsuran_piutang.GLID = daftar_piutang.GLID )				GROUP BY				penjualan.so_no,				daftar_piutang.GLID				ORDER BY penjualan.tanggal																";			$this->db->flush_cache();		return $this->db->query($query);	}		function get_angsuran_piutang($glid){		$query = "SELECT angsuran_piutang.GLID,  sum(angsuran_piutang.ANGSURAN)  			FROM (`angsuran_piutang`) 			JOIN `daftar_piutang` ON `daftar_piutang`.`GLID` = `angsuran_piutang`.`GLID` 			WHERE `angsuran_piutang`.GLID='" . $glid . "'";			$this->db->flush_cache();		return $this->db->query($query);	}
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		return $this->db->get('penjualan');
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