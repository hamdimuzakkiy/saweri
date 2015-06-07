<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class laporan_laba_rugi extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_laba_rugi', 'laporan_laba_rugi');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_laba_rugi/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_laba_rugi->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_laba_rugi/form_lap_laporan_laba_rugi_periode');
		
		$this->close();
	}
	
	
	function form_lap_laba_rugi_periode(){
		$this->open();
		$this->load->view('laporan_laba_rugi/form_lap_laba_rugi_periode');
		$this->close();
	}
	
	
	function view_lap_laba_rugi_periode(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;			$datenow=date('Y-m-d');			$yearnow=date('Y');			$start_persediaan_awal = $yearnow . '01-01';
			$data['results_penjualan'] = $this->laporan_laba_rugi->getItem_penjualan();			$data['results_pembelian'] = $this->laporan_laba_rugi->get_total_pembelian();			$data['results_kas_awal'] = $this->laporan_laba_rugi->get_total_kas_awal();			$data['results_kas_awal_pembelian'] = $this->laporan_laba_rugi->get_kas_awal_pembelian($periode_awal,$start_persediaan_awal);			$data['results_pendapatan'] = $this->laporan_laba_rugi->getItem_pendapatan();			$data['results_total_refund'] = $this->laporan_laba_rugi->get_total_refund();			$data['results_total_diskon'] = $this->laporan_laba_rugi->get_total_diskon();			$data['results'] = $this->laporan_laba_rugi->getItem_periode($periode_awal,$periode_akhir);			$data['get_kas_awal'] = $this->laporan_laba_rugi->getItem_kas_awal($yearnow);
			$this->load->view('laporan_laba_rugi/view_lap_laba_rugi_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);		$datenow=date('Y');
		$data['results'] = $this->laporan_laba_rugi->getItem_periode($periode_awal,$periode_akhir);		$data['get_kas_awal'] = $this->laporan_laba_rugi->getItem_kas_awal($datenow);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_laba_rugi/pdf_lap_laba_rugi_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_laba_rugi','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_laba_rugi_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	
	function pdf_lap_laba_rugi_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_laba_rugi->get_lap_laba_rugi_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_laba_rugi->get_lap_laba_rugi_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_laba_rugi/pdf_lap_laba_rugi_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_laba_rugi_barang','letter','landscape');
	}

}