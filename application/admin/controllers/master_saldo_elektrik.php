<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_saldo_elektrik extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
				$this->load->model('mdl_master_saldo_elektrik', 'master_saldo_elektrik');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/master_saldo_elektrik/index/';
		$config['total_rows'] = $this->master_saldo_elektrik->getallItem('master_saldo_elektrik');
		$config['per_page'] = '10';
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
		
		
		
		$data['results'] = $this->master_saldo_elektrik->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('master_saldo_elektrik/master_saldo_elektrik_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE)
		{
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_saldo'] = $this->input->post('id_saldo');		
		$data['nama_mastersaldo'] = $this->input->post('nama_mastersaldo');		
		$data['saldo'] = $this->input->post('saldo');
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('id_saldo');		
		$this->form_validation->set_rules('nama_mastersaldo', 'nama_mastersaldo', 'required');		
		$this->form_validation->set_rules('saldo', 'saldo', 'trim|numeric');						
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						
		$this->form_validation->set_message('required', 'Field %s harus diisi!');		
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		if ($this->form_validation->run() == FALSE){						
		$this->load->view('master_saldo_elektrik/master_saldo_elektrik_add',$data);					
		}
		else
		{				
			$this->master_saldo_elektrik->insert($data);						
			$this->session->set_flashdata('message', 'Data Master Saldo Berhasil disimpan.');			
			redirect('master_saldo_elektrik');		
		}
		
		$this->close();
	}
	
	function cek_nama($id)
	{
	
		
		$this->open();
		
		if($str == '')
			{			
				$this->form_validation->set_message('cek_nama', 'Field %s tidak boleh kosong.');			
				return FAlSE;		
			}				
			$this->db->flush_cache();		
			$this->db->select('*');		
			$this->db->where('nama_mastersaldo', $str);		
			$q = $this->db->get('master_saldo_elektrik');				
			if($q->num_rows() > 0)
				{			
					$this->form_validation->set_message('cek_nama', 'Nama "'. $str . '" sudah terdaftar, coba masukan nama yang lain.');			return FALSE;		}else{			return TRUE;		}
		
		$this->close();
	}

	function update($id)
	{		
		if ($this->can_update() == FALSE){			redirect('auth/failed');		
	}				
	$this->open();				
	$data['result'] = $this->master_saldo_elektrik->getItemById($id);				
	$data['id_saldo'] = $id;
	$data['nama_mastersaldo'] = $data['result']->row()->nama_mastersaldo;		
	$data['saldo'] = $data['result']->row()->saldo;						
	$this->load->view('master_saldo_elektrik/master_saldo_elektrik_edit', $data);				
	$this->close();	
	}		

	function process_update()
	{
		if ($this->can_update() == FALSE){			
			redirect('auth/failed');		
		}				
		$this->open();						
		$data['id_saldo'] = $this->input->post('id_saldo');		
		$data['nama_mastersaldo'] = $this->input->post('nama_mastersaldo');		
		$data['saldo'] = $this->input->post('saldo');										
		$this->form_validation->set_rules('nama_mastersaldo', 'nama_mastersaldo');		
		$this->form_validation->set_rules('id_saldo', 'id_saldo');		
		$this->form_validation->set_rules('saldo', 'saldo', 'trim|numeric');						
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						
		$this->form_validation->set_message('required', 'Field %s harus diisi!');		
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						
		if ($this->form_validation->run() == FALSE){						
		$this->load->view('master_saldo_elektrik/master_saldo_elektrik_edit',$data);					
		}else{				
		$this->master_saldo_elektrik->update($data['id_saldo'], $data);						
		$this->session->set_flashdata('message', 'Data Master Saldo Berhasil diupdate.');			
		redirect('master_saldo_elektrik');		
		}				
		$this->close();		
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){			redirect('auth/failed');		}				
		$this->master_saldo_elektrik->delete($id);		
		$this->session->set_flashdata('message', 'Data Master Saldo Berhasil dihapus.');		
		redirect('master_saldo_elektrik');
	}
	
}