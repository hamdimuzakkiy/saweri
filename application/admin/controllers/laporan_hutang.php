<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_hutang extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_hutang', 'laporan_hutang');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/laporan_hutang/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_hutang->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_hutang/form_lap_hutang_periode');
		
		$this->close();
	}
	
	
	function form_lap_penjualan_periode(){
		$this->open();
		$this->load->view('laporan_hutang/form_lap_hutang_periode');
		$this->close();
	}
	
	
	function view_lap_hutang_periode(){
				$periode_awal = $this->uri->segment('3');		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->laporan_hutang->getItem($periode_awal,$periode_akhir);
			$this->load->view('laporan_hutang/view_lap_hutang_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->laporan_hutang->getItem_periode($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_hutang/pdf_lap_hutang_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_hutang','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_hutang_periode.xls");
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
		$html=$this->load->view('laporan_hutang/pdf_lap_penjualan_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_hutang_barang','letter','landscape');
	}

}