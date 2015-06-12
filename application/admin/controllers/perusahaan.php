<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class perusahaan extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();		
        $this->load->model('mdl_cabang', 'cabang');		
		//$this->load->library('fungsi');
		
	}
        
	function index()
	{
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
         $idCabang = $this->getIdCabang();
        $data['results'] = $this->cabang->getItemById($idCabang);

        $this->load->view('perusahaan/perusahaan_list', $data);
	}

	function update()
	{
		if ($this->can_update() == FALSE){
			redirect('auth/failed');
		}
		
		$this->open();
		 $idCabang = $this->getIdCabang();
		$data['idCabang'] = $idCabang;
        $results = $this->cabang->getItemById($idCabang);

        foreach ($results->result() as $row) {
        	$data['perusahaan'] = $row->perusahaan;
        	$data['alamat'] = $row->alamat;
        }

        $this->load->view('perusahaan/perusahaan_edit', $data);
	}

	function process_update()
	{
		$this->open();
		$data['perusahaan'] = $this->input->post('perusahaan');
		$data['alamat'] = $this->input->post('alamat');

		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required');
				
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->form_validation->set_message('required', 'Field %s harus diisi!');		

		if ($this->form_validation->run() == FALSE)
		$this->load->view('perusahaan/perusahaan_edit',$data);
		else
		{	
			$idCabang = $this->getIdCabang();
			$this->cabang->update($idCabang,$data);
			$this->session->set_flashdata('message', 'Data Perusahaan Berhasil diupdate.');			
			redirect('perusahaan');
		}
		$this->close();

	}
}
