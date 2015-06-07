<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users_level extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_users_level', 'users_level');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/users_level/index/';
		$config['total_rows'] = $this->db->count_all('users_level');
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
		
		
		
		$data['results'] = $this->users_level->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('users_level/users_level_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['level_id'] = $this->input->post('level_id');
		$data['nama'] = $this->input->post('nama');
		
		
		$this->form_validation->set_rules('level_id', 'level_id', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field Harus Diisi!');
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('users_level/users_level_add',$data);
			
		}else{	
			
			$fields = $this->db->field_data('users_level');
			foreach($fields as $field){
				if (($field->name != 'level_id') && ($field->name != 'nama'))
				{
					$level = $this->input->post('level');
					$data[$field->name] = '';
					
					/* akses */
					if($level[$field->name][0]){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* view */
					if($level[$field->name][1]){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* insert */
					if($level[$field->name][2]){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* update */
					if($level[$field->name][3]){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* delete */
					if($level[$field->name][4]){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
				}
			}
			
			$this->users_level->insert($data);
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('users_level');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] = $this->users_level->getItemById($id);
		
		$data['level_id'] = $data['result']->row()->level_id;
		$data['nama'] = $data['result']->row()->nama;

		$this->load->view('users_level/users_level_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['level_id'] = $this->input->post('level_id');
		$data['nama'] = $this->input->post('nama');
		
		
		$this->form_validation->set_rules('level_id', 'level_id', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field Harus Diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('users_level/users_level_edit',$data);
			
		}else{	
			
			$fields = $this->db->field_data('users_level');
			foreach($fields as $field){
				if (($field->name != 'level_id') && ($field->name != 'nama'))
				{
					$level = $this->input->post('level');
					$data[$field->name] = '';
					

								
					print $field->name.'<br>';

					/* akses */					
					if(isset($level[$field->name][0]) ){		
						$data[$field->name] = $data[$field->name].'1';
					}					
					else{						
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* view */
					if(isset($level[$field->name][1])  ){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/*insert */
					if(isset($level[$field->name][2])  ){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* update */
					if(isset($level[$field->name][3])  ){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					
					/* delete */
					if(isset($level[$field->name][4])  ){
						$data[$field->name] = $data[$field->name].'1';
					}else{
						$data[$field->name] = $data[$field->name].'0';
					}
					print $field->name.'<br>';	
				}
			}
			
			$this->users_level->update($data['level_id'], $data);
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('users_level');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->users_level->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('users_level');
	}
	
}