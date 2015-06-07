<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_hutang extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		$this->db->select('pembelian.id_pembelian, pembelian.po_no, supplier.kode_supplier, supplier.nama AS nama_supplier, cabang.nama_cabang, 		pembelian.tanggal,pembelian.kd_akun,daftar_hutang.glid,daftar_hutang.id,daftar_hutang.TANGGAL,daftar_hutang.JUMLAH,daftar_hutang.GLID');
		$this->db->from('pembelian');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->join('cabang', 'cabang.id_cabang = pembelian.id_cabang');		$this->db->join('daftar_hutang', 'daftar_hutang.po_no = pembelian.po_no');
		$this->db->where('cabang.id_cabang', $this->session->userdata('idcabang'));		$this->db->where('pembelian.status_hutang','0');		$this->db->or_where('pembelian.status_hutang', '1'); 		$this->db->where('pembelian.cara_bayar','2');
		$this->db->limit($num, $offset);
		return $this->db->get();
	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		/*$this->db->select('pembelian.id_pembelian, supplier.id_supplier, supplier.kode_supplier, supplier.nama AS nama_supplier, cabang.id_cabang, 		cabang.nama_cabang,daftar_hutang.GLID,daftar_hutang.po_no,daftar_hutang.KODE_PARTNER,daftar_hutang.JUMLAH,daftar_hutang.TANGGAL as tanggal_daftarhutang');
		$this->db->from('daftar_hutang');
		$this->db->join('supplier', 'supplier.id_supplier = daftar_hutang.KODE_PARTNER');
		$this->db->join('cabang', 'cabang.id_cabang = daftar_hutang.KOUNIT');		$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');		$this->db->join('daftar_hutang', 'daftar_hutang.po_no= pembelian.po_no');*/				$this->db->select('daftar_hutang.*,supplier.id_supplier, supplier.kode_supplier,cabang.id_cabang,supplier.nama AS nama_supplier,cabang.nama_cabang');		$this->db->from('daftar_hutang');		$this->db->join('pembelian', 'daftar_hutang.po_no= pembelian.po_no');			$this->db->join('supplier', 'supplier.id_supplier = daftar_hutang.KODE_PARTNER');		$this->db->join('cabang', 'cabang.id_cabang = daftar_hutang.KOUNIT');			
		$this->db->where('daftar_hutang.GLID', $id);
		return $this->db->get();
	}

	function insert($data)
	{
		$this->db->flush_cache();
		$this->db->insert('daftar_hutang', $data);
	}		function insert_angsuran($data)	{		$this->db->flush_cache();		$this->db->insert('angsuran_hutang', $data);	}
	
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
		$this->db->where('id_pembelian', $id_request);
		$this->db->order_by('detail_pembelian.id_detail_pembelian', 'ASC');
		return $this->db->get();
	}		function getItem_angsuran($glid){		$this->db->flush_cache();		$this->db->select('angsuran_hutang.*,cabang.nama_cabang,supplier.nama as nama_supplier');		$this->db->from('angsuran_hutang');		$this->db->join('cabang', 'cabang.id_cabang= angsuran_hutang.KOUNIT');				$this->db->join('supplier', 'supplier.id_supplier= angsuran_hutang.KODE_PARTNER');				$this->db->where('angsuran_hutang.GLID', $glid);				return $this->db->get();	}
		function getItem_posting(){		$this->db->flush_cache();		$this->db->select('angsuran_hutang.*,daftar_hutang.po_no,pembelian.cara_bayar,cabang.nama_cabang,supplier.nama nama_supplier');		$this->db->from('angsuran_hutang');		$this->db->join('daftar_hutang', 'daftar_hutang.GLID= angsuran_hutang.GLID');				$this->db->join('pembelian', 'pembelian.po_no= daftar_hutang.po_no');				$this->db->join('cabang', 'cabang.id_cabang= angsuran_hutang.KOUNIT');				$this->db->join('supplier', 'supplier.id_supplier= angsuran_hutang.KODE_PARTNER');			$this->db->where('angsuran_hutang.STATUS_POSTING', '0');		return $this->db->get();	}		

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
		
		$this->db->flush_cache();
		$this->db->from('pembelian');
		$this->db->like('po_no', 'PO-'.$kode_cabang.$code_user.$tanggal, 'after');
		$query = $this->db->get();
		
		$no_po = $query->num_rows();
		$no_po = (int) $no_po + 1;
		$no_po = str_pad($no_po, 6, '0', STR_PAD_LEFT);
		
		return 'PO-'.$kode_cabang.$code_user.$tanggal.$no_po;
		
	}	function get_glid(){		$this->db->flush_cache();		$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'daftar_hutang'");		$tmp_no = $query1->row()->Auto_increment;		$no = str_pad($tmp_no, 5, '0', STR_PAD_LEFT);		return 'HTG/'.substr(date('Y'),2,2).date('md').'/'.$no;			}
	
	function get_barang()
	{
		$this->db->flush_cache();
		$this->db->select('*, jenis.jenis AS jenis_barang, kategori.kategori AS kategori_barang');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id_jenis = barang.id_jenis');
		$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
		$this->db->where('barang.id_jenis <>', '3');
		return $this->db->get();
	}		function insert_J($data)	{		$this->db->flush_cache();		$this->db->insert('jurnal', $data);	}		function insert_detailJ($data)	{		$this->db->flush_cache();		$this->db->insert('detail_jurnal', $data);	}		function update_posting($id, $data)	{		$this->db->flush_cache();		$this->db->where('id', $id);		$this->db->update('angsuran_hutang', $data);	}
	
}