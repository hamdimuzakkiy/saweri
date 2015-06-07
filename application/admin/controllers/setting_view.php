<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_view extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_setting_view', 'setting_view');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/setting_view/index/';
		$config['total_rows'] = $this->db->count_all('setting_view');
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
		
		$data['results'] = $this->setting_view->getItem($config['per_page'], $this->uri->segment(3));

		$this->load->view('setting_view/setting_view_list', $data);
		
		$this->close();
	}
	
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->setting_view->getItemById($id);
		
		$data['id'] = $id;
		$data['name'] = $data['result']->row()->name;
		$data['detail'] = $data['result']->row()->detail;
		$data['judul'] = $data['result']->row()->judul;
		$data['gambar1'] = $data['result']->row()->name_gambar1 ;
		$data['gambar2'] = $data['result']->row()->name_gambar2 ;
		$data['header1'] = $data['result']->row()->name_header1 ;
		$data['header2'] = $data['result']->row()->name_header2 ;
		$data['error'] = '';
		
		$this->load->view('setting_view/setting_view_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		/*
		$data['id_setting_view'] = $this->input->post('id_setting_view');
		$data['kode_setting_view'] = $this->input->post('kode_setting_view');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['telpon'] = $this->input->post('telpon');
		$data['saldo_hutang'] = $this->input->post('saldo_hutang');
		$data['userid'] = get_userid();
		
		
		$this->form_validation->set_rules('kode_setting_view', 'Kode setting_view', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('telpon', 'Telpon', 'trim');
		$this->form_validation->set_rules('saldo_hutang', 'saldo_hutang', 'trim|numeric');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('alpha', 'Field %s harus diisi hanya dengan huruf!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('setting_view/setting_view_edit',$data);
		}else{
			$this->setting_view->update($data['id_setting_view'], $data);
			$this->session->set_flashdata('message', 'Data setting_view Berhasil diupdate.');
			redirect('setting_view');
		}
		*/
		
		
		$gambar1 = 'gambar1';
		$gambar2 = 'gambar2';
		$header1 = 'header1';
		$header2 = 'header2';
		/*$data['id']=$this->input->post('id');
		$data['name']=$this->input->post('name');
		$data['detail']=$this->input->post('detail');*/
		
		$id = '';
		$name = '';
		$judul = '';
		$detail = '';
		$arr_postdata=$this->input->post();
		
		foreach ($arr_postdata as $keys => $value){
			switch($keys){
				case "id" : $id=$value; break;
				case "name" : $name=$value; break;
				case "judul" : $judul=$value; break;
				case "detail" : $detail=$value; break;
			}
		}
		$data['id']=$id;
		$data['name']=$name;
		$data['judul']='<h3>' . $judul . '</h3>';
		$data['detail']=$detail;
		
		/*echo $id .'-' . $name .'-' . $detail;*/
		
		
		
		$config['upload_path'] = './asset/admin/upload/dashboard/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($gambar1))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('setting_view/setting_view_edit', $error);
		}
		else
		{
			$inform_gambar1 = array('upload_data' => $this->upload->data());

			foreach($inform_gambar1 as $row){
				$data['name_gambar1']=$row['file_name'];
				$data['file_path_gambar1']=$row['file_path'];
			}
		}
		
		if (!$this->upload->do_upload($gambar2))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('setting_view/setting_view_edit', $error);
		}
		else
		{
			$inform_gambar2 = array('upload_data' => $this->upload->data());
			foreach($inform_gambar2 as $row2){
				$data['name_gambar2']=$row2['file_name'];
				$data['file_path_gambar2']=$row2['file_path'];
			}
			
		}
		
		if (!$this->upload->do_upload($header1))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('setting_view/setting_view_edit', $error);
		}
		else
		{
			$inform_header1 = array('upload_data' => $this->upload->data());
			foreach($inform_header1 as $row3){
				$data['name_header1']=$row3['file_name'];
				$data['file_path_header1']=$row3['file_path'];
			}
			
		}
		
		if (!$this->upload->do_upload($header2))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('setting_view/setting_view_edit', $error);
		}
		else
		{
			$inform_header2 = array('upload_data' => $this->upload->data());
			foreach($inform_header2 as $row4){
				$data['name_header2']=$row4['file_name'];
				$data['file_path_header2']=$row4['file_path'];
			}
			
		}
		
		$this->setting_view->update($data['id'], $data);
		
		$this->close();
		redirect('setting_view');
	}
	

	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->setting_view->delete($id);
		$this->session->set_flashdata('message', 'Data setting_view Berhasil dihapus.');
		redirect('setting_view');
	}
	
}