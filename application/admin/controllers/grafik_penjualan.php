<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grafik_penjualan extends My_Controller
{
	    public $swfcharts ;
		public $swfchartsdetail ;
		
		var $title = 'chart';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_grafik_penjualan', 'gfk_penjualan');
		$this->load->helper(array('fusioncharts')) ;
		$this->load->library('fungsi');
	}
	
	function index()
	{
		$this->open();
		
	
		$config['base_url'] = base_url().'index.php/penjualan/index/';
		
		$this->pagination->initialize($config);	
		
		
		
		/*$data['results'] = $this->grafik_pembelian->getItem($config['per_page'], $this->uri->segment(3)); */
		
		
		$this->load->view('grafik_penjualan/form_grafik_penjualan');
		
		$this->close();
	}
	
	function view_grafik_penjualan(){
		$this->open();
		$graph_swffile      = base_url().'asset/admin/flash/FCF_Line.swf' ;
		$graph_numberprefix = '' ;
		$graph_title		='';
		$graph_width        = 900 ;
		$graph_height       = 500 ;
		$periode_awal = $this->input->post('periode_awal');
		$periode_akhir = $this->input->post('periode_akhir');
		$filter = $this->input->post('filter');
			
		if ($filter=='1'){
			$value = $this->gfk_penjualan->get_gfk_penjualan_cabang($periode_awal,$periode_akhir);
			$data['graph_caption'] = 'Grafik Penjualan Cabang' ;
			$graph_numberPrefix    = '' ;
			$xname='Nama Cabang';
			$numberSuffix		   =' Units';
			if ($value==false){
					$this->data_kosong();
	
			}else{
			
				$a=0;
				foreach($value as $row){
					$arrData[$a][1] = $row->nama_cabang;
					$arrData[$a][2] = $row->jumlah_penjualan;
				
					$a++;	
				}	
					$strxml = "<graph bgColor='dfe1e3' showAlternateHGridColor='1' alternateHGridColor='f8f8f8' canvasBgAlpha='20' outCnvBaseFontColor='1145b4' canvasBorderThickness='0' divLineColor='c5c5c5'  showBorder='0' numberPrefix='".$graph_numberprefix."' formatNumberScale='0' decimalPrecision='0' xAxisName='" . $xname . "' yAxisName='Jumlah penjualan' rotateYAxisName='45' yAxisNameWidth='100' rotateNames='1'>";
			 
						/*Convert data to XML and append */
					foreach ($arrData as $arSubData) {
						$strxml .= "<set label='aaaaaaaaa' name='" . $arSubData[1] . "' value='" . $arSubData[2] . "' color='".getFCColor()."' />";
					}
						/*Close <chart> element */
					$strxml .= "</graph>";
					 
					$data['graph']  = renderChart($graph_swffile, $graph_title, $strxml, "div" , $graph_width, $graph_height); 
					$this->load->view('grafik_penjualan/chart_view',$data) ;

				
			}
		}elseif ($filter=='2'){
			$value=$this->gfk_penjualan->get_gfk_penjualan_barang($periode_awal,$periode_akhir);
			$data['graph_caption'] = 'Grafik Penjualan Barang' ;
			$graph_numberPrefix    = 'Rp ' ;
			$numberSuffix		   ='';
			$xname='Nama Barang';
				if($value==false){	
					$this->data_kosong();
				}else{
					$a=0;
					foreach($value as $row){
						$arrData[$a][1] = $row->nama_barang;
						$arrData[$a][2] = $row->jumlah_penjualan;
						
						$a++;
					}
							
			
					$strxml = "<graph bgColor='dfe1e3' showAlternateHGridColor='1' alternateHGridColor='f8f8f8' canvasBgAlpha='20' outCnvBaseFontColor='1145b4' canvasBorderThickness='0' divLineColor='c5c5c5'  showBorder='0' numberPrefix='".$graph_numberprefix."' formatNumberScale='0' decimalPrecision='0' xAxisName='" . $xname . "' yAxisName='Jumlah penjualan' rotateYAxisName='45' yAxisNameWidth='100' rotateNames='1'>";
				 
							/*Convert data to XML and append */
						foreach ($arrData as $arSubData) {
							$strxml .= "<set label='aaaaaaaaa' name='" . $arSubData[1] . "' value='" . $arSubData[2] . "' color='".getFCColor()."' />";
						}
							/*Close <chart> element */
						$strxml .= "</graph>";
						 
					$data['graph']  = renderChart($graph_swffile, $graph_title, $strxml, "div" , $graph_width, $graph_height); 
					$this->load->view('grafik_penjualan/chart_view',$data) ;

				}	
			}	
		
		$this->close();

	}



	function show_report(){
		$periode_awal = $this->uri->segment('3');
		$periode_akhir = $this->uri->segment('4');
		
		if (($periode_awal)&&($periode_akhir)){
			$data['periode_awal']=$periode_awal;
			$data['periode_akhir']=$periode_akhir;
			$data['results'] = $this->lap_pembelian->getItem($periode_awal,$periode_akhir);
			$this->load->view('grafik_penjualan/show_report', $data);
		}
	}
	
	function data_kosong(){
		$this->load->view('grafik_penjualan/view_data_kosong');
	}
	
		
}