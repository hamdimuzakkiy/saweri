<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class harga_beli extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_harga_beli', 'harga_beli');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		

		$config['base_url'] = base_url().'index.php/harga_beli/index/';
		$config['total_rows'] = $this->db->count_all('harga');
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

		

		$data['results'] = $this->harga_beli->getItem($config['per_page'], $this->uri->segment(3));
		

		$this->load->view('harga_beli/harga_beli_list', $data);
		
		$this->close();
	}
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();

		$data['id_harga'] = $this->input->post('id_harga');
		$data['id_barang'] = $this->input->post('id_barang');
		/*$data['id_supplier'] = $this->input->post('id_supplier'); */
		$data['periode_start'] = $this->input->post('periode_start');
		$data['periode_end'] = $this->input->post('periode_end');
		$data['harga_beli'] = $this->input->post('harga_beli');
		
		
		$this->form_validation->set_rules('id_barang', 'Barang', 'required');
		/*$this->form_validation->set_rules('id_supplier', 'Supplier', 'required'); */
		$this->form_validation->set_rules('periode_start', 'Periode Start', 'required');
		$this->form_validation->set_rules('periode_end', 'Periode End', 'required');
		$this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		

		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi dengan angka tidak boleh karakter!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('harga_beli/harga_beli_add',$data);
			
		}else{	
			$this->harga_beli->insert($data);
			
			$this->session->set_flashdata('message', 'Data Harga Beli Berhasil disimpan.');
			redirect('harga_beli');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->harga_beli->getItemById($id);
		
		$data['id_harga'] = $id;
		$data['id_barang'] = $data['result']->row()->id_barang;
		/*$data['id_supplier'] = $data['result']->row()->id_supplier; */
		$data['periode_start'] = $data['result']->row()->periode_start;
		$data['periode_end'] = $data['result']->row()->periode_end;
		$data['harga_beli'] = $data['result']->row()->harga_beli;		
		
		$this->load->view('harga_beli/harga_beli_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		

		$data['id_harga'] = $this->input->post('id_harga');
		$data['id_barang'] = $this->input->post('id_barang');
		/*$data['id_supplier'] = $this->input->post('id_supplier'); */
		$data['periode_start'] = $this->input->post('periode_start');
		$data['periode_end'] = $this->input->post('periode_end');
		$data['harga_beli'] = $this->input->post('harga_beli');
		
		

		$this->form_validation->set_rules('id_barang', 'Barang', 'required');
		/*$this->form_validation->set_rules('id_supplier', 'Supplier', 'required'); */
		$this->form_validation->set_rules('periode_start', 'Periode Start', 'required');
		$this->form_validation->set_rules('periode_end', 'Periode End', 'required');
		$this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
		
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		

		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi dengan angka tidak boleh karakter!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('harga_beli/harga_beli_edit',$data);
			
		}else{	
			$this->harga_beli->update($data['id_harga'], $data);
			
			$this->session->set_flashdata('message', 'Data Harga Beli Berhasil diupdate.');
			redirect('harga_beli');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->harga_beli->delete($id);
		$this->session->set_flashdata('message', 'Data Harga Beli Berhasil dihapus.');
		redirect('harga_beli');
	}
	
	
}