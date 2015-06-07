<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_laporan_laba_rugi extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}		
	function getItem_penjualan(){		
		$query="SELECT			
		penjualan.so_no,			
		sum(penjualan.total) as total_penjualan,			
		jurnal.PO_NO,			
		jurnal.GLID			
		FROM			
		penjualan			
		Inner Join jurnal ON penjualan.so_no = jurnal.PO_NO			
		where jurnal.KAS_AWAL = 0			
		GROUP by jurnal.KAS_AWAL";						
		$this->db->flush_cache();		
		return $this->db->query($query);	
	}
	
	function getItem_pembelian(){		
	$query="SELECT			
		pembelian.po_no,			
		sum(pembelian.total) as total_pembelian,			
		jurnal.PO_NO,			
		jurnal.GLID			
		FROM			
		pembelian			
		Inner Join jurnal ON pembelian.po_no = jurnal.PO_NO			
		where jurnal.KAS_AWAL = 0			
		GROUP by jurnal.KAS_AWAL";
		$this->db->flush_cache();		
		return $this->db->query($query);	
		}	
	function getItem_persediaan(){		
	$query="SELECT				
		jurnal.PO_NO,				
		jurnal.GLID,				
		penjualan.id_penjualan,				
		penjualan.total,				
		detail_penjualan.id_barang,				
		detail_penjualan.total,				
		detail_pembelian.id_barang,				
		detail_pembelian.harga,				
		sum(detail_pembelian.harga) total_jual_hrg_awal_pembelian,				penjualan.posting				FROM				jurnal				
		Inner Join penjualan ON jurnal.PO_NO = penjualan.so_no				
		Inner Join detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan				
		Inner Join detail_pembelian ON detail_penjualan.id_detail_pembelian = detail_pembelian.id_detail_pembelian				GROUP by penjualan.posting				";		$this->db->flush_cache();		return $this->db->query($query);	}	
	function getItem_periode($periode_awal,$periode_akhir)	{	
	/*$query = "	
	SELECT					
	jurnal.PO_NO,					
	jurnal.GLID,					
	detail_jurnal.GLID,					
	detail_jurnal.AKUNID,					
	detail_jurnal.DEBET jumlah_debet,					
	sum(detail_jurnal.KREDIT) as jml_pendapatan,					
	detail_jurnal.KAS_AWAL,					
	jurnal.TANGGAL,					
	jurnal.KETERANGAN					
	FROM					
	jurnal					
	Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					
	where (LEFT(jurnal.GLID_PARENT,3)='BKM')  
	and (`jurnal`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "' ) 					
	group by jurnal.GLID 					ORDER BY detail_jurnal.AKUNID ASC";*/
	/*		$query="SELECT					jurnal.PO_NO,					jurnal.GLID,					
	detail_jurnal.GLID,					detail_jurnal.AKUNID,					sum(detail_jurnal.DEBET) jml_pendapatan,					detail_jurnal.KREDIT as kredit,					detail_jurnal.KAS_AWAL,					jurnal.TANGGAL,					master_akun.NAKUN,					jurnal.KETERANGAN					FROM					jurnal					Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					Inner Join master_akun ON detail_jurnal.AKUNID = master_akun.AKUNID					where (LEFT(jurnal.GLID_PARENT,3)='BKM') and (detail_jurnal.AKUNID LIKE '42%') and (`jurnal`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "' )					group by detail_jurnal.AKUNID "; */
	/*$query = "SELECT   DISTINCT				
	jurnal.GLID,				jurnal.PO_NO,				jurnal.KAS_AWAL,				
	jurnal.TANGGAL,				master_akun.NAKUN,				detail_jurnal.KETERANGAN,  				detail_jurnal.AKUNID,				detail_jurnal.DEBET,				detail_jurnal.KREDIT  				FROM 				jurnal, detail_jurnal, master_akun				where				detail_jurnal.GLID = jurnal.GLID and				detail_jurnal.AKUNID  = master_akun.AKUNID and				detail_jurnal.AKUNID LIKE '5%' and 				`jurnal`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "'   			order BY detail_jurnal.ID";*/			
	$query = "SELECT					
	detail_jurnal.GLID,					detail_jurnal.AKUNID,					
	SUM(detail_jurnal.DEBET) as DEBET,					SUM(detail_jurnal.KREDIT) as KREDIT,					detail_jurnal.KETERANGAN,					jurnal.GLID,					jurnal.TANGGAL,					jurnal.PO_NO,					master_akun.NAKUN					FROM					detail_jurnal					Inner Join jurnal ON jurnal.GLID = detail_jurnal.GLID					Inner Join master_akun ON master_akun.AKUNID = detail_jurnal.AKUNID					where					detail_jurnal.AKUNID LIKE '5%' 					and master_akun.KOUNIT='07000000'					group by detail_jurnal.AKUNID					order by detail_jurnal.AKUNID desc					";					
	//detail_jurnal.AKUNID LIKE '5%' and jurnal.PO_NO like 'PO%' group by detail_jurnal.AKUNID";		
	$this->db->flush_cache();		
	$this->db->flush_cache();		
	return $this->db->query($query);			
	}		function getItem_pendapatan(){		
	$query = "SELECT					detail_jurnal.GLID,					detail_jurnal.AKUNID,					sum(detail_jurnal.DEBET) DEBET,					sum(detail_jurnal.KREDIT) KREDIT,					detail_jurnal.KETERANGAN,					jurnal.GLID,					jurnal.TANGGAL,					jurnal.PO_NO,					master_akun.NAKUN					FROM					detail_jurnal					Inner Join jurnal ON jurnal.GLID = detail_jurnal.GLID					Inner Join master_akun ON master_akun.AKUNID = detail_jurnal.AKUNID					where					detail_jurnal.AKUNID LIKE '4%'					and master_akun.KOUNIT='07000000'					group by detail_jurnal.AKUNID					order by detail_jurnal.AKUNID desc					";				$this->db->flush_cache();		return $this->db->query($query);	}	function getItem_kas_awal($yearnow)	{		/*		$query = "SELECT				detail_jurnal.AKUNID,				detail_jurnal.DEBET,				detail_jurnal.KREDIT,				detail_jurnal.KREDIT - detail_jurnal.DEBET as laba_rugi				FROM				jurnal				INNER JOIN detail_jurnal ON jurnal.GLID = detail_jurnal.GLID						WHERE `jurnal`.`TANGGAL` BETWEEN '" . $periode_awal . "' AND '" . $periode_akhir . "' and    detail_jurnal.AKUNID LIKE '4%' ORDER BY detail_jurnal.AKUNID ASC";		*/		$query = "SELECT 					jurnal.GLID,					jurnal.PO_NO,					jurnal.KAS_AWAL,					jurnal.KETERANGAN,					jurnal.TANGGAL,					detail_jurnal.DEBET,					detail_jurnal.AKUNID,					detail_jurnal.KREDIT, 					detail_jurnal.GLID as glid_detail,					sum(detail_jurnal.DEBET) as debet, 					sum(detail_jurnal.KREDIT) as JUMLAH_KAS_AWAL 					FROM jurnal										Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID					where SUBSTR(TANGGAL,1,4)=" . $yearnow . " and detail_jurnal.AKUNID LIKE '4%' group by detail_jurnal.STATUS";		$this->db->flush_cache();		return $this->db->query($query);	}	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_pembelian', $id);
		return $this->db->get('pembelian');
	}		function get_total_refund(){		$query = "SELECT				
	refund.GLID,				refund.GLID_PARENT,				
	jurnal.GLID,				detail_jurnal.AKUNID,				
	detail_jurnal.DEBET,				detail_jurnal.KREDIT,				sum(detail_jurnal.DEBET) refund_debet,				
	sum(detail_jurnal.KREDIT) refund_kredit,				detail_jurnal.KETERANGAN				
	FROM				refund				Inner Join jurnal ON jurnal.GLID = refund.GLID				
	Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID				where akunid like '11%'				GROUP BY GROUP_REFUND = 1				";		$this->db->flush_cache();		return $this->db->query($query);	}		function get_total_diskon(){		$query="SELECT			jurnal.GLID,			jurnal.TANGGAL,			jurnal.KETERANGAN,			detail_jurnal.AKUNID,			detail_jurnal.DEBET,			detail_jurnal.KREDIT,			sum(detail_jurnal.KREDIT) as total_diskon			FROM			pembelian			Inner Join jurnal ON pembelian.po_no = jurnal.PO_NO			Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID			where pembelian.diskon <> 0 and pembelian.posting =1 and detail_jurnal.AKUNID like '4%'			GROUP BY GROUP_JURNAL = 1			";		$this->db->flush_cache();		return $this->db->query($query);	}		function get_total_pembelian(){		$query="SELECT				jurnal.PO_NO,				detail_jurnal.DEBET,				detail_jurnal.KREDIT,				jurnal.GLID,				pembelian.po_no,				jurnal.TANGGAL,				pembelian.total,				pembelian.cara_bayar,				pembelian.`status`,				pembelian.posting,				sum(detail_jurnal.KREDIT) as total_pembelian				FROM				jurnal				Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID				Inner Join pembelian ON pembelian.po_no = jurnal.PO_NO				group by jurnal.PO_NO like 'PO%'";		$this->db->flush_cache();		return $this->db->query($query);	}		function get_total_kas_awal(){		$query="SELECT				jurnal.PO_NO,				detail_jurnal.DEBET,				detail_jurnal.KREDIT,				jurnal.GLID,				jurnal.TANGGAL,				sum(detail_jurnal.DEBET) as kas_awal 				FROM				jurnal				Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID				where jurnal.KAS_AWAL = 1				group by jurnal.KAS_AWAL = 1";		$this->db->flush_cache();		return $this->db->query($query);	}		function get_kas_awal_pembelian($periode_awal,$start_persediaan_awal){		$query="SELECT				jurnal.PO_NO,				detail_jurnal.AKUNID,				detail_jurnal.DEBET,				detail_jurnal.KREDIT,				jurnal.GLID,				pembelian.po_no,				jurnal.TANGGAL,				pembelian.posting,				sum(detail_jurnal.DEBET) as total_kas_awal_pembelian				FROM								jurnal								Inner Join detail_jurnal ON jurnal.GLID = detail_jurnal.GLID								Inner Join pembelian ON pembelian.po_no = jurnal.PO_NO				WHERE				(jurnal.TANGGAL BETWEEN  '" . $start_persediaan_awal . "' AND '" . $periode_awal . "')				group by jurnal.PO_NO like 'PO%'";		$this->db->flush_cache();		return $this->db->query($query);	}	
}