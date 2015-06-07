<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur_penjualan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_retur_penjualan', 'retur_penjualan');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/retur_penjualan/index/';
		$config['total_rows'] = $this->db->count_all('retur_penjualan');
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
		
		
		
		$data['results'] = $this->retur_penjualan->getItem($config['per_page'], $this->uri->segment(3));	 	
		


		$this->load->view('retur_penjualan/retur_penjualan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['detail'] = $this->input->post('detail');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['userid'] = get_userid();
		
		
		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('retur_penjualan/retur_penjualan_add',$data);
			
		}else{
			
			# insert return penjualan
			$detail = $data['detail'];
			$count_detail = count($detail);
		
			for($i=0; $i<$count_detail; $i++)
			{
				if(isset($detail[$i]['id_barang'])){
					
					$_data['id_detail_penjualan'] 	= $detail[$i]['id_detail_penjualan'];
					$_data['id_barang'] 	= $detail[$i]['id_barang'];
					$_data['qty'] 			= $detail[$i]['qty'];
					$_data['sn'] 			= $detail[$i]['sn'];
					$_data['tanggal'] 		= $data['tanggal'];
					$_data['userid'] 		= $data['userid'];
					
					$this->retur_penjualan->insert($_data);
				}
			}
			
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('retur_penjualan');
		}
		
		$this->close();
	}
	
	// function update($id)
	// {
		// if ($this->can_update() == FALSE){
			// redirect('auth/failed');
		// }
		
		// $this->open();
		
		// $data['result'] 		= $this->retur_penjualan->getItemById($id);
		
		// $data['id_retur_penjualan']		 	= $id;
		// $data['id_penjualan']			 	= $data['result']->row()->id_penjualan;
		// $data['id_barang'] 					= $data['result']->row()->id_barang;
		// $data['sn'] 						= $data['result']->row()->id_barang;
		// $data['qty'] 						= $data['result']->row()->qty;
		// $data['tanggal']					= $data['result']->row()->tanggal;
		// $data['userid']						= $data['result']->row()->userid;
		
		
		// $this->load->view('retur_penjualan/retur_penjualan_edit', $data);
		
		// $this->close();
	// }
	
	// function process_update()
	// {
		// if ($this->can_update() == FALSE){
			// redirect('auth/failed');
		// }
		
		// $this->open();
		
		// 
		// $data['id_retur_penjualan'] = $this->input->post('id_retur_penjualan');
		// $data['id_penjualan'] = $this->input->post('id_penjualan');
		// $data['id_barang'] = $this->input->post('id_barang');
		// $data['sn'] = $this->input->post('qty');
		// $data['qty'] = $this->input->post('qty');
		// $data['tanggal'] = $this->input->post('tanggal');
		// $data['userid'] = get_userid();
		
		
		// 		
		// $this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'required');
		// $this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		// $this->form_validation->set_rules('qty', 'qty', 'required');
		// $this->form_validation->set_rules('tanggal', 'tanggal', 'required');		
		
		// $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		// 
		// $this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		// if ($this->form_validation->run() == FALSE){
			
			// $this->load->view('retur_penjualan/retur_penjualan_edit',$data);
			
		// }else{	
			// $this->retur_penjualan->update($data['id_retur_penjualan'], $data);
			// $this->session->set_flashdata('message', 'Data Berhasil diupdate.');
			// redirect('retur_penjualan');
		// }
		
		// $this->close();
		
	// }
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->retur_penjualan->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('retur_penjualan');
	}
	
	function get_barang_by_so($so)
	{
		# ambil id pembelian berdasarkan no SO di tabel pembelian
		$this->db->flush_cache();
		$this->db->from('penjualan');
		$this->db->where('so_no', $so);
		$que1 = $this->db->get();
		
		if($que1->num_rows() > 0){
			$id_penjualan = $que1->row()->id_penjualan;
			
			# ambil barang-barang berdasarkan id pembelian di tabel detail pembelian
			$this->db->flush_cache();
			$this->db->select('detail_penjualan.*, barang.*');
			$this->db->from('detail_penjualan');
			$this->db->join('barang', 'barang.id_barang = detail_penjualan.id_barang');
			$this->db->where('id_penjualan', $id_penjualan);
			$que2 = $this->db->get();
			
			
			if($que2->num_rows() > 0){
				# populasi
				$i=0;
				foreach($que2->result() as $row){
					echo
							'<tr>
								<td>
									<input name="detail['.$i.'][id_detail_penjualan]" value="'.$row->id_detail_penjualan.'" type="hidden" />
									<input name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" type="checkbox" />
								</td>
								<td>'.($i + 1).'</td>
								<td>'.$row->nama_barang.'</td>
								<td>'.$row->sn.'
										<input size="3" name="detail['.$i.'][sn]" type="hidden" value="'.$row->sn.'" />
								</td>
								<td>'.$row->qty.'</td>
								<td>'.$row->qty.'
								<input size="3" name="detail['.$i.'][qty]" type="hidden" value="1" /></td>
							</tr>' 
					;
					
					$i++;
				}
			}
		}
	}
	
	
	
}