<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_akun extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_master_akun', 'master_akun');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/master_akun/index/';
		$config['total_rows'] = $this->master_akun->getallItem('master_akun');
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

	
		$data['results'] = $this->master_akun->getItem($config['per_page'], $this->uri->segment(3));
		
		$this->load->view('master_akun/master_akun_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
	
		$data['AKUNID'] = $this->input->post('kode_akun');
		$data['NAKUN'] = $this->input->post('nama_akun');
		
	
		$this->form_validation->set_rules('kode_akun', 'Kode Akun', 'required|numeric');
		$this->form_validation->set_rules('nama_akun', 'Nama Akun', 'callback_cek_nama|required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('master_akun/master_akun_add',$data);
			
		}else{	
			$this->master_akun->insert($data);
			$this->session->set_flashdata('message', 'Data Akun Berhasil disimpan.');
			redirect('master_akun');
		}
		
		$this->close();
	}
	
	function cek_nama($str)
	{
		if($str == ''){
			$this->form_validation->set_message('cek_nama', 'Field %s tidak boleh kosong.');
			return FAlSE;
		}
		
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->where('nama_cabang', $str);
		$q = $this->db->get('cabang');
		
		if($q->num_rows() > 0){
			$this->form_validation->set_message('cek_nama', 'Nama "'. $str . '" sudah terdaftar, coba masukan nama yang lain.');
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
			
		$this->open();
		
		$data['result'] 		= $this->master_akun->getItemById($id);
		
		$data['AKUNID'] = $id;
		$data['AKUNID'] = $data['result']->row()->AKUNID;		$data['NAKUN'] = $data['result']->row()->NAKUN;		/*
		$data['alamat'] = $data['result']->row()->alamat;
		$data['telepon'] = $data['result']->row()->telepon;
		$data['max_piutang'] = $data['result']->row()->max_piutang;
		$data['saldo_piutang'] = $data['result']->row()->saldo_piutang;		*/
		
		
		
		$this->load->view('master_akun/master_akun_edit', $data);
		
		$this->close();
	}
	
	function process_update()	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');		
		}				
		$this->open();				$data['AKUNID'] = $this->input->post('AKUNID');		
		$data['NAKUN'] = $this->input->post('NAKUN');				
		$this->form_validation->set_rules('AKUNID', 'Kode Akun', 'required|numeric');		
		$this->form_validation->set_rules('NAKUN', 'Nama Akun', 'required');
		/*		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');		
		$this->form_validation->set_rules('telepon', 'telepon', 'trim|numeric');		
		$this->form_validation->set_rules('max_piutang', 'max_piutang', 'trim|numeric');		
		$this->form_validation->set_rules('saldo_piutang', 'saldo_piutang', 'trim|numeric');*/						
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
		$this->form_validation->set_message('required', 'Field %s harus diisi!');		
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						
		if ($this->form_validation->run() == FALSE){						
		$this->load->view('master_akun/master_akun_edit',$data);					
		}else{				$this->master_akun->update($data['AKUNID'], $data);			
		$this->session->set_flashdata('message', 'Data Akun Berhasil diupdate.');			
		redirect('master_akun');		}				
		$this->close();			}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->master_akun->delete($id);
		$this->session->set_flashdata('message', 'Data Akun Berhasil dihapus.');
		redirect('master_akun');
	}
	
}