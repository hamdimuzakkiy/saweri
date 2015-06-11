<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class satuan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_satuan', 'satuan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/satuan/index/';
		$config['total_rows'] = $this->db->count_all('satuan');
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
		
		
		
		$data['results'] = $this->satuan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('satuan/satuan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
                
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['satuan'] = $this->input->post('satuan');
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
                $checker = $this->checkName($data['satuan']);
		if ($this->form_validation->run() == FALSE){
                    $data['usernameValidation']=0;
                    $this->load->view('satuan/satuan_add',$data);
		}
                else if($checker==FALSE){
                    $data['usernameValidation']=1;
                    $this->load->view('satuan/satuan_add',$data);
                }
                else{	
			$this->satuan->insert($data);
			$this->session->set_flashdata('message', 'Data Satuan Barang Berhasil disimpan.');
			redirect('satuan');
		}
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->satuan->getItemById($id);
		
		$data['id_satuan'] = $id;
		$data['satuan'] = $data['result']->row()->satuan;
                $data['usernameValidation'] = 0;
		
		
		$this->load->view('satuan/satuan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['satuan'] = $this->input->post('satuan');
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('satuan', 'satuan', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
                
                $checker = $this->checkName($data['satuan']);
                
		if ($this->form_validation->run() == FALSE){
                        $data['usernameValidation']=0;
			$this->load->view('satuan/satuan_edit',$data);	
		}
                else if($checker==FALSE){
                    $data['usernameValidation']=1;
                    $this->load->view('satuan/satuan_add',$data);
                }
                else{	
			$this->satuan->update($data['id_satuan'], $data);
			$this->session->set_flashdata('message', 'Data Satuan Barang Berhasil diupdate.');
			redirect('satuan');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->satuan->delete($id);
		$this->session->set_flashdata('message', 'Data Satuan Barang Berhasil dihapus.');
		redirect('satuan');
	}
        
	function checkName($name){
            $result = $this->satuan->getItemByName($name);
            if($result->num_rows()==0)return TRUE;
            else return FALSE;
        }
}