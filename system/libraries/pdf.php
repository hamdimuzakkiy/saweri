<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class CI_Pdf {
 
    function pdf_create($html, $filename, $stream=TRUE)
	{
		require_once("dompdf/dompdf_config.inc.php");
		spl_autoload_register('DOMPDF_autoload');
	 
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		if ($stream) {
			$dompdf->stream($filename.".pdf");
		} else {
			$CI =& get_instance();
			$CI->load->helper('file');
			write_file($filename, $dompdf->output());
		}
	}
}