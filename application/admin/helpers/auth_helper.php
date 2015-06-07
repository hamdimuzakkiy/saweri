<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Cek login
if ( ! function_exists('is_login'))
{
	function is_login()
	{
		//print_r(get_instance()->session->userdata('privilage'));
		
		$token = get_instance()->session->userdata('token');
		
		if ($token){
			$row = get_instance()->mdl_auth->get_userByToken($token);
			
			if ($row->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		return FALSE;
	}
}

# get Logged as
if ( ! function_exists('logged_as'))
{
	function logged_as()
	{
		return get_instance()->session->userdata('logged_as');
	}
}

# get User ID
if ( ! function_exists('get_userid'))
{
	function get_userid()
	{
		return get_instance()->session->userdata('userid');
	}
}

# get kode cabang
if ( ! function_exists('get_kodecabang'))
{
	function get_kodecabang()
	{
		return get_instance()->session->userdata('kodecabang');
	}
}

# get ID cabang
if ( ! function_exists('get_idcabang'))
{
	function get_idcabang()
	{
		return get_instance()->session->userdata('idcabang');
	}
}

# get user level
if ( ! function_exists('get_userlevel'))
{
	function get_userlevel()
	{
		return get_instance()->session->userdata('userlevel');
	}
}

