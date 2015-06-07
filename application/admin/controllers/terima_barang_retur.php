<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class terima_barang_retur extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_terima_barang_retur', 'terima_barang_retur');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/retur_pembelian/index/';
		$config['total_rows'] = $this->db->count_all('retur_pembelian');
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
		
		
		
		$data['results'] = $this->terima_barang_retur->getItem($config['per_page'], $this->uri->segment(3));
		

		
		$this->load->view('terima_barang_retur/terima_barang_retur_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{		
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['tanggal'] = $this->input->post('tanggal');
		//print $data['detail'] = $this->input->post('detail');

		$data['userid'] = get_userid();
		$data['id_retur_pembelian'] = $this->input->post('po_no');	
		$datas['sn'] = $this->input->post('sn');	
		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('terima_barang_retur/terima_barang_retur_add',$data);
			
		}else{
			
			$this->terima_barang_retur->insert($data);
			$this->terima_barang_retur->update_sn($data,$datas);
			# insert return pembelian
			//$detail = $data['detail'];
			
			/*$count_detail = count($detail);
		
			for($i=0; $i<$count_detail; $i++)
			{
				if(isset($detail[$i]['id_barang'])){
					$_data['id_detail_pembelian'] 	= $detail[$i]['id_detail_pembelian'];
					$_data['id_barang'] 			= $detail[$i]['id_barang'];
					$_data['qty'] 					= $detail[$i]['qty'];					
					$_data['tanggal'] 				= $data['tanggal'];
					$_data['userid'] 				= $data['userid'];
					
					$this->retur_pembelian->insert($_data);
				}
			}*/


			
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('terima_barang_retur');
		}
		
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['result'] 		= $this->retur_pembelian->getItemById($id);
		
		$data['id_retur_pembelian'] = $id;
		$data['id_pembelian'] = $data['result']->row()->id_pembelian;
		$data['id_barang'] = $data['result']->row()->id_barang;
		$data['qty'] = $data['result']->row()->qty;
		$data['tanggal'] = $data['result']->row()->tanggal;
		$data['userid'] = $data['result']->row()->userid;
		
		
		$this->load->view('retur_pembelian/retur_pembelian_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		
		$data['id_retur_pembelian'] = $this->input->post('id_retur_pembelian');
		$data['id_pembelian'] = $this->input->post('id_pembelian');
		$data['id_barang'] = $this->input->post('id_barang');
		$data['qty'] = $this->input->post('qty');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('id_pembelian', 'id_pembelian', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('retur_pembelian/retur_pembelian_edit',$data);
			
		}else{	
			$this->retur_pembelian->update($data['id_retur_pembelian'], $data);
			$this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			redirect('retur_pembelian');
		}
		
		$this->close();
		
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->retur_pembelian->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('retur_pembelian');
	}
	
	function get_barang_id_retur($po){
		# ambil id pembelian berdasarkan no po di tabel pembelian
		
		$this->db->flush_cache();
		$this->db->select('retur_pembelian.id_retur_pembelian,detail_pembelian.id_detail_pembelian, pembelian.po_no, supplier.kode_supplier, detail_pembelian.sn, supplier.nama AS nama_supplier, retur_pembelian.tanggal, barang.nama_barang, retur_pembelian.qty');
		$this->db->from('retur_pembelian');
		$this->db->join('detail_pembelian', 'retur_pembelian.id_detail_pembelian = detail_pembelian.id_detail_pembelian');
		$this->db->join('pembelian', 'pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');		
		$this->db->where('retur_pembelian.id_retur_pembelian', $po);
				

		$res =  $this->db->get();
	 	$res = $res->result();
	 	$i=0;
		foreach ($res as $row) {					
			if ($row->sn != '' ){
		echo
							'<tr>								
								<td>'.($i + 1).'</td>
								<td>'.$row->nama_barang.'</td>
								
								<td><input type = "text" value = "'.$row->sn.'" name = "sn"></td>

								<td>'.$row->nama_supplier.'</td>
								<td>'.$row->qty.'</td>
								<td>'.$row->qty.'
								<input name="detail['.$i.'][qty]" type="hidden" value="1" /></td>
							</tr>'
					;
				}
				else{
		echo
							'<tr>								
								<td>'.($i + 1).'</td>
								<td>'.$row->nama_barang.'</td>
								
								<td>'.$row->sn.'</td>
								<input type = "hiden" value = "" name = "sn">
								<td>'.$row->nama_supplier.'</td>
								<td>'.$row->qty.'</td>
								<td>'.$row->qty.'
								<input name="detail['.$i.'][qty]" type="hidden" value="1" /></td>
							</tr>'
					;
				}
		}

		/*
		if($que1->num_rows() > 0){
			$id_pembelian = $que1->row()->id_pembelian;
			
			# ambil barang-barang berdasarkan id pembelian di tabel detail pembelian
			// $this->db->flush_cache();
			// $this->db->select('detail_pembelian.*, barang.*');
			// $this->db->from('detail_pembelian');
			// $this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
			// $this->db->where('id_pembelian', $id_pembelian);
			// $que2 = $this->db->get();
			
			$this->db->flush_cache();
			$this->db->select('*, supplier.nama AS nama_supplier');
			$this->db->from('pembelian');
			$this->db->join('detail_pembelian', 'detail_pembelian.id_pembelian = pembelian.id_pembelian');
			$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
			$this->db->join('supplier', 'supplier.id_supplier = pembelian.id_supplier');
			$this->db->where('pembelian.id_pembelian', $id_pembelian);			
			$que2 = $this->db->get();
			
			if($que2->num_rows() > 0){
				# populasi
				$i=0;
				foreach($que2->result() as $row){
					echo
							'<tr>
								<td>
									<input name="detail['.$i.'][id_detail_pembelian]" value="'.$row->id_detail_pembelian.'" type="hidden" />
									<input name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" type="checkbox" />
								</td>
								<td>'.($i + 1).'</td>
								<td>'.$row->nama_barang.'</td>
								<td>'.$row->sn.'</td>
								<td>'.$row->nama_supplier.'</td>
								<td>'.$row->qty.'</td>
								<td>'.$row->qty.'
								<input name="detail['.$i.'][qty]" type="hidden" value="1" /></td>
							</tr>'
					;
					
					$i++;
				}				
			}
		}*/
	}
	
}