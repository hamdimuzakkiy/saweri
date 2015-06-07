<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penerimaan_kas extends My_Controller
{
	
	function __construct()	{		parent::__construct();				
	$this->load->model('mdl_hutang', 'hutang');		
	$this->load->model('mdl_penerimaan_kas', 'penerimaan_kas');		
	$this->load->library(array('fungsi','pquery'));			
	}	function index()	{		
	if ($this->can_view() == FALSE){			
	redirect('auth/failed');		}				
	$data['can_view'] 	= $this->can_view();		
	$data['can_insert'] = $this->can_insert();		
	$data['can_update'] = $this->can_update();		
	$data['can_delete'] = $this->can_delete();				
	$this->open();				
	/* config pagination		*/
	$config['base_url'] = base_url().'index.php/penerimaan_kas/index/';		
	$config['total_rows'] = $this->db->count_all('daftar_hutang');		
	$config['per_page'] = '20';		$config['num_links'] = '5';		
	$config['uri_segment'] = '3';				$config['full_tag_open'] = '';		
	$config['full_tag_close'] = '';				
	$config['num_tag_open'] = '<li>';		$config['num_tag_close'] = '</li>';				
	$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';		
	$config['cur_tag_close'] = '</a></li>';				
	$config['prev_link'] = 'Prev';		$config['prev_tag_open'] = '<li>';		
	$config['prev_tag_close'] = '</li>';				
	$config['next_link'] = 'Next';		$config['next_tag_open'] = '<li>';		
	$config['next_tag_close'] = '</li>';				
	$config['last_link'] = 'Last';		$config['last_tag_open'] = '<li>';		
	$config['last_tag_close'] = '</li>';				
	$config['first_link'] = 'First';		$config['first_tag_open'] = '<li>';		
	$config['first_tag_close'] = '</li>';				
	$this->pagination->initialize($config);			
	/*end config pagination				*/
	/*get data				*/
	$tanggal_sekarang = date('Y-m-d');		
	$data['results'] = $this->penerimaan_kas->getItem($config['per_page'], $this->uri->segment(3),$tanggal_sekarang);		
	/*load view		*/
	$this->load->view('penerimaan_kas/penerimaan_kas_list.php', $data);				
	$this->close();	}				function show_akun(){		
	$data['result'] = $this->penerimaan_kas->get_master_akun();		
	$this->load->view('penerimaan_kas/list_akun.php', $data);	}			
	function get_kas(){		$akunid=$this->uri->segment(3); 		
	$data_kas = $this->penerimaan_kas->get_total_tiap_akun($akunid,false);		
	$data_kas_count = $this->penerimaan_kas->get_total_tiap_akun($akunid,true);			
	if ($data_kas_count!=0){			$rows=$data_kas->row();			
	echo $data['data_jml_kas']=$rows->total_kas;		
	}else{			echo $data['data_jml_kas'] = 0;		}			}		
	function insert()	{		
	if ($this->can_insert() == FALSE){			
	redirect('auth/failed');		
	}						
	$this->open();		
	/*Data				*/
	$data['kd_akun_kredit'] = $this->input->post('kd_akun_kredit');		
	$data['kd_akun_debet'] = $this->input->post('kd_akun_debet');		
	$data['tanggal'] = $this->input->post('tanggal');		
	$data['jumlah_kredit'] = $this->input->post('jumlah_kredit');		
	$data['ket_transaksi'] = $this->input->post('ket_transaksi');		
	$data['userid'] = get_userid();						
	/*set rules validation		*/
	$this->form_validation->set_rules('kd_akun_kredit', 'kd_akun_kredit', 'required');		
	$this->form_validation->set_rules('kd_akun_debet', 'kd_akun_debet', 'required');		
	$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		
	$this->form_validation->set_rules('jumlah_kredit', 'jumlah_kredit', 'required|trim|numeric');			
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
	/*set message validation*/
	$this->form_validation->set_message('required', 'Field %s harus diisi!');		
	$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						
	if ($this->form_validation->run() == FALSE){						
	$this->load->view('penerimaan_kas/penerimaan_kas_add',$data);					
	}else{				$this->view_posting_penerimaan_kas();					}		
	$this->close();	}		function view_posting_penerimaan_kas(){		
	/*Data*/		
	$kd_kas_debet			= $this->input->post('kd_kas');		
	$jumlah_kredit			= $this->input->post('jumlah_kredit');		
	$tanggal			= $this->input->post('tanggal');				
	/*set rules validation*/
	$this->form_validation->set_rules('jumlah_kredit', 'jumlah_kredit', 'required');		
	/*		*/		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
	/*set message validation		*/
	$this->form_validation->set_message('required', 'Field %s harus diisi!');	
	$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');				
	if ($this->form_validation->run() == FALSE){					$this->load->view('penerimaan_kas/penerimaan_kas_add');		
	}else{				
	$detail			= $this->input->post('detail');			
	$gen_glid=$this->penerimaan_kas->get_glid();	
	$count_detail = count($detail);			$i=0;						
	$jml=0;			
	for($j=0; $j<$count_detail; $j++){				
	$jml		= $jml +  $detail[$j]['jumlah'];				
	}							
	$total_kredit=$jml;					
	for($i=0; $i<$count_detail; $i++){						
	$data['akunid'][]=$detail[$i]['akunid'];					
	$data['jumlah'][]=$detail[$i]['jumlah'];		
	$data['nakun'][]=$detail[$i]['nakun'];					
	$data['ket_transaksi'][]=$detail[$i]['ket_transaksi'];			
	$data['glid'][]=$gen_glid;					
	$data['kd_kas_debet'][]	= $kd_kas_debet;																							}	
	$data['akunid_debet']	=$kd_kas_debet;					
	$data['jumlah_kredit']	= $jumlah_kredit;					
	$data['total_kredit']	= $total_kredit;					
	$data['tanggal']	= $tanggal;					$data['glid_j']=$gen_glid;					$this->load->view('penerimaan_kas/view_posting_penerimaan_kas_preview', $data);					}				$this->close();	}		function posting_penerimaan_kas(){		$glid=$this->input->post('glid');		$akunid_debet=$this->input->post('akunid_debet');		$tanggal=$this->input->post('tanggal');		$jumlah_debet=$this->input->post('jumlah_debet');		$total_kredit=$this->input->post('total_kredit');		$glid_j=$this->input->post('glid_j');		$gen_glid_penerimaan=$this->penerimaan_kas->get_glid_penerimaan();					$data['GLID'] = $glid_j;		$data['TANGGAL'] = $tanggal;		$data['CUID'] = get_userid();		$data['CDATE'] = date('Y-m-d');		$data['GLID_PARENT'] = $gen_glid_penerimaan;				$dataP['glid'] = $gen_glid_penerimaan;		$dataP['tanggal'] = $tanggal;		$dataP['cuid'] = get_userid();		$dataP['cdate'] = date('Y-m-d');				$detailJ2['CUID'] = get_userid();		$detailJ2['CDATE'] = date('Y-m-d');		$detailJ2['GLID'] = $glid_j;		$detailJ2['AKUNID'] = $akunid_debet;		$detailJ2['DEBET'] = $total_kredit;				$detailP2['cuid'] = get_userid();		$detailP2['cdate'] = date('Y-m-d');		$detailP2['glid'] = $gen_glid_penerimaan;		$detailP2['akunid'] = $akunid_debet;		$detailP2['debet'] = $total_kredit;				$this->penerimaan_kas->insert($data);		$this->penerimaan_kas->insert_penerimaan($dataP);		$this->penerimaan_kas->insert_detailJ($detailJ2);		$this->penerimaan_kas->insert_detail_penerimaan($detailP2);				$i=0;				$detailP["glid"]=$gen_glid_penerimaan;		$detailP['cuid'] = get_userid();		$detailP['cdate'] = date('Y-m-d');		foreach($glid as $row){						if ($row['id_glid'] == true){				$detailP["kredit"]=$row['jumlah'];				$detailP["akunid"]=$row['akunid'];				$detailP["ket_transaksi"]=$row['ket_transaksi'];								$detailJ["KREDIT"]=$row['jumlah'];				$detailJ["AKUNID"]=$row['akunid'];				$detailJ["glid"]=$row['id_glid'];				$detailJ["KETERANGAN"]=$row['ket_transaksi'];				$detailJ['CUID'] = get_userid();				$detailJ['CDATE'] = date('Y-m-d');				$i=$i+1;				$this->penerimaan_kas->insert_detailJ($detailJ);				$this->penerimaan_kas->insert_detail_penerimaan($detailP);			}		}			redirect('penerimaan_kas');	}
}