<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class barang_point extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_barang_point', 'barang_point');
		$this->load->model('mdl_barang', 'barang');
		$this->load->model('mdl_pembelian', 'pembelian');
		$this->load->model('mdl_detail_pembelian', 'detail_pembelian');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/barang_point/index/';
		$config['total_rows'] = $this->barang_point->getallItem('barang_point');
		$config['per_page'] = '10';
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
		
		

		$data['results'] = $this->barang_point->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('barang_point/barang_point_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_barang'] = strtoupper($this->input->post('id_barang'));
		$data['nama_barang'] = strtoupper($this->input->post('nama_barang'));
		$data['id_jenis'] = $this->input->post('id_jenis');
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['id_golongan'] = $this->input->post('id_golongan');
		$data['hpp'] = $this->input->post('hpp');
		$data['harga_toko'] = $this->input->post('harga_toko');
		$data['harga_partai'] = $this->input->post('harga_partai');
		$data['harga_cabang'] = $this->input->post('harga_cabang');	
		$data['point_karyawan'] = 0;
		$data['point_member'] = 0;
		$data['point_barangpoint'] = $this->input->post('point_barangpoint');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['po_no'] = $this->input->post('po_no');
		$data['is_hargatoko'] = $this->input->post('is_hargatoko');
		$data['is_hargapartai'] = $this->input->post('is_hargapartai');
		$data['is_hargajual'] = $this->input->post('is_hargajual');
		$data['sn'] = $this->input->post('sn');
		$data['userid'] = get_userid();
		$jumlah_barang = $this->input->post('jumlah_barang');
		
		
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'callback_cek_nama');
		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');
		$this->form_validation->set_rules('hpp', 'hpp', 'trim');
		$this->form_validation->set_rules('harga_toko', 'harga_toko', 'trim|numeric');
		$this->form_validation->set_rules('harga_partai', 'harga_partai', 'trim|numeric');
		$this->form_validation->set_rules('harga_cabang', 'harga_cabang', 'trim|numeric');
		$this->form_validation->set_rules('point_karyawan', 'point_karyawan', 'trim|numeric');
		$this->form_validation->set_rules('point_member', 'point_member', 'trim|numeric');
		$this->form_validation->set_rules('point_barangpoint', 'point_barangpoint', 'trim|numeric');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|numeric');
		$this->form_validation->set_rules('po_no', 'po_no', 'trim|numeric');
		$this->form_validation->set_rules('is_hargatoko', 'is_hargatoko', 'trim');
		$this->form_validation->set_rules('is_hargapartai', 'is_hargapartai', 'trim');
		$this->form_validation->set_rules('is_hargajual', 'is_hargajual', 'trim');
		$this->form_validation->set_rules('sn', 'sn', 'trim');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('barang_point/barang_point_add',$data);
		}
                else{	
			$this->barang_point->insert($data);
			$max = $this->barang->getMax();			
			foreach ($max->result() as $row) {
				$maxId = $row->maxId;
			}		

			for ($i=0; $i < $jumlah_barang ; $i++) { 
				
				$data_['id_pembelian'] 		= 'Point';
				$data_['id_barang'] 		= $maxId;
				$data_['harga'] 			= $data['hpp'];
				$data_['qty'] 				= 1;				
				$data_['total'] 			= $data['hpp'];
				$data_['sn']	 			= 0;
				$data_['posisi_pusat'] 		= 1;				
				$this->pembelian->insert_detail($data_);
			}
			$this->session->set_flashdata('message', 'Data Barang Point Berhasil disimpan.');
			redirect('barang_point');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->barang_point->getItemById($id);
		
		$data['sn'] = $data['result']->row()->sn;
		$data['id_barang'] = $id;
		$data['nama_barang'] = $data['result']->row()->nama_barang;
		$data['id_jenis'] = $data['result']->row()->id_jenis;
		$data['id_kategori'] = $data['result']->row()->id_kategori;
		$data['id_satuan'] = $data['result']->row()->id_satuan;
		$data['id_golongan'] = $data['result']->row()->id_golongan;
		$data['hpp'] = $data['result']->row()->hpp;
		$data['harga_toko'] = $data['result']->row()->harga_toko;
		$data['harga_partai'] = $data['result']->row()->harga_partai;
		$data['harga_cabang'] = $data['result']->row()->harga_cabang;
		$data['point_karyawan'] = $data['result']->row()->point_karyawan;
		$data['point_member'] = $data['result']->row()->point_member;
		$data['point_barangpoint'] = $data['result']->row()->point_barangpoint;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['po_no'] = $data['result']->row()->po_no;
		$data['is_hargatoko'] = $data['result']->row()->is_hargatoko;
		$data['is_hargapartai'] = $data['result']->row()->is_hargapartai;
		$data['is_hargajual'] = $data['result']->row()->is_hargajual;		
		
		$res_hpp = $this->detail_pembelian->getHPP($id);

		if ($res_hpp->row()->jumlah == 0)
		$data['hpp'] = 0;
		else
		$data['hpp'] =  $res_hpp->row()->total/$res_hpp->row()->jumlah;

		$this->load->view('barang_point/barang_point_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_barang'] = strtoupper($this->input->post('id_barang'));
		$data['nama_barang'] = strtoupper($this->input->post('nama_barang'));
		$data['id_jenis'] = $this->input->post('id_jenis');
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['id_satuan'] = $this->input->post('id_satuan');
		$data['id_golongan'] = $this->input->post('id_golongan');
		$data['point_barangpoint'] = $this->input->post('point_barangpoint');			
		$data['userid'] = get_userid();
		
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');
		$this->form_validation->set_rules('point_barangpoint', 'point_barangpoint', 'required|numeric');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		if ($this->form_validation->run() == FALSE){	
			$this->load->view('barang_point/barang_point_edit',$data);
		}
                else{	
			$this->barang_point->update($data['id_barang'], $data);	
			$this->session->set_flashdata('message', 'Data Barang Point Berhasil diupdate.');
			redirect('barang_point');
		}
		$this->close();
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->barang_point->delete($id);
		$this->session->set_flashdata('message', 'Data Barang point Berhasil dihapus.');
		redirect('barang_point');
	}
	
}