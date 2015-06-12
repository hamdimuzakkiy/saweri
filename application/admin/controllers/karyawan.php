<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class karyawan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_karyawan', 'karyawan');
		$this->load->model('mdl_users', 'users');
                $this->load->model('mdl_cabang', 'cabang');
		$this->load->library('pdf');
		//$this->load->library('fungsi');
		
	}
	
	function cokot($id){
                echo $this->karyawan->get_idkaryawan($id);
		return $this->karyawan->get_idkaryawan($id);
	}
	
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/karyawan/index/';
		$config['total_rows'] = $this->karyawan->countallItem('karyawan');
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
		
		
		
		$data['results'] = $this->karyawan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('karyawan/karyawan_list', $data);
		
		$this->close();
	}
	
	
	function insert()
	{
		if ($this->can_insert() == FALSE){
			redirect('auth/failed');
		}
		$this->open();
		
		/*$data['id_karyawan'] = $this->input->post('id_karyawan'); */
		$data['id_cabang'] = $this->input->post('id_cabang');
		//$data['kode_karyawan'] = $this->input->post('kode_karyawan');
                $data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['telp1'] = $this->input->post('telp1');
		$data['jenis_pengenal'] = $this->input->post('jenis_pengenal');
		$data['no_pengenal'] = $this->input->post('no_pengenal');
		$data['point'] = $this->input->post('point');
		$data['status'] = $this->input->post('status');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['level_id'] = $this->input->post('level_id');
		$data['userid'] = $this->input->post('userid');
                $data['usernameValidation']=0;
		
		
		
		$this->form_validation->set_rules('id_cabang', 'ID Cabang', 'required');		
		//$this->form_validation->set_rules('kode_karyawan', 'Kode Karyawan', 'required');		
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('jenis_pengenal', 'Jenis Pengenal', 'required');
		$this->form_validation->set_rules('no_pengenal', 'No Pengenal', 'required|numeric');
		$this->form_validation->set_rules('point', 'Point', 'trim');
		$this->form_validation->set_rules('telp1', 'Telepon 1', 'trim|numeric');	
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confpassword]');
		$this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		$this->form_validation->set_message('alpha_dash', 'Field %s harus diisi hanya dengan karakter, angka, underscore, titik!');
		$this->form_validation->set_message('matches', 'Field Password harus sama dengan password confirmasi');
		
		
		if ($this->form_validation->run() == FALSE){	
			$this->load->view('karyawan/karyawan_add',$data);
		}
                else{	
			/*insert ke tabel karyawan */
			$data_karyawan['id_karyawan'] = $this->input->post('id_karyawan');
			$data_karyawan['userid'] = $this->input->post('userid');
			$data_karyawan['id_cabang'] = $this->input->post('id_cabang');
			//$data_karyawan['kode_karyawan'] = $this->input->post('kode_karyawan');
                        $data1 = $this->cabang->getItemByID($data_karyawan['id_cabang']);
                        
                        foreach ($data1->result() as $temp){
                            $kode_karyawan = $temp->kode_cabang;
                        }
			$data_karyawan['kode_karyawan'] = $this->cokot($kode_karyawan);
                        $data_karyawan['nama'] = $this->input->post('nama');
			$data_karyawan['alamat'] = $this->input->post('alamat');
			$data_karyawan['jenis_pengenal'] = $this->input->post('jenis_pengenal');
			$data_karyawan['no_pengenal'] = $this->input->post('no_pengenal');
			$data_karyawan['point'] = $this->input->post('point');
			$data_karyawan['status'] = $this->input->post('status');
			$data_karyawan['telp1'] = $this->input->post('telp1');
			
			/* insert ke tabel user */
			$data_user['userid'] = $this->input->post('userid');
			$data_user['username'] = $this->input->post('username');
			$data_user['password'] = md5($this->input->post('password'));
			$data_user['level_id'] = $this->input->post('level_id');
			
                        if(sizeof($this->karyawan->CheckUsername($data_user['username'])->result())==1){
                            $data['usernameValidation']=1;
                            $this->load->view('karyawan/karyawan_add',$data);                            
                            return 0;
                        }
                        else{
                            $this->users->insert($data_user);
                            $this->karyawan->insert($data_karyawan);
                            $this->session->set_flashdata('message', 'Data Karyawan Berhasil disimpan.');
                            redirect('karyawan');
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
		
		$data['result'] 		= $this->karyawan->getItemById($id);
		
		$data['id_karyawan'] = $id;
		$data['id_cabang'] = $data['result']->row()->id_cabang;
		$data['kode_karyawan'] = $data['result']->row()->kode_karyawan;
		$data['nama'] = $data['result']->row()->nama;
		$data['alamat'] = $data['result']->row()->alamat;
		$data['telp1'] = $data['result']->row()->telp1;
		$data['jenis_pengenal'] = $data['result']->row()->jenis_pengenal;
		$data['no_pengenal'] = $data['result']->row()->no_pengenal;
		$data['status'] = $data['result']->row()->status;
		$data['point'] = $data['result']->row()->point;		
		$data['username'] = $data['result']->row()->username;		
		$data['password'] = $data['result']->row()->password;		
		$data['confpassword'] = $data['result']->row()->password;
		$data['level_id'] = $data['result']->row()->level_id;
		$data['userid'] = $data['result']->row()->userid;
		
		$this->load->view('karyawan/karyawan_edit', $data);
		
		$this->close();
	}
	
	function process_update()
	{

		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
				
		$data['id_karyawan'] = $this->input->post('id_karyawan');
		//$data['id_cabang'] = $this->input->post('id_cabang');
		//$data['kode_karyawan'] = $this->input->post('kode_karyawan');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['telp1'] = $this->input->post('telp1');
		$data['jenis_pengenal'] = $this->input->post('jenis_pengenal');
		$data['no_pengenal'] = $this->input->post('no_pengenal');
		$data['point'] = $this->input->post('point');
		$data['status'] = $this->input->post('status');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$data['confpassword'] = $this->input->post('confpassword');
		$data['level_id'] = $this->input->post('level_id');
		$data['userid'] = $this->input->post('userid');
		
		
		//$this->form_validation->set_rules('id_cabang', 'ID Cabang', 'required');		
		//$this->form_validation->set_rules('kode_karyawan', 'Kode Karyawan', 'required');		
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('jenis_pengenal', 'Jenis Pengenal', 'required');
		$this->form_validation->set_rules('no_pengenal', 'No Pengenal', 'required|numeric');
		$this->form_validation->set_rules('point', 'Point', 'trim');
		$this->form_validation->set_rules('telp1', 'Telepon 1', 'trim|numeric');		
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confpassword]');
		$this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required');
				
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');
		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');
		$this->form_validation->set_message('alpha_dash', 'Field %s harus diisi hanya dengan karakter, angka, underscore, titik!');
		$this->form_validation->set_message('matches', 'Field Password harus sama dengan password confirmasi');
		
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('karyawan/karyawan_edit',$data);
			
		}else{				
			
			/* update ke tabel karyawan */
			$data_karyawan['id_karyawan'] = $this->input->post('id_karyawan');
			$data_karyawan['userid'] = $this->input->post('userid');
			//$data_karyawan['id_cabang'] = $this->input->post('id_cabang');
			//$data_karyawan['kode_karyawan'] = $this->input->post('kode_karyawan');
                        //$data_karyawan['kode_karyawan'] = $this->cokot($data_karyawan['id_cabang']);
			$data_karyawan['nama'] = $this->input->post('nama');
			$data_karyawan['alamat'] = $this->input->post('alamat');
			$data_karyawan['jenis_pengenal'] = $this->input->post('jenis_pengenal');
			$data_karyawan['no_pengenal'] = $this->input->post('no_pengenal');
			$data_karyawan['point'] = $this->input->post('point');
			$data_karyawan['status'] = $this->input->post('status');
			$data_karyawan['telp1'] = $this->input->post('telp1');
						
			$this->karyawan->update($data_karyawan['id_karyawan'], $data_karyawan);
			
			/* insert ke tabel user */
			$data_user['userid'] = $this->input->post('userid');
			$data_user['username'] = $this->input->post('username');
			$user_password = $this->input->post('password');
			$data_user['level_id'] = $this->input->post('level_id');
			
                        $checker = $this->checkPass($data_user['username'],$user_password);
                        if($checker==TRUE){
                            $data_user['password']=  md5($data_user['password']);
                            $this->users->update($data_user['userid'], $data_user);
                        }
                        else{
                            $this->users->update($data_user['userid'], $data_user);
                        }
			
			$this->session->set_flashdata('message', 'Data Karyawan Berhasil diupdate.');			
			redirect('karyawan');
		}
		
		$this->close();
		
	}
	
	function delete($id, $userid)
	{
		if ($this->can_delete() == FALSE){
			redirect('auth/failed');
		}
		
		$this->karyawan->delete_karyawan($id);
		$this->karyawan->delete_users($userid);
		$this->session->set_flashdata('message', 'Data Karyawan Berhasil dihapus.');
		redirect('karyawan');
	}
	
	function prepare_report_excel(){
		$data['can_view'] 	= $this->can_view();
		
		
		
		$config['base_url'] = base_url().'index.php/karyawan/index/';
		$config['total_rows'] = $this->db->count_all('karyawan');
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
		
		
		$data['results'] = $this->karyawan->getItem($config['per_page'], $this->uri->segment(3));
		
		
		$this->load->view('karyawan/karyawan_report', $data);
		
		
	}
        
	function report_excel(){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=rekap_penjualan_periode.xls");
		echo  $this->input->post('rekap_tabel1');
	}
	
	function pdf_lap_karyawan(){
		
		$data['results'] = $this->karyawan->getAll(false);
		$data['num'] = $this->karyawan->getAll(true);
		$html=$this->load->view('karyawan/karyawan_report_pdf', $data, true);
		$this->pdf->pdf_create($html, 'karyawan_report_pdf','letter','landscape');
	}
        function checkPass($username,$password){
            $result = $this->users->checkPass($username,$password);
            if($result->num_rows==0)return TRUE;
            else return FALSE;
        }
}
