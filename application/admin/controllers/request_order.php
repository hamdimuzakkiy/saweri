<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class request_order extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_request_order', 'request_order');		$this->load->model('mdl_penjualan', 'penjualan');		$this->load->model('mdl_kode_trans', 'kode_trans');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/request_order/index/';
		$config['total_rows'] = $this->request_order->count('request_order');
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
		
		
		
		$data['results'] = $this->request_order->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('request_order/request_order_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_request_order'] = $this->input->post('id_request_order');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['tanggal'] = $this->input->post('tanggal');
		
		$data['userid'] = get_userid();
		
		
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('request_order/request_order_add',$data);
			
		}else{	
			
			# insert ke table request_order
			$request_order['id_request'] 	= $data['id_request_order'];
			
		 	$request_order['id_cabang'] 	= $data['id_cabang'];
		 	
			$request_order['tanggal'] 		= $data['tanggal'];
			
		 	$request_order['userid'] 		= $data['userid'];		 	
			
			

			$this->request_order->insert($request_order);
			

			# insert ke table detail request_order
			$detail	= $this->input->post('detail');
			
			$count_detail = count($detail);			
			$i=0;
			
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_request'] 		= $request_order['id_request'];
				
				$data_['id_barang'] 		= $detail[$i]['id_barang'];
				
				$data_['qty'] 				= $detail[$i]['qty'];
								
				$this->request_order->insert_detail($data_);
			}
										
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('request_order/index');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->request_order->getItemById($id);
		
		$data['id_request'] = $data['result']->row()->id_request;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['nama_cabang'] = $data['result']->row()->nama_cabang;
		$data['kode_cabang'] = $data['result']->row()->kode_cabang;
		
		$this->load->view('request_order/request_order_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_request_order'] = $this->input->post('id_request_order');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['tanggal'] = $this->input->post('tanggal');
		
		$data['userid'] = get_userid();
		
		
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('request_order/request_order_add',$data);
			
		}else{	
			
			# update ke table request_order
			$request_order['id_request'] 	= $data['id_request_order'];
			$request_order['id_cabang'] 	= $data['id_cabang'];
			$request_order['tanggal'] 		= $data['tanggal'];
			$request_order['userid'] 		= $data['userid'];
			
			$this->request_order->update($data['id_request_order'], $request_order);
			
			# hapus semua data detail RO lama
			$this->db->flush_cache();
			$this->db->where('id_request', $data['id_request_order']);
			$this->db->delete('detail_request_order');
			
			# update ke table detail request_order
			$detail			= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_request'] 		= $request_order['id_request'];
				$data_['id_barang'] 		= $detail[$i]['id_barang'];
				$data_['qty'] 				= $detail[$i]['qty'];
				
				$this->request_order->insert_detail($data_);
			}
			
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('request_order/index');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->request_order->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('request_order/index');
	}
	
	function view($id)
	{
		$data['result'] = $this->request_order->get_detail($id);
		
		$this->load->view('request_order/request_order_view', $data);
	}
	
	# menampilkan list barang pada fancyBox
	function show_barang()
	{
		$data['result'] = $this->request_order->get_barang();
		$this->load->view('request_order/list_barang.php', $data);
	}		
	function send_order(){		
		$this->open();			
		$data['id_request']=$this->uri->segment(3);				
	$data['result_trans']=$this->kode_trans->get_kd_awal('penjualan');		
	$data['kode_transaksi']=$data['result_trans']->row()->kd_trans;				
	$data['result'] = $this->request_order->getItemById($data['id_request']);				
	$this->load->view('penjualan/penjualan_send_ro', $data);				
	$this->close();	}
	
}