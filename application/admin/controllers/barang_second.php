<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class barang_second extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_barang', 'barang');
		$this->load->model('mdl_pembelian', 'pembelian');
		$this->load->model('mdl_detail_pembelian','detail_pembelian');		
	}

	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
	}

}