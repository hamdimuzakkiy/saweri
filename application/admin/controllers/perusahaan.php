<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class perusahaan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_karyawan', 'karyawan');
		$this->load->model('mdl_users', 'users');
                $this->load->model('mdl_cabang', 'cabang');
		$this->load->library('pdf');
		//$this->load->library('fungsi');
		
	}
        
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
                //$this->getIDCabang();
		$config['base_url'] = base_url().'index.php/karyawan/index/';
		$config['total_rows'] = $this->karyawan->countallItem('perusahaan');
		$config['per_page'] = '10';
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
		$data['results'] = $this->karyawan->getItem($config['per_page'], $this->uri->segment(3));
		$this->load->view('perusahaan/perusahaan_list', $data);
		$this->close();
	}
}
