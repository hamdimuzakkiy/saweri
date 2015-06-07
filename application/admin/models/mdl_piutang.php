<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_piutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('penjualan.id_penjualan, penjualan.so_no, cabang.nama_cabang,penjualan.id_cabang,pelanggan.nama as nama_pelanggan, penjualan.id_pelanggan,		penjualan.tanggal,penjualan.kd_akun,penjualan.total,penjualan.cara_bayar,dp.glid,dp.id,dp.TANGGAL,dp.JUMLAH,dp.GLID');
		$this->db->from('penjualan');
		$this->db->join('cabang', 'cabang.id_cabang = penjualan.id_cabang');		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan');		$this->db->join('daftar_piutang dp', 'dp.so_no = penjualan.so_no');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('penjualan.status_piutang','0');		$this->db->or_where('penjualan.status_piutang', '1'); 		$this->db->where('penjualan.cara_bayar','2');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		/*$this->db->select('penjualan.id_pembelian, supplier.id_supplier, supplier.kode_supplier, supplier.nama AS nama_supplier, cabang.id_cabang, 		cabang.nama_cabang,daftar_piutang.GLID,daftar_piutang.so_no,daftar_piutang.KODE_PARTNER,daftar_piutang.JUMLAH,daftar_piutang.TANGGAL as tanggal_daftarhutang');
		$this->db->from('daftar_piutang');
		$this->db->join('supplier', 'supplier.id_supplier = daftar_piutang.KODE_PARTNER');
		$this->db->join('cabang', 'cabang.id_cabang = daftar_piutang.KOUNIT');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = penjualan.id_pembelian');		$this->db->join('daftar_piutang', 'daftar_piutang.so_no= penjualan.so_no');*/		$this->db->select('daftar_piutang.*,pelanggan.id_pelanggan, pelanggan.kode_pelanggan,cabang.id_cabang,pelanggan.nama AS nama_pelanggan,cabang.nama_cabang');		$this->db->from('daftar_piutang');		$this->db->join('penjualan', 'daftar_piutang.so_no= penjualan.so_no');			$this->db->join('pelanggan', 'pelanggan.id_pelanggan = daftar_piutang.KODE_PARTNER');		$this->db->join('cabang', 'cabang.id_cabang = daftar_piutang.KOUNIT');			
		$this->db->where('daftar_piutang.GLID', $id);
		return $this->db->get();
	}
	function getItem_angsuran($glid){		$this->db->flush_cache();		$this->db->select('angsuran_piutang.*,cabang.nama_cabang,pelanggan.nama nama_pelanggan');		$this->db->from('angsuran_piutang');		$this->db->join('cabang', 'cabang.id_cabang= angsuran_piutang.KOUNIT');				$this->db->join('pelanggan', 'pelanggan.id_pelanggan= angsuran_piutang.KODE_PARTNER');				$this->db->where('angsuran_piutang.GLID', $glid);				return $this->db->get();	}		function getItem_posting(){		$this->db->flush_cache();		$this->db->select('angsuran_piutang.*,daftar_piutang.so_no,penjualan.cara_bayar,cabang.nama_cabang,pelanggan.nama nama_pelanggan');		$this->db->from('angsuran_piutang');		$this->db->join('daftar_piutang', 'daftar_piutang.GLID= angsuran_piutang.GLID');				$this->db->join('penjualan', 'penjualan.so_no= daftar_piutang.so_no');				$this->db->join('cabang', 'cabang.id_cabang= angsuran_piutang.KOUNIT');				$this->db->join('pelanggan', 'pelanggan.id_pelanggan= angsuran_piutang.KODE_PARTNER');				$this->db->where('angsuran_piutang.STATUS_POSTING', '0');		return $this->db->get();	}		function get_detail_piutang($so_no){		$this->db->flush_cache();		$this->db->select('penjualan.so_no,						penjualan.id_penjualan,						detail_penjualan.id_barang,						detail_penjualan.harga,						detail_penjualan.qty,						detail_penjualan.total,						barang.nama_barang,						barang.id_kategori,						kategori.akunid,						kategori.kategori');		$this->db->from('penjualan');		$this->db->join('detail_penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');		$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');		$this->db->where('penjualan.so_no',$so_no);		return $this->db->get();	}
	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('daftar_piutang', $data);
	}		function insert_angsuran($data)	{		$this->db->flush_cache();		$this->db->insert('angsuran_piutang', $data);	}
	
	function insert_detail($data)
	{
		$this->db->flush_cache();
		$this->db->insert('detail_penjualan', $data);
	}
	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_penjualan', $id);
		$this->db->update('penjualan', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('pembelian', array('id_pembelian' => $id));
	}		function insert_J($data)	{		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	}		function insert_detailJ($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function update_posting($id, $data)	{		$this->db->flush_cache();		$this->db->where('ID', $id);		$this->db->update('angsuran_piutang', $data);	}
	
	function get_detail($id_request)
	{
		$this->db->flush_cache();
		$this->db->select('detail_pembelian.*, barang.*');
		$this->db->from('detail_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->where('id_pembelian', $id_request);
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		return $this->db->get();
	}
	
	
	function get_po()
	{
		
		$code_user = get_userid();
		$code_user = str_pad($code_user, 3, '0', STR_PAD_LEFT);
		
		
		$this->db->flush_cache();
		$this->db->select('users.*, cabang.*, karyawan.*');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->where('users.userid', get_userid());
		$kode_cabang = $this->db->get()->row()->kode_cabang;
		
		
		$tanggal = date('dmY');
		
		# ambil nomer running berdasarkan
		$this->db->flush_cache();
		$this->db->from('pembelian');
		$this->db->like('po_no', 'PO-'.$kode_cabang.$code_user.$tanggal, 'after');
		$query = $this->db->get();
		
		$no_po = $query->num_rows();
		$no_po = (int) $no_po + 1;
		$no_po = str_pad($no_po, 6, '0', STR_PAD_LEFT);
		
		return 'PO-'.$kode_cabang.$code_user.$tanggal.$no_po;
		
	}	
	# untuk di list barang pada fancyBox
	function get_barang()
	{
		$this->db->flush_cache();
		$this->db->select('*, jenis.jenis AS jenis_barang, kategori.kategori AS kategori_barang');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		$this->db->where('barang.id_jenis <>', '3');
		return $this->db->get();
	}		function get_glid(){		$this->db->flush_cache();		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'daftar_piutang'");				$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);		return 'PTG/'.substr(date('Y'),2,2).date('md').'/'.$no;			}
	
}