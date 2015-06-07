<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class barang_point extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_barang_point', 'barang_point');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/barang_point/index/';
		$config['total_rows'] = $this->barang_point->getallItem('barang_point');
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
		
		

		$data['results'] = $this->barang_point->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('barang_point/barang_point_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_barang'] = $this->input->post('id_barang');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['id_jenis'] = '3';
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['id_golongan'] = $this->input->post('id_golongan');		
		$data['point_barangpoint'] = $this->input->post('point_barangpoint');	
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');		
		$this->form_validation->set_rules('point_barangpoint', 'point_barangpoint', 'required|numeric');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('barang_point/barang_point_add',$data);
			
		}else{	
			$this->barang_point->insert($data);
			
			$this->session->set_flashdata('message', 'Data Barang Point Berhasil disimpan.');
			redirect('barang_point');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->barang_point->getItemById($id);
		
		$data['id_barang'] = $id;
		$data['nama_barang'] = $data['result']->row()->nama_barang;
		$data['id_jenis'] = $data['result']->row()->id_jenis;
		$data['id_kategori'] = $data['result']->row()->id_kategori;
		$data['id_satuan'] = $data['result']->row()->id_satuan;
		$data['id_golongan'] = $data['result']->row()->id_golongan;		
		$data['point_barangpoint'] = $data['result']->row()->point_barangpoint;		
		
		
		$this->load->view('barang_point/barang_point_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_barang'] = $this->input->post('id_barang');
		$data['nama_barang'] = $this->input->post('nama_barang');
		$data['id_jenis'] = '3';
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['id_golongan'] = $this->input->post('id_golongan');
		$data['point_barangpoint'] = $this->input->post('point_barangpoint');			
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');
		$this->form_validation->set_rules('point_barangpoint', 'point_barangpoint', 'required|numeric');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('barang_point/barang_point_edit',$data);
			
		}else{	
			$this->barang_point->update($data['id_barang'], $data);
			
			$this->session->set_flashdata('message', 'Data Barang Point Berhasil diupdate.');
			redirect('barang_point');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->barang_point->delete($id);
		$this->session->set_flashdata('message', 'Data Barang point Berhasil dihapus.');
		redirect('barang_point');
	}
	
}