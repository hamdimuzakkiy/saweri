<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_users', 'users');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/users/index/';
		$config['total_rows'] = $this->db->count_all('users');
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
		
		
		
		$data['results'] = $this->users->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('users/users_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['nama'] = $this->input->post('nama');
		$data['level_id'] = $this->input->post('level_id');
		$data['id_cabang'] = $this->input->post('id_cabang');
		
		
		
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('level_id', 'level_id', 'required');
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field Harus Diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('users/users_add',$data);
			
		}else{	
			$data['password'] = md5($this->input->post('password'));
			$this->users->insert($data);
			$this->session->set_flashdata('message', 'Data user Berhasil disimpan.');
			redirect('users');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->users->getItemById($id);
		
		$data['userid'] = $data['result']->row()->userid;
		$data['username'] = $data['result']->row()->username;
		$data['password'] = $data['result']->row()->password;
		$data['nama'] = $data['result']->row()->nama;
		$data['level_id'] = $data['result']->row()->level_id;
		$data['id_cabang'] = $data['result']->row()->id_cabang;
		
		
		$this->load->view('users/users_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['userid'] = get_userid();
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['nama'] = $this->input->post('nama');
		$data['level_id'] = $this->input->post('level_id');
		$data['id_cabang'] = $this->input->post('id_cabang');
		
		
		
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('level_id', 'level_id', 'required');
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field Harus Diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('users/users_edit',$data);
			
		}else{	
			$this->users->update($data['userid'], $data);
			$this->session->set_flashdata('message', 'Data user Berhasil diupdate.');
			redirect('users');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->users->delete($id);
		$this->session->set_flashdata('message', 'Data user Berhasil dihapus.');
		redirect('users');
	}
	
}