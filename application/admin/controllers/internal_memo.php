<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class internal_memo extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_internal_memo', 'internal_memo');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/internal_memo/index/';
		$config['total_rows'] = $this->db->count_all('internal_memo');
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
		
		
		
		$data['results'] = $this->internal_memo->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('internal_memo/internal_memo_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		

		$data['tanggal'] = $this->input->post('tanggal') . ' ' . date('H:i:s');
		$data['memo'] = $this->input->post('memo');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('memo', 'memo', 'required');
			
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('alpha', 'Field %s harus diisi hanya dengan huruf!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('internal_memo/internal_memo_add',$data);
			
		}else{	
			$this->internal_memo->insert($data);
			$this->session->set_flashdata('message', 'Data internal_memo Berhasil disimpan.');
			redirect('internal_memo');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->internal_memo->getItemById($id);
		
		$data['id_internal_memo'] = $id;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['memo'] = $data['result']->row()->memo;
		$data['userid'] = $data['result']->row()->userid;
		
		
		$this->load->view('internal_memo/internal_memo_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
		
		$data['id_internal_memo'] = $this->input->post('id_internal_memo');				$data['tanggal'] = $this->input->post('tanggal');		$data['memo'] = $this->input->post('memo');
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		$this->form_validation->set_rules('memo', 'memo', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('alpha', 'Field %s harus diisi hanya dengan huruf!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('internal_memo/internal_memo_edit',$data);
		}else{
			$this->internal_memo->update($data['id_internal_memo'], $data);
			$this->session->set_flashdata('message', 'Data internal_memo Berhasil diupdate.');
			redirect('internal_memo');
		}
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->internal_memo->delete($id);
		$this->session->set_flashdata('message', 'Data internal_memo Berhasil dihapus.');
		redirect('internal_memo');
	}
	
}