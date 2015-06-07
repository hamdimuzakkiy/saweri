<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detail_penjualan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_detail_penjualan', 'detail_penjualan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/detail_penjualan/index/';
		$config['total_rows'] = $this->db->count_all('detail_penjualan');
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
		
		
		
		$data['results'] = $this->detail_penjualan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('detail_penjualan/detail_penjualan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_detail_penjualan'] = $this->input->post('id_detail_penjualan');
		$data['id_penjualan'] = $this->input->post('id_penjualan');
		$data['id_barang'] = $this->input->post('id_barang');
		$data['harga'] = $this->input->post('harga');
		$data['qty'] = $this->input->post('qty');
		$data['total'] = $this->input->post('total');
		$data['id_karyawan'] = $this->input->post('id_karyawan');
		
		
		
		$this->form_validation->set_rules('id_detail_penjualan', 'id_detail_penjualan', 'required');
		$this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('total', 'total', 'required');
		$this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('detail_penjualan/detail_penjualan_add',$data);
			
		}else{	
			$this->detail_penjualan->insert($data);
			redirect('detail_penjualan');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->detail_penjualan->getItemById($id);
		
		$data['id_detail_penjualan'] = $data['result']->row()->id_detail_penjualan;
		$data['id_penjualan'] = $data['result']->row()->id_penjualan;
		$data['id_barang'] = $data['result']->row()->id_barang;
		$data['harga'] = $data['result']->row()->harga;
		$data['qty'] = $data['result']->row()->qty;
		$data['total'] = $data['result']->row()->total;
		$data['id_karyawan'] = $data['result']->row()->id_karyawan;
		
		
		$this->load->view('detail_penjualan/detail_penjualan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_detail_penjualan'] = $this->input->post('id_detail_penjualan');
		$data['id_penjualan'] = $this->input->post('id_penjualan');
		$data['id_barang'] = $this->input->post('id_barang');
		$data['harga'] = $this->input->post('harga');
		$data['qty'] = $this->input->post('qty');
		$data['total'] = $this->input->post('total');
		$data['id_karyawan'] = $this->input->post('id_karyawan');
		
		
		
		$this->form_validation->set_rules('id_detail_penjualan', 'id_detail_penjualan', 'required');
		$this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('harga', 'harga', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('total', 'total', 'required');
		$this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('detail_penjualan/detail_penjualan_edit',$data);
			
		}else{	
			$this->detail_penjualan->update($data['id_detail_penjualan'], $data);
			redirect('detail_penjualan');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->detail_penjualan->delete($id);
		redirect('detail_penjualan');
	}
	
}