<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class beban_transaksi extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_beban_transaksi', 'beban_transaksi');				
		$this->load->model('mdl_kode_trans', 'kode_trans');				
		$this->load->model('mdl_hutang', 'hutang');		
		$this->load->model('mdl_retur_pembelian', 'retur_pembelian');
		$this->load->library('fungsi');
		$this->load->library('pdf');	
	}
	
	function index()
	{

		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();

		$this->open();

		$config['base_url'] = base_url().'index.php/beban_transaksi/index/';
		$config['total_rows'] = sizeof($this->beban_transaksi->count()->result());

		

		$config['per_page'] = '50';
		$config['num_links'] = '10';
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
		
		$data['results'] = $this->beban_transaksi->getItem($config['per_page'], $this->uri->segment(3));
				
		$this->load->view('beban_transaksi/beban_transaksi_list', $data);
		
		$this->close();
	}

	function update($id)
	{
		
	}
}