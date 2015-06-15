<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class setting_kode_trans extends My_Controller{
	function __construct()	{
		parent::__construct();
		$this->load->model('mdl_kode_trans', 'setting_kode_trans');
		}
	function index()	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		$this->open();
		$config['base_url'] = base_url().'index.php/setting_kode_trans/index/';
		$config['total_rows'] = $this->db->count_all('setting_kode_trans');
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
		$data['results'] = $this->setting_kode_trans->getItem($config['per_page'], $this->uri->segment(3));
		$this->load->view('setting_kode_trans/setting_kode_trans_list', $data);
		$this->close();	
	}
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		$data['kd_trans'] = strtoupper($this->input->post('kd_trans'));
		$data['transaksi'] = strtoupper($this->input->post('transaksi'));		
		
		$this->form_validation->set_rules('kd_trans', 'kd_trans', 'required');
		$this->form_validation->set_rules('transaksi', 'transaksi', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('setting_kode_trans/setting_kode_trans_add',$data);
			
		}else{	
			$this->setting_kode_trans->insert($data);
			
			$this->session->set_flashdata('message', 'Data kode transaksi Berhasil disimpan.');
			redirect('setting_kode_trans');
		}
		$this->close();
	}

	function update($id)
	{
		if ($this->can_update() == FALSE)
		{
			redirect('auth/failed');
		}
		$this->open();
		$data['result'] = $this->setting_kode_trans->getItemById($id);
		$data['id'] = $data['result']->row()->id;
		$data['kd_trans'] = $data['result']->row()->kd_trans;
		$data['transaksi'] = $data['result']->row()->transaksi;
		$this->load->view('setting_kode_trans/setting_kode_trans_edit', $data);
		$this->close();	
	}

	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
		$data['id'] = strtoupper($this->input->post('id'));
		$data['kd_trans'] = strtoupper($this->input->post('kd_trans'));
		$data['transaksi'] = strtoupper($this->input->post('transaksi'));
		$this->form_validation->set_rules('id', 'id');
		$this->form_validation->set_rules('kd_trans', 'kd_trans', 'required');
		$this->form_validation->set_rules('transaksi', 'transaksi', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('setting_kode_trans/seting_kode_trans_edit',$data);
		}
		else
		{
			$this->setting_kode_trans->update($data['id'], $data);
			$this->session->set_flashdata('message', 'Kode Transaksi Berhasil diupdate.');
			redirect('setting_kode_trans');		
		}
		$this->close();
	}
	
	function delete($id){
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		$this->setting_kode_trans->delete($id);
		$this->session->set_flashdata('message', 'Data Kode Transaksi Berhasil dihapus.');
		redirect('setting_kode_trans');	
	}
}