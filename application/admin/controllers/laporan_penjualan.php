<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_penjualan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_laporan_penjualan', 'lap_penjualan');
		$this->load->library('pdf');
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/pembelian/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->laporan_penjualan->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('laporan_penjualan/filter_laporan_penjualan');
		
		$this->close();
	}
	
	
	function form_lap_penjualan_periode(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_penjualan_periode');
		$this->close();
	}
	
	
	function view_lap_penjualan_periode(){

		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->lap_penjualan->get_lap_penjualan_periode($periode_awal,$periode_akhir);
			$this->load->view('laporan_penjualan/view_lap_penjualan_periode', $data);
		}
	}
	
	function report_pdf(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		$data['periode_awal']=$this->fungsi->dateindo3('-',$periode_awal);
		$data['periode_akhir']=$this->fungsi->dateindo3('-',$periode_akhir);
		$data['results'] = $this->lap_penjualan->get_lap_penjualan_periode($periode_awal,$periode_akhir);
		$data['date_now']=$this->fungsi->dateindo3('-',date('Y-m-d'));
        $html = $this->load->view('laporan_penjualan/pdf_lap_penjualan_periode', $data, true);
        $this->pdf->pdf_create($html, 'laporan_penjualan','letter','landscape');
	}
	
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_penjualan_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	function form_lap_penjualan_barang(){
		$this->open();
		$data['barang'] = $this->lap_penjualan->get_item_barang(false);
		$data['num'] = $this->lap_penjualan->get_item_barang(true);
		$this->load->view('laporan_penjualan/form_lap_penjualan_barang',$data);
		$this->close();
	}
	
	function view_lap_penjualan_barang(){
		$cek_pilihan = $this->uri->segment('3');
		
		/* $periode_akhir = $this->uri->segment('4'); */
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		
		$date_now=date('d M Y');
	
		$data['dt_nama_barang'] = $nama_barang;
		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,false);
			 $data['num'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_penjualan_barang', $data);
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_penjualan/pdf_lap_penjualan_brg', $data);
				$this->pdf->pdf_create($html, 'laporan_penjualan_barang','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_penjualan_perbarang.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }
		
		
	}
	
	function pdf_lap_penjualan_brg(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$nama_barang = $this->input->post('nama_barang');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,false);
		$data['num'] = $this->lap_penjualan->get_lap_penjualan_barang($periode_awal,$periode_akhir,$nama_barang,true);
		$html=$this->load->view('laporan_penjualan/pdf_lap_penjualan_brg', $data, true);
		$this->pdf->pdf_create($html, 'laporan_penjualan_barang','letter','landscape');
	}
	
	function get_barang(){
		$data['barang'] = $this->lap_penjualan->get_item_barang(false);
		$data['num'] = $this->lap_penjualan->get_item_barang(true);
		$this->load->view('laporan_penjualan/get_barang',$data);
	}
	
	function search_barang()
	{
		$key = $this->uri->segment(3,0);
		
		$perpage=15;
		$total_page=$this->lap_penjualan->get_barang_like($key,true);	
		$data['num'] = $total_page;
		
		$data['barang'] = $this->lap_penjualan->get_barang_like($key,false);
		$this->load->view('laporan_penjualan/get_barang',$data);
	}
	
	
	/*laporan persupplier */
	function form_lap_penjualan_pelanggan(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_penjualan_pelanggan');
		$this->close();
	}
	
	function get_pelanggan(){
		$data['pelanggan'] = $this->lap_penjualan->get_pelanggan(false);
		$data['num'] = $this->lap_penjualan->get_pelanggan(true);
		$this->load->view('laporan_penjualan/get_pelanggan',$data);
	}
	
	function search_pelanggan()
	{
		$key = $this->uri->segment(3,0);
	
		$perpage=15;
		$total_page=$this->lap_penjualan->get_pelanggan_like($key,true);	
		$data['num'] = $total_page;
		
		$data['pelanggan'] = $this->lap_penjualan->get_pelanggan_like($key,false);
		$this->load->view('laporan_penjualan/get_pelanggan',$data);
	}
	
	function view_lap_penjualan_pelanggan(){
		$cek_pilihan = $this->uri->segment('3');
		
		
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$id_pelanggan = $this->input->post('nama');
		
		$date_now=date('d M Y');

		$data['dt_nama_supplier'] = $id_pelanggan;
		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_penjualan->get_lap_penjualan_pelanggan($periode_awal,$periode_akhir,$id_pelanggan,false);
			 $data['num'] = $this->lap_penjualan->get_lap_penjualan_pelanggan($periode_awal,$periode_akhir,$id_pelanggan,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_penjualan_pelanggan', $data);
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_penjualan/pdf_lap_penjualan_supplier', $data);
				$this->pdf->pdf_create($html, 'laporan_penjualan_pelanggan','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_penjualan_perpelanggan.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }

		
	}
	
	function pdf_lap_penjualan_pelanggan(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$id_pelanggan = $this->input->post('nama_supplier');
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_penjualan->get_lap_penjualan_pelanggan($periode_awal,$periode_akhir,$id_pelanggan,false);
		$data['num'] = $this->lap_penjualan->get_lap_penjualan_pelanggan($periode_awal,$periode_akhir,$id_pelanggan,true);
		$html=$this->load->view('laporan_penjualan/pdf_lap_penjualan_pelanggan', $data, true);
		/*$this->load->view('laporan_penjualan/pdf_lap_penjualan_pelanggan', $data, true); */
		$this->pdf->pdf_create($html, 'laporan_penjualan_pelanggan','letter','landscape');
	}
	
	/*laporan return penjualan	 */
	function form_lap_retur_penjualan(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_retur_penjualan');
		$this->close();
	}
	
	function view_lap_retur_penjualan(){
		
		$cek_pilihan = $this->uri->segment('3');
		
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$date_now=date('d M Y');

		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_penjualan->get_lap_retur_penjualan($periode_awal,$periode_akhir,false);
			 $data['num'] = $this->lap_penjualan->get_lap_retur_penjualan($periode_awal,$periode_akhir,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_retur_penjualan', $data);
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_penjualan/pdf_lap_pembelian_brg', $data);
				$this->pdf->pdf_create($html, 'laporan_pembelian_barang','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_retur_penjualan.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }

		
	}
	
	function pdf_lap_retur_penjualan(){
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		$data['results'] = $this->lap_penjualan->get_lap_retur_penjualan($periode_awal,$periode_akhir,false);
		$data['num'] = $this->lap_penjualan->get_lap_retur_penjualan($periode_awal,$periode_akhir,true);
		$html=$this->load->view('laporan_penjualan/pdf_lap_retur_penjualan', $data, true);
		$this->pdf->pdf_create($html, 'laporan_penjualan_pelanggan','letter','landscape');
	}
	
	function form_lap_services(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_service');
		$this->close();
	}
	
	function view_lap_service(){
		
		$cek_pilihan = $this->uri->segment('3');
		$periode_awal = $this->uri->segment('4');
		$periode_akhir = $this->uri->segment('5');
		
		
	
		$date_now=date('d M Y');
	
		 if (($periode_awal)&&($periode_akhir)){
			 $data['periode_awal']=$periode_awal;
			 $data['periode_akhir']=$periode_akhir;
			 $data['results'] = $this->lap_penjualan->get_lap_service($periode_awal,$periode_akhir,false);
			 $data['num'] = $this->lap_penjualan->get_lap_service($periode_awal,$periode_akhir,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_service', $data);
			}elseif($cek_pilihan=='v_pdf'){
				$html=$this->load->view('laporan_penjualan/pdf_lap_service', $data);
				$this->pdf->pdf_create($html, 'laporan_service','letter','landscape');
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_service.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		 }

		
	}
	
	
	
	function form_lap_point_member(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_point_member');
		$this->close();
	}
	
	function get_member(){
		$data['pelanggan'] = $this->lap_penjualan->get_pelanggan(false);
		$data['num'] = $this->lap_penjualan->get_pelanggan(true);
		$this->load->view('laporan_penjualan/get_member',$data);
	}
	
	function search_member()
	{
		$key = $this->uri->segment(3,0);
		
		$perpage=15;
		$total_page=$this->lap_penjualan->get_pelanggan($key,true);	
		$data['num'] = $total_page;
		
		$data['pelanggan'] = $this->lap_penjualan->get_pelanggan($key,false);
		$this->load->view('laporan_penjualan/get_member',$data);
	}
	
	function view_lap_point_member(){
		$kode_pelanggan= $this->input->post('nama');
		$data['kode_pelanggan']=$kode_pelanggan;
		$cek_pilihan = $this->uri->segment('3');

		$date_now=date('d M Y');

			 $data['results'] = $this->lap_penjualan->get_lap_point_member($kode_pelanggan,false);
			 $data['num'] = $this->lap_penjualan->get_lap_point_member($kode_pelanggan,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_point_member', $data);
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_point_member.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		
	}
	
	function pdf_lap_point_member(){	
		$kode_pelanggan = $this->input->post('nama');
		
		$data['results'] = $this->lap_penjualan->get_lap_point_member($kode_pelanggan,false);
		$data['num'] = $this->lap_penjualan->get_lap_point_member($kode_pelanggan,true);
			 
		$html=$this->load->view('laporan_penjualan/pdf_lap_point_member', $data, true);
		
		$this->pdf->pdf_create($html, 'laporan_point_member','letter','landscape');
	}
	
	function form_lap_point_karyawan(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_point_karyawan');
		$this->close();
	}

	
	function get_karyawan(){
		$data['karyawan'] = $this->lap_penjualan->get_karyawan(false);
		$data['num'] = $this->lap_penjualan->get_karyawan(true);
		$this->load->view('laporan_penjualan/get_karyawan',$data);
	}
	
	function search_karyawan()
	{
		$key = $this->uri->segment(3,0);
		
		$perpage=15;
		$total_page=$this->lap_penjualan->get_karyawan_like($key,true);	
		$data['num'] = $total_page;
		
		$data['karyawan'] = $this->lap_penjualan->get_karyawan_like($key,false);
		$this->load->view('laporan_penjualan/get_karyawan',$data);
	}
	
	
	function view_lap_point_karyawan(){
		$kode_karyawan = $this->input->post('nama');
		$data['kode_karyawan']=$kode_karyawan;
		$cek_pilihan = $this->uri->segment('3');

		$date_now=date('d M Y');

			 $data['results'] = $this->lap_penjualan->get_lap_point_karyawan($kode_karyawan,false);
			 $data['num'] = $this->lap_penjualan->get_lap_point_karyawan($kode_karyawan,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_point_karyawan', $data);
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_point_karyawan.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		
	}
	
	function pdf_lap_point_karyawan(){	
		$kode_karyawan = $this->input->post('nama');
		
		$data['results'] = $this->lap_penjualan->get_lap_point_karyawan($kode_karyawan,false);
		 $data['num'] = $this->lap_penjualan->get_lap_point_karyawan($kode_karyawan,true);
			 
		$html=$this->load->view('laporan_penjualan/pdf_lap_point_karyawan', $data, true);
		$this->pdf->pdf_create($html, 'laporan_penjualan_barang','letter','landscape');
	}
	
	function form_lap_penjualan_area(){
		$this->open();
		$this->load->view('laporan_penjualan/form_lap_penjualan_area');
		$this->close();
	}
	
	function get_area(){
		$data['area'] = $this->lap_penjualan->get_area(false);
		$data['num'] = $this->lap_penjualan->get_area(true);
		$this->load->view('laporan_penjualan/get_area',$data);
	}
	
	function search_area()
	{
		$key = $this->uri->segment(3,0);
		
		$perpage=15;
		$total_page=$this->lap_penjualan->get_area_like($key,true);	
		$data['num'] = $total_page;
		
		$data['area'] = $this->lap_penjualan->get_area_like($key,false);
		$this->load->view('laporan_penjualan/get_area',$data);
	}
	
	function view_lap_area(){
		$kode_area = $this->input->post('nama');
		
		$periode_awal = $this->uri->segment('4');
		$periode_akhir = $this->uri->segment('5');
		
		$data['kode_area']=$kode_area;
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;

		$cek_pilihan = $this->uri->segment('3');

		$date_now=date('d M Y');

			 $data['results'] = $this->lap_penjualan->get_lap_penjualan_area($periode_awal,$periode_akhir,$kode_area,false);
			 $data['num'] = $this->lap_penjualan->get_lap_penjualan_area($periode_awal,$periode_akhir,$kode_area,true);
			if ($cek_pilihan=='v_html'){
				$this->load->view('laporan_penjualan/view_lap_penjualan_area', $data);
			}elseif($cek_pilihan=='v_excel'){
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=laporan_penjualan_area.xls");
				echo  $this->input->post('rekap_tabel1');
			}
		
	}
	function pdf_lap_penjualan_area(){
		$kode_area = $this->input->post('nama');
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		
		$data['periode_awal']=$periode_awal;
		$data['periode_akhir']=$periode_akhir;
		
		$data['results'] = $this->lap_penjualan->get_lap_penjualan_area($periode_awal,$periode_akhir,$kode_area,false);
		$data['num'] = $this->lap_penjualan->get_lap_penjualan_area($periode_awal,$periode_akhir,$kode_area,true);
			 
		$html=$this->load->view('laporan_penjualan/pdf_lap_penjualan_area', $data, true);
		
		$this->pdf->pdf_create($html, 'laporan_penjualan_area','letter','landscape');
	}

}