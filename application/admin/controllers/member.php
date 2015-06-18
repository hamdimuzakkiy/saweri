<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_member', 'member');
		
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		$config['base_url'] = base_url().'index.php/member/index/';
		$config['total_rows'] = $this->member->getallItem('pelanggan');
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
		$data['results'] = $this->member->getItem($config['per_page'], $this->uri->segment(3));
		$this->load->view('member/member_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_pelanggan'] = strtoupper($this->input->post('id_pelanggan'));
		$data['kode_pelanggan'] = strtoupper($this->input->post('kode_pelanggan'));
		$data['nama'] = strtoupper($this->input->post('nama'));
		$data['alamat'] = strtoupper($this->input->post('alamat'));
		$data['tgl_lahir'] = strtoupper($this->input->post('tgl_lahir'));
		$data['agama'] = strtoupper($this->input->post('agama'));
		$data['pekerjaan'] = strtoupper($this->input->post('pekerjaan'));
		$data['jenis_pengenal'] = $this->input->post('jenis_pengenal');
		$data['no_pengenal'] = strtoupper($this->input->post('no_pengenal'));
		$data['tel'] = $this->input->post('tel');
		$data['max_piutang'] = $this->input->post('max_piutang');
		$data['id_area'] = $this->input->post('id_area');
		$data['point'] = $this->input->post('point');
		$data['expired'] = $this->input->post('expired');
		$data['saldo_piutang'] = $this->input->post('saldo_piutang');				
		$data['tanggal_piutang'] = $this->input->post('tanggal_piutang');
                $data['id_kartu'] = $this->input->post('id_kartu');
                $data['no_kartu'] = $this->input->post('no_kartu');
		$data['userid'] = get_userid();
				
		$this->form_validation->set_rules('kode_pelanggan', 'Kode Pelanggan', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim');
		$this->form_validation->set_rules('agama', 'Agama', 'trim');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim');
		$this->form_validation->set_rules('jenis_pengenal', 'Jenis Pengenal', 'required');
		$this->form_validation->set_rules('no_pengenal', 'No Pengenal', 'required|numeric');
		$this->form_validation->set_rules('tel', 'Telepon', 'trim|numeric');
		$this->form_validation->set_rules('max_piutang', 'Max Piutang', 'trim|numeric');
		$this->form_validation->set_rules('id_area', 'Max id_area', 'trim');
		$this->form_validation->set_rules('point', 'Point', 'trim|numeric');
		$this->form_validation->set_rules('expired', 'Expired', 'trim');				
		$this->form_validation->set_rules('tanggal_piutang', 'Tanggal Saldo Piutang', 'trim');
		$this->form_validation->set_rules('saldo_piutang', 'Saldo Piutang', 'trim|numeric');
                $this->form_validation->set_rules('id_kartu', 'ID Kartu', 'required');
                $this->form_validation->set_rules('no_kartu', 'No Kartu', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
                $checker = $this->checkMemberID($data['kode_pelanggan']);
                
		if ($this->form_validation->run() == FALSE){			
			$data['usernameValidation']=0;
                        $data['get_date_now'] = date('Y-m-d');
			$this->load->view('member/member_add',$data);
		}
                else if($checker == FALSE){			
			$data['usernameValidation']=1;
                        $data['get_date_now'] = date('Y-m-d');
			$this->load->view('member/member_add',$data);
		}
                else{	
			$this->member->insert($data);
			$this->session->set_flashdata('message', 'Data Pelanggan Berhasil disimpan.');
			redirect('member');
		}
		$this->close();
	}
	
	function update($id)
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		$data['result'] 		= $this->member->getItemById($id);
		
		$data['id_pelanggan'] = $id;
		$data['kode_pelanggan'] = $data['result']->row()->kode_pelanggan;
		$data['nama'] = $data['result']->row()->nama;
		$data['alamat'] = $data['result']->row()->alamat;
		$data['tgl_lahir'] = $data['result']->row()->tgl_lahir;
		$data['agama'] = $data['result']->row()->agama;
		$data['pekerjaan'] = $data['result']->row()->pekerjaan;
		$data['jenis_pengenal'] = $data['result']->row()->jenis_pengenal;
		$data['no_pengenal'] = $data['result']->row()->no_pengenal;
		$data['tel'] = $data['result']->row()->tel;
		$data['max_piutang'] = $data['result']->row()->max_piutang;
		$data['id_area'] = $data['result']->row()->id_area;
		$data['point'] = $data['result']->row()->point;
		$data['expired'] = $data['result']->row()->expired;
		$data['saldo_piutang'] = $data['result']->row()->saldo_piutang;				
		$data['tanggal_piutang'] = $data['result']->row()->tanggal_piutang;
                $data['id_kartu'] = $data['result']->row()->id_kartu;				
		$data['no_kartu'] = $data['result']->row()->no_kartu;
		
		$this->load->view('member/member_edit', $data);
		$this->close();
	}
	
	function process_update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		
		$data['id_pelanggan'] = strtoupper($this->input->post('id_pelanggan'));
		$data['kode_pelanggan'] = strtoupper($this->input->post('kode_pelanggan'));
		$data['nama'] = strtoupper($this->input->post('nama'));
		$data['alamat'] = strtoupper($this->input->post('alamat'));
		$data['tgl_lahir'] = strtoupper($this->input->post('tgl_lahir'));
		$data['agama'] = strtoupper($this->input->post('agama'));
		$data['pekerjaan'] = strtoupper($this->input->post('pekerjaan'));
		$data['jenis_pengenal'] = $this->input->post('jenis_pengenal');
		$data['no_pengenal'] = $this->input->post('no_pengenal');
		$data['tel'] = $this->input->post('tel');
		$data['max_piutang'] = $this->input->post('max_piutang');
		$data['id_area'] = $this->input->post('id_area');
		$data['point'] = $this->input->post('point');
		$data['expired'] = $this->input->post('expired');
		$data['saldo_piutang'] = $this->input->post('saldo_piutang');
		$data['userid'] = get_userid();
		$data['tanggal_piutang'] = $this->input->post('tanggal_piutang');
		$data['id_kartu'] = $this->input->post('id_kartu');
		$data['no_kartu'] = $this->input->post('no_kartu');
		
		$this->form_validation->set_rules('kode_pelanggan', 'Kode Pelanggan', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim');
		$this->form_validation->set_rules('agama', 'Agama', 'trim');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim');
		$this->form_validation->set_rules('jenis_pengenal', 'Jenis Pengenal', 'required');
		$this->form_validation->set_rules('no_pengenal', 'No Pengenal', 'required|numeric');
		$this->form_validation->set_rules('tel', 'Telepon', 'trim|numeric');
		$this->form_validation->set_rules('max_piutang', 'Max Piutang', 'trim|numeric');
		$this->form_validation->set_rules('id_area', 'Max id_area', 'trim');
		$this->form_validation->set_rules('point', 'Point', 'trim|numeric');
		$this->form_validation->set_rules('expired', 'Expired', 'trim');
		$this->form_validation->set_rules('saldo_piutang', 'Saldo Piutang', 'trim|numeric');
		$this->form_validation->set_rules('id_kartu', 'ID Kartu', 'required');
                $this->form_validation->set_rules('no_kartu', 'No Kartu', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		
		if ($this->form_validation->run() == FALSE){			
			$this->load->view('member/member_edit',$data);
		}else{	
			$this->member->update($data['id_pelanggan'], $data);
			$this->session->set_flashdata('message', 'Data Pelanggan Berhasil diupdate.');
			redirect('member');
		}
		$this->close();	
	}
	
	function delete($id)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		$this->member->delete($id);
		$this->session->set_flashdata('message', 'Data Pelanggan Berhasil dihapus.');
		redirect('member');
	}
        function getKecamatan(){ 
            $kabupaten = $this->uri->segment('3');
            $this->db->flush_cache();
            $this->db->where("id_kabupaten",$kabupaten);
            $id_kecamatan = $this->db->get("kecamatan");
            echo '<option value="0">-</option>';
            foreach ($id_kecamatan->result() as $kecamatan){
                echo '<option value="'.$kecamatan->id_kecamatan.'">'.$kecamatan->kecamatan.'</option>';
            }
        }
        function getArea(){ 
            $kecamatan = $this->uri->segment('3');
            $this->db->flush_cache();
            $this->db->where("id_kecamatan",$kecamatan);
            $id_area = $this->db->get("area");
            echo '<option value="0">-</option>';
            foreach ($id_area->result() as $area){
                echo '<option value="'.$area->id_area.'">'.$area->area.'</option>';
            }
        }
        function checkMemberID($id){
            $result = $this->member->getItemByKode($id);
            if($result->num_rows==0)return TRUE;
            else return FALSE;
        }
}