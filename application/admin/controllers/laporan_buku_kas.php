<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_buku_kas extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_buku_kas', 'laporan_buku_kas');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_buku_kas/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_buku_kas->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_buku_kas/form_lap_laporan_buku_kas_periode');
		
		$this->close();
	}
	
	
	function form_lap_buku_kas_periode(){
		$this->open();
		$this->load->view('laporan_buku_kas/form_lap_buku_kas_periode');
		$this->close();
	}
	
	
	function view_lap_buku_kas_periode(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;			$datenow=date('Y');
			$data['results'] = $this->laporan_buku_kas->getItem_periode($periode_awal,$periode_akhir);			$data['get_kas_awal'] = $this->laporan_buku_kas->getItem_kas_awal($datenow);
			$this->load->view('laporan_buku_kas/view_lap_buku_kas_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);		$datenow=date('Y');
		$data['results'] = $this->laporan_buku_kas->getItem_periode($periode_awal,$periode_akhir);		$data['get_kas_awal'] = $this->laporan_buku_kas->getItem_kas_awal($datenow);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_buku_kas/pdf_lap_buku_kas_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_buku_kas','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_buku_kas_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	
	function pdf_lap_buku_kas_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_buku_kas->get_lap_buku_kas_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_buku_kas->get_lap_buku_kas_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_buku_kas/pdf_lap_buku_kas_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_buku_kas_barang','letter','landscape');
	}

}