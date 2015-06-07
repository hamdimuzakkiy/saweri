<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_piutang extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_piutang', 'laporan_piutang');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_piutang/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_piutang->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_piutang/form_lap_piutang_periode');
		
		$this->close();
	}
	
	
	function form_lap_penjualan_periode(){
		$this->open();
		$this->load->view('laporan_piutang/form_lap_penjualan_periode');
		$this->close();
	}
	
	
	function view_lap_piutang_periode(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->laporan_piutang->getItem_periode($periode_awal,$periode_akhir);
			$this->load->view('laporan_piutang/view_lap_piutang_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->laporan_piutang->getItem_periode($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_piutang/pdf_lap_piutang_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_piutang','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_piutang_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}

}