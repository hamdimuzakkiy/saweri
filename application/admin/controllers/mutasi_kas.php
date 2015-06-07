<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mutasi_kas extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_inventory', 'inventory');		
		$this->load->model('mdl_mutasi_kas', 'mutasi_kas');		
		$this->load->library(array('fungsi','pquery'));
		
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
		
		/*config pagination */
		$config['base_url'] = base_url().'index.php/mutasi_kas/index/';
		$config['total_rows'] = $this->db->count_all('mutasi_kas');
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
		/*end config pagination */
		
		/*get data		*/
		$data['results'] = $this->mutasi_kas->getItem($config['per_page'], $this->uri->segment(3));
		/*$data['sebagai'] = $sebagai; */
		
		
		/*load view */
		$this->load->view('mutasi_kas/mutasi_kas_list', $data);
		
		$this->close();
	}		


	function insert()	{		
		/*		if ($this->can_insert() == FALSE){		
		redirect('auth/failed');		}	
		*/
		$this->open();	

		$kd_kas_debet = $this->input->post('kd_kas');	
		$jumlah_debet = $this->input->post('jumlah_debet');	

		$this->form_validation->set_rules('jumlah_debet', 'jumlah_debet', 'required');
		$this->form_validation->set_rules("kd_kas", "kode kas", 'required');	
		/*		*/
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');	
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');	
		if ($this->form_validation->run() == FALSE){			
			/*$data['results']=$this->mutasi_kas->get_total_tiap_akun();	*/

		
		$this->load->view('mutasi_kas/mutasi_kas_add');				
		}
		else
		{
			$detail= $this->input->post('detail');		
			$gen_glid=$this->mutasi_kas->get_glid();		
			$count_detail = count($detail);			
			$i=0;		
			$jml=0;			
			for($j=0; $j<$count_detail; $j++){		
			$jml		= $jml +  $detail[$j]['jumlah'];				
		}							if ($jml<=$jumlah_debet){		
			$data_origin['cuid'] = get_userid();					
			$data_origin['cdate'] = date('Y-m-d');					
			$data_origin['glid'] =$this->mutasi_kas->get_glid();		
			$data_origin['akunid'] = $kd_kas_debet;								
			$data_origin['debet'] = $jml;					
			$data_origin['tanggal']  = date('Y-m-d');					
			$this->mutasi_kas->insert_detail($data_origin);												
			$data_origin_J['GLID']= $this->mutasi_kas->get_glid_jurnal(); 
			/*$this->fungsi->gen_glid_counter('/',$gen_glid,$i);*/
			$data_origin_J['CUID'] = get_userid();						
			$data_origin_J['CDATE'] = date('Y-m-d');						
			/*$data_origin['glid'] =$this->mutasi_kas->get_glid();*/			
			$data_origin_J['AKUNID'] = $kd_kas_debet;											
			$data_origin_J['DEBET'] = $jml;						
			$this->mutasi_kas->insert_detail_J($data_origin_J);												
			$data_['cuid'] = get_userid();												
			$data_['cdate'] = date('Y-m-d');						
			$data_['glid'] =$this->mutasi_kas->get_glid();												
			$data_J['CUID'] = get_userid();												
			$data_J['CDATE'] = date('Y-m-d');						
			$data_J['GLID'] =$this->mutasi_kas->get_glid_jurnal(); 
			/*$this->fungsi->gen_glid_counter('/',$gen_glid,$i);*/										
			$data_detail_J['CUID'] = get_userid();												
			$data_detail_J['CDATE'] = date('Y-m-d');						
			$data_detail_J['GLID'] =$this->mutasi_kas->get_glid_jurnal();						
			$total_penjumlahan = 0;						
			$data_['tanggal']  = date('Y-m-d');						
			for($i=0; $i<$count_detail; $i++)												
			{							
				$data_['akunid'] 		= $detail[$i]['akunid'];							
				$data_['kredit'] 		= $detail[$i]['jumlah'];														
				$data_detail_J['akunid'] 		= $detail[$i]['akunid'];							
				$data_detail_J['kredit'] 		= $detail[$i]['jumlah'];							
				$total_penjumlahan		= $total_penjumlahan + $detail[$i]['jumlah'];														
				/*$total_penjumlahan = 2;*/					
				$this->mutasi_kas->insert_detail($data_);							
				$this->mutasi_kas->insert_detail_J($data_detail_J);						
			}																					
			$this->db->flush_cache();							
			$data['cuid'] = get_userid();							
			$data['cdate'] = date('Y-m-d');							
			$data['tanggal'] = date('Y-m-d');							
			$data['glid']=$data_['glid'];							
			$data['jumlah']=$total_penjumlahan;														
			$data_J['CUID'] = get_userid();							
			$data_J['CDATE'] = date('Y-m-d');							
			$data_J['TANGGAL'] = date('Y-m-d');							
			$data_J['GLID_PARENT']=$data_['glid'];							
			$data_J['GLID']=$this->mutasi_kas->get_glid_jurnal(); 
			/*$this->fungsi->gen_glid_counter('/',$gen_glid,$i);;*/																
			$this->mutasi_kas->insert($data);						
			$this->mutasi_kas->insert_J($data_J);												
			$this->session->set_flashdata('message', 'Data Mutasi Kas Berhasil Disimpan.');						
			redirect('mutasi_kas/index');				
		}else{					
			$this->session->set_flashdata('message', 'Kas tidak mencukupi');					
			$this->load->view('mutasi_kas/mutasi_kas_add');				
		}					
	}				$this->close();	}		function get_form_data(){				
		$data['txtBookName'] = $this->input->post('txtBookName');		
		$data['authorName'] = $this->input->post('authorName');		
		echo $data['txtBookName'].'<br/><br/>';		$i=0;		
		foreach ($data['authorName'] as $rows_author){			
			echo $i . '-' .$rows_author . '<br/>';			$i++;		
		}	
	}


	function show_akun(){		
		$data['result'] = $this->mutasi_kas->get_master_akun();		
		$this->load->view('mutasi_kas/list_akun.php', $data);	
	}		


	function get_kas(){			
		$akunid=$this->uri->segment(3); 		
		$data_kas = $this->mutasi_kas->get_total_tiap_akun($akunid,false);		
		$data_kas_count = $this->mutasi_kas->get_total_tiap_akun($akunid,true);				
		if ($data_kas_count!=0){			
			$rows=$data_kas->row();			
			echo $data['data_jml_kas']=$rows->total_kas;		
		}else{			
			echo $data['data_jml_kas'] = 0;		
		}	
	}
	
}