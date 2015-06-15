<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class area extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_area', 'area');
                $this->load->model('mdl_kecamatan', 'kecamatan');
                $this->load->model('mdl_kabupaten', 'kabupaten');
		
	}
	
	function index()
	{	
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/area/index/';
		$config['total_rows'] = $this->area->getallItem('area');
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
		
		$data['results'] = $this->area->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('area/area_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
	
		$data['id_kecamatan'] = strtoupper($this->input->post('id_kecamatan'));
		$data['id_area'] = strtoupper($this->input->post('id_area'));
		$data['area'] = strtoupper($this->input->post('area'));
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('area', 'area', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field harus diisi!');
                

		if ($this->form_validation->run() == FALSE){
                        $data['usernameValidation'] = 0;
			$this->load->view('area/area_add',$data);
		}
                else{	
                        $data['id_kabupaten'] = $this->checkKabupaten($data['id_kecamatan']);
			$checker = $this->checkArea($data['area'],$data['id_kabupaten'],$data['id_kecamatan']);
                        if($checker==FALSE){
                            $data['usernameValidation'] = 1;
                            $this->load->view('area/area_add',$data);
                        }
                        else{
                            $this->area->insert($data);
                            $this->session->set_flashdata('message', 'Data Area Berhasil disimpan.');
                            redirect('area');
                        }
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
		$this->db->where('area', $str);
		$q = $this->db->get('area');
		
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
		
		$data['result'] 		= $this->area->getItemById($id);
		//$data['id_kecamatan'] = $data['result']->row()->id_kecamatan;
		$data['id_kabupaten'] = $data['result']->row()->id_kabupaten;
		$data['id_area'] = $data['result']->row()->id_area;
		$data['area'] = $data['result']->row()->area;
        $data['id_kecamatan'] = $data['result']->row()->id_kecamatan;
        $data['usernameValidation'] = 0;
		
		$this->load->view('area/area_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		//$data['id_kabupaten'] = $this->input->post('id_kabupaten');
		$data['id_area'] = strtoupper($this->input->post('id_area'));
		$data['area'] = strtoupper($this->input->post('area'));
                $data['id_kecamatan'] = strtoupper($this->input->post('id_kecamatan'));
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('area', 'area', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field harus diisi!');
                
		if ($this->form_validation->run() == FALSE){
                        $data['usernameValidation'] = 0;
			$this->load->view('area/area_edit',$data);
		}
                else{
                        $data['id_kabupaten'] = $this->checkKabupaten($data['id_kecamatan']);
                        $checker = $this->checkArea($data['area'],$data['id_kabupaten'],$data['id_kecamatan']);
                        if($checker==FALSE){
                            $data['usernameValidation'] = 1;
                            $this->load->view('area/area_edit',$data);
                        }
                        else{
                            $this->area->update($data['id_area'], $data);
                            $this->session->set_flashdata('message', 'Data Area Berhasil diupdate.');
                            redirect('area');
                        }
		}
		$this->close();
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->area->delete($id);
		$this->session->set_flashdata('message', 'Data Area Berhasil dihapus.');
		redirect('area');
	}
        
        function checkKabupaten($id_kecamatan){
            $kbptn = $this->kecamatan->getKabupaten($id_kecamatan);
            $kbptn = $kbptn->first_row();
            return $id_kbptn = $kbptn->id_kabupaten;
        }
        
        function checkArea($nama_area,$id_kabupaten,$id_kecamatan){
            $area = $this->area->getNama($nama_area);
            if($area->num_rows()==0){
                return TRUE;
            }
            else{
                $checker = $this->area->checkArea($nama_area,$id_kabupaten,$id_kecamatan);
                if($checker->num_rows()==0)return TRUE;
                else return FALSE;
            }
        }
}
	