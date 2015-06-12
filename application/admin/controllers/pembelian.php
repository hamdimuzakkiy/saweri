<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_pembelian', 'pembelian');				
		$this->load->model('mdl_kode_trans', 'kode_trans');				
		$this->load->model('mdl_hutang', 'hutang');		
		$this->load->library('fungsi');
		$this->load->library('pdf');
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();

		$config['base_url'] = base_url().'index.php/pembelian/index/';
		$config['total_rows'] = sizeof($this->pembelian->count()->result());
		$config['per_page'] = '20';
		$config['num_links'] = '10';
		$config['uri_segment'] = '3';
		
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$this->pagination->initialize($config);	

		$data['results'] = $this->pembelian->getItem($config['per_page'], $this->uri->segment(3));		
		
		$this->load->view('pembelian/pembelian_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();		
	 	$data['id_pembelian'] = $this->input->post('id_pembelian');
		$data['po_no'] = $this->input->post('po_no');
		$data['id_supplier'] = $this->input->post('id_supplier');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['tanggal'] = $this->input->post('tanggal');						
		$data['glid'] = $this->input->post('glid');		
		$sums = $this->input->post('sum');		
		$data['result_trans']=$this->kode_trans->get_kd_awal('pembelian');	
		$data['kode_transaksi']=$data['result_trans']->row()->kd_trans;
		$data['id_coa'] = '5';
		$data['userid'] = get_userid();		$data['glid'] 	= $this->hutang->get_glid();

		$data['diskon'] = $this->input->post('diskon'); // diskon

		$data['kas'] = $this->input->post('kas'); // kas
		$data['kas'] = explode('/', $data['kas'])[0];
	
		$data['cara_bayar'] = $this->input->post('cara_bayar'); // cara bayar
		$data['jatuh_tempo'] = $this->input->post('pembelian_jatuh_tempo');

		$data['nama_atm'] = $this->input->post('nama_atm'); //M card
		$data['nomor_atm'] = $this->input->post('nomor_atm');
		$data['id_beban_transaksi'] = explode('/', $this->input->post('beban_transaksi'))[0];		

		if ($data['cara_bayar'] != 'Cash')
		{
			$data['kas'] = '';
			$data['id_beban_transaksi'] = -1;
		}

		if ($data['id_beban_transaksi'] == -1)
		{
			$data['nama_atm'] = '';
			$data['nomor_atm'] = '';
		}

		$this->form_validation->set_rules('po_no', 'po_no', 'required');
		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');				 			 		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
			

		if ($this->form_validation->run() == FALSE)
		{
			$data['total_kas'] = $this->pembelian->get_total_kas();
			$this->load->view('pembelian/pembelian_add',$data);		
		}		
		else
		{	
			$beban = explode('/', $this->input->post('beban_transaksi'))[1];
			if ($data['id_beban_transaksi'] == -1)
				$beban = 0;
			$get_kas_v2 = $this->pembelian->get_total_kas_v2($data['kas']);
			
			foreach ($get_kas_v2->result() as $row) 
			{
				$cur_saldo =  $row->saldo;
			}
			
			if ($data['kas'] == '')
			{

			}
			else if ($cur_saldo < (($sums*(100-$data['diskon'])/100)+$sums*($beban/100)))
			{				
				$this->session->set_flashdata('message', 'Saldo Tidak Mencukupi!');
				redirect('pembelian/insert');				
			}

			$pembelian['beban_transaksi'] = $beban;
			$pembelian['id_beban_transaksi'] = $data['id_beban_transaksi'];
			$pembelian['id_pembelian'] 	= $data['id_pembelian'];			
			$pembelian['po_no'] 		= $data['po_no'];			
			$pembelian['id_supplier'] 	= $data['id_supplier'];
			$pembelian['id_cabang'] 	= $data['id_cabang'];
			$pembelian['tanggal'] 		= $data['tanggal'];
			$pembelian['diskon'] 		= $data['diskon'];
			$pembelian['id_coa'] 		= $data['id_coa'];
			$pembelian['userid'] 		= $data['userid'];			
			$pembelian['cara_bayar'] 	= $data['cara_bayar'];
			$pembelian['kode_kas'] 		= $data['kas'];								
			$pembelian['jatuh_tempo'] 	= $data['jatuh_tempo'];								
			$pembelian['nama_atm'] 		= $data['nama_atm'];								
			$pembelian['nomor_atm'] 	= $data['nomor_atm'];								
			$cara_bayar=$data['cara_bayar'];
			
			
			$detail			= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			$total_penjumlahan = 0;
			for($i=0; $i<$count_detail; $i++)			
			{
							$a = $detail[$i]['id_barang'];				
				$query = "SELECT id_kategori FROM barang where id_barang = '". $a ."'";				
				$result = mysql_query($query);				
				$hasil = mysql_fetch_array($result);																				
				{					
					$qty_pembelian = $detail[$i]['qty'];											
					for ($j=0;$j<$qty_pembelian;$j++)
					{							
						$data_['id_pembelian'] 		= $pembelian['id_pembelian'];							
						print $data_['id_barang'] 		= $detail[$i]['id_barang'];							
						$data_['harga'] 			= $detail[$i]['harga'];							
						/*$data_['qty'] 				= $detail[$i]['qty']; */							
						$data_['qty'] 				= 1;
						$data_['sn'] 				= $detail[$i]['sn'];							
						$data_['jatuh_tempo'] 		= $detail[$i]['jatuh_tempo'];							
						$data_['total'] 			= $detail[$i]['total'];							
						$data_['posisi_pusat'] 		= 1;																					
						$total_penjumlahan			= $total_penjumlahan + $detail[$i]['total'];														
						$this->pembelian->insert_detail($data_);														
						$this->db->flush_cache();						
					}					
					
					$data_update = 	array(
										'harga_toko' => $detail[$i]['harga_toko'],
										'harga_partai' => $detail[$i]['harga_partai'],
										'harga_cabang' => $detail[$i]['harga_cabang']
									);
					$this->db->where('id_barang', $detail[$i]['id_barang']);				
					$this->db->update('barang', $data_update);				
					}
			}									
			$hutang['KOUNIT'] 		= $data['id_cabang'];			
			$hutang['TANGGAL'] 		= $data['tanggal'];			
			$hutang['po_no'] 		= $data['po_no'];						
			$hutang['GLID'] 		= $data['glid'];			
			$hutang['AKUN'] 		= '';								
			$hutang['KODE_PARTNER'] = $data['id_supplier'];												
			$hutang['JUMLAH'] 		= $total_penjumlahan;						
			$hutang['CUID'] 		= $data['userid'];			
			$hutang['CDATE'] 		= date('Y-m-d'); 			
			$hutang['MUID'] 		= '';			
			$hutang['MDATE'] 		= '';						
			$pembelian['total'] 		= $total_penjumlahan*(100-$data['diskon'])/100;
			$data['total_kas'] = $this->pembelian->get_total_kas();

			foreach($data['total_kas']->result() as $row)			
			{				
			/*if (($total_penjumlahan > $row->total_kas)&&($cara_bayar=='1'))				
			{
				$this->session->set_flashdata('message', 'Uang di kas tidak mencukupi!!'); 						
				redirect('pembelian/insert');				
			}			*/
		}			 		

				$u_kas['saldo']	= $cur_saldo - $sums;
				$this->pembelian->insert($pembelian);
				$this->pembelian->update_kas($data['kas'],$u_kas);
				if ($cara_bayar=='2'){
				$this->hutang->insert($hutang);			
			}									
			if(get_kodecabang() == '001'){		
				$x=0;
				$i=0;
				
				$qty = 0;
				$total = 0;
				$tmp_iditem='';
				$group_item;
				
				for($i=0; $i<$count_detail; $i++)
				{
					if ($tmp_iditem == ''){
						$tmp_iditem = $detail[$i]['id_barang'];
						$qty++;
						$total = $qty * $detail[$i]['total'];
						
						$group_item[$x]['id_barang'] = $tmp_iditem;
						$group_item[$x]['qty'] = $qty;
						$group_item[$x]['total'] = $total;
						
						
					}else if($tmp_iditem == $detail[$i]['id_barang']){
						$tmp_iditem = $detail[$i]['id_barang'];
						$qty++;
						$total = $qty * $detail[$i]['total'];
						
						$group_item[$x]['id_barang'] = $tmp_iditem;
						$group_item[$x]['qty'] = $qty;
						$group_item[$x]['total'] = $total;
						
					}else{
						$x++;
						$qty=0;
						$total=0;
						
						$tmp_iditem = $detail[$i]['id_barang'];
						$qty++;
						$total = $qty * $detail[$i]['total'];
						
						$group_item[$x]['id_barang'] = $tmp_iditem;
						$group_item[$x]['qty'] = $qty;
						$group_item[$x]['total'] = $total;
						
					}
					
				}
				$detail			= $group_item;
				$count_detail 	= count($detail);
				$i=0;
				
				$new_hpp = 0;
				
				
				for($i=0; $i<$count_detail; $i++)
				{
					$id_barang 	= $detail[$i]['id_barang'];
					$qty		= $detail[$i]['qty'];
					$total		= $detail[$i]['total'];
					
		
					$this->db->flush_cache();
					$this->db->from('barang');
					$this->db->where('id_barang', $id_barang);
					$query = $this->db->get();
					
					$hpp = $query->row()->hpp;
					
					if($hpp == 0 || $hpp == ''){
						$new_hpp = $total / $qty;
					
					}else{
						
						$this->db->flush_cache();
						$que = $this->db->query("	SELECT sum(detail_pembelian.qty) AS total 
													FROM `detail_pembelian` 
													INNER JOIN pembelian ON pembelian.id_pembelian = detail_pembelian.id_pembelian 
													WHERE detail_pembelian.id_barang = '$id_barang' AND detail_pembelian.soldout != '1' AND pembelian.id_cabang = '1' " );
						$qty_total = $que->row()->total;
						
						$new_hpp = ($hpp + $total) / ($qty_total);
						
					}

					$this->db->flush_cache();
					$this->db->where('id_barang', $id_barang);
					$this->db->update('barang', array('hpp'=>$new_hpp));
					
				}
			}
					
			
						$this->session->set_flashdata('message', 'Data Pembelian Berhasil disimpan.');
			redirect('pembelian');			
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->pembelian->getItemById($id);
		$data['id_pembelian']	= $id;
		
		$this->load->view('pembelian/pembelian_edit', $data);

		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();

		$data['id_pembelian'] = $this->input->post('id_pembelian');
		$data['po_no'] = $this->input->post('po_no');
		$data['id_supplier'] = $this->input->post('id_supplier');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['diskon'] = $this->input->post('diskon');
		$data['tanggal'] = $this->input->post('tanggal');

		
		$data['id_coa'] = '5';
		$data['userid'] = get_userid();
		
		

		$this->form_validation->set_rules('po_no', 'po_no', 'required');
		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		

		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('pembelian/pembelian_edit', $data); 
			
		}else{	
			
			$pembelian['id_pembelian'] 	= $data['id_pembelian'];
			$pembelian['po_no'] 		= $data['po_no'];
			$pembelian['id_supplier'] 	= $data['id_supplier'];
			$pembelian['id_cabang'] 	= $data['id_cabang'];
			$pembelian['tanggal'] 		= $data['tanggal'];
			$pembelian['diskon'] 		= $data['diskon'];
			$pembelian['id_coa'] 		= $data['id_coa'];
			$pembelian['userid'] 		= $data['userid'];
			$this->pembelian->update($pembelian['id_pembelian'], $pembelian);
			

			$this->db->flush_cache();
			$this->db->where('id_pembelian', $data['id_pembelian']);
			$this->db->delete('detail_pembelian');
			
			

			$detail			= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			
			for($i=0; $i<$count_detail; $i++)
			{				$a = $detail[$i]['id_barang'];				
			$query = "SELECT id_kategori,kategori FROM barang where id_barang = '". $a ."'";				
			$result = mysql_query($query);				
			$hasil = mysql_fetch_array($result);								
			$b = $pembelian['id_pembelian'];				
			$query2 = "SELECT cara_bayar FROM pembelian where id_pembelian = '". $b ."'";				
			$result2 = mysql_query($query2);				
			$hasil2 = mysql_fetch_array($result2);				
			if ((($hasil['id_kategori'] == '3')or ($hasil['id_kategori'] == '4') or ($hasil['id_kategori'] == '5') or ($hasil['id_kategori'] == '6') or ($hasil['id_kategori'] == '7'))&& ($detail[$i]['sn']=='')) 				{ 					$this->session->set_flashdata('message', 'Field Serial Number harus diisi!'); 					redirect('pembelian/insert');				
			}				
			else if (($hasil2['cara_bayar'] == '2')&&($detail[$i]['jatuh_tempo']==''))				
			{ 					
			$this->session->set_flashdata('message', 'Field Jatuh Tempo harus diisi!'); 					
			redirect('pembelian/insert');				} 				
			else				{				
			$data_['id_pembelian'] 		= $pembelian['id_pembelian'];
				$data_['id_barang'] 		= $detail[$i]['id_barang'];
				$data_['harga'] 			= $detail[$i]['harga'];
				$data_['qty'] 				= $detail[$i]['qty'];
				$data_['sn'] 				= $detail[$i]['sn'];
				$data_['jatuh_tempo'] 		= $detail[$i]['jatuh_tempo'];
				$data_['total'] 			= $detail[$i]['total'];
				$data['total_kas'] = $this->pembelian->get_total_kas(); 
				foreach($data['total_kas']->result() as $row)				{ 				
				$b = $pembelian['id_pembelian'];				
				$query2 = "SELECT cara_bayar FROM pembelian where id_pembelian = '". $b ."'";				
				$result2 = mysql_query($query2);				
				$hasil2 = mysql_fetch_array($result2);				
				if (($detail[$i]['total'] > $row->total_kas)&&($hasil2['cara_bayar']=='1'))				{					
				$this->session->set_flashdata('message', 'Uang di kas tidak mencukupi!!'); 						
				redirect('pembelian/insert');				}				
				}				 
				$this->pembelian->insert_detail($data_);		
				$this->db->flush_cache();
				
				$data_update = 	array(
									'harga_toko' => $detail[$i]['harga_toko'],
									'harga_partai' => $detail[$i]['harga_partai'],
									'harga_cabang' => $detail[$i]['harga_cabang']
								);
				
				$this->db->where('id_barang', $detail[$i]['id_barang']);
				
				$this->db->update('barang', $data_update);				}
			}
			
			
			$this->session->set_flashdata('message', 'Data Pembelian Berhasil diupdate.');
			redirect('pembelian');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->pembelian->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('pembelian');
	}
	function view($id)
	{					
		$data['results'] = $this->pembelian->getItemById($id);
		$data['result'] = $this->pembelian->get_detail_versi2($id);
		$this->load->view('pembelian/pembelian_view', $data);
	}
	
	function show_barang()
	{
		$data['result'] = $this->pembelian->get_barang();
		$this->load->view('pembelian/list_barang.php', $data);
	}
	
	function view_lap_pembelian()
	{
		$id = $this->uri->segment('3');
		$data['results'] = $this->pembelian->getItemById($id);
		#$data['results2'] = $this->pembelian->get_detail($id);
		$data['results2'] = $this->pembelian->get_detail_versi2($id);
		$this->load->view('pembelian/view_lap_pembelian', $data);
	}

	function report_pdf()
	{
		$id = $this->uri->segment('3');
		$data['results'] = $this->pembelian->getItemById($id);
		$data['results2'] = $this->pembelian->get_detail($id);
		$html = $html=$this->load->view('pembelian/pdf_laporan_pembelian', $data, true);
		$this->pdf->pdf_create($html, 'laporan_biaya','letter','landscape');
	}
	
}
