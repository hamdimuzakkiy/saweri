<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class privilege extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_privilege', 'privilege');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/privilege/index/';
		$config['total_rows'] = $this->db->count_all('privilege');
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
		
		
		
		$data['results'] = $this->privilege->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('privilege/privilege_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_privilege'] = $this->input->post('id_privilege');
		$data['privilege'] = $this->input->post('privilege');
		$data['deskripsi'] = $this->input->post('deskripsi');
		
		
		
		$this->form_validation->set_rules('id_privilege', 'id_privilege', 'required');
		$this->form_validation->set_rules('privilege', 'privilege', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('privilege/privilege_add',$data);
			
		}else{	
			$this->privilege->insert($data);
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('privilege');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->privilege->getItemById($id);
		
		$data['id_privilege'] = $data['result']->row()->id_privilege;
		$data['privilege'] = $data['result']->row()->privilege;
		$data['deskripsi'] = $data['result']->row()->deskripsi;
		
		
		$this->load->view('privilege/privilege_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_privilege'] = $this->input->post('id_privilege');
		$data['privilege'] = $this->input->post('privilege');
		$data['deskripsi'] = $this->input->post('deskripsi');
		
		
		
		$this->form_validation->set_rules('id_privilege', 'id_privilege', 'required');
		$this->form_validation->set_rules('privilege', 'privilege', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('privilege/privilege_edit',$data);
			
		}else{	
			$this->privilege->update($data['id_privilege'], $data);
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('privilege');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->privilege->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('privilege');
	}
	
}