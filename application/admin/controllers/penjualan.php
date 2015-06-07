<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_penjualan', 'penjualan');
		$this->load->model('mdl_piutang', 'piutang');
		$this->load->model('mdl_kode_trans', 'kode_trans');
		$this->load->model('mdl_pelanggan', 'pelanggan');
		$this->load->model('mdl_cabang', 'cabang');
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		/* config pagination */
		
		$config['base_url'] = base_url().'index.php/penjualan/index/';
		$totals =  $this->penjualan->counts();
		$config['total_rows'] = sizeof($totals->result());
		//$config['total_rows'] = $this->penjualan->getItem('penjualan');

		$config['per_page'] = '50';
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
		$data['results'] = $this->penjualan->getItem($config['per_page'], $this->uri->segment(3));	
		$this->load->view('penjualan/penjualan_list', $data);
		$this->close();
	}
	
	function insert()
	{
		if ($this->can_insert() == FALSE)
		{
			redirect('auth/failed');
		}
		
		$this->open();
				
		$data['id_penjualan'] = $this->input->post('id_penjualan');//simpan ke $data
		$data['so_no'] = $this->input->post('so_no');
		$data['id_pelanggan'] = $this->input->post('id_pelanggan');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['id_jenis_penjualan'] = $this->input->post('id_jenis_penjualan');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['alamat'] = $this->input->post('alamat');
		$data['kas'] = $this->input->post('kas');
		$data['nama_atm'] = $this->input->post('atm');
		$data['nama_rekening'] = $this->input->post('nama_rekening');
		$data['cara_bayar'] = $this->input->post('cara_bayar');
		$data['pil_penjualan'] = $this->input->post('pil_penjualan');
		$data['jatuh_tempo'] = $this->input->post('jatuh_tempo');
		$data['nomor_atm'] = $this->input->post('nomor_atm');

		$cara_bayar = $data['cara_bayar'];
		$data['result_trans'] = $this->kode_trans->get_kd_awal('penjualan');//?
		$data['kode_transaksi'] = $data['result_trans']->row()->kd_trans;//?
		//$data['diskon'] = $this->input->post('diskon');

		$data['id_coa'] = '5';
		$data['userid'] = get_userid();
		$data['glid'] 	= $this->piutang->get_glid();
				
		$this->form_validation->set_rules('so_no', 'so_no', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
		$this->form_validation->set_message('required', 'Field harus diisi!');

		if ($this->form_validation->run() == FALSE)
		{			
			$this->load->view('penjualan/penjualan_add',$data);
			
		}
		else
		{	
									
 			$penjualan['id_penjualan'] 		= $data['id_penjualan']; 			 
			$penjualan['so_no'] 			= $data['so_no'];
			$penjualan['id_pelanggan'] 		= $data['id_pelanggan'];
			$penjualan['id_cabang'] 		= $data['id_cabang'];
			$penjualan['id_jpenjualan'] 	= $data['id_jenis_penjualan'];			 
			$penjualan['tanggal'] 			= $data['tanggal'];
			$penjualan['alamat']		 	= $data['alamat'];
			$penjualan['nama_atm']			= $data['nama_atm'];
			$penjualan['kode_kas']			= $data['kas'];
			$penjualan['cara_bayar'] 		= $data['cara_bayar'];
			$penjualan['nomor_atm']			= $data['nomor_atm'];
			$penjualan['nama_rekening']		= $data['nama_rekening'];
			$penjualan['jatuh_tempo'] 		= $data['jatuh_tempo'];			 
			//$penjualan['diskon'] 			= $data['diskon'];
			$penjualan['id_coa'] 			= $data['id_coa'];
			$penjualan['userid'] 			= $data['userid'];
			
			
			$detail	= $this->input->post('detail');
			$count_detail = count($detail);
			$i=0;
			$total_penjumlahan = 0;
			$total_penjumlahan2 = 0;
			$saldo_sum_total = 0;
			
		if ($data['pil_penjualan']=='pelanggan')
		{		
			for($i=0; $i<$count_detail; $i++)
			{
				$data['total']	 			= $detail[$i]['total'];
				$total_penjumlahan2			= $total_penjumlahan2 + $detail[$i]['total'];
			}	
							
			$data['result_sum_total']=$this->penjualan->get_total_penjualan_by_pelanggan($data['id_pelanggan']);
			$data['result_pelanggan']=$this->pelanggan->getItemById($data['id_pelanggan']);
				
			foreach ($data['result_sum_total']->result() as $rows)
			{
				$saldo_sum_total=$rows->sum_total;
			}
				
			$saldo_piutang = $data['result_pelanggan']->row()->saldo_piutang;
			$saldo_piutang_pelanggan = $saldo_sum_total + $total_penjumlahan2;
							
			if ($saldo_piutang_pelanggan > $saldo_piutang)
			{
				$data['message'] = 'Pelanggan Melebihi Saldo Piutang';
				$this->load->view('penjualan/penjualan_add',$data);
			}
			else
			{							
				for($i=0; $i<$count_detail; $i++)
				{
					$qty_penjualan=$detail[$i]['qty'];
					for ($j=0;$j<$qty_penjualan;$j++)
					{
						$data_['id_penjualan'] 			= $penjualan['id_penjualan'];									 	
						$data_['id_barang'] 			= $detail[$i]['id_barang'];
									
						$data_['id_detail_pembelian'] 	= (int)$detail[$i]['id_detail_pembelian']+$j;
									
						$data_['harga'] 				= $detail[$i]['harga'];
									
						/*$data_['qty'] 					= $detail[$i]['qty'];*/
						 $data_['qty'] 					= 1;
									
						 $data_['sn'] 					= $detail[$i]['sn'];
						
						 $data_['total'] 				= $detail[$i]['total'];
							
						 $total_penjumlahan				= $total_penjumlahan + $detail[$i]['total'];
									
						$this->penjualan->insert_detail($data_);
									
									
									/*
									update barang di tabel detail pembelian.
									untuk menandakan bawasannya barang sudah di jual, 
									sehingga barang nantinya tidak ditampilkan lagi di penjualan
									-------------------------------------------------------------
									
									*/
									
									$idcabang = get_idcabang();
									if ($idcabang==1)
									{
										$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], 'posisi_pusat', 'posisi_pelanggan', $data['id_pelanggan']);
									}
									else
									{
										$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], 'posisi_cabang', 'posisi_pelanggan', $data['id_pelanggan']);
									}
									

								}
							}
							
							/* ambil id barang dan point*/
							
							
							$piutang['KOUNIT'] 		= $data['id_cabang'];
							$piutang['TANGGAL'] 	= $data['tanggal'];
							$piutang['so_no'] 		= $data['so_no'];			
							$piutang['GLID'] 		= $data['glid'];
							$piutang['AKUN'] 		= '';
							$piutang['KODE_PARTNER']= $data['id_pelanggan'];			
							$piutang['JUMLAH'] 		= $total_penjumlahan;
							$piutang['CUID'] 		= $data['userid']; /* userid */
							$piutang['CDATE'] 		= date('Y-m-d'); /* tanggal sistem */
							$piutang['MUID'] 		= '';/*$data['MUID']; edit perubahan oleh user siapa */
							$piutang['MDATE'] 		= '';/*$data['MDATE']; tanggal perubahan terakhir */

							
							$penjualan['total'] 		= $total_penjumlahan;
							$penjualan['id_pelanggan'] 	= 'plg-' . $data['id_pelanggan'];
							$penjualan['id_cabang'] 	= get_idcabang();
							$this->penjualan->insert($penjualan);

								
					if ($cara_bayar=='2')
					{
						$this->piutang->insert($piutang);
					}
									
											
					/* ambil point barang dri tabel kmudian kaluklasikan dgn qty */					
					$this->db->flush_cache();
					$this->db->from('barang');
					$this->db->where('id_barang', $data_['id_barang']);
					$tb_barang = $this->db->get();
						
					$point_member=(int) $tb_barang->row()->point_member;
					$point_karyawan=(int) $tb_barang->row()->point_karyawan;
							
					$this->db->flush_cache();
					$this->db->from('pelanggan');
					$this->db->where('id_pelanggan', $data['id_pelanggan']);
					$tb_pelanggan = $this->db->get();
											
					$point_awal=(int) $tb_pelanggan->row()->point;
																						
					$this->db->flush_cache();
					$this->db->from('karyawan');
					$this->db->where('userid', $data['userid']);
					$tb_karyawan = $this->db->get();
					$point_awal_karyawan=(int) $tb_karyawan->row()->point;
					/* ambil point karyawan/pelanggan */
					/* dan kurangi dengan total point barang yg sudah di ambil*/
								
								
					$this->db->flush_cache();
					$this->db->where('id_pelanggan', $data['id_pelanggan']);
					$this->db->update('pelanggan', array('point' => ($point_awal + $point_member)));
									
					$this->db->flush_cache();
					$this->db->where('userid', $data['userid']);
					$this->db->update('karyawan', array('point' => ($point_awal_karyawan + $point_karyawan)));				
								
					$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
					redirect('penjualan');
				}
			}

			else
			{					
					
							for($i=0; $i<$count_detail; $i++)
							{
								
								$qty_penjualan=$detail[$i]['qty'];
								for ($j=0;$j<$qty_penjualan;$j++){
									$data_['id_penjualan'] 			= $penjualan['id_penjualan'];
									$data_['id_barang'] 			= $detail[$i]['id_barang'];
									$data_['id_detail_pembelian'] 	= (int)$detail[$i]['id_detail_pembelian']+$j;
									$data_['harga'] 				= $detail[$i]['harga'];
									/*$data_['qty'] 					= $detail[$i]['qty'];*/
									$data_['qty'] 					= 1;
									$data_['sn'] 					= $detail[$i]['sn'];
									$data_['total'] 				= $detail[$i]['total'];
									$total_penjumlahan				= $total_penjumlahan + $detail[$i]['total'];
									$this->penjualan->insert_detail($data_);
									
									$data__['id_penjualan'] 			= $penjualan['id_penjualan'];
									$data__['id_barang'] 			= $detail[$i]['id_barang'];
									$data__['harga'] 				= $detail[$i]['harga'];
									$data__['id_detail_pembelian'] 	= (int)$detail[$i]['id_detail_pembelian'] + $j;
									/*$data_['qty'] 					= $detail[$i]['qty'];*/
									$data__['qty'] 					= 1;
									$data__['sn'] 					= $detail[$i]['sn'];
									$data__['total'] 				= $detail[$i]['total'];
									$total_penjumlahan				= $total_penjumlahan + $detail[$i]['total'];
									
									/*
									update barang di tabel detail pembelian.
									untuk menandakan bawasannya barang sudah di jual, 
									sehingga barang nantinya tidak ditampilkan lagi di penjualan
									-------------------------------------------------------------
									*/
									
									$idcabang = get_idcabang();
									if ($idcabang==1){
										$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], 'posisi_pusat', 'posisi_cabang', $data['id_cabang']);
									}else{
										$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], 'posisi_pelanggan', 'posisi_cabang', $data['id_cabang']);
									}
									
									/*$this->penjualan->updateBarangPembelian('1');  */
								}
							}
							
							/* ambil id barang dan point*/
							
							
							$piutang['KOUNIT'] 		= $data['id_cabang'];
							$piutang['TANGGAL'] 	= $data['tanggal'];
							$piutang['so_no'] 		= $data['so_no'];			
							$piutang['GLID'] 		= $data['glid'];
							$piutang['AKUN'] 		= '';
									
							$piutang['KODE_PARTNER'] = $data['id_pelanggan'];			
							
							$piutang['JUMLAH'] 		= $total_penjumlahan;
							
							$piutang['CUID'] 		= $data['userid']; /* userid */
							
							$piutang['CDATE'] 		= date('Y-m-d'); /* tanggal sistem */
							
							$piutang['MUID'] 		= ''; /*$data['MUID'];  edit perubahan oleh user siapa */
							
							$piutang['MDATE'] 		= ''; /*$data['MDATE'];  tanggal perubahan terakhir */
							

							$penjualan['total'] 		= $total_penjumlahan;
							
							
							$penjualan['id_pelanggan'] 			= 'cbg-' . $data['id_pelanggan'];
							$this->penjualan->insert($penjualan);

								
								if ($cara_bayar=='2'){
									
										$this->piutang->insert($piutang);
								}
									
											
											/* ambil point barang dri tabel kmudian kaluklasikan dgn qty */
											
											$this->db->flush_cache();
											$this->db->from('barang');
											$this->db->where('id_barang', $data_['id_barang']);
											$tb_barang = $this->db->get();
											
											$point_member=(int) $tb_barang->row()->point_member;
											$point_karyawan=(int) $tb_barang->row()->point_karyawan;
											
											/**
											$this->db->flush_cache();
											$this->db->from('pelanggan');
											$this->db->where('id_pelanggan', $data['id_pelanggan']);
											$tb_pelanggan = $this->db->get();
											
											$point_awal=(int) $tb_pelanggan->row()->point; */
											
											
											$this->db->flush_cache();
											$this->db->from('karyawan');
											$this->db->where('userid', $data['userid']);
											$tb_karyawan = $this->db->get();
											
											$point_awal_karyawan=(int) $tb_karyawan->row()->point;
								/* ambil point karyawan/pelanggan */
								/* dan kurangi dengan total point barang yg sudah di ambil*/
								
									
									/**
									$this->db->flush_cache();
									$this->db->where('id_pelanggan', $data['id_pelanggan']);
									$this->db->update('pelanggan', array('point' => ($point_awal + $point_member))); */
									
									$this->db->flush_cache();
									$this->db->where('userid', $data['userid']);
									$this->db->update('karyawan', array('point' => ($point_awal_karyawan + $point_karyawan)));
								
								
								
								$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
								//redirect('penjualan');
					
			}
		}
		
		$this->close();
	}
	
		
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		
		$this->open();
		
		
		$data['id_penjualan'] = $this->input->post('id_penjualan');
		$data['so_no'] = $this->input->post('so_no');
		$data['id_pelanggan'] = $this->input->post('id_pelanggan');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['id_jenis_penjualan'] = $this->input->post('id_jenis_penjualan');
		$data['tanggal'] = $this->input->post('tanggal');
		
		/*
		$date = date_create($data['tanggal']);
		date_add($date, date_interval_create_from_date_string($this->input->post('jatuh_tempo').' days'));
		$data['jatuh_tempo'] = date_format($date, 'Y-m-d');
		*/
		$data['jatuh_tempo'] = $this->input->post('jatuh_tempo');
		
		$data['diskon'] = $this->input->post('diskon');
		$data['id_coa'] = '5';
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('so_no', 'so_no', 'required');
		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required');
		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('jatuh_tempo', 'jatuh_tempo', 'required');
		$this->form_validation->set_rules('diskon', 'diskon', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('penjualan/penjualan_add',$data);
			
		}
		else
		{				
			$penjualan['id_penjualan'] 			= $data['id_penjualan'];
			$penjualan['so_no'] 				= $data['so_no'];
			$penjualan['id_pelanggan'] 			= $data['id_pelanggan'];
			$penjualan['id_cabang'] 			= $data['id_cabang'];
			$penjualan['id_jpenjualan'] 		= $data['id_jenis_penjualan'];
			$penjualan['tanggal'] 				= $data['tanggal'];
			$penjualan['jatuh_tempo'] 			= $data['jatuh_tempo'];
			$penjualan['diskon'] 				= $data['diskon'];
			$penjualan['id_coa'] 				= $data['id_coa'];
			$penjualan['userid'] 				= $data['userid'];
			
			$this->penjualan->update($data['id_penjualan'], $penjualan);
			
			/* kembalikan status soldout menjadi 0 di tabel detail pembelian berdasarkan id detail pembelian yg di detail penjualan */
			
			$detail	= $this->input->post('detail');
			$count_detail = count($detail);
			$i=0;
			for($i=0; $i<$count_detail; $i++)
			{
				$this->penjualan->updateBarangPembelian($detail[$i]['id_detail_pembelian'], '0');
			}
			
			/* hapus data detail penjualan lama */
			
			$this->db->flush_cache();
			$this->db->where('id_penjualan', $data['id_penjualan']);
			$this->db->delete('detail_penjualan');
			
			/* update ke table detail penjualan */
			
			$i=0;
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_penjualan'] 			= $penjualan['id_penjualan'];
				$data_['id_barang'] 			= $detail[$i]['id_barang'];
				$data_['id_detail_pembelian'] 	= $detail[$i]['id_detail_pembelian'];
				$data_['harga'] 				= $detail[$i]['harga'];
				$data_['qty'] 					= $detail[$i]['qty'];
				$data_['sn'] 					= $detail[$i]['sn'];
				$data_['total'] 				= $detail[$i]['total'];
				
				$this->penjualan->insert_detail($data_);
				
				/*
				update barang di tabel detail pembelian.
				untuk menandakan bawasannya barang sudah di jual, 
				sehingga barang nantinya tidak ditampilkan lagi di penjualan
				-------------------------------------------------------------
				*/
				
				$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], '1');
				
			}
			
			
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			//redirect('penjualan');
		}
		
		$this->close();
		
	}

	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->penjualan->getItemById($id);
		
		$data['id_penjualan'] = $id;
		
		
		$this->load->view('penjualan/penjualan_edit', $data);
		
		$this->close();
	}
	
	function check_saldo_piutang()
	{
		/*$output_string = "nilai";
		
		echo json_encode($output_string);*/
		
		$data['id_pelanggan'] = $this->input->post('id_pelanggan');
		$detail	= $this->input->post('detail');
		
		$count_detail = count($detail);
		$total_penjumlahan2=0;
		$saldo_sum_total=0;
		for($i=0; $i<$count_detail; $i++)
						{
							$data__['total'] 				= $detail[$i]['total'];
							$total_penjumlahan2				= $total_penjumlahan2 + $detail[$i]['total'];
						}
			$data['result_sum_total']=$this->penjualan->get_total_penjualan_by_pelanggan($data['id_pelanggan']);
			$data['result_pelanggan']=$this->pelanggan->getItemById($data['id_pelanggan']);
			
			foreach ($data['result_sum_total']->result() as $rows){
				$saldo_sum_total=$rows->sum_total;
			}
			
				/*$saldo_sum_total=$data['result_sum_total']->row()->sum_total;*/
		
			$saldo_piutang=$data['result_pelanggan']->row()->saldo_piutang;
			
			$saldo_piutang_pelanggan = $saldo_sum_total + $total_penjumlahan2;
			
			if ($saldo_piutang_pelanggan > $saldo_piutang){
				/*$result_check_saldo= 'Pelanggan Melebihi Saldo Piutang';*/
				$result_check_saldo='gagal';
			}else{
				$result_check_saldo='berhasil';
			}
		/*echo $data['id_pelanggan'] . '--' . 'saldosumtotal=' .$saldo_sum_total . '=total_penjumlahan=' . $total_penjumlahan2 .'resultcheck=' .$result_check_saldo;*/
		echo $result_check_saldo;
	}

	function get_cabang($result_checked)
	{		
		//$result_checked=$this->uri->segment(3);		
		if ($result_checked=='cabang')
		{
			$query = $this->db->get('cabang');
			if($query->num_rows() > 0)
			{
				echo '<select name="id_cabang">';
				foreach($query->result() as $row)
				{
					//echo '<option value="'.$row->id_cabang.'">'.$row->id_cabang.' - '.$row->nama_cabang.'</option>';
					echo '<option value="'.$row->id_cabang.'">'.$row->nama_cabang.'</option>';
				}
				echo '</select>';
			}
		}
		else
		{						
			$query = $this->db->get('pelanggan');			
			echo '<select name="id_pelanggan">';
			if($query->num_rows() > 0)
			{
				
				foreach($query->result() as $row)
				{					
					//echo '<option value="'.$row->id_pelanggan.'">'.$row->kode_pelanggan.' - '.$row->nama.'</option>';
					echo '<option value="'.$row->id_pelanggan.'">'.$row->nama.'</option>';
				}				
			}
			echo '</select>';
		}		
	}

	function delete($id)
	{
		if ($this->can_delete() == FALSE)
		{
			redirect('auth/failed');
		}
		
		$this->penjualan->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('penjualan');
	}
	
	function view($id)
	{
		$data['result'] = $this->penjualan->get_detail($id);
		$this->load->view('penjualan/penjualan_view', $data);
	}
	
	/* menampilkan list barang pada fancyBox */
	
	function show_barang($jenis)
	{
		
		$get_posisi = get_idcabang();

		if ($get_posisi==1)
		{
			$data['result'] = $this->penjualan->get_barang('posisi_pusat','1');
		}
		else
		{
			$data['result'] = $this->penjualan->get_barang('posisi_cabang',$get_posisi);
		}
		
		$data['jenis'] = $jenis;
		$this->load->view('penjualan/list_barang.php', $data);
	}
	
	/* menampilkan items berdasarkan id pembelian dan barang */
	
	function set_items($jenis,$id_jenis, $id_pembelian, $id_barang)
	{
		$get_posisi = get_idcabang();
		if ($get_posisi==1)
		{
			
			if ($id_jenis=='4')
			{
				$data['query'] = $this->penjualan->get_items_hp($id_pembelian, $id_barang, 'posisi_pusat','1');
			}
			else
			{
				//$data['query'] = $this->penjualan->get_items($id_pembelian, $id_barang, 'posisi_pusat','1');
				//hamdi 
				$data['query'] = $this->penjualan->h_get_items($id_pembelian, $id_barang, 'posisi_pusat','1');
			}
		}
		else
		{
			
			if ($id_jenis=='4')
			{
				$data['query'] = $this->penjualan->get_items_hp($id_pembelian, $id_barang, 'posisi_cabang',$get_posisi);
			}
			else
			{
				//$data['query'] = $this->penjualan->get_items($id_pembelian, $id_barang, 'posisi_cabang',$get_posisi);
				//hamdi
				$data['query'] = $this->penjualan->h_get_items($id_pembelian, $id_barang, 'posisi_cabang',$get_posisi);
			}
		}
		$data['jenis'] = $jenis;
		$this->load->view('penjualan/items.php', $data);
	}
	
}