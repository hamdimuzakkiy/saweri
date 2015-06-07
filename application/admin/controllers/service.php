<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class service extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_service', 'service');	
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/service/index/';
		$config['total_rows'] = $this->db->count_all('service');
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
		
		
		
		$data['results'] = $this->service->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('service/service_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_service'] = $this->input->post('id_service');
		$data['nama_pelanggan'] = $this->input->post('nama_pelanggan');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['kerusakan'] = $this->input->post('kerusakan');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['status'] = $this->input->post('status');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		/*$this->form_validation->set_rules('kerusakan', 'Kerusakan', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required|numeric');
		$this->form_validation->set_rules('status', 'Status', 'required');*/
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('service/service_add',$data);
			
		}else{	
			$this->service->insert($data);
			$this->session->set_flashdata('message', 'Data Service Berhasil disimpan.');
			redirect('service');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->service->getItemById($id);
		
		$data['id_service'] = $id;
		$data['nama_pelanggan'] = $data['result']->row()->nama_pelanggan;
		$data['nama_barang'] = $data['result']->row()->nama_barang;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['kerusakan'] = $data['result']->row()->kerusakan;
		$data['total_bayar'] = $data['result']->row()->total_bayar;
		$data['status'] = $data['result']->row()->status;
		
		
		$this->load->view('service/service_edit', $data);
		
		$this->close();
	}
		
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_service'] = $this->input->post('id_service');
		$data['nama_pelanggan'] = $this->input->post('nama_pelanggan');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['kerusakan'] = $this->input->post('kerusakan');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['status'] = $this->input->post('status');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('kerusakan', 'Kerusakan', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required|numeric');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('service/service_edit',$data);
			
		}else{	
			$this->service->update($data['id_service'], $data);
			$this->session->set_flashdata('message', 'Data Service Berhasil diupdate.');
			redirect('service');
		}
		
		$this->close();
		
	}
	function bayar($id)	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}				$this->open();				$data['result'] 		= $this->service->getItemById($id);				$data['id_service'] = $id;		$data['nama_pelanggan'] = $data['result']->row()->nama_pelanggan;		$data['nama_barang'] = $data['result']->row()->nama_barang;		$data['tanggal'] = $data['result']->row()->tanggal;		$data['kerusakan'] = $data['result']->row()->kerusakan;		$data['total_bayar'] = $data['result']->row()->total_bayar;		$data['status'] = $data['result']->row()->status;						$this->load->view('service/service_bayar', $data);				$this->close();	}		function process_bayar()	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}				$this->open();						$data['id_service'] = $this->input->post('id_service');		$data['nama_pelanggan'] = $this->input->post('nama_pelanggan');		$data['nama_barang'] = $this->input->post('nama_barang');		$data['tanggal'] = $this->input->post('tanggal');		$data['kerusakan'] = $this->input->post('kerusakan');		$data['total_bayar'] = $this->input->post('total_bayar');		$data['status'] = $this->input->post('status');		$data['userid'] = get_userid();								$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');		$this->form_validation->set_rules('kerusakan', 'Kerusakan', 'required');		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required|numeric');		$this->form_validation->set_rules('status', 'Status', 'required');				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						$this->form_validation->set_message('required', 'Field %s harus diisi!');		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						if ($this->form_validation->run() == FALSE){						$this->load->view('service/service_bayar',$data);					}else{				$this->service->update($data['id_service'], $data);			$this->session->set_flashdata('message', 'Data Service Berhasil dibayar.');			redirect('service');		}				$this->close();			}
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->service->delete($id);
		$this->session->set_flashdata('message', 'Data Service Berhasil dihapus.');
		redirect('service');
	}
	
}