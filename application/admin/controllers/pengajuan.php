<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pengajuan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_pengajuan', 'pengajuan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/pengajuan/index/';
		$config['total_rows'] = $this->db->count_all('pengajuan');
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
		
		
		
		$data['results'] = $this->pengajuan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('pengajuan/pengajuan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_pengajuan'] = $this->input->post('id_pengajuan');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['tanggal'] = $this->input->post('tanggal');
		
		$data['userid'] = get_userid();
		
		
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('pengajuan/pengajuan_add',$data);
			
		}else{	
			
			# insert ke table pengajuan
			$pengajuan['id_request'] 	= $data['id_pengajuan'];
			$pengajuan['id_cabang'] 	= $data['id_cabang'];
			$pengajuan['tanggal'] 		= $data['tanggal'];
			$pengajuan['userid'] 		= $data['userid'];
			
			$this->pengajuan->insert($pengajuan);
			
			# insert ke table detail pengajuan
			$detail			= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_request'] 		= $pengajuan['id_request'];
				$data_['id_barang'] 		= $detail[$i]['id_barang'];
				$data_['qty'] 				= $detail[$i]['qty'];
				
				$this->pengajuan->insert_detail($data_);
			}
			
			
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('pengajuan/index');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->pengajuan->getItemById($id);
		
		$data['id_request'] = $data['result']->row()->id_request;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['nama_cabang'] = $data['result']->row()->nama_cabang;
		$data['kode_cabang'] = $data['result']->row()->kode_cabang;
		
		$this->load->view('pengajuan/pengajuan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_pengajuan'] = $this->input->post('id_pengajuan');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['tanggal'] = $this->input->post('tanggal');
		
		$data['userid'] = get_userid();
		
		
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('pengajuan/pengajuan_add',$data);
			
		}else{	
			
			# update ke table pengajuan
			$pengajuan['id_request'] 	= $data['id_pengajuan'];
			$pengajuan['id_cabang'] 	= $data['id_cabang'];
			$pengajuan['tanggal'] 		= $data['tanggal'];
			$pengajuan['userid'] 		= $data['userid'];
			
			$this->pengajuan->update($data['id_pengajuan'], $pengajuan);
			
			# hapus semua data detail RO lama
			$this->db->flush_cache();
			$this->db->where('id_request', $data['id_pengajuan']);
			$this->db->delete('detail_pengajuan');
			
			# update ke table detail pengajuan
			$detail			= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_request'] 		= $pengajuan['id_request'];
				$data_['id_barang'] 		= $detail[$i]['id_barang'];
				$data_['qty'] 				= $detail[$i]['qty'];
				
				$this->pengajuan->insert_detail($data_);
			}
			
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('pengajuan/index');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->pengajuan->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('pengajuan/index');
	}
	
	function view($id)
	{
		$data['result'] = $this->pengajuan->get_detail($id);
		
		$this->load->view('pengajuan/pengajuan_view', $data);
	}
	
	# menampilkan list barang pada fancyBox
	function show_barang()
	{
		$data['result'] = $this->pengajuan->get_barang();
		$this->load->view('pengajuan/list_barang.php', $data);
	}
	
}