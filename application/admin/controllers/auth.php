<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('mdl_setting_login', 'setting_login');
	}
	
	function index()
	{
		
		$this->login();
	}
	
	
	function login()
	{
		if (is_login() == TRUE){
			redirect(base_url());
		}
				$id = "1";		
				$data['id'] = $id;		
				$data['resultlogin'] 		= $this->setting_login->getItemById($id);					
				$data['name'] = $data['resultlogin']->row()->name;		
				$data['login1'] = $data['resultlogin']->row()->name_login1 ;		
		
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['message'] = '';
		
		
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		
		$this->form_validation->set_message('required', 'Field Harus Diisi!');
		
		if ($this->form_validation->run() == FALSE){		/* validasi gagal */
			$this->load->view('users/login_form', $data);
		}else{												/* validasi berhasil */
			
			/* cek user */
			$row = $this->mdl_auth->get_user($data['username'], $data['password']);
			
			if ($row->num_rows() > 0){								/* login sukses */
				/* set token */
				$token = md5($row->row()->userid . time());
				$this->mdl_auth->set_token($row->row()->userid, $token);
				$this->session->set_userdata('token', $token);
				
				/* set logged as to session */
				$log_as = $this->mdl_auth->get_logged_as($row->row()->userid);
				$this->session->set_userdata('logged_as', $log_as);
				$this->session->set_userdata('userid', $row->row()->userid);
				$this->session->set_userdata('userlevel', $row->row()->level_id);
				$this->session->set_userdata('kodecabang', $row->row()->kode_cabang);
				$this->session->set_userdata('idcabang', $row->row()->id_cabang);
				
				redirect(base_url());
				/*print_r($this->session->userdata('privilage')); */
				
				
			}else{															/* login gagal */
				$data['message'] = 'Akses ditolak!';
				$this->load->view('users/login_form', $data);
			}
			
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	
	function failed(){
		echo 'Maaf, Anda tidak memiliki hak untuk mengakses menu ini!';
		echo anchor(base_url(), 'Dashboard');
		echo '<br/>';
		print_r($this->session->userdata('privilage'));
	}
	
}
