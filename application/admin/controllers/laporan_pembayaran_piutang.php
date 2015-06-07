<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_pembayaran_piutang extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_pembayaran_piutang', 'laporan_pembayaran_piutang');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_pembayaran_piutang/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_pembayaran_piutang->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_pembayaran_piutang/form_lap_pembayaran_piutang');
		
		$this->close();
	}
	
	
	function form_lap_penjualan_periode(){
		$this->open();
		$this->load->view('laporan_pembayaran_piutang/form_lap_penjualan_periode');
		$this->close();
	}
	
	
	function view_lap_pembayaran_piutang(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->laporan_pembayaran_piutang->getItem_periode($periode_awal,$periode_akhir);
			$this->load->view('laporan_pembayaran_piutang/view_lap_pembayaran_piutang', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->laporan_pembayaran_piutang->getItem_periode($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_pembayaran_piutang/pdf_lap_hutang_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_pembayaran_piutang','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_pembayaran_hutang_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	
	function pdf_lap_penjualan_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_pembayaran_piutang/pdf_lap_penjualan_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_pembayaran_piutang_barang','letter','landscape');
	}

}