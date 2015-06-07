<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_buku_kas extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function getItem_periode($periode_awal,$periode_akhir)	{		$query = "SELECT				jurnal.GLID,				jurnal.PO_NO,				jurnal.KAS_AWAL,				jurnal.TANGGAL,				jurnal.KETERANGAN,				jurnal.KAS_AWAL,				detail_jurnal.GLID as GLID_DETAIL,				detail_jurnal.AKUNID,				detail_jurnal.DEBET,				detail_jurnal.KREDIT  				FROM				jurnal				Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID			WHERE `jurnal`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "' and jurnal.KAS_AWAL='0' and detail_jurnal.AKUNID LIKE '1%' ORDER BY detail_jurnal.ID";		$this->db->flush_cache();		return $this->db->query($query);	}	function getItem_kas_awal($yearnow)	{		$query = "SELECT 					jurnal.GLID,					jurnal.PO_NO,					jurnal.KAS_AWAL,					jurnal.KETERANGAN,					detail_jurnal.DEBET,					detail_jurnal.KREDIT, 					detail_jurnal.GLID as glid_detail,					sum(detail_jurnal.DEBET) as debet,					jurnal.TANGGAL,					sum(detail_jurnal.KREDIT) as JUMLAH_KAS_AWAL 					FROM					jurnal					Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					where (jurnal.KAS_AWAL=1) and SUBSTR(TANGGAL,1,4)=" . $yearnow . " group by detail_jurnal.STATUS";		$this->db->flush_cache();		return $this->db->query($query);	}	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		return $this->db->get('pembelian');
	}

}