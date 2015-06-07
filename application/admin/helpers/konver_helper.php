<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Cek login
if ( ! function_exists('convert_rupiah'))
{
	function convert_rupiah($number)
	{
		$rupiah = number_format($number, 0, ',', '.').',-';
		$rupiah2 = 'Rp. '.str_pad($rupiah, 15, '#', STR_PAD_LEFT);
		
		return str_replace('#', '&nbsp;', $rupiah2);
	}
}

if ( ! function_exists('convert_rupiah_non_rp'))
{
	function convert_rupiah_non_rp($number)
	{
		$rupiah = number_format($number, 0, ',', '.').',-';
		$rupiah2 = str_pad($rupiah, 15, '#', STR_PAD_LEFT);
		
		return str_replace('#', '&nbsp;', $rupiah2);
	}
}

if ( ! function_exists('convert_date_mysql_indo'))
{
	function convert_date_mysql_indo($in)
	{
		$ci=&get_instance();
		$ci->load->library('fungsi');
		$tgl = substr($in,8,2);
		$bln = substr($in,5,2);
		$thn = substr($in,0,4);
		if(checkdate($bln,$tgl,$thn))
		{
		   //$out=substr($in,8,2)." ".$this->fungsi->bulan2(substr($in,5,2))." ".substr($in,0,4);
		   $out=substr($in,8,2)."-".substr($in,5,2)."-".substr($in,0,4);
		}
		else
		{
		   $out = "<span class='error'>-error-</span>";
		}
		return $out;
	}
}
