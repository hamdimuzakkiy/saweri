<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jenis extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_jenis', 'jenis');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/jenis/index/';
		$config['total_rows'] = $this->db->count_all('jenis');
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
		
		
		
		$data['results'] = $this->jenis->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('jenis/jenis_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_jenis'] = strtoupper($this->input->post('id_jenis'));
		$data['jenis'] = strtoupper($this->input->post('jenis'));
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('jenis', 'jenis', 'callback_cek_nama|required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('jenis/jenis_add',$data);
			
		}else{	
			$this->jenis->insert($data);
			$this->session->set_flashdata('message', 'Data Jenis Barang Berhasil disimpan.');
			redirect('jenis');
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
		$this->db->where('jenis', $str);
		$q = $this->db->get('jenis');
		
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
		
		$data['result']= $this->jenis->getItemById($id);
		$data['id_jenis'] = $id;
                $data['usernameValidation'] = 0;

		$this->load->view('jenis/jenis_edit', $data);		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_jenis'] = strtoupper($this->input->post('id_jenis'));
		$data['jenis'] = strtoupper($this->input->post('jenis'));		
		$data['userid'] = get_userid();
                
		$this->form_validation->set_rules('jenis', 'jenis', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');

                $checker = $this->checkNama($data['jenis']);
		if ($this->form_validation->run() == FALSE){
                        $data['usernameValidation'] = 0;
                        $data['result']= $this->jenis->getItemById($data['id_jenis']);
			$this->load->view('jenis/jenis_edit',$data);
		}
                else if ($checker==FALSE){
			$data['usernameValidation'] = 1;
                        $data['result']= $this->jenis->getItemById($data['id_jenis']);
                        $this->load->view('jenis/jenis_edit',$data);
		}
                else{	
			$this->jenis->update($data['id_jenis'], $data);
			$this->session->set_flashdata('message', 'Data Jenis Barang Berhasil diupdate.');
			redirect('jenis');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->jenis->delete($id);
		$this->session->set_flashdata('message', 'Data Jenis Barang Berhasil dihapus.');
		redirect('jenis');
	}
        
	function checkNama($nama){
            $result = $this->jenis->getItemByName($nama);
            if($result->num_rows()==0)return TRUE;
            else return FALSE;
        }
}