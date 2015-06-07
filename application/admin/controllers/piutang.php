<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class piutang extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_piutang', 'piutang');
		
	}
	function index()
	{
		if ($this->can_view() == FALSE){
			redirect('auth/failed');
		}
		
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/piutang/index/';
		$config['total_rows'] = $this->db->count_all('daftar_piutang');
		$config['per_page'] = '20';
		$config['num_links'] = '5';
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
		
		
				
		$data['results'] = $this->piutang->getItem($config['per_page'], $this->uri->segment(3));
		/*$data['sebagai'] = $sebagai;*/
		
		
		
		$this->load->view('piutang/piutang_list.php', $data);
		
		$this->close();
	}		function insert()	{		if ($this->can_insert() == FALSE){			redirect('auth/failed');		}						$this->open();				$data['id_barang'] = $this->input->post('id_barang');		$data['nama_barang'] = $this->input->post('nama_barang');		$data['id_jenis'] = $this->input->post('id_jenis');		$data['id_kategori'] = $this->input->post('id_kategori');		$data['id_satuan'] = $this->input->post('id_satuan');		$data['id_golongan'] = $this->input->post('id_golongan');		$data['hpp'] = $this->input->post('hpp');		$data['harga_toko'] = $this->input->post('harga_toko');		$data['harga_partai'] = $this->input->post('harga_partai');		$data['harga_cabang'] = $this->input->post('harga_cabang');				$data['is_hargatoko'] = $this->input->post('is_hargatoko');		$data['is_hargapartai'] = $this->input->post('is_hargapartai');		$data['is_hargajual'] = $this->input->post('is_hargajual');		$data['point_karyawan'] = $this->input->post('point_karyawan');		$data['point_member'] = $this->input->post('point_member');		$data['userid'] = get_userid();								$this->form_validation->set_rules('nama_barang', 'nama_barang', 'callback_cek_nama');		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');		$this->form_validation->set_rules('hpp', 'hpp', 'trim');		$this->form_validation->set_rules('harga_toko', 'harga_toko', 'trim|numeric');		$this->form_validation->set_rules('harga_partai', 'harga_partai', 'trim|numeric');		$this->form_validation->set_rules('harga_cabang', 'harga_cabang', 'trim|numeric');		$this->form_validation->set_rules('is_hargatoko', 'is_hargatoko', 'trim');		$this->form_validation->set_rules('is_hargapartai', 'is_hargapartai', 'trim');		$this->form_validation->set_rules('is_hargajual', 'is_hargajual', 'trim');		$this->form_validation->set_rules('point_karyawan', 'point_karyawan', 'trim|numeric');		$this->form_validation->set_rules('point_member', 'point_member', 'trim|numeric');						$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						$this->form_validation->set_message('required', 'Field %s harus diisi!');		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						if ($this->form_validation->run() == FALSE){						$this->load->view('piutang/piutang_add',$data);					}else{				$this->piutang->insert($data);						$this->session->set_flashdata('message', 'Data Penerimaan Kas Berhasil disimpan.');			redirect('piutang');		}				$this->close();	}		function pembayaran(){		if ($this->can_view() == FALSE){			redirect('auth/failed');		}				$data['can_view'] 	= $this->can_view();		$data['can_insert'] = $this->can_insert();		$data['can_update'] = $this->can_update();		$data['can_delete'] = $this->can_delete();				$this->open();						$config['base_url'] = base_url().'index.php/piutang/index/';		$config['total_rows'] = $this->db->count_all('daftar_piutang');		$config['per_page'] = '20';		$config['num_links'] = '5';		$config['uri_segment'] = '3';				$config['full_tag_open'] = '';		$config['full_tag_close'] = '';				$config['num_tag_open'] = '<li>';		$config['num_tag_close'] = '</li>';				$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';		$config['cur_tag_close'] = '</a></li>';				$config['prev_link'] = 'Prev';		$config['prev_tag_open'] = '<li>';		$config['prev_tag_close'] = '</li>';				$config['next_link'] = 'Next';		$config['next_tag_open'] = '<li>';		$config['next_tag_close'] = '</li>';				$config['last_link'] = 'Last';		$config['last_tag_open'] = '<li>';		$config['last_tag_close'] = '</li>';				$config['first_link'] = 'First';		$config['first_tag_open'] = '<li>';		$config['first_tag_close'] = '</li>';				$this->pagination->initialize($config);											$data['results'] = $this->piutang->getItem($config['per_page'], $this->uri->segment(3));		
	/*$data['sebagai'] = $sebagai;				*/				
	$this->load->view('piutang/pembayaran_piutang_list.php', $data);				$this->close();	}		function update()	{		$glid1=$this->uri->segment(3);		$glid2=$this->uri->segment(4);		$glid3=$this->uri->segment(5);		$id = $glid1 . '/' . $glid2 . '/' . $glid3;		$config['base_url'] = base_url().'index.php/piutang/index/';		$config['total_rows'] = $this->db->count_all('daftar_piutang');		$config['per_page'] = '20';		$config['num_links'] = '5';		$config['uri_segment'] = '3';				$config['full_tag_open'] = '';		$config['full_tag_close'] = '';				$config['num_tag_open'] = '<li>';		$config['num_tag_close'] = '</li>';				$config['cur_tag_open'] = '<li><a href="javascript:void(0)" class="current">';		$config['cur_tag_close'] = '</a></li>';				$config['prev_link'] = 'Prev';		$config['prev_tag_open'] = '<li>';		$config['prev_tag_close'] = '</li>';				$config['next_link'] = 'Next';		$config['next_tag_open'] = '<li>';		$config['next_tag_close'] = '</li>';				$config['last_link'] = 'Last';		$config['last_tag_open'] = '<li>';		$config['last_tag_close'] = '</li>';				$config['first_link'] = 'First';		$config['first_tag_open'] = '<li>';		$config['first_tag_close'] = '</li>';				$this->pagination->initialize($config);											$data['results'] = $this->piutang->getItem_angsuran($id);		/*end list angsuran*/				if ($this->can_update() == FALSE){			redirect('auth/failed');		}				$this->open();				$data['result'] 		= $this->piutang->getItemById($id);		$data['id_penjualan']	= $id;				$this->load->view('piutang/pembayaran_piutang_edit', $data);		$this->close();	}
	function process_update()	{		if ($this->can_update() == FALSE){			redirect('auth/failed');		}		
	$this->open();				$sisa_piutang=0;		$data['id_pembelian'] = $this->input->post('id_pembelian');		$data['so_no'] = $this->input->post('so_no');				$data['id_pelanggan'] = $this->input->post('id_pelanggan');		$data['id_cabang'] = $this->input->post('id_cabang');		$data['total_tagihan'] = $this->input->post('total_tagihan');		$data['pembayaran'] = $this->input->post('pembayaran');		$data['cara_bayar'] = $this->input->post('cara_bayar');		$sisa_piutang = $data['total_tagihan'] - $data['pembayaran'];		$data['sisa'] = $this->input->post('sisa');				$data['tanggal'] = $this->input->post('tanggal');		$data['glid'] = $this->input->post('glid');				$data['id_coa'] = '5';		$data['userid'] = get_userid();				$this->form_validation->set_rules('so_no', 'so_no', 'required');		$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'required');		$this->form_validation->set_rules('id_cabang', 'id_cabang', 'required');		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						$this->form_validation->set_message('required', 'Field %s harus diisi!');		if ($this->form_validation->run() == FALSE){					$this->load->view('piutang/pembayaran_piutang_edit', $data); 				}else{			
	# update ke table angsuran_piutang			
	# -------------------------			
	$angsuran_piutang['KOUNIT'] 	= $data['id_cabang'];			
	//$angsuran_piutang['so_no'] 	= $data['so_no'];			
	$angsuran_piutang['TANGGAL'] 	= date('Y-m-d'); 
	//$data['tanggal'];			
	$angsuran_piutang['GLID'] 		= $data['glid'];					$angsuran_piutang['KODE_PARTNER'] = $data['id_pelanggan'];						$angsuran_piutang['total'] 		= $data['total_tagihan'];			$angsuran_piutang['angsuran'] 	= $data['pembayaran'];			$angsuran_piutang['pembayaran'] = $data['cara_bayar'];			$angsuran_piutang['sisa'] 		= $sisa_piutang;			
	//$angsuran_piutang['userid'] 	= $data['userid'];			
	//$this->pembelian->update($angsuran_piutang['id_pembelian'], $angsuran_piutang);			
	$this->piutang->insert_angsuran($angsuran_piutang);									$this->db->flush_cache();						$update_piutang = array(								'JUMLAH' => $sisa_piutang							);				$this->db->where('GLID', $data['glid']);						$this->db->update('daftar_piutang', $update_piutang);						$this->db->flush_cache();						if ($sisa_piutang=='0'){				$update_penjualan = array(								'status_piutang' => '2'				);								}else{				$update_penjualan = array(								'status_piutang' => '1'				);					}			$this->db->where('so_no', $data['so_no']);						$this->db->update('penjualan', $update_penjualan);						$this->session->set_flashdata('message', 'Data Pembayaran piutang Berhasil disimpan.');			redirect('piutang/pembayaran');		}				$this->close();			}
}