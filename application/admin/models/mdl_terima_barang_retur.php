<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class mdl_terima_barang_retur extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getItem($num=0, $offset=0)
	{
		$this->db->flush_cache();
		//$this->db->select('retur_pembelian.id_retur_pembelian, pembelian.po_no, supplier.kode_supplier, detail_pembelian.sn, supplier.nama AS nama_supplier, retur_pembelian.tanggal, barang.nama_barang, retur_pembelian.qty');
		$this->db->select('terima_barang_retur.id_retur_penerimaan,terima_barang_retur.tanggal,terima_barang_retur.id_retur_pembelian,terima_barang_retur.userid,retur_pembelian.id_retur_pembelian, pembelian.po_no, supplier.kode_supplier, detail_pembelian.sn, supplier.nama AS nama_supplier, barang.nama_barang, retur_pembelian.qty');
		$this->db->from('terima_barang_retur');
		$this->db->join('retur_pembelian','terima_barang_retur.id_retur_pembelian = retur_pembelian.id_retur_pembelian');
		$this->db->join('detail_pembelian', 'retur_pembelian.id_detail_pembelian = detail_pembelian.id_detail_pembelian');
		$this->db->join('pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
		$this->db->where('pembelian.id_cabang', get_idcabang());
		$this->db->limit($num, $offset);
		return $this->db->get();

	}
	
	function getItemById($id)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_pembelian', $id);
		return $this->db->get('retur_pembelian');
	}

	function insert($data,$kode)
	{
		$data['id_retur_penerimaan'] = $this->getID($kode);
		$this->db->flush_cache();
		$this->db->insert('terima_barang_retur', $data);
		#$data['id_retur_pembelian']		
	}

	function update_sn($data,$datas)
	{
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('detail_pembelian');
		$this->db->join('retur_pembelian', 'detail_pembelian.id_detail_pembelian = retur_pembelian.id_detail_pembelian');
		//$this->db->query('select * from detail_pembelian dp, retur_pembelian rp where rp.id_detail_pembelian = dp.id_detail_pembelian and 
		//							rp.id_retur_pembelian = '.$data['id_retur_pembelian'].'');
		$q = $this->db->get();
		$q = $q->result();
		foreach ($q as $row) {
			$dpb = $row->id_detail_pembelian;
		}
		print "err";
		$this->db->flush_cache();
		$this->db->query('update detail_pembelian set sn = "'.$datas["sn"].'"  where id_detail_pembelian = "'.$dpb.'"');
	 	print $this->db->last_query();

	}

	function getID($kode)
	{
		$kd_awal = $kode;
		$code_user = get_userid();		
		$code_user = str_pad($code_user, 3, '0', STR_PAD_LEFT);
		
		$this->db->flush_cache();
		$this->db->select('users.*, cabang.*, karyawan.*');
		$this->db->from('users');
		$this->db->join('karyawan', 'karyawan.userid = users.userid');
		$this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang');
		$this->db->where('users.userid', get_userid());
		$kode_cabang = $this->db->get()->row()->kode_cabang;
		
		$tanggal = date('dmy');
		
		$this->db->flush_cache();
		$this->db->from('terima_barang_retur');
		//$this->db->like('po_no', $kd_awal . '-'.$kode_cabang.$code_user.$tanggal, 'after');
		$this->db->like('id_retur_penerimaan', $kd_awal . '-'.$kode_cabang.$tanggal, 'after');
		$query = $this->db->get();
		
		//print $this->db->last_query();

		$no_po = $query->num_rows();
		$no_po = (int) $no_po + 1;
		$no_po = str_pad($no_po, 4, '0', STR_PAD_LEFT);
		
		/*return $kd_awal . '-'.$kode_cabang.$code_user.$tanggal.$no_po; */
		return $kd_awal . '-'.$kode_cabang.$tanggal.$no_po; 
	}

	
	function update($id, $data)
	{
		$this->db->flush_cache();
		$this->db->where('id_retur_pembelian', $id);
		$this->db->update('retur_pembelian', $data);
	}
	
	function delete($id)
	{
		$this->db->flush_cache();
		$this->db->delete('retur_pembelian', array('id_retur_pembelian' => $id));
	}
	
}