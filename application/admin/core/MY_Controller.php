<?php

class MY_Controller extends CI_Controller{
	
	var $privilage_x;
	
	public function __construct()
	{		
		parent::__construct();
		$this->output->enable_profiler(false);		
		$this->load->model('mdl_setting_view', 'setting_view');
		$this->load->model('mdl_karyawan', 'karyawan');
		
		// jika belum login
		if (is_login() == FALSE){					
			redirect('auth');
		}
		
		// set privilage		
		$this->set_privilage();		
		
		// jika tidak diperbolehkan mengakses controller
		$ctr = $this->uri->segment(1);
		if ($this->can_access($ctr) == FALSE){
			redirect('auth/failed');
		}
		
	}		
	private function ambilheader()	
	{	
		$data['result'] = $this->setting_view->getItemById($id);				
	 	$data['id'] = $id;		
		$data['name'] = $data['result']->row()->name;		
		$data['detail'] = $data['result']->row()->detail;		
		$data['judul'] = $data['result']->row()->judul;		
		$data['gambar1'] = $data['result']->row()->name_gambar1 ;		
		$data['gambar2'] = $data['result']->row()->name_gambar2 ;		
		$data['header1'] = $data['result']->row()->name_header1 ;		
		$data['header2'] = $data['result']->row()->name_header2 ;		
	}
	
	function open()
	{		
		$data['privilage'] = $this->privilage_x;		
		$id = "1";
		$data['id'] = $id;
		$data['resultheader'] = $this->setting_view->getItemById($id);
		$data['name'] = $data['resultheader']->row()->name;		
		$data['detail'] = $data['resultheader']->row()->detail;		
		$data['judul'] = $data['resultheader']->row()->judul;		
		$data['gambar1'] = $data['resultheader']->row()->name_gambar1 ;		
		$data['gambar2'] = $data['resultheader']->row()->name_gambar2 ;		
		$data['header1'] = $data['resultheader']->row()->name_header1 ;		
		$data['header2'] = $data['resultheader']->row()->name_header2 ;		
	
		

		$this->load->view('layouts/header');
		$this->load->view('layouts/menu', $data);
	}

	function getIdCabang()
	{
		$res = $this->karyawan->getItemById($this->session->userdata('userid'));

		foreach ($res->result() as $row) {
			$data['idCabang'] = $row->id_cabang;
		}
		return $data['idCabang'];
	}
	
	function close()
	{		
		$this->load->view('layouts/footer');
	}
	
	function set_privilage(){
		// cek user				

		$row = $this->session->userdata('userlevel');

		# set privilage
		# init privilage
		//$privilage[''][0] = '';
		
		# ambil privilage dari users_level
		$this->db->flush_cache();
		$this->db->where('level_id', $row);
		$row_pri = $this->db->get('users_level')->row_array();
		
		$fields = $this->db->field_data('users_level');
		foreach($fields as $field){
			//echo $field->name.'<br>';
			if (($field->name != 'level_id') and ($field->name != 'nama'))
			{				
				
				$tmp_pri = str_split($row_pri[$field->name]);
//				print $field->name.'<br>';		
				$privilage[$field->name][0] = isset($tmp_pri[0]) ? $tmp_pri[0]:'0';
				$privilage[$field->name][1] = isset($tmp_pri[1]) ? $tmp_pri[1]:'0';
				$privilage[$field->name][2] = isset($tmp_pri[2]) ? $tmp_pri[2]:'0';
				$privilage[$field->name][3] = isset($tmp_pri[3]) ? $tmp_pri[3]:'0';
				$privilage[$field->name][4] = isset($tmp_pri[4]) ? $tmp_pri[4]:'0';
				 // echo 'Field : '.$field->name.'&nbsp;&nbsp;&nbsp;0.'.$tmp_pri[0].
												// '&nbsp;&nbsp;&nbsp;1.'.$tmp_pri[1].
												// '&nbsp;&nbsp;&nbsp;2.'.$tmp_pri[2].
												// '&nbsp;&nbsp;&nbsp;3.'.$tmp_pri[3].
												// '&nbsp;&nbsp;&nbsp;4.'.$tmp_pri[4].'<br/>';				
			}
		}
		
		//print $privilage[$field->name][1];		
		$this->privilage_x = $privilage;
	}
		
	function can_access($ctr='')
	{	
		$priv = $this->privilage_x;
		$form = $ctr;
		if($form){
			if($priv[$form][0] == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	
	function can_view()
	{
		$priv = $this->privilage_x;
		$form = $this->uri->segment(1);
		
		if($form){
			if($priv[$form][1] == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	
	function can_insert()
	{
		$priv = $this->privilage_x;
		$form = $this->uri->segment(1);
		
		if($form){
			if($priv[$form][2] == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	
	function can_update()
	{
		$priv = $this->privilage_x;
		$form = $this->uri->segment(1);
		
		if($form){
			if($priv[$form][3] == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	
	function can_delete()
	{
		$priv = $this->privilage_x;
		$form = $this->uri->segment(1);
		
		if($form){
			if($priv[$form][4] == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	
}