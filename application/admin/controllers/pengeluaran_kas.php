<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengeluaran_kas extends My_Controller
{
	
	function __construct()	{		
	parent::__construct();				
	$this->load->model('mdl_hutang', 'hutang');		
	$this->load->model('mdl_pengeluaran_kas', 'pengeluaran_kas');		
	$this->load->library(array('fungsi','pquery'));			
	}	function index()	{		if ($this->can_view() == FALSE){			
	redirect('auth/failed');		}				
	$data['can_view'] 	= $this->can_view();		
	$data['can_insert'] = $this->can_insert();		
	$data['can_update'] = $this->can_update();		
	$data['can_delete'] = $this->can_delete();			
	$this->open();			
	/*config pagination	*/
	$config['base_url'] = base_url().'index.php/pengeluaran_kas/index/';	
	$config['total_rows'] = $this->db->count_all('daftar_hutang');	
	$config['per_page'] = '20';		$config['num_links'] = '5';		
	$config['uri_segment'] = '3';				
	$config['full_tag_open'] = '';		$config['full_tag_close'] = '';	
	$config['num_tag_open'] = '<li>';		$config['num_tag_close'] = '</li>';			
	$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';		$config['cur_tag_close'] = '</a></li>';		
	$config['prev_link'] = 'Prev';		$config['prev_tag_open'] = '<li>';		$config['prev_tag_close'] = '</li>';		
	$config['next_link'] = 'Next';		$config['next_tag_open'] = '<li>';		$config['next_tag_close'] = '</li>';			
	$config['last_link'] = 'Last';		$config['last_tag_open'] = '<li>';		$config['last_tag_close'] = '</li>';		
	$config['first_link'] = 'First';		$config['first_tag_open'] = '<li>';		$config['first_tag_close'] = '</li>';	
	$this->pagination->initialize($config);		
	/*end config pagination				*/
	/*get data*/
	$date_now = date('Y-m-d');		
	$data['results'] = $this->pengeluaran_kas->getItem($config['per_page'], $this->uri->segment(3),$date_now);	
	/*load view		*/
	$this->load->view('pengeluaran_kas/pengeluaran_kas_list.php', $data);		
	$this->close();	}		function insert()	{		if ($this->can_insert() == FALSE){		
	redirect('auth/failed');		}						$this->open();	
	/*Data				*/
	$data['kd_akun_kredit'] = $this->input->post('kd_akun_kredit');		
	$data['kd_akun_debet'] = $this->input->post('kd_akun_debet');	
	$data['tanggal'] = $this->input->post('tanggal');	
	$data['jumlah_debet'] = $this->input->post('jumlah_debet');	
	$data['ket_transaksi'] = $this->input->post('ket_transaksi');	
	$data['userid'] = get_userid();						
	/*set rules validation		*/
	$this->form_validation->set_rules('kd_akun_kredit', 'kd_akun_kredit', 'required');	
	$this->form_validation->set_rules('kd_akun_debet', 'kd_akun_debet', 'required');		
	$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		
	$this->form_validation->set_rules('jumlah_debet', 'jumlah_debet', 'required|trim|numeric');	
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
	/*set message validation		*/
	$this->form_validation->set_message('required', 'Field %s harus diisi!');	
	$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');		
	if ($this->form_validation->run() == FALSE){				
	$this->load->view('pengeluaran_kas/pengeluaran_kas_add',$data);				
	}else{				$this->view_posting_pengeluaran_kas();			
	}		$this->close();	}		function view_posting_pengeluaran_kas(){	
	/*Data		*/
	$kd_kas_debet			= $this->input->post('kd_kas');	
	$jumlah_debet			= $this->input->post('jumlah_debet');		
	$tanggal			= $this->input->post('tanggal');				
	/*set rules validation		*/
	$this->form_validation->set_rules('jumlah_debet', 'jumlah_debet', 'required');	
	/*		*/		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
	/*set message validation	*/
	$this->form_validation->set_message('required', 'Field %s harus diisi!');	
	$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');		
	if ($this->form_validation->run() == FALSE){				
	$this->load->view('pengeluaran_kas/pengeluaran_kas_add');			
	}else{				$detail			= $this->input->post('detail');		
	$gen_glid=$this->pengeluaran_kas->get_glid();			$count_detail = count($detail);			$i=0;						$jml=0;			for($j=0; $j<$count_detail; $j++){				$jml		= $jml +  $detail[$j]['jumlah'];												}						$total_kredit=$jml;							if ($jml<=$jumlah_debet){										for($i=0; $i<$count_detail; $i++){						$data['akunid'][]=$detail[$i]['akunid'];						$data['jumlah'][]=$detail[$i]['jumlah'];						$data['nakun'][]=$detail[$i]['nakun'];						$data['ket_transaksi'][]=$detail[$i]['ket_transaksi'];						$data['glid'][]=$gen_glid;						$data['kd_kas_debet'][]	= $kd_kas_debet;																							}					$data['akunid_debet']	=$kd_kas_debet;					$data['jumlah_debet']	= $jumlah_debet;					$data['total_kredit']	= $total_kredit;					$data['tanggal']	= $tanggal;					$data['glid_j']=$gen_glid;						$this->load->view('pengeluaran_kas/view_posting_pengeluaran_kas_preview', $data);				}else{					$this->session->set_flashdata('message', 'Kas tidak mencukupi');					$this->load->view('pengeluaran_kas/_404_insufficient.php');				}					}				$this->close();	}		function posting_pengeluaran_kas(){		$glid=$this->input->post('glid');		$akunid_debet=$this->input->post('akunid_debet');		$tanggal=$this->input->post('tanggal');		$jumlah_debet=$this->input->post('jumlah_debet');		$total_kredit=$this->input->post('total_kredit');		$glid_j=$this->input->post('glid_j');		$gen_glid_pengeluaran=$this->pengeluaran_kas->get_glid_pengeluaran();					$data['GLID'] = $glid_j;		$data['TANGGAL'] = $tanggal;		$data['CUID'] = get_userid();		$data['CDATE'] = date('Y-m-d');		$data['GLID_PARENT'] = $gen_glid_pengeluaran;				$dataP['glid'] = $gen_glid_pengeluaran;		$dataP['tanggal'] = $tanggal;		$dataP['cuid'] = get_userid();		$dataP['cdate'] = date('Y-m-d');				$detailJ2['CUID'] = get_userid();		$detailJ2['CDATE'] = date('Y-m-d');		$detailJ2['GLID'] = $glid_j;		$detailJ2['AKUNID'] = $akunid_debet;		$detailJ2['KREDIT'] = $total_kredit;				$detailP2['cuid'] = get_userid();		$detailP2['cdate'] = date('Y-m-d');		$detailP2['glid'] = $gen_glid_pengeluaran;		$detailP2['akunid'] = $akunid_debet;		$detailP2['kredit'] = $total_kredit;				$this->pengeluaran_kas->insert($data);		$this->pengeluaran_kas->insert_pengeluaran($dataP);		$this->pengeluaran_kas->insert_detailJ($detailJ2);		$this->pengeluaran_kas->insert_detail_pengeluaran($detailP2);				$i=0;				$detailP["glid"]=$gen_glid_pengeluaran;		$detailP['cuid'] = get_userid();		$detailP['cdate'] = date('Y-m-d');		foreach($glid as $row){						if ($row['id_glid'] == true){				$detailP["debet"]=$row['jumlah'];				$detailP["akunid"]=$row['akunid'];				$detailP["ket_transaksi"]=$row['ket_transaksi'];												$detailJ["DEBET"]=$row['jumlah'];				$detailJ["AKUNID"]=$row['akunid'];				$detailJ["glid"]=$row['id_glid'];				$detailJ["KETERANGAN"]=$row['ket_transaksi'];				$detailJ['CUID'] = get_userid();				$detailJ['CDATE'] = date('Y-m-d');				$i=$i+1;				$this->pengeluaran_kas->insert_detailJ($detailJ);				$this->pengeluaran_kas->insert_detail_pengeluaran($detailP);			}		}			redirect('pengeluaran_kas');	}		function get_kas(){		$akunid=$this->uri->segment(3); 		$data_kas = $this->pengeluaran_kas->get_total_tiap_akun($akunid,false);		$data_kas_count = $this->pengeluaran_kas->get_total_tiap_akun($akunid,true);			$data_jml_kas = 0;		if ($data_kas_count!=0 || $data_kas_count!=null){			$rows=$data_kas->row();			echo $data['data_jml_kas']=$rows->total_kas;					}else{			echo $data['data_jml_kas'] = 0;		}	}		function show_akun(){		$data['result'] = $this->pengeluaran_kas->get_master_akun();		$this->load->view('pengeluaran_kas/list_akun.php', $data);	}		function update($id)	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}				$this->open();				$data['result'] 		= $this->hutang->getItemById($id);		$data['id_pembelian']	= $id;				$this->load->view('hutang/pembayaran_hutang_edit', $data);		$this->close();	}	function process_update()	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}	
	$this->open();	
	/*Data		*/
	$sisa_hutang=0;	
	$data['id_pembelian'] = $this->input->post('id_pembelian');	
	$data['po_no'] = $this->input->post('po_no');			
	$data['id_supplier'] = $this->input->post('id_supplier');		$data['id_cabang'] = $this->input->post('id_cabang');		$data['total_tagihan'] = $this->input->post('total_tagihan');		$data['pembayaran'] = $this->input->post('pembayaran');		$sisa_hutang = $data['total_tagihan'] - $data['pembayaran'];		$data['sisa'] = $this->input->post('sisa');				$data['tanggal'] = $this->input->post('tanggal');		$data['glid'] = $this->input->post('glid');				$data['id_coa'] = '5';	
	$data['userid'] = get_userid();		
	/*set rules validation	*/
	$this->form_validation->set_rules('po_no', 'po_no', 'required');	
	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
	/*set message validation*/
	$this->form_validation->set_message('required', 'Field %s harus diisi!');	
	if ($this->form_validation->run() == FALSE){					$this->load->view('hutang/pembayaran_hutang_edit', $data); 			
	}else{		
	/*update ke table angsuran_hutang	*/
		/*-------------------------			*/
		$angsuran_hutang['KOUNIT'] 		= $data['id_cabang'];	
		/*$angsuran_hutang['po_no'] 	= $data['po_no'];		*/
		$angsuran_hutang['TANGGAL'] 	= $data['tanggal'];		
		$angsuran_hutang['GLID'] 		= $data['glid'];			
		$angsuran_hutang['KODE_PARTNER'] = $data['id_supplier'];			
		$angsuran_hutang['total'] 		= $data['total_tagihan'];			
		$angsuran_hutang['angsuran'] 	= $data['pembayaran'];		
		$angsuran_hutang['sisa'] 		= $sisa_hutang;			
		/*$angsuran_hutang['userid'] 	= $data['userid'];		*/
		/*$this->pembelian->update($angsuran_hutang['id_pembelian'], $angsuran_hutang);*/
		$this->hutang->insert_angsuran($angsuran_hutang);							
		$this->db->flush_cache();						
		$update_hutang = array('JUMLAH' => $sisa_hutang);			
		$this->db->where('GLID', $data['glid']);
		$this->db->update('daftar_hutang', $update_hutang);
		$this->db->flush_cache();						if ($sisa_hutang=='0'){				$update_pembelian = array(								'status_hutang' => '2'				);								}else{				$update_pembelian = array(								'status_hutang' => '1'				);					}			$this->db->where('po_no', $data['po_no']);						$this->db->update('pembelian', $update_pembelian);						$this->session->set_flashdata('message', 'Data Pembayaran Hutang Berhasil disimpan.');			redirect('hutang');		}		}		function view_posting(){		$PO_NO=$this->input->post('PO_NO');		$JUMLAH=$this->input->post('JUMLAH');		$GLID=$this->input->post('GLID');		$KODE_PARTNER=$this->input->post('KODE_PARTNER');/*		$TANGGAL=$this->input->post('TANGGAL');				$KET_TRANSASKSI=$this->input->post('KET_TRANSASKSI');		$AKUNID=$this->input->post('AKUNID');		$KOUNIT=$this->input->post('KOUNIT');		*/				$gen_glid=$this->pengeluaran_kas->get_glid();				$i=0;		foreach($PO_NO as $row){						if ($row['KODE_PO'] == true){				$data['PO_NO'][] = $row['KODE_PO'];				$data['GLID'][]	= $this->fungsi->gen_glid_counter('/',$gen_glid,$i);				$data['KODE_PARTNER'][] = $row['KODE_PARTNER'];				$data['NAMA_PARTNER'][] = $row['NAMA_PARTNER'];				$data['AKUNID'][] = $row['AKUNID_SELECT'];								$data['KOUNIT'][] = $row['KOUNIT'];				$data['NAMA_KOUNIT'][] = $row['NAMA_KOUNIT'];				$data['TANGGAL'][] = $row['TANGGAL'];				
		$data['JUMLAH'][] = $row['JUMLAH'];			
		/*echo "KODE PARTNER : ".$row['KODE_PARTNER']."\n\n";			*/
		/*echo "AKUN : ".$row['AKUNID']."\n\n";			*/
		$i=$i+1;		
		}		}		
		$this->load->view('pengeluaran_kas/view_posting_preview', $data);	}	
		function posting(){		$PO_NO=$this->input->post('PO_NO');	
		$JUMLAH=$this->input->post('JUMLAH');		$GLID=$this->input->post('GLID');		
		$i=0;		foreach($PO_NO as $row){						if ($row['KODE_PO'] == true){			
		$data['PO_NO'] = $row['KODE_PO'];				$data['GLID']	= $row['GLID'];			
		$data['PARTNERID'] = $row['KODE_PARTNER'];								$data['KOUNIT'] = $row['KOUNIT'];		
		$data['TANGGAL'] = $row['TANGGAL'];				$data['CUID'] = get_userid();		
		$data['CDATE'] = date('Y-m-d');								$i=$i+1;			
		$this->pengeluaran_kas->insert($data);				$data_update=array('posting'=>'1');			
		$this->pengeluaran_kas->update($data['PO_NO'],$data_update);							
		$detailJ["KREDIT"]=$row['JUMLAH'];				$detailJ["AKUNID"]=$row['AKUNID'];		
		$detailJ["KOUNIT"]=$row['KOUNIT'];				$detailJ["GLID"]=$row['GLID'];			
		$detailJ['CUID'] = get_userid();				$detailJ['CDATE'] = date('Y-m-d');			
		/*$detailJ["PO_NO"]=$row['KODE_PO'];		*/
		$this->pengeluaran_kas->insert_detailJ($detailJ);	
		$get_detail=$this->pengeluaran_kas->get_detail_pembelian($data['PO_NO']);		
		foreach($get_detail->result() as $rows_detailPjl){			
		$detail_idbarang=$rows_detailPjl->id_barang;				
		$detail_total=$rows_detailPjl->total;					$detail_akunid=$rows_detailPjl->akunid;										$detailJ2["GLID"]=$row['GLID'];		
			$detailJ2["KOUNIT"]=$row['KOUNIT'];			
			$detailJ2["AKUNID"]=$detail_akunid;					$detailJ2["DEBET"]=$detail_total;			
			$detailJ2["CDATE"]=$row['TANGGAL'];					$this->pengeluaran_kas->insert_detailJ($detailJ2);			
			}			}		}			
			/*		for($i=0;$i<count($PO_NO);$i++)	
			{		
			$data['PO_NO']=$PO_NO[$i];			
			$data['GLID']=$GLID[$i];			
			$this->pengeluaran_kas->insert($data);		
			$data_update=array('posting'=>'1');			
			//$this->pengeluaran_kas->update($data['PO_NO'],$data_update);		
			//$data['results'] = $this->pengeluaran_kas->get_datafordetailjurnal($data['PO_NO']);	
			//$data['results'] = $this->pengeluaran_kas->get_datafordetailjurnal($data['PO_NO']);	
			$detail_jurnal = $this->pengeluaran_kas->get_datafordetailjurnal($data['PO_NO']);		
			foreach ($detail_jurnal->result() as $rows_detailJ){					$detailJ['GLID']=$rows_detailJ->GLID;	
			/*$detailJ['id_pembelian']=$rows_detailJ->id_pembelian;							
			$detailJ['id_barang']=$rows_detailJ->id_barang;			
			$detailJ['AKUNID']=$rows_detailJ->akunid;			
			$detailJ['KREDIT']=$rows_detailJ->harga;							
			$this->pengeluaran_kas->insert_detailJ($detailJ);				}			}			
			$this->load->view('pengeluaran_kas/detail_jurnal_list', $data); */	
			redirect('pengeluaran_kas');	}		
			
}