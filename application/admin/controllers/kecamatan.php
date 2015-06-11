<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kecamatan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_kecamatan', 'kecamatan');
		
	}
	
	function index()
	{	
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/kecamatan/index/';
		$config['total_rows'] = $this->db->count_all('kecamatan');		
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
		
		
		
		$data['results'] = $this->kecamatan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('kecamatan/kecamatan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_kecamatan'] = $this->input->post('id_kecamatan');
		$data['id_kabupaten'] = $this->input->post('id_kabupaten');
		$data['kecamatan'] = $this->input->post('kecamatan');
		$data['userid'] = get_userid();
			
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
                $checker = $this->checkNama($data['kecamatan'],$data['id_kabupaten']);
		if ($this->form_validation->run() == FALSE){
                    $data['usernameValidation'] = 0;
                    $this->load->view('kecamatan/kecamatan_add',$data);
		}
                else if($checker==FALSE){
                    $data['usernameValidation'] = 1;
                    $this->load->view('kecamatan/kecamatan_add',$data);
                }
                else{	
			$this->kecamatan->insert($data);
			$this->session->set_flashdata('message', 'Data kecamatan Berhasil disimpan.');
			redirect('kecamatan');
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
		$this->db->where('kecamatan', $str);
		$q = $this->db->get('kecamatan');
		
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
		
		$data['result'] = $this->kecamatan->getItemById($id);
		
		$data['id_kecamatan'] = $data['result']->row()->id_kecamatan;
		$data['kecamatan'] = $data['result']->row()->kecamatan;
		
		$this->load->view('kecamatan/kecamatan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_kecamatan'] = $this->input->post('id_kecamatan');
		$data['id_kabupaten'] = $this->input->post('id_kabupaten');
		$data['kecamatan'] = $this->input->post('kecamatan');
		$data['userid'] = get_userid();
		
               $hasil_kabupaten = $this->kecamatan->getKabupaten($data['id_kecamatan']);
               $checker = $this->checkNama($data['kecamatan'],$data['id_kabupaten']);
               
               if($data['id_kabupaten']==$hasil_kabupaten->row()->id_kabupaten){
                    $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
                    $this->form_validation->set_message('required', 'Field %s harus diisi!');
                    
                    if ($this->form_validation->run()==FALSE){
			//$this->load->view('kecamatan/kecamatan_edit',$data);
                        //$this->update($data['id_kecamatan']);
                        $data['usernameValidation'] = 0;
                        $this->load->view('kecamatan/kecamatan_edit',$data);
                    }
                    else if($checker==FALSE){
                    $data['usernameValidation'] = 1;
                    $this->load->view('kecamatan/kecamatan_add',$data);
                    }
                    else{
			$this->kecamatan->update($data['id_kecamatan'], $data);
			$this->session->set_flashdata('message', 'Data kecamatan Berhasil diupdate.');
			redirect('kecamatan');
                    }
               }
                else{
			$this->kecamatan->update($data['id_kecamatan'], $data);
			$this->session->set_flashdata('message', 'Data kecamatan Berhasil diupdate.');
			redirect('kecamatan');
		}
		$this->close();
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->kecamatan->delete($id);
		$this->session->set_flashdata('message', 'Data kecamatan Berhasil dihapus.');
		redirect('kecamatan');
	}
        function checkNama($nama,$id_kabupaten){
            $result = $this->kecamatan->getNama($nama,$id_kabupaten);
            if($result->num_rows()==0)return TRUE;
            else return FALSE;
        }
}
	