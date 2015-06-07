<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penukaran_point extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_penukaran_point', 'penukaran_point');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/penukaran_point/index/';
		$config['total_rows'] = $this->db->count_all('penukaran_point');
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
		
		
		
		$data['results'] = $this->penukaran_point->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('penukaran_point/penukaran_point_pelanggan_list', $data);
		
		$this->close();
	}
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_penukaranpoint'] 			= $this->input->post('id_penukaranpoint');
		$data['id_barang'] 					= $this->input->post('id_barang');	
		$data['qty']						= $this->input->post('qty');
		$data['jmlpoint_tukar']				= $this->input->post('jmlpoint_tukar');
		$data['id_karyawan'] 			    = $this->input->post('id_karyawan');
		$data['id_pelanggan'] 			    = $this->input->post('id_pelanggan');
		
		$type = $this->input->post('input_tipe');
		$id_customer = $this->input->post('input_id');
		$customer_point = $this->input->post('input_point');
		
		
		$this->form_validation->set_rules('id_penukaranpoint', 'id_penukaranpoint', 'trim');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$this->form_validation->set_message('required', 'Field harus diisi!');
		
		
		if ($this->form_validation->run() == FALSE){
			
			$this->load->view('penukaran_point/penukaran_point_add',$data);
			
		}else{
		
			$total_point=0;
			$total_point_perbarang=0;
			
			$detail = $this->input->post('detail');
			$count_detail = count($detail);
			$i=0;
			for($i=0; $i<$count_detail; $i++)
			{
				$total_point_perbarang=0;
				
				// ambil id barang dan qty
				if(isset($detail[$i]['id_barang'])){
					$id_barang 	= $detail[$i]['id_barang'];
					$qty 		= $detail[$i]['qty'];
					if($id_barang != '' && $qty != ''){	// jika id barang and qty != null
						
						// ambil point barang dri tabel kmudian kaluklasikan dgn qty
						$this->db->flush_cache();
						$this->db->from('barang');
						$this->db->where('id_barang', $id_barang);
						$tb_barang = $this->db->get();
						
						$total_point_perbarang=(int) $tb_barang->row()->point_barangpoint * $qty;
						$total_point = $total_point + $total_point_perbarang;
						
						$penukaran['id_barang'] = $id_barang;
						$penukaran['qty'] = $qty;
						$penukaran['jmlpoint_tukar'] = $total_point_perbarang;
						
						if($type == 'pelanggan'){
							$penukaran['id_karyawan'] 	= '0';
							$penukaran['id_pelanggan'] 	= $id_customer;
						}else{
							$penukaran['id_pelanggan'] 	= '0';
							$penukaran['id_karyawan'] 	= $id_customer;
						}
						
						// insert ke tabel penukaran_point
						$this->db->flush_cache();
						$this->db->insert('penukaran_point', $penukaran);
					}
				}
			}
			
			// ambil point karyawan/pelanggan
			// dan kurangi dengan total point barang yg sudah di ambil
			if($type == 'pelanggan'){
				$this->db->flush_cache();
				$this->db->where('id_pelanggan', $id_customer);
				$this->db->update('pelanggan', array('point' => ($customer_point - $total_point)));
			}else{
				$this->db->flush_cache();
				$this->db->where('id_karyawan', $id_customer);
				$this->db->update('karyawan', array('point' => ($customer_point - $total_point)));
			}
			
			$this->session->set_flashdata('message', 'Data Berhasil disimpan.');
			redirect('penukaran_point');
		}
		
		$this->close();
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->penukaran_point->delete($id);
		$this->session->set_flashdata('message', 'Data Berhasil dihapus.');
		redirect('penukaran_point');
	}
	
	function get_expired_by_pelanggan($id_pelanggan)
	{
		# ambil id pembelian berdasarkan id pelanggan di tabel pembelian
		$this->db->flush_cache();
		$this->db->from('pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$que1 = $this->db->get();
		
		if($que1->num_rows() > 0){
			
				# populasi
				$i=0;
				foreach($que1->result() as $row){
					echo
							'<tr>
								<td>'.$row->expired.'</td>
								<td>'.$row->point.'</td>
							</tr>' 
					;
					
					$i++;
				}
		}
	}
	
	function get_point_by_barang($id_barang)
	{
		# ambil id pembelian berdasarkan no SO di tabel pembelian
		$this->db->flush_cache();
		$this->db->from('barang');
		$this->db->where('id_barang', $id_barang);
		$que1 = $this->db->get();
		
		if($que1->num_rows() > 0){
				# populasi
				$i=0;
				foreach($que1->result() as $row){
					echo
							'<tr>
								<td>
									<input name="detail['.$i.'][id_barang]" value="'.$id_barang.'" type="hidden" />
									<input name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" type="checkbox" />
								</td>
								<td>'.($i + 1).'</td>
								<td>'.$row->nama_barang.'</td>
								<td>'.$row->point.'</td>
							</tr>' 
					;
					
					$i++;
				}
			}
		}
	
	
	// menampilkan fancy box
	function get_customer($tipe){
		$queri = '';
		$this->db->flush_cache();
		if($tipe == 'pelanggan'){
			$queri = $this->db->get('pelanggan');
		}else{
			$queri = $this->db->get('karyawan');
		}
		
		$data['result'] = $queri;
		$data['tipe'] = $tipe;
		
		$this->load->view('penukaran_point/get_customer', $data);
		
	}
	
}