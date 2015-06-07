<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_coa', 'coa');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/coa/index/';
		$config['total_rows'] = $this->db->count_all('coa');
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
		
		
		
		$data['results'] = $this->coa->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('coa/coa_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_coa'] = $this->input->post('id_coa');
		$data['kode_coa'] = $this->input->post('kode_coa');
		$data['deskripsi'] = $this->input->post('deskripsi');
		
		
		
		$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
		$this->form_validation->set_rules('kode_coa', 'kode_coa', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('coa/coa_add',$data);
			
		}else{	
			$this->coa->insert($data);
			redirect('coa');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->coa->getItemById($id);
		
		$data['id_coa'] = $data['result']->row()->id_coa;
		$data['kode_coa'] = $data['result']->row()->kode_coa;
		$data['deskripsi'] = $data['result']->row()->deskripsi;
		
		
		$this->load->view('coa/coa_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_coa'] = $this->input->post('id_coa');
		$data['kode_coa'] = $this->input->post('kode_coa');
		$data['deskripsi'] = $this->input->post('deskripsi');
		
		
		
		$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
		$this->form_validation->set_rules('kode_coa', 'kode_coa', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('coa/coa_edit',$data);
			
		}else{	
			$this->coa->update($data['id_coa'], $data);
			redirect('coa');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->coa->delete($id);
		redirect('coa');
	}
	
}