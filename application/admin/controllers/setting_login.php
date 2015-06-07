<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_login extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_setting_login', 'setting_login');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/setting_login/index/';
		$config['total_rows'] = $this->db->count_all('setting_login');
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
		
		$data['results'] = $this->setting_login->getItem($config['per_page'], $this->uri->segment(3));

		$this->load->view('setting_login/setting_login_list', $data);
		
		$this->close();
	}
	
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['resultlogin'] 		= $this->setting_login->getItemById($id);
		
		$data['id'] = $id;
		$data['name'] = $data['resultlogin']->row()->name;
		$data['login1'] = $data['resultlogin']->row()->name_login1 ;
		$data['error'] = '';
		
		$this->load->view('setting_login/setting_login_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
	
		$login1 = 'login1';

		
		$id = '';
		$name = '';

		$arr_postdata=$this->input->post();
		
		foreach ($arr_postdata as $keys => $value){
			switch($keys){
				case "id" : $id=$value; break;
				case "name" : $name=$value; break;
			}
		}
		$data['id']=$id;
		$data['name']=$name;
		
		/*echo $id .'-' . $name .'-' . $detail;*/
		
		
		
		$config['upload_path'] = './asset/admin/upload/login/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($login1))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('setting_login/setting_login_edit', $error);
		}
		else
		{
			$inform_login1 = array('upload_data' => $this->upload->data());

			foreach($inform_login1 as $row){
				$data['name_login1']=$row['file_name'];
				$data['file_path_login1']=$row['file_path'];
			}
		}
		
	
		
		$this->setting_login->update($data['id'], $data);
		
		$this->close();
		redirect('setting_login');
	}
	

	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->setting_login->delete($id);
		$this->session->set_flashdata('message', 'Data setting_login Berhasil dihapus.');
		redirect('setting_login');
	}
	
}