<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class golongan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_golongan', 'golongan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/golongan/index/';
		$config['total_rows'] = $this->golongan->getallItem('golongan');
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
		
		
		
		$data['results'] = $this->golongan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('golongan/golongan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_golongan'] = $this->input->post('id_golongan');
		$data['golongan'] = $this->input->post('golongan');		
		$data['jenis'] = $this->input->post('jenis');
		
		$this->form_validation->set_rules('golongan', 'golongan', 'callback_cek_nama|required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('golongan/golongan_add',$data);
			
		}else{	
			$this->golongan->insert($data);
			
			$this->session->set_flashdata('message', 'Data Golongan Berhasil disimpan.');
			redirect('golongan');
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
		$this->db->where('golongan', $str);
		$q = $this->db->get('golongan');
		
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
		
		$data['result'] = $this->golongan->getItemById($id);
		$data['id_golongan'] = $id;
		$data['golongan'] = $data['result']->row()->golongan;
		$data['jenis'] = $data['result']->row()->jenis;
		
		$this->load->view('golongan/golongan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_golongan'] = $this->input->post('id_golongan');
		$data['golongan'] = $this->input->post('golongan');	
		$data['jenis'] = $this->input->post('jenis');	
		
		$this->form_validation->set_rules('golongan', 'golongan', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('golongan/golongan_edit',$data);
			
		}else{	
			$this->golongan->update($data['id_golongan'], $data);
			
			$this->session->set_flashdata('message', 'Data Golongan Barang Berhasil diupdate.');
			redirect('golongan');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->golongan->delete($id);
		$this->session->set_flashdata('message', 'Data Golongan Barang Berhasil dihapus.');
		redirect('golongan');
	}
	
}