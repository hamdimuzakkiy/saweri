<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_biaya extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_biaya', 'laporan_biaya');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_biaya/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_biaya->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_biaya/form_lap_laporan_biaya_periode');
		
		$this->close();
	}
	
	
	function form_lap_biaya_periode(){
		$this->open();
		$this->load->view('laporan_biaya/form_lap_biaya_periode');
		$this->close();
	}
	
	
	function view_lap_biaya_periode(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;			$datenow=date('Y');
			$data['results'] = $this->laporan_biaya->getItem_periode($periode_awal,$periode_akhir);			$data['get_kas_awal'] = $this->laporan_biaya->getItem_kas_awal($datenow);
			$this->load->view('laporan_biaya/view_lap_biaya_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);		$datenow=date('Y');
		$data['results'] = $this->laporan_biaya->getItem_periode($periode_awal,$periode_akhir);		$data['get_kas_awal'] = $this->laporan_biaya->getItem_kas_awal($datenow);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_biaya/pdf_lap_biaya_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_biaya','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_biaya_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	
	function pdf_lap_biaya_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_biaya->get_lap_biaya_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_biaya->get_lap_biaya_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_biaya/pdf_lap_biaya_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_biaya_barang','letter','landscape');
	}

}