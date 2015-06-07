<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_piutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem_periode($periode_awal,$periode_akhir)	{		/*		$this->db->flush_cache();		$this->db->select('daftar_piutang.*,cabang.nama_cabang,pelanggan.nama as nama_pelanggan');		$this->db->from('daftar_piutang');				$this->db->join('cabang', 'cabang.id_cabang = daftar_piutang.KOUNIT');		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = daftar_piutang.KODE_PARTNER');		$this->db->where("daftar_piutang.TANGGAL BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "'");		*/		/*		$query = "SELECT penjualan.so_no,			daftar_piutang.GLID,			daftar_piutang.TANGGAL,			daftar_piutang.so_no,			penjualan.so_no,			penjualan.id_pelanggan,			pelanggan.nama as nama_pelanggan,			cabang.nama_cabang,			daftar_piutang.KET_TRANSASKSI,			pelanggan.nama AS nama_pelanggan,			penjualan.total AS piutang 			FROM (`daftar_piutang`) 			JOIN `penjualan` ON `penjualan`.`so_no` = `daftar_piutang`.`so_no` 			JOIN `cabang` ON `cabang`.`id_cabang` = `daftar_piutang`.`KOUNIT` 			JOIN `pelanggan` ON `pelanggan`.`id_pelanggan` = `daftar_piutang`.`KODE_PARTNER`			WHERE `daftar_piutang`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "' order by pelanggan.id_pelanggan";			$this->db->flush_cache();		return $this->db->query($query);*/				$query="SELECT lap_piutang.so_no,lap_piutang.TANGGAL,lap_piutang.KET_TRANSASKSI,			get_pelanggan.nama_pelanggan as nama_pelanggan,get_pelanggan.saldo_piutang,get_pelanggan.id_pelanggan,			lap_piutang.id_cabang,lap_piutang.nama_cabang,lap_piutang.GLID,			lap_piutang.piutang,get_pelanggan.tanggal_piutang 		FROM (SELECT 		penjualan.so_no, `penjualan`.`TANGGAL`, `daftar_piutang`.`KET_TRANSASKSI`,		`cabang`.`id_cabang`, `cabang`.`nama_cabang`, `pelanggan`.`id_pelanggan`,		`pelanggan`.`nama` , `pelanggan`.`saldo_piutang`, 		`angsuran_piutang`.`GLID`, `penjualan`.`total` as piutang 		FROM (`daftar_piutang`) 		JOIN `angsuran_piutang` ON `angsuran_piutang`.`GLID` = `daftar_piutang`.`GLID` 		JOIN `penjualan` ON `penjualan`.`so_no` = `daftar_piutang`.`so_no` 		JOIN `cabang` ON `cabang`.`id_cabang` = `daftar_piutang`.`KOUNIT` 		RIGHT JOIN `pelanggan` ON `pelanggan`.`id_pelanggan` = `daftar_piutang`.`KODE_PARTNER` 		WHERE `daftar_piutang`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir .  "' group by `angsuran_piutang`.`GLID`) as lap_piutang		right join (select pelanggan.nama as nama_pelanggan,pelanggan.id_pelanggan,pelanggan.saldo_piutang,pelanggan.tanggal_piutang from pelanggan) as get_pelanggan 		on (get_pelanggan.id_pelanggan=lap_piutang.id_pelanggan) order by get_pelanggan.id_pelanggan,lap_piutang.TANGGAL";				$this->db->flush_cache();		return $this->db->query($query);	}
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