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
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/penjualan/index/';
		$config['total_rows'] = $this->db->count_all('penjualan');
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
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_penjualan'] = $this->input->post('id_penjualan');
		$data['so_no'] = $this->input->post('so_no');
		$data['id_pelanggan'] = $this->input->post('id_pelanggan');
		$data['id_cabang'] = $this->input->post('id_cabang');
		$data['id_jenis_penjualan'] = $this->input->post('id_jenis_penjualan');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['cara_bayar'] = $this->input->post('cara_bayar');
		
		$cara_bayar 						= $data['cara_bayar'];
		
		$data['result_trans']=$this->kode_trans->get_kd_awal('penjualan');
		$data['kode_transaksi']=$data['result_trans']->row()->kd_trans;
		
		/*
		$date = date_create($data['tanggal']);
		date_add($date, date_interval_create_from_date_string($this->input->post('jatuh_tempo').' days'));
		$data['jatuh_tempo'] = date_format($date, 'Y-m-d');
		*/
		$data['jatuh_tempo'] = $this->input->post('jatuh_tempo');
		
		$data['diskon'] = $this->input->post('diskon');
		$data['id_coa'] = '5';
		$data['userid'] = get_userid();
		$data['glid'] 	= $this->piutang->get_glid();
		
		
		$this->form_validation->set_rules('so_no', 'so_no', 'required');
		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required');
		//$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		/*$this->form_validation->set_rules('jatuh_tempo', 'jatuh_tempo', 'required');
		$this->form_validation->set_rules('diskon', 'diskon', 'required');*/
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('penjualan/penjualan_add',$data);
			
		}else{	
			
			# insert ke table penjualan
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
			$penjualan['cara_bayar'] 			= $data['cara_bayar'];
			
			
			
			# insert ke table detail penjualan
			$detail	= $this->input->post('detail');
			
			$count_detail = count($detail);
			$i=0;
			$total_penjumlahan = 0;
			for($i=0; $i<$count_detail; $i++)
			{
				$data_['id_penjualan'] 			= $penjualan['id_penjualan'];
				$data_['id_barang'] 			= $detail[$i]['id_barang'];
				$data_['id_detail_pembelian'] 	= $detail[$i]['id_detail_pembelian'];
				$data_['harga'] 				= $detail[$i]['harga'];
				$data_['qty'] 					= $detail[$i]['qty'];
				$data_['sn'] 					= $detail[$i]['sn'];
				$data_['total'] 				= $detail[$i]['total'];
				$total_penjumlahan				= $total_penjumlahan + $detail[$i]['total'];
				//$data_['id_karyawan'] 	= ;
				$this->penjualan->insert_detail($data_);
				
				
				# update barang di tabel detail pembelian.
				# untuk menandakan bawasannya barang sudah di jual, 
				# sehingga barang nantinya tidak ditampilkan lagi di penjualan
				# -------------------------------------------------------------
				$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], '1');
				
				/*
				# insert ke table stok [Persediaan]
				# ---------------------------------
				// ambil jumlah debit dan kredit berdasarkan kode cabang
				$this->db->flush_cache();
				$this->db->select_sum('debit');
				$this->db->select_sum('kredit');
				$this->db->where('kode_cabang', get_kodecabang());
				$query = $this->db->get('stok');
				
				$tmp_debit 	= $query->row()->debit;
				$tmp_kredit = $query->row()->kredit;
				
				// karena penjualan maka kredit
				$tmp_kredit = $tmp_kredit + $data_['qty'];
				
				$inv['kode_cabang'] 	= get_kodecabang();
				$inv['id_penjualan'] 	= $data_['id_penjualan'];
				$inv['id_barang'] 		= $data_['id_barang'];
				$inv['id_supplier'] 	= $data['id_cabang'];
				$inv['tanggal'] 		= date('Y-m-d H:i:s');
				$inv['jumlah'] 			= $data_['qty'];
				$inv['debit'] 			= '0';
				$inv['kredit'] 			= $data_['qty'];
				$inv['saldo'] 			= $tmp_debit - $tmp_kredit;
				
				$this->db->flush_cache();
				$this->db->insert('stok', $inv); 
				*/
			}
			
			// ambil id barang dan point
			
			
			$piutang['KOUNIT'] 		= $data['id_cabang'];
			$piutang['TANGGAL'] 	= $data['tanggal'];
			$piutang['so_no'] 		= $data['so_no'];			
			$piutang['GLID'] 		= $data['glid'];
			$piutang['AKUN'] 		= '';
					
			$piutang['KODE_PARTNER'] = $data['id_pelanggan'];			
			//$hutang['REFF_TRANSAKSI'] = $data['po_no'];	
			//$hutang['KET_TRANSASKSI'] = $data['id_supplier'];	
			
			$piutang['JUMLAH'] 		= $total_penjumlahan;
			
			$piutang['CUID'] 		= $data['userid']; // userid
			$piutang['CDATE'] 		= date('Y-m-d'); // tanggal sistem
			$piutang['MUID'] 		= '';//$data['MUID']; // edit perubahan oleh user siapa
			$piutang['MDATE'] 		= '';//$data['MDATE']; // tanggal perubahan terakhir
			
			//$penjualan['status_piutang'] 		= '1';
			$penjualan['total'] 		= $total_penjumlahan;
			
			$data['result_sum_total']=$this->penjualan->get_total_penjualan_by_pelanggan($data['id_pelanggan']);
			$data['result_pelanggan']=$this->pelanggan->getItemById($data['id_pelanggan']);
			$saldo_sum_total=$data['result_sum_total']->row()->sum_total;
			$saldo_piutang=$data['result_pelanggan']->row()->saldo_piutang;
			
			$saldo_piutang_pelanggan = $saldo_sum_total + $total_penjumlahan;
			/*echo $saldo_piutang_pelanggan . '---' . $saldo_piutang;*/
			
			if ($saldo_piutang > $saldo_piutang_pelanggan){
				$this->insert();
			}else{
				$this->penjualan->insert($penjualan);

				
				if ($cara_bayar=='2'){
					
						$this->piutang->insert($piutang);
				}
					
							
							// ambil point barang dri tabel kmudian kaluklasikan dgn qty
							$this->db->flush_cache();
							$this->db->from('barang');
							$this->db->where('id_barang', $data_['id_barang']);
							$tb_barang = $this->db->get();
							
							$point_member=(int) $tb_barang->row()->point_member;
							
							$this->db->flush_cache();
							$this->db->from('pelanggan');
							$this->db->where('id_pelanggan', $data['id_pelanggan']);
							$tb_pelanggan = $this->db->get();
							
							$point_awal=(int) $tb_pelanggan->row()->point;
				
				/* ambil point karyawan/pelanggan */
				/* dan kurangi dengan total point barang yg sudah di ambil*/
				
					$this->db->flush_cache();
					$this->db->where('id_pelanggan', $data['id_pelanggan']);
					$this->db->update('pelanggan', array('point' => ($point_awal + $point_member)));
				
				
				
				$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
				redirect('penjualan');
			}
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
			
		}else{	
			
			# update ke table penjualan
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
			
			# kembalikan status soldout menjadi 0 di tabel detail pembelian berdasarkan id detail pembelian yg di detail penjualan
			$detail	= $this->input->post('detail');
			$count_detail = count($detail);
			$i=0;
			for($i=0; $i<$count_detail; $i++)
			{
				$this->penjualan->updateBarangPembelian($detail[$i]['id_detail_pembelian'], '0');
			}
			
			# hapus data detail penjualan lama
			$this->db->flush_cache();
			$this->db->where('id_penjualan', $data['id_penjualan']);
			$this->db->delete('detail_penjualan');
			
			# update ke table detail penjualan
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
				//$data_['id_karyawan'] 	= ;
				$this->penjualan->insert_detail($data_);
				
				# update barang di tabel detail pembelian.
				# untuk menandakan bawasannya barang sudah di jual, 
				# sehingga barang nantinya tidak ditampilkan lagi di penjualan
				# -------------------------------------------------------------
				$this->penjualan->updateBarangPembelian($data_['id_detail_pembelian'], '1');
				
			}
			
			
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('penjualan');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
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
	
	# menampilkan list barang pada fancyBox
	function show_barang($jenis)
	{
		$data['result'] = $this->penjualan->get_barang();
		$data['jenis'] = $jenis;
		$this->load->view('penjualan/list_barang.php', $data);
	}
	
	# menampilkan items berdasarkan id pembelian dan barang
	function set_items($jenis, $id_pembelian, $id_barang){
		$data['query'] = $this->penjualan->get_items($id_pembelian, $id_barang);
		$data['jenis'] = $jenis;
		$this->load->view('penjualan/items.php', $data);
	}
	
}