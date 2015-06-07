<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class auth
{

	function __construct()
	{
		$this->ci =& get_instance();

		//$this->ci->load->database();
		$this->ci->load->model('mdl_auth', 'm_auth');
		
	}
	
	
	function login($username, $password)
	{
		if ((strlen($username) > 0) AND (strlen($password) > 0)) {
			
			$rows = $this->ci->m_auth->get_user($username, $password);
			
			if ( $rows->num_rows() > 0 ){			// login sukses
				
				return TRUE;
			}
			
		}
		return FALSE;
	}

	function logout()
	{
		$this->delete_autologin();

		// See http://codeigniter.com/forums/viewreply/662369/ as the reason for the next line
		$this->ci->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => ''));

		$this->ci->session->sess_destroy();
	}

	
	function is_logged_in($activated = TRUE)
	{
		
	}

}
