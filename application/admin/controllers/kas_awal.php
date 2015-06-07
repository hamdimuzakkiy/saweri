<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kas_awal extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();		$this->load->model('mdl_kas_awal', 'kas_awal');		$this->load->library(array('fungsi','pquery'));
		
	}
	
	function index($sebagai='')
	{
		if ($this->can_view() == FALSE){
			redirect('auth/failed');
		}
		
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/kas_awal/index/';
		$config['total_rows'] = $this->kas_awal->count_getItem();
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
		
		
		$data['results'] = $this->kas_awal->getItem($config['per_page'], $this->uri->segment(3));		
		$kas_awal = $this->kas_awal->getItem($config['per_page'], $this->uri->segment(3));		$data['sum_kas']=$this->kas_awal->get_sum_kas();
		/*$data['sebagai'] = $sebagai;		 */
		foreach($kas_awal->result() as $rows_posting){										
		$data['AKUNID'][]	= $rows_posting->AKUNID;					
		$data['NAKUN'][]	= $rows_posting->NAKUN;			
		}
		
		$this->load->view('kas_awal/kas_awal_list', $data);
		
		$this->close();
	}		function insert()	{				$this->open();				
	$VAR_AKUN=$this->input->post('VAR_AKUN');				
	$tanggal_kas_awal=$this->input->post('tanggal_kas_awal');		
	$tahun_kas_awal=$this->input->post('tahun_kas_awal');		
	$tgl_kas_awal =  $tahun_kas_awal . '-01-01' ;		
	$gen_glid=$this->kas_awal->get_glid();						
	$data_J['GLID']	= $gen_glid;				
	$data_J['TANGGAL'] = $tgl_kas_awal;				$data_J['CDATE']=date('Y-m-d');				
	$data_J['CUID'] = get_userid();				$data_J['KAS_AWAL'] = 1;				
	$this->kas_awal->insert($data_J);		$i=0;		foreach($VAR_AKUN as $row){						
	if ($row['AKUNID'] == true){				
	$data_detailJ['AKUNID'] = $row['AKUNID'];				$data_detailJ['DEBET'] = $row['NOMINAL'];				
	$data_detailJ['GLID']	= $gen_glid;				$data_detailJ['CDATE']=date('Y-m-d');				
	$data_detailJ['CUID'] = get_userid();												
	$i=$i+1;								$this->kas_awal->insert_detailJ($data_detailJ);			}		}				
	$this->close();		redirect('kas_awal');	}		
	/*menampilkan list barang pada fancyBox	 */
	function show_kas()	{		
	$data['sum_kas']=$this->kas_awal->get_sum_kas();		
	$this->load->view('kas_awal/list_kas.php', $data);	}
}