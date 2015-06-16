<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_pembelian extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_pembelian', 'lap_pembelian');
$this->load->model('mdl_inventory', 'inventory');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/pembelian/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_pembelian->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_pembelian/filter_laporan_pembelian');
		
		$this->close();
	}
	
	
	
	
	
	function show_report(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->lap_pembelian->getItem($periode_awal,$periode_akhir);
			$this->load->view('laporan_pembelian/show_report', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->lap_pembelian->getItem($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_pembelian/report_pdf', $data, true);
        $this->pdf->pdf_create($html, 'laporan_pembelian','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=laporan_pembelian.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	function form_lap_pembelian_barang(){
		$this->open();
		$data['barang'] = $this->lap_pembelian->get_item_barang(false);
		$data['num'] = $this->lap_pembelian->get_item_barang(true);
		$this->load->view('laporan_pembelian/form_lap_pembelian_barang',$data);
		$this->close();
	}
	
	function view_lap_pembelian_barang(){
		
		$cek_pilihan = $this->uri->segment('3');
		
		/* $periode_akhir = $this->uri->segment('4'); */
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		
		$date_now=date('d M Y');
	/*	echo $periode_awal . '-' . $periode_akhir . '<br/>';
		foreach($nama_barang as $barang){
			echo $barang.'<br>';
		}*/
		$data['dt_nama_barang'] = $nama_barang;
		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_pembelian->get_lap_pembelian_barang($periode_awal,$periode_akhir,$nama_barang,false);
			 $data['num'] = $this->lap_pembelian->get_lap_pembelian_barang($periode_awal,$periode_akhir,$nama_barang,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_pembelian/view_lap_pembelian_barang', $data);
				
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_pembelian/pdf_lap_pembelian_brg', $data);
				$this->pdf->pdf_create($html, 'laporan_pembelian_barang','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_pembelian_perbarang.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }
		/*foreach($nama_barang as $barang){
			echo $barang.'<br>';
		}*/
		
	}
	
	function pdf_lap_pembelian_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_pembelian->get_lap_pembelian_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_pembelian->get_lap_pembelian_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_pembelian/pdf_lap_pembelian_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_pembelian_barang','letter','landscape');
	}
	
	function get_barang(){
		$data['barang'] = $this->lap_pembelian->get_item_barang(false);
		$data['num'] = $this->lap_pembelian->get_item_barang(true);
		$this->load->view('laporan_pembelian/get_barang',$data);
	}
	
	function search_barang()
	{
		$key = $this->uri->segment(3,0);
		
		/*$offset = $this->uri->segment(4,0); */
		$perpage=15;
		$total_page=$this->lap_pembelian->get_barang_like($key,true);	
		$data['num'] = $total_page;
		/*$data['batas'] = $offset; */
		$data['barang'] = $this->lap_pembelian->get_barang_like($key,false);
		$this->load->view('laporan_pembelian/get_barang',$data);
	}
	
	/*end laporan perbarang */
	
	/*laporan persupplier */
	function form_lap_pembelian_supplier(){
		$this->open();
		$this->load->view('laporan_pembelian/form_lap_pembelian_supplier');
		$this->close();
	}
	
	function get_supplier(){
		$data['barang'] = $this->lap_pembelian->get_supplier(false);
		$data['num'] = $this->lap_pembelian->get_supplier(true);
		$this->load->view('laporan_pembelian/get_supplier',$data);
	}
	
	function search_supplier()
	{
		$key = $this->uri->segment(3,0);
		
		
		$perpage=15;
		$total_page=$this->lap_pembelian->get_supplier_like($key,true);	
		$data['num'] = $total_page;
		
		$data['barang'] = $this->lap_pembelian->get_supplier_like($key,false);
		$this->load->view('laporan_pembelian/get_supplier',$data);
	}
	
	function view_lap_pembelian_supplier(){
		$cek_pilihan = $this->uri->segment('3');
		
		
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$id_supplier = $this->input->post('nama');
		
		$date_now=date('d M Y');

		$data['dt_nama_supplier'] = $id_supplier;
		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_pembelian->get_lap_pembelian_supplier($periode_awal,$periode_akhir,$id_supplier,false);
			 $data['num'] = $this->lap_pembelian->get_lap_pembelian_supplier($periode_awal,$periode_akhir,$id_supplier,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_pembelian/view_lap_pembelian_supplier', $data);
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_pembelian/pdf_lap_pembelian_brg', $data);
				$this->pdf->pdf_create($html, 'laporan_pembelian_barang','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_pembelian_perbarang.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }

		
	}
	
	function pdf_lap_pembelian_supplier(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$id_supplier = $this->input->post('nama_supplier');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_pembelian->get_lap_pembelian_supplier($periode_awal,$periode_akhir,$id_supplier,false);
		$data['num'] = $this->lap_pembelian->get_lap_pembelian_supplier($periode_awal,$periode_akhir,$id_supplier,true);
		$html=$this->load->view('laporan_pembelian/pdf_lap_pembelian_supplier', $data, true);
		$this->pdf->pdf_create($html, 'laporan_pembelian_supplier','letter','landscape');
	}
	
	
	
	function form_lap_retur_pembelian(){
		$this->open();
		$this->load->view('laporan_pembelian/form_lap_retur_pembelian');
		$this->close();
	}
	
	function view_lap_retur_pembelian(){
		$cek_pilihan = $this->uri->segment('3');
		
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$date_now=date('d M Y');

		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_pembelian->get_lap_retur_pembelian($periode_awal,$periode_akhir,false);
			 $data['num'] = $this->lap_pembelian->get_lap_retur_pembelian($periode_awal,$periode_akhir,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_pembelian/view_lap_retur_pembelian', $data);
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_retur_pembelian.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }
		
	}
	
	
	function pdf_lap_retur_pembelian(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');

		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_pembelian->get_lap_retur_pembelian($periode_awal,$periode_akhir,false);
		$data['num'] = $this->lap_pembelian->get_lap_retur_pembelian($periode_awal,$periode_akhir,true);
		$html=$this->load->view('laporan_pembelian/pdf_lap_retur_pembelian', $data, true);
		$this->pdf->pdf_create($html, 'laporan_retur_pembelian','letter','landscape');
	}
	
	function form_lap_saldo_stok(){
		$this->open();
		$this->load->view('laporan_pembelian/form_lap_saldo_stok');
		$this->close();
	}
	
	function view_lap_saldo_stok(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->lap_pembelian->get_lap_saldo_stok($periode_awal,$periode_akhir);
			$this->load->view('laporan_pembelian/view_lap_saldo_stok', $data);
		}
	}
	
	function excel_lap_saldo_stok(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=laporan_saldo_stok.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	function pdf_lap_saldo_stok(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->lap_pembelian->get_lap_saldo_stok($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_pembelian/pdf_lap_saldo_stok', $data, true);
        $this->pdf->pdf_create($html, 'laporan_saldo_stok','letter','landscape');
	}
	
	
}