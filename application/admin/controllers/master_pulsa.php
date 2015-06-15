<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_pulsa extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_master_pulsa', 'master_pulsa');
		$this->load->model('mdl_barang', 'barang');
		$this->load->model('mdl_detail_pembelian','detail_pembelian');
		$this->load->model('mdl_pembelian', 'pembelian');
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		/*config pagination*/
		$config['base_url'] = base_url().'index.php/master_pulsa/index/';
		$config['total_rows'] = $this->master_pulsa->getallItem('master_pulsa');
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
		/* end config pagination*/
		
		/* get data*/
		$data['results'] = $this->master_pulsa->getItem($config['per_page'], $this->uri->segment(3));
		
		/* load view*/
		$this->load->view('master_pulsa/master_pulsa_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
			
		$this->open();		
		/* Data*/		
		/*$data['id_pulsa'] = $this->input->post('id_pulsa');				
		$data['kode_pulsa'] = $this->input->post('kode_pulsa');		
		$data['nama_pulsa'] = $this->input->post('nama_pulsa');*/
		$data['id_barang'] = $this->input->post('id_pulsa');				
		$data['kode'] = $this->input->post('kode_pulsa');		
		$data['nama_barang'] = $this->input->post('nama_pulsa');
		$data['id_jenis'] = $this->input->post('id_jenis');		
		$data['id_kategori'] = $this->input->post('id_kategori');		
		$data['id_satuan'] = $this->input->post('id_satuan');				
		$data['id_saldo'] = $this->input->post('id_saldo');		
		$data['id_golongan'] = $this->input->post('id_golongan');		
		$hpp = $this->input->post('hpp');				
		$data['hpp']  = $hpp;		
		$data['harga_toko'] = $this->input->post('harga_toko');		
		$data['harga_partai'] = $this->input->post('harga_partai');		
		$data['harga_cabang'] = $this->input->post('harga_cabang');				
		$data['is_hargatoko'] = $this->input->post('is_hargatoko');		
		$data['is_hargapartai'] = $this->input->post('is_hargapartai');		
		$data['is_hargajual'] = $this->input->post('is_hargajual');		
		$data['point_karyawan'] = $this->input->post('point_karyawan');		
		$data['point_member'] = $this->input->post('point_member');		
		$data['userid'] = get_userid();
		$data['jenis_barang'] = 'pulsa';
		
		/* set rules validation*/
		$this->form_validation->set_rules('nama_pulsa', 'nama_pulsa', 'required');				
		$this->form_validation->set_rules('kode_pulsa', 'kode_pulsa', 'required');		
		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'required');		
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');		
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');				
		$this->form_validation->set_rules('id_saldo','id_saldo', 'required');		
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');		
		$this->form_validation->set_rules('hpp', 'hpp', 'trim');		
		$this->form_validation->set_rules('harga_toko', 'harga_toko', 'trim|numeric');		
		$this->form_validation->set_rules('harga_partai', 'harga_partai', 'trim|numeric');	
                $this->form_validation->set_rules('harga_cabang', 'harga_cabang', 'trim|numeric');	
                $this->form_validation->set_rules('is_hargatoko', 'is_hargatoko', 'trim');		$this->form_validation->set_rules('is_hargapartai', 'is_hargapartai', 'trim');		$this->form_validation->set_rules('is_hargajual', 'is_hargajual', 'trim');		$this->form_validation->set_rules('point_karyawan', 'point_karyawan', 'trim|numeric');		$this->form_validation->set_rules('point_member', 'point_member', 'trim|numeric');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		
                $checker = $this->checkKode($data['kode']);
                if ($this->form_validation->run() == FALSE){
                    $data['id_barang'] = $this->input->post('id_pulsa');					
                    $data['kode'] = $this->input->post('kode_pulsa');			
                    //$data['nama_pulsa'] = $this->input->post('nama_pulsa');			
                    $data['nama_barang'] = $this->input->post('nama_pulsa');			
                    $data['id_jenis'] = $this->input->post('id_jenis');			
                    $data['id_kategori'] = $this->input->post('id_kategori');			
                    $data['id_satuan'] = $this->input->post('id_satuan');						
                    $data['id_saldo'] = $this->input->post('id_saldo');			
                    $data['id_golongan'] = $this->input->post('id_golongan');			
                    $hpp = $this->input->post('hpp');						
                    $data['hpp']  = $hpp;			
                    $data['harga_toko'] = $this->input->post('harga_toko');			
                    $data['harga_partai'] = $this->input->post('harga_partai');			
                    $data['harga_cabang'] = $this->input->post('harga_cabang');					
                    $data['is_hargatoko'] = $this->input->post('is_hargatoko');			
                    $data['is_hargapartai'] = $this->input->post('is_hargapartai');			
                    $data['is_hargajual'] = $this->input->post('is_hargajual');			
                    $data['point_karyawan'] = $this->input->post('point_karyawan');			
                    $data['point_member'] = $this->input->post('point_member');
                    $data['userid'] = get_userid();
                    $data['usernameValidation']=0;
                    $this->load->view('master_pulsa/master_pulsa_add',$data);
		}
                else if($checker==FALSE){
                    $data['id_barang'] = $this->input->post('id_pulsa');					
                    $data['kode'] = $this->input->post('kode_pulsa');			
                    $data['nama_barang'] = $this->input->post('nama_pulsa');			
                    $data['id_jenis'] = $this->input->post('id_jenis');			
                    $data['id_kategori'] = $this->input->post('id_kategori');			
                    $data['id_satuan'] = $this->input->post('id_satuan');						
                    $data['id_saldo'] = $this->input->post('id_saldo');			
                    $data['id_golongan'] = $this->input->post('id_golongan');			
                    $hpp = $this->input->post('hpp');						
                    $data['hpp']  = $hpp;			
                    $data['harga_toko'] = $this->input->post('harga_toko');			
                    $data['harga_partai'] = $this->input->post('harga_partai');			
                    $data['harga_cabang'] = $this->input->post('harga_cabang');					
                    $data['is_hargatoko'] = $this->input->post('is_hargatoko');			
                    $data['is_hargapartai'] = $this->input->post('is_hargapartai');			
                    $data['is_hargajual'] = $this->input->post('is_hargajual');			
                    $data['point_karyawan'] = $this->input->post('point_karyawan');			
                    $data['point_member'] = $this->input->post('point_member');
                    $data['userid'] = get_userid();			
                    $data['usernameValidation']=1;
                    $this->load->view('master_pulsa/master_pulsa_add',$data);
                }
                else{													
		$data['id_barang'] = $this->input->post('id_pulsa');					
		$data['kode'] = $this->input->post('kode_pulsa');			
		$data['nama_barang'] = $this->input->post('nama_pulsa');			
		$data['id_jenis'] = $this->input->post('id_jenis');			
		$data['id_kategori'] = $this->input->post('id_kategori');			
		$data['id_satuan'] = $this->input->post('id_satuan');						
		$data['id_saldo'] = $this->input->post('id_saldo');			
		$data['id_golongan'] = $this->input->post('id_golongan');			
		$hpp = $this->input->post('hpp');						
		$data['hpp']  = $hpp;
		$data['sn']	 = 0;
		$data['harga_toko'] = $this->input->post('harga_toko');			
		$data['harga_partai'] = $this->input->post('harga_partai');			
		$data['harga_cabang'] = $this->input->post('harga_cabang');					
		$data['is_hargatoko'] = $this->input->post('is_hargatoko');			
		$data['is_hargapartai'] = $this->input->post('is_hargapartai');			
		$data['is_hargajual'] = $this->input->post('is_hargajual');			
		$data['point_karyawan'] = $this->input->post('point_karyawan');			
		$jumlah_barang = $this->input->post('jumlah_barang');
		$data['point_member'] = $this->input->post('point_member');
		$data['userid'] = get_userid();

		$saldo_elektrik	= $this->master_pulsa->get_saldo_elektrik($data['id_saldo']);						
		$v_saldo_saldo_elektrik = $saldo_elektrik->row()->saldo;						
		$hasil_saldo_akhir 		= $v_saldo_saldo_elektrik - $hpp*$jumlah_barang;						
		$data_saldo['saldo'] 	= $hasil_saldo_akhir;						
		$this->barang->insert($data);
		$max = $this->barang->getMax();			
		foreach ($max->result() as $row) {
                    $maxId = $row->maxId;
		}		

		for ($i=0; $i < $jumlah_barang ; $i++) { 					
                    $data_['id_pembelian'] 		= 'Pulsa';
                    $data_['id_barang'] 		= $maxId;
                    $data_['harga'] 			= $data['hpp'];
                    $data_['qty'] 				= 1;				
                    $data_['total'] 			= $data['hpp'];
                    $data_['sn']	 			= 0;
                    $data_['posisi_pusat'] 		= 1;				
                    $this->pembelian->insert_detail($data_);
		}				
                    $this->master_pulsa->update_saldo_transaksi($data['id_saldo'], $data_saldo);
                    $this->session->set_flashdata('message', 'Data Master Pulsa Berhasil disimpan.');			
                    redirect('master_pulsa');
		}
		
		$this->close();
	}		
	function cek_nama($str)	{		
		if($str == ''){			
	$this->form_validation->set_message('cek_nama', 'Field %s tidak boleh kosong.');			
	return FAlSE;		
	}				
	$this->db->flush_cache();		
	$this->db->select('*');		
	$this->db->where('nama_pulsa', $str);		
	$q = $this->db->get('master_pulsa');				
	if($q->num_rows() > 0){			
	$this->form_validation->set_message('cek_nama', 'Nama "'. $str . '" sudah terdaftar, coba masukan nama yang lain.');			
	return FALSE;		
	}else{			
	return TRUE;		
	}			
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){			
			redirect('auth/failed');		
		}				
			$this->open();				
			$data['result'] 		= $this->master_pulsa->getItemById($id);				
			$data['id_pulsa'] = $id;
			$data['kode_pulsa'] = $data['result']->row()->kode;		
			$data['nama_pulsa'] = $data['result']->row()->nama_barang;		
			$data['id_pulsa'] = $data['result']->row()->id_barang;		
			$data['id_kategori'] = $data['result']->row()->id_kategori;		
			$data['id_satuan'] = $data['result']->row()->id_satuan;			
			$data['id_jenis'] = $data['result']->row()->id_jenis;
			$data['id_saldo']= $data['result']->row()->id_saldo;		
			$data['id_golongan'] = $data['result']->row()->id_golongan;		
			$data['hpp'] = $data['result']->row()->hpp;				
			$data['harga_toko'] = $data['result']->row()->harga_toko;		
			$data['harga_partai'] = $data['result']->row()->harga_partai;		
			$data['harga_cabang'] = $data['result']->row()->harga_cabang;		
			$data['is_hargatoko'] = $data['result']->row()->is_hargatoko;		
			$data['is_hargapartai'] = $data['result']->row()->is_hargapartai;		
			$data['is_hargajual'] = $data['result']->row()->is_hargajual;		
			$data['point_karyawan'] = $data['result']->row()->point_karyawan;		
			$data['point_member'] = $data['result']->row()->point_member;		
                        $data['usernameValidation']=0;
                        
			$res_hpp = $this->detail_pembelian->getHPP($id);
			if ($res_hpp->row()->jumlah == 0)
			$data['hpp'] = 0;
			else
			$data['hpp'] =  $res_hpp->row()->total/$res_hpp->row()->jumlah;				

			$data['hpp'] = number_format((float)$data['hpp'], 2, '.', '');

			$this->load->view('master_pulsa/master_pulsa_edit', $data);				
			$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){			
		redirect('auth/failed');		
		}				
		$this->open();				
		$data['id_barang'] = $this->input->post('id_pulsa');				
		$data['kode'] = $this->input->post('kode_pulsa');		
		$data['nama_barang'] = $this->input->post('nama_pulsa');		
		$data['id_jenis'] = $this->input->post('id_jenis');
		$data['id_kategori'] = $this->input->post('id_kategori');		
		$data['id_satuan'] = $this->input->post('id_satuan');				
		$data['id_saldo'] = $this->input->post('id_saldo');		
		$data['id_golongan'] = $this->input->post('id_golongan');		
		$data['hpp'] = $this->input->post('hpp');		
		$data['harga_toko'] = $this->input->post('harga_toko');		
		$data['harga_partai'] = $this->input->post('harga_partai');		
		$data['harga_cabang'] = $this->input->post('harga_cabang');				
		$data['is_hargatoko'] = $this->input->post('is_hargatoko');		
		$data['is_hargapartai'] = $this->input->post('is_hargapartai');		
		$data['is_hargajual'] = $this->input->post('is_hargajual');		
		$data['point_karyawan'] = $this->input->post('point_karyawan');		
		$data['point_member'] = $this->input->post('point_member');		
		$data['userid'] = get_userid();		
		/* set rules validation*/		
		$this->form_validation->set_rules('nama_pulsa', 'nama_pulsa');				
		$this->form_validation->set_rules('kode_pulsa', 'kode_pulsa', 'required');		
		$this->form_validation->set_rules('id_pulsa', 'id_pulsa', 'required');		
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'required');		
		$this->form_validation->set_rules('id_satuan', 'id_satuan', 'required');				
		$this->form_validation->set_rules('id_saldo', 'id_saldo', 'required');		
		$this->form_validation->set_rules('id_golongan', 'id_golongan', 'required');		
		$this->form_validation->set_rules('hpp', 'hpp', 'trim');		
		$this->form_validation->set_rules('harga_toko', 'harga_toko', 'trim|numeric');		
		$this->form_validation->set_rules('harga_partai', 'harga_partai', 'trim|numeric');		
		$this->form_validation->set_rules('harga_cabang', 'harga_cabang', 'trim|numeric');		
		$this->form_validation->set_rules('is_hargatoko', 'is_hargatoko', 'trim');		
		$this->form_validation->set_rules('is_hargapartai', 'is_hargapartai', 'trim');		
		$this->form_validation->set_rules('is_hargajual', 'is_hargajual', 'trim');		
		$this->form_validation->set_rules('point_karyawan', 'point_karyawan', 'trim|numeric');		
		$this->form_validation->set_rules('point_member', 'point_member', 'trim|numeric');				
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');				
		/**/		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');		
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');						
		
                                $checker = $this->checkKode($data['kode']);
                if ($this->form_validation->run() == FALSE){
                    $data['id_barang'] = $this->input->post('id_pulsa');					
                    $data['kode'] = $this->input->post('kode_pulsa');			
                    //$data['nama_pulsa'] = $this->input->post('nama_pulsa');			
                    $data['nama_barang'] = $this->input->post('nama_pulsa');			
                    $data['id_jenis'] = $this->input->post('id_jenis');			
                    $data['id_kategori'] = $this->input->post('id_kategori');			
                    $data['id_satuan'] = $this->input->post('id_satuan');						
                    $data['id_saldo'] = $this->input->post('id_saldo');			
                    $data['id_golongan'] = $this->input->post('id_golongan');			
                    $hpp = $this->input->post('hpp');						
                    $data['hpp']  = $hpp;			
                    $data['harga_toko'] = $this->input->post('harga_toko');			
                    $data['harga_partai'] = $this->input->post('harga_partai');			
                    $data['harga_cabang'] = $this->input->post('harga_cabang');					
                    $data['is_hargatoko'] = $this->input->post('is_hargatoko');			
                    $data['is_hargapartai'] = $this->input->post('is_hargapartai');			
                    $data['is_hargajual'] = $this->input->post('is_hargajual');			
                    $data['point_karyawan'] = $this->input->post('point_karyawan');			
                    $data['point_member'] = $this->input->post('point_member');
                    $data['userid'] = get_userid();
                    $data['usernameValidation']=0;
                    $this->load->view('master_pulsa/master_pulsa_add',$data);
		}
                else if($checker==FALSE){
                    $data['id_barang'] = $this->input->post('id_pulsa');					
                    $data['kode'] = $this->input->post('kode_pulsa');			
                    $data['nama_barang'] = $this->input->post('nama_pulsa');			
                    $data['id_jenis'] = $this->input->post('id_jenis');			
                    $data['id_kategori'] = $this->input->post('id_kategori');			
                    $data['id_satuan'] = $this->input->post('id_satuan');						
                    $data['id_saldo'] = $this->input->post('id_saldo');			
                    $data['id_golongan'] = $this->input->post('id_golongan');			
                    $hpp = $this->input->post('hpp');						
                    $data['hpp']  = $hpp;			
                    $data['harga_toko'] = $this->input->post('harga_toko');			
                    $data['harga_partai'] = $this->input->post('harga_partai');			
                    $data['harga_cabang'] = $this->input->post('harga_cabang');					
                    $data['is_hargatoko'] = $this->input->post('is_hargatoko');			
                    $data['is_hargapartai'] = $this->input->post('is_hargapartai');			
                    $data['is_hargajual'] = $this->input->post('is_hargajual');			
                    $data['point_karyawan'] = $this->input->post('point_karyawan');			
                    $data['point_member'] = $this->input->post('point_member');
                    $data['userid'] = get_userid();			
                    $data['usernameValidation']=1;
                    $this->load->view('master_pulsa/master_pulsa_add',$data);
                }
                else{
		/*			$saldo_elektrik 		= $this->master_pulsa->get_saldo_elektrik($data['id_saldo']);			
		$v_saldo_saldo_elektrik = $saldo_elektrik->row()->saldo;						
		$hasil_saldo_akhir = $v_saldo_saldo_elektrik - $hpp;						
		$data_saldo['saldo'] = $hasil_saldo_akhir; */						
		$this->master_pulsa->update($data['id_barang'], $data);			
		$this->session->set_flashdata('message', 'Data Master Pulsa Berhasil diupdate.');			
		redirect('master_pulsa');		
		}				
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE)
		{
			redirect('auth/failed');
		}
		
		$this->master_pulsa->delete($id);
		$this->session->set_flashdata('message', 'Data master pulsa berhasil dihapus.');
		redirect('master_pulsa');
	}
        function checkKode($kode){
            $result = $this->master_pulsa->getItemByKode($kode);
            if($result->num_rows()==0)return TRUE;
            else return FALSE;
        }
}