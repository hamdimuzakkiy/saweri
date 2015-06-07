<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posting_keluar extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_hutang', 'hutang');		$this->load->model('mdl_posting_keluar', 'posting_keluar');		$this->load->library(array('fungsi','pquery'));
		
	}
	function index()
	{
		if ($this->can_view() == FALSE){
			redirect('auth/failed');
		}
		
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/posting_keluar/index/';
		$config['total_rows'] = $this->db->count_all('daftar_hutang');
		$config['per_page'] = '20';
		$config['num_links'] = '5';
		$config['uri_segment'] = '3';
		
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);	
		
		
				
		$data['results'] = $this->posting_keluar->getItem($config['per_page'], $this->uri->segment(3));		$data_posting = $this->posting_keluar->getItem($config['per_page'], $this->uri->segment(3));		$count_data_posting = $this->posting_keluar->count_getItem();
		//$data['sebagai'] = $sebagai;		/*if ($count_data_posting==0){			$data['PO_NO'][]		= null;			$data['GLID'][]			= null;			$data['TANGGAL'][]		= null;			$data['KODE_PARTNER'][]	= null;			$data['KET_TRANSASKSI'][]= null;			$data['KOUNIT'][]		= null;			$data['JUMLAH'][]		= null;		}else{*/
			foreach($data_posting->result() as $rows_posting){										$data['PO_NO'][]		= $rows_posting->po_no;					//$data['GLID'][]			= $rows_posting->GLID;					$data['TANGGAL'][]		= $rows_posting->tanggal;					$data['KODE_PARTNER'][]	= $rows_posting->id_supplier;					$data['NAMA_PARTNER'][]	= $rows_posting->nama_supplier;					$data['KET_TRANSASKSI'][]= '';					$data['KOUNIT'][]		= $rows_posting->id_cabang;					$data['NAMA_KOUNIT'][]	= $rows_posting->nama_cabang;					$data['JUMLAH'][]		= $rows_posting->total;					$data['CARA_BAYAR'][]	= $rows_posting->cara_bayar;					 			}		//}
		
		
		$this->load->view('posting_keluar/posting_keluar_list.php', $data);
		
		$this->close();
	}		function insert()	{		if ($this->can_insert() == FALSE){			redirect('auth/failed');		}						$this->open();				$data['id_barang'] = $this->input->post('id_barang');		$data['nama_barang'] = $this->input->post('nama_barang');		$data['id_jenis'] = $this->input->post('id_jenis');		$data['id_kategori'] = $this->input->post('id_kategori');		$data['id_satuan'] = $this->input->post('id_satuan');		$data['id_golongan'] = $this->input->post('id_golongan');		$data['hpp'] = $this->input->post('hpp');		$data['harga_toko'] = $this->input->post('harga_toko');		$data['harga_partai'] = $this->input->post('harga_partai');		$data['harga_cabang'] = $this->input->post('harga_cabang');				$data['is_hargatoko'] = $this->input->post('is_hargatoko');		$data['is_hargapartai'] = $this->input->post('is_hargapartai');		$data['is_hargajual'] = $this->input->post('is_hargajual');		$data['point_karyawan'] = $this->input->post('point_karyawan');		$data['point_member'] = $this->input->post('point_member');		$data['userid'] = get_userid();								$this->form_validation->set_rules('nama_barang', 'nama_barang', 'callback_cek_nama');		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');		$this->form_validation->set_rules('hpp', 'hpp', 'trim');		$this->form_validation->set_rules('harga_toko', 'harga_toko', 'trim|numeric');		$this->form_validation->set_rules('harga_partai', 'harga_partai', 'trim|numeric');		$this->form_validation->set_rules('harga_cabang', 'harga_cabang', 'trim|numeric');		$this->form_validation->set_rules('is_hargatoko', 'is_hargatoko', 'trim');		$this->form_validation->set_rules('is_hargapartai', 'is_hargapartai', 'trim');		$this->form_validation->set_rules('is_hargajual', 'is_hargajual', 'trim');		$this->form_validation->set_rules('point_karyawan', 'point_karyawan', 'trim|numeric');		$this->form_validation->set_rules('point_member', 'point_member', 'trim|numeric');						$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						$this->form_validation->set_message('required', 'Field %s harus diisi!');		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						if ($this->form_validation->run() == FALSE){						$this->load->view('pengeluaran_kas/pengeluaran_kas_add',$data);					}else{				$this->hutang->insert($data);						$this->session->set_flashdata('message', 'Data Penerimaan Kas Berhasil disimpan.');			redirect('posting_keluar');		}				$this->close();	}		function update($id)	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}				$this->open();				$data['result'] 		= $this->hutang->getItemById($id);		$data['id_pembelian']	= $id;				$this->load->view('hutang/pembayaran_hutang_edit', $data);		$this->close();	}
	function process_update()	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}		$this->open();				$sisa_hutang=0;		$data['id_pembelian'] = $this->input->post('id_pembelian');		$data['po_no'] = $this->input->post('po_no');				$data['id_supplier'] = $this->input->post('id_supplier');		$data['id_cabang'] = $this->input->post('id_cabang');		$data['total_tagihan'] = $this->input->post('total_tagihan');		$data['pembayaran'] = $this->input->post('pembayaran');		$sisa_hutang = $data['total_tagihan'] - $data['pembayaran'];		$data['sisa'] = $this->input->post('sisa');				$data['tanggal'] = $this->input->post('tanggal');		$data['glid'] = $this->input->post('glid');				$data['id_coa'] = '5';		$data['userid'] = get_userid();				$this->form_validation->set_rules('po_no', 'po_no', 'required');		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						$this->form_validation->set_message('required', 'Field %s harus diisi!');		if ($this->form_validation->run() == FALSE){					$this->load->view('hutang/pembayaran_hutang_edit', $data); 				}else{			# update ke table angsuran_hutang			# -------------------------			$angsuran_hutang['KOUNIT'] 		= $data['id_cabang'];			//$angsuran_hutang['po_no'] 	= $data['po_no'];			$angsuran_hutang['TANGGAL'] 	= $data['tanggal'];			$angsuran_hutang['GLID'] 		= $data['glid'];					$angsuran_hutang['KODE_PARTNER'] = $data['id_supplier'];						$angsuran_hutang['total'] 		= $data['total_tagihan'];			$angsuran_hutang['angsuran'] 	= $data['pembayaran'];			$angsuran_hutang['sisa'] 		= $sisa_hutang;			//$angsuran_hutang['userid'] 	= $data['userid'];			//$this->pembelian->update($angsuran_hutang['id_pembelian'], $angsuran_hutang);			$this->hutang->insert_angsuran($angsuran_hutang);									$this->db->flush_cache();						$update_hutang = array(								'JUMLAH' => $sisa_hutang							);				$this->db->where('GLID', $data['glid']);						$this->db->update('daftar_hutang', $update_hutang);						$this->db->flush_cache();						if ($sisa_hutang=='0'){				$update_pembelian = array(								'status_hutang' => '2'				);								}else{				$update_pembelian = array(								'status_hutang' => '1'				);					}			$this->db->where('po_no', $data['po_no']);						$this->db->update('pembelian', $update_pembelian);						$this->session->set_flashdata('message', 'Data Pembayaran Hutang Berhasil disimpan.');			redirect('hutang');		}				$this->close();			}		function view_posting(){		$PO_NO=$this->input->post('PO_NO');		$JUMLAH=$this->input->post('JUMLAH');		$GLID=$this->input->post('GLID');		$KODE_PARTNER=$this->input->post('KODE_PARTNER');/*		$TANGGAL=$this->input->post('TANGGAL');				$KET_TRANSASKSI=$this->input->post('KET_TRANSASKSI');		$AKUNID=$this->input->post('AKUNID');		$KOUNIT=$this->input->post('KOUNIT');		*/				$gen_glid=$this->posting_keluar->get_glid();				$i=0;		foreach($PO_NO as $row){						if ($row['KODE_PO'] == true){				$data['PO_NO'][] = $row['KODE_PO'];				$data['GLID'][]	= $this->fungsi->gen_glid_counter('/',$gen_glid,$i);				$data['KODE_PARTNER'][] = $row['KODE_PARTNER'];				$data['NAMA_PARTNER'][] = $row['NAMA_PARTNER'];				$data['AKUNID'][] = $row['AKUNID_SELECT'];								$data['KOUNIT'][] = $row['KOUNIT'];				$data['NAMA_KOUNIT'][] = $row['NAMA_KOUNIT'];				$data['TANGGAL'][] = $row['TANGGAL'];				$data['JUMLAH'][] = $row['JUMLAH'];				//echo "KODE PARTNER : ".$row['KODE_PARTNER']."\n\n";				//echo "AKUN : ".$row['AKUNID']."\n\n";				$i=$i+1;			}		}				$this->load->view('posting_keluar/view_posting_preview', $data);	}		function posting(){		$PO_NO=$this->input->post('PO_NO');		$JUMLAH=$this->input->post('JUMLAH');		$GLID=$this->input->post('GLID');				$i=0;		foreach($PO_NO as $row){						if ($row['KODE_PO'] == true){								$data['PO_NO'] = $row['KODE_PO'];				$data['GLID']	= $row['GLID'];				$data['PARTNERID'] = $row['KODE_PARTNER'];								$data['KOUNIT'] = $row['KOUNIT'];				$data['TANGGAL'] = $row['TANGGAL'];				$data['CUID'] = get_userid();				$data['CDATE'] = date('Y-m-d');								$i=$i+1;				$this->posting_keluar->insert($data);				$data_update=array('posting'=>'1');				$this->posting_keluar->update($data['PO_NO'],$data_update);								$get_detail=$this->posting_keluar->get_detail_pembelian($data['PO_NO']);				foreach($get_detail->result() as $rows_detailPjl){					$detail_idbarang=$rows_detailPjl->id_barang;					$detail_total=$rows_detailPjl->total;					$detail_akunid=$rows_detailPjl->akunid_biaya;					$var_diskon=$rows_detailPjl->diskon;					$var_pembelian=$rows_detailPjl->total_pembelian;										$detailJ2["GLID"]=$row['GLID'];					$detailJ2["KOUNIT"]=$row['KOUNIT'];					$detailJ2["AKUNID"]=$detail_akunid;					$detailJ2["DEBET"]=$detail_total;					$detailJ2["CDATE"]=$row['TANGGAL'];					$detailJ2['CUID'] = get_userid();					$this->posting_keluar->insert_detailJ($detailJ2);									}				if ($var_diskon!=0){					$get_diskon = ($var_diskon * $var_pembelian)/100;					$total_kredit = $var_pembelian - $get_diskon;				}else{					$total_kredit = $row['JUMLAH'];				}				$detailJ["KREDIT"]=$total_kredit;				$detailJ["AKUNID"]=$row['AKUNID'];				$detailJ["KOUNIT"]=$row['KOUNIT'];				$detailJ["GLID"]=$row['GLID'];				$detailJ['CUID'] = get_userid();				$detailJ['CDATE'] = date('Y-m-d');				//$detailJ["PO_NO"]=$row['KODE_PO'];				$this->posting_keluar->insert_detailJ($detailJ);				foreach ($get_detail->result() as $rows_diskon){					if ($rows_diskon->diskon!=0){						$disc_each_goods = ($rows_diskon->diskon*$rows_diskon->harga)/100;						$detailJ_in_disc["KREDIT"]=$disc_each_goods;						$detailJ_in_disc["AKUNID"]=$rows_diskon->akunid_diskon_pendapatan;						$detailJ_in_disc["KOUNIT"]=$row['KOUNIT'];						$detailJ_in_disc["GLID"]=$row['GLID'];						$detailJ_in_disc['CUID'] = get_userid();						$detailJ_in_disc['CDATE'] = date('Y-m-d');						$this->posting_keluar->insert_detailJ($detailJ_in_disc);					}				}			}		}				/*		for($i=0;$i<count($PO_NO);$i++)			{				$data['PO_NO']=$PO_NO[$i];				$data['GLID']=$GLID[$i];				$this->posting_keluar->insert($data);				$data_update=array('posting'=>'1');				//$this->posting_keluar->update($data['PO_NO'],$data_update);								//$data['results'] = $this->posting_keluar->get_datafordetailjurnal($data['PO_NO']);				//$data['results'] = $this->posting_keluar->get_datafordetailjurnal($data['PO_NO']);				$detail_jurnal = $this->posting_keluar->get_datafordetailjurnal($data['PO_NO']);				foreach ($detail_jurnal->result() as $rows_detailJ){					$detailJ['GLID']=$rows_detailJ->GLID;					/*$detailJ['id_pembelian']=$rows_detailJ->id_pembelian;										$detailJ['id_barang']=$rows_detailJ->id_barang;					$detailJ['AKUNID']=$rows_detailJ->akunid;					$detailJ['KREDIT']=$rows_detailJ->harga;										$this->posting_keluar->insert_detailJ($detailJ);				}			}				$this->load->view('posting_keluar/detail_jurnal_list', $data); */		redirect('posting_keluar');	}
}