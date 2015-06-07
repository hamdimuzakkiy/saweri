<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_kas extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();				
		$this->load->model('mdl_master_kas', 'master_kas');
	}

	function index()
	{
		if ($this->can_view() == FALSE){
			redirect('auth/failed');
		}
		
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/master_kas/index/';
		$config['total_rows'] = $this->db->count_all('kas');
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
		
		
				
		$data['results'] = $this->master_kas->getItem($config['per_page'], $this->uri->segment(3));
		/*$data['sebagai'] = $sebagai; */
		 
		
		
		$this->load->view('master_kas/master_kas_list', $data);
		
		$this->close();
	}

	function insert()
	{
		if ($this->can_update() == FALSE){			
			redirect('auth/failed');		
		}

		$this->open();				
		$data['kode'] = $this->input->post('kode');		
		$data['nama'] = $this->input->post('nama');		
		$data['saldo'] = $this->input->post('saldo');

		$this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		if ($this->form_validation->run() == FALSE){						
				$this->load->view('master_kas/master_kas_add',$data);					
		}else{			
			$ceks = $this->master_kas->getItemById($data['kode']);
			//print sizeof($ceks->result());
			if (sizeof($ceks->result())!=0)
			{
				$this->session->set_flashdata('message', 'Kode Kas Tidak Boleh Sama.');
				$this->load->view('master_kas/master_kas_add',$data);
				
			}
			else
			{
				$this->master_kas->insert($data);
				$this->session->set_flashdata('message', 'Data Penerimaan Kas Berhasil disimpan.');			
				redirect('master_kas');						
			} 
			
		}
	}

	function update($id)
	{	
		if ($this->can_update() == FALSE){			
			redirect('auth/failed');		
		}

		$this->open();				
		$data['result'] = $this->master_kas->getItemById($id);
		$data['kode'] = $data['result']->row()->kode;
		$data['nama'] = $data['result']->row()->nama;
		$data['saldo'] = $data['result']->row()->saldo;
		$this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('saldo', 'saldo', 'required');
		$this->load->view('master_kas/master_kas_edit', $data);
		$this->close();
	}

	function process_update()
	{
		if ($this->can_update() == FALSE){			
		redirect('auth/failed');		
		}				
		$this->open();				
		$data['kode'] = $this->input->post('kode');
		$data['nama'] = $this->input->post('nama');		
		$data['saldo'] = $this->input->post('saldo');	

		$this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('saldo', 'saldo', 'required');

		$this->form_validation->set_message('required', 'Field %s harus diisi!');

		if ($this->form_validation->run() == FALSE){						
		$this->load->view('master_kas/master_kas_edit',$data);					
		}else{
			$this->master_kas->update($data['kode'], $data);
			$this->session->set_flashdata('message', 'Data Master Pulsa Berhasil diupdate.');			
			redirect('master_kas');		
		}
	}

	function delete($id)
	{
		if ($this->can_delete() == FALSE)
		{
			redirect('auth/failed');
		}
		
		$this->master_kas->delete($id);
		$this->session->set_flashdata('message', 'Data master pulsa berhasil dihapus.');
		redirect('master_kas');
	}
}