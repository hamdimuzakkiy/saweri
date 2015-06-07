<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends My_Controller
{
	
	function __construct()	{		
		parent::__construct();				
		$this->load->model('mdl_setting_view', 'setting_view');			
		}
	
	function index()
	{
		$this->open();
		$id="1";
		$data['result'] 	= $this->setting_view->getItemById($id);				
		$data['id'] 		= $id;		
		$data['name'] 		= $data['result']->row()->name;		
		$data['detail'] 	= $data['result']->row()->detail;		
		$data['judul'] 		= $data['result']->row()->judul;		
		$data['gambar1'] 	= $data['result']->row()->name_gambar1 ;		
		$data['gambar2'] 	= $data['result']->row()->name_gambar2 ;		
		$data['header1'] 	= $data['result']->row()->name_header1 ;		
		$data['header2'] 	= $data['result']->row()->name_header2 ;	
		$config['base_url'] = base_url().'index.php/dashboard/index/';
		
		$this->pagination->initialize($config);	
		$this->load->view('dashboard/dashboard', $data);				
		$this->close();
	}
	
}