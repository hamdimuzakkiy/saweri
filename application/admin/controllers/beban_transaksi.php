<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class beban_transaksi extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_beban_transaksi', 'beban_transaksi');				
		$this->load->model('mdl_kode_trans', 'kode_trans');				
		$this->load->model('mdl_hutang', 'hutang');		
		$this->load->model('mdl_retur_pembelian', 'retur_pembelian');
		$this->load->library('fungsi');
		$this->load->library('pdf');	
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();

		$this->open();

		$config['base_url'] = base_url().'index.php/beban_transaksi/index/';
		$config['total_rows'] = sizeof($this->beban_transaksi->count()->result());

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
		
		$data['results'] = $this->beban_transaksi->getItem($config['per_page'], $this->uri->segment(3));
				
		$this->load->view('beban_transaksi/beban_transaksi_list', $data);
		
		$this->close();
	}

	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
				
		$data['pembayaran'] = strtoupper($this->input->post('pembayaran'));		
		$data['beban'] = strtoupper($this->input->post('beban'));
		
		$this->form_validation->set_rules('pembayaran', 'pembayaran', 'callback_cek_nama|required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
                $checker = $this->checkName($data['pembayaran']);
		if ($this->form_validation->run() == FALSE){	
                    $data['usernameValidation'] = 0;
                    $this->load->view('beban_transaksi/beban_transaksi_add',$data);			
		}
                else if ($checker == FALSE){			
                    $data['usernameValidation'] = 1;
                    $this->load->view('beban_transaksi/beban_transaksi_add',$data);			
		}
                else{	
			$this->beban_transaksi->insert($data);
			$this->session->set_flashdata('message', 'Data Golongan Berhasil disimpan.');
			redirect('beban_transaksi');
		}
		$this->close();
	}

	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();		
		$data['result'] 		= $this->beban_transaksi->getItemById($id);		
		$data['id'] = $data['result']->row()->id;
		$data['beban'] = $data['result']->row()->beban;
		$data['pembayaran'] = $data['result']->row()->pembayaran;
		
		$this->load->view('beban_transaksi/beban_transaksi_edit', $data);
		
		$this->close();
	}

	function process_update()
	{

		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();

		$id =  $_POST['id'];
		$data['pembayaran'] = strtoupper($_POST['pembayaran']);
		$data['beban'] = strtoupper($_POST['beban']);

		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('pembayaran', 'pembayaran', 'required');
		$this->form_validation->set_rules('beban', 'beban', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('beban_transaksi/beban_transaksi_edit',$data);	
		}else{	
			$this->beban_transaksi->update($id, $data);
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('beban_transaksi');
		}
		$this->close();
	}

	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->beban_transaksi->delete($id);
		$this->session->set_flashdata('message', 'Data Cabang Berhasil dihapus.');
		redirect('beban_transaksi');
	}
        function checkName($name){
            $result = $this->beban_transaksi->getItemByName($name);
            if($result->num_rows()==0)return TRUE;
            else return FALSE;
        }
}