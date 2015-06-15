<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class supplier extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_supplier', 'supplier');		
		$this->load->model('mdl_hutang', 'hutang');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/supplier/index/';
		$config['total_rows'] = $this->supplier->getallItem('supplier');
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
		
		$data['results'] = $this->supplier->getItem($config['per_page'], $this->uri->segment(3));
		
		$this->load->view('supplier/supplier_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_supplier'] = strtoupper($this->input->post('id_supplier'));
		$data['kode_supplier'] = strtoupper($this->input->post('kode_supplier'));
		$data['nama'] = strtoupper($this->input->post('nama'));
		$data['alamat'] = strtoupper($this->input->post('alamat'));
		$data['telpon'] = strtoupper($this->input->post('telpon'));
		$data['saldo_hutang'] = strtoupper($this->input->post('saldo_hutang'));
		$data['userid'] = get_userid();		
                $glid = $this->hutang->get_glid();
                
                $data_j['GLID']	= $glid;
                $data_j['KOUNIT'] = $data['kode_supplier'];
                $data_j['KETERANGAN'] = 'Saldo Hutang';
                $data_j['TANGGAL'] = date('Y-m-d');
                $data_j['CDATE']=date('Y-m-d');
                $data_j['CUID'] = get_userid();
                $this->hutang->insert_J($data_j);
                $detailJ_origin['CDATE']=date('Y-m-d');
                $detailJ_origin["DEBET"]=$data['saldo_hutang'];
                $detailJ_origin["AKUNID"]='21200';
                $detailJ_origin["KOUNIT"]=$data['kode_supplier'];
                $detailJ_origin["GLID"]= $glid;	
                $detailJ_origin['CUID'] = get_userid();	
                $this->hutang->insert_detailJ($detailJ_origin);	
                $detailJ['CDATE']=date('Y-m-d');
                $detailJ["KREDIT"]=$data['saldo_hutang'];
                $detailJ["AKUNID"]='44500';
                $detailJ["KOUNIT"]=$data['kode_supplier'];
                $detailJ["GLID"]= $glid;
                $detailJ['CUID'] = get_userid();
                $this->hutang->insert_detailJ($detailJ);
		
		
		$this->form_validation->set_rules('kode_supplier', 'Kode Supplier', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('telpon', 'Telpon', 'trim');
		$this->form_validation->set_rules('saldo_hutang', 'saldo_hutang', 'trim|numeric');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('alpha', 'Field %s harus diisi hanya dengan huruf!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		$checker = $this->checkID($data['kode_supplier']);
                
		if ($this->form_validation->run() == FALSE){
			$data['usernameValidation'] = 0;
			$this->load->view('supplier/supplier_add',$data);
		}
                else if($checker==FALSE){
                        $data['usernameValidation'] = 1;
			$this->load->view('supplier/supplier_add',$data);
                }
                else{	
			$this->supplier->insert($data);
			$this->session->set_flashdata('message', 'Data Supplier Berhasil disimpan.');
			redirect('supplier');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		$data['result'] 		= $this->supplier->getItemById($id);
		$data['id_supplier'] = $id;
		$data['kode_supplier'] = $data['result']->row()->kode_supplier;
		$data['nama'] = $data['result']->row()->nama;
		$data['alamat'] = $data['result']->row()->alamat;
		$data['telpon'] = $data['result']->row()->telpon;
		$data['saldo_hutang'] = $data['result']->row()->saldo_hutang;
		$data['userid'] = $data['result']->row()->userid;
                $data['usernameValidation']=0;
		$this->load->view('supplier/supplier_edit', $data);
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		$data['id_supplier'] = strtoupper($this->input->post('id_supplier'));
		$data['kode_supplier'] = strtoupper($this->input->post('kode_supplier'));
		$data['nama'] = strtoupper($this->input->post('nama'));
		$data['alamat'] = strtoupper($this->input->post('alamat'));
		$data['telpon'] = $this->input->post('telpon');
		$data['saldo_hutang'] = $this->input->post('saldo_hutang');
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('kode_supplier', 'Kode Supplier', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('telpon', 'Telpon', 'trim');
		$this->form_validation->set_rules('saldo_hutang', 'saldo_hutang', 'trim|numeric');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('alpha', 'Field %s harus diisi hanya dengan huruf!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		//$checker = $this->checkID($data['kode_supplier']);
                
		if ($this->form_validation->run() == FALSE){
                        $data['usernameValidation']=0;
			$this->load->view('supplier/supplier_edit',$data);
		}
                else{
			$this->supplier->update($data['id_supplier'], $data);
			$this->session->set_flashdata('message', 'Data Supplier Berhasil diupdate.');
			redirect('supplier');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->supplier->delete($id);
		$this->session->set_flashdata('message', 'Data Supplier Berhasil dihapus.');
		redirect('supplier');
	}
        function checkID($id){
            $result = $this->supplier->getItemByKode($id);
            if($result->num_rows==0)return TRUE;
            else return FALSE;
        }
}