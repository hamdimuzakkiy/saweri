<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detail_pembelian extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_detail_pembelian', 'detail_pembelian');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/detail_pembelian/index/';
		$config['total_rows'] = $this->db->count_all('detail_pembelian');
		$config['per_page'] = '5';
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
		
		
		
		$data['results'] = $this->detail_pembelian->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('detail_pembelian/detail_pembelian_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_detail_pembelian'] = $this->input->post('id_detail_pembelian');
		$data['id_pembelian'] = $this->input->post('id_pembelian');
		$data['id_barang'] = $this->input->post('id_barang');
		$data['harga'] = $this->input->post('harga');
		$data['qty'] = $this->input->post('qty');
		$data['total'] = $this->input->post('total');
		
		
		
		$this->form_validation->set_rules('id_detail_pembelian', 'id_detail_pembelian', 'required');
		$this->form_validation->set_rules('id_pembelian', 'id_pembelian', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('total', 'total', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('detail_pembelian/detail_pembelian_add',$data);
			
		}else{	
			$this->detail_pembelian->insert($data);
			redirect('detail_pembelian');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->detail_pembelian->getItemById($id);
		
		$data['id_detail_pembelian'] = $data['result']->row()->id_detail_pembelian;
		$data['id_pembelian'] = $data['result']->row()->id_pembelian;
		$data['id_barang'] = $data['result']->row()->id_barang;
		$data['harga'] = $data['result']->row()->harga;
		$data['qty'] = $data['result']->row()->qty;
		$data['total'] = $data['result']->row()->total;
		
		
		$this->load->view('detail_pembelian/detail_pembelian_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_detail_pembelian'] = $this->input->post('id_detail_pembelian');
		$data['id_pembelian'] = $this->input->post('id_pembelian');
		$data['id_barang'] = $this->input->post('id_barang');
		$data['harga'] = $this->input->post('harga');
		$data['qty'] = $this->input->post('qty');
		$data['total'] = $this->input->post('total');
		
		
		
		$this->form_validation->set_rules('id_detail_pembelian', 'id_detail_pembelian', 'required');
		$this->form_validation->set_rules('id_pembelian', 'id_pembelian', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('total', 'total', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('detail_pembelian/detail_pembelian_edit',$data);
			
		}else{	
			$this->detail_pembelian->update($data['id_detail_pembelian'], $data);
			redirect('detail_pembelian');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->detail_pembelian->delete($id);
		redirect('detail_pembelian');
	}
	
}