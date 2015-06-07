<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_laporan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_setting_laporan', 'setting_laporan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/setting_laporan/index/';
		$config['total_rows'] = $this->db->count_all('setting_laporan');
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
		
		$data['results'] = $this->setting_laporan->getItem($config['per_page'], $this->uri->segment(3));

		$this->load->view('setting_laporan/setting_laporan_list', $data);
		
		$this->close();
	}
	
	

	
	
	function update($id)

	{

		if ($this->can_update() == FALSE){

			redirect('auth/failed');

		}
		$this->open();
		$data['result'] = $this->setting_laporan->getItemById($id);
		$data['id'] = $data['result']->row()->id;
		$data['footer_pembelian'] = $data['result']->row()->footer_pembelian;
		$data['footer_penjualan'] = $data['result']->row()->footer_penjualan;
		$data['footer_service'] = $data['result']->row()->footer_service;
		$data['footer_tukar_tambah'] = $data['result']->row()->footer_tukar_tambah;
		$this->load->view('setting_laporan/setting_laporan_edit', $data);
		$this->close();
	}
	
	function process_update()
	{

		if ($this->can_update() == FALSE){

			redirect('auth/failed');

		}
	

		$this->open();

		$data['id'] = $this->input->post('id');

		$data['footer_pembelian'] = $this->input->post('footer_pembelian');
		$data['footer_penjualan'] = $this->input->post('footer_penjualan');
		$data['footer_service'] = $this->input->post('footer_service');
		$data['footer_tukar_tambah'] = $this->input->post('footer_tukar_tambah');

		

		

		$this->form_validation->set_rules('id', 'id');

		/*$this->form_validation->set_rules('footer_pembelian', 'footer_pembelian', 'required');*/

		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		

		

		$this->form_validation->set_message('required', 'Field %s harus diisi!');

		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');

		
		
		

		if ($this->form_validation->run() == FALSE){

			

			$this->load->view('setting_laporan/setting_laporan_edit',$data);

			

		}else{	

			$this->setting_laporan->update($data['id'], $data);

			

			$this->session->set_flashdata('message', 'Setup Footer Laporan Berhasil diupdate.');

			redirect('setting_laporan');

		}

		

		$this->close();

		

	}
	
}