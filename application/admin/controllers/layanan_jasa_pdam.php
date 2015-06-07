<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class layanan_jasa_pdam extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_layanan_jasa_pdam', 'layanan_jasa');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.phplayanan_jasa/index/';
		$config['total_rows'] = $this->db->count_all('layanan_jasa');
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
		
		
		
		$data['results'] = $this->layanan_jasa->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('layanan_jasa_pdam/layanan_jasa_pdam_list', $data);
		
		$this->close();
	}
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_layanan_jasa'] = $this->input->post('id_layanan_jasa');
		$data['jenis_layanan'] = '3';
		$data['periode_start'] = $this->input->post('periode_start');
		$data['periode_end'] = $this->input->post('periode_end');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['no_pelanggan'] = $this->input->post('no_pelanggan');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['tagihan'] = $this->input->post('tagihan');
		$data['biaya_admin'] = $this->input->post('biaya_admin');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['status'] = $this->input->post('status');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('periode_start', 'Periode End', 'required');
		$this->form_validation->set_rules('periode_end', 'Periode End', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('no_pelanggan', 'No Pelanggan', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('tagihan', 'Tagihan', 'required|numeric');
		$this->form_validation->set_rules('biaya_admin', 'Biaya_admin', 'required|numeric');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('layanan_jasa_pdam/layanan_jasa_pdam_add',$data);
			
		}else{	
			$this->layanan_jasa->insert($data);
			$this->session->set_flashdata('message', 'Data Layanan Pihak ke-3 Berhasil disimpan.');
			redirect('layanan_jasa_pdam');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->layanan_jasa->getItemById($id);
		
		$data['id_layanan_jasa'] = $id;
		$data['jenis_layanan'] = $data['result']->row()->jenis_layanan;
		$data['periode_start'] = $data['result']->row()->periode_start;
		$data['periode_end'] = $data['result']->row()->periode_end;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['no_pelanggan'] = $data['result']->row()->no_pelanggan;
		$data['nama'] = $data['result']->row()->nama;
		$data['alamat'] = $data['result']->row()->alamat;
		$data['tagihan'] = $data['result']->row()->tagihan;
		$data['biaya_admin'] = $data['result']->row()->biaya_admin;
		$data['total_bayar'] = $data['result']->row()->total_bayar;
		$data['status'] = $data['result']->row()->status;
		
		
		$this->load->view('layanan_jasa_pdam/layanan_jasa_pdam_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_layanan_jasa'] = $this->input->post('id_layanan_jasa');
		$data['jenis_layanan'] = '3';
		$data['periode_start'] = $this->input->post('periode_start');
		$data['periode_end'] = $this->input->post('periode_end');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['no_pelanggan'] = $this->input->post('no_pelanggan');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['tagihan'] = $this->input->post('tagihan');
		$data['biaya_admin'] = $this->input->post('biaya_admin');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['status'] = $this->input->post('status');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('periode_start', 'Periode End', 'required');
		$this->form_validation->set_rules('periode_end', 'Periode End', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('no_pelanggan', 'No Pelanggan', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('tagihan', 'Tagihan', 'required|numeric');
		$this->form_validation->set_rules('biaya_admin', 'Biaya_admin', 'required|numeric');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('layanan_jasa_pdam/layanan_jasa_pdam_edit',$data);
			
		}else{	
			$this->layanan_jasa->update($data['id_layanan_jasa'], $data);
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('layanan_jasa_pdam');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->layanan_jasa->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('layanan_jasa_pdam');
	}
	
}