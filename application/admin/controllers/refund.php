<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class refund extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();		$this->load->model('mdl_refund', 'refund');		$this->load->library(array('fungsi','pquery'));
	}
	
	function index($sebagai='')
	{
		if ($this->can_view() == FALSE){
			redirect('auth/failed');
		}
		
		$data['can_view'] 	= $this->can_view();
		$data['can_insert'] = $this->can_insert();
		$data['can_update'] = $this->can_update();
		$data['can_delete'] = $this->can_delete();
		
		$this->open();
		
		
		$config['base_url'] = base_url().'index.php/refund/index/';
		$config['total_rows'] = $this->db->count_all('jurnal');
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
		
		
				
		$data['results'] = $this->refund->getItem($config['per_page'], $this->uri->segment(3));		
		//$data['sebagai'] = $sebagai;
		
		
		
		$this->load->view('refund/refund_list', $data);
		
		$this->close();
	}			function koreksi(){		if ($this->can_update() == FALSE){			
			redirect('auth/failed');		}						$this->open();		$glid1=$this->uri->segment(3);		$glid2=$this->uri->segment(4);		$glid3=$this->uri->segment(5);		$glid=$glid1 . '/' . $glid2 . '/' . $glid3;		
			//$data['result'] = $this->refund->getItemById($id);		
			$data['result']=$this->refund->get_item_jurnal_detail($glid);		$data['results']=$this->refund->get_item_jurnal($glid);		$data['glid']	= $glid;						$this->load->view('refund/refund_edit', $data);		$this->close();	}		function process_koreksi(){				$id					= $this->input->post('id');		$id_refund			= $this->input->post('id_refund');		$id_pilihan			= $this->input->post('id_pilihan');		
			//$nominal			= $this->input->post('nominal');		
			//$nominal_read		= $this->input->post('nominal_read');		
			//$akunid				= $this->input->post('akunid');		
			$tanggal			= $this->input->post('tanggal');		$glid				= $this->input->post('glid');		
			$refund				= $this->input->post('refund');		$keterangan			= $this->input->post('keterangan');		
			$KOUNIT				= $this->input->post('KOUNIT');		$PARTNERID			= $this->input->post('PARTNERID');		$gen_glid			=$this->refund->get_glid_jurnal();						$this->form_validation->set_rules('id_pilihan', 'id_pilihan', 'required');		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		$this->form_validation->set_message('required', 'Field %s harus diisi!');		
			if ($this->form_validation->run() == FALSE){	
			/*$this->open();		
			//$data['result'] = $this->refund->getItemById($id);		$data['result']=$this->refund->get_item_jurnal_detail($glid);		
			$data['results']=$this->refund->get_item_jurnal($glid);		$data['glid']	= $glid;					
			$this->load->view('refund/refund_edit', $data); 					$this->close();*/				
			$this->session->set_flashdata('message', 'Option pilihan harus dipilih');					redirect('refund/koreksi/' . $glid);		}else{				$dataJ['GLID_PARENT'] 	= $glid;				$dataJ['GLID'] 			= $gen_glid;				$dataJ['TANGGAL'] 		= $tanggal;				$dataJ['CUID'] 			= get_userid();				$dataJ['CDATE'] 		= date('Y-m-d');				$dataJ['KETERANGAN'] 	= $keterangan;				$dataJ['PARTNERID'] 	= $PARTNERID;				$dataJ['KOUNIT'] 		= $KOUNIT;				
			/*				foreach($akunid as $row_akun){					//$data['akuid'][] = $row_akun;					$akun[] = $row_akun;				
			}				foreach($nominal_read as $row_nominal_read){					
			//$data['nominal_read'][] = $row_nominal_read;					 $read_nominal[]=$row_nominal_read;				}*/								
			$nilai_d=0;				$nilai_k=0;				foreach($refund as $row){					if ($row['akunid'] == true){						
			//$read_nominal[]=$row_nominal_read;						
			//echo $data['akunid']=$row['akunid'] . '-';						
			//echo $data['nominal_read_d']=$row['nominal_read_d'] . '-';						
			if ($row['nominal_d']==null){							$nilai_d=$nilai_d + 0;						
			}else						$nilai_d=$nilai_d + $row['nominal_d'];												
			if ($row['nominal_k']==null){							$nilai_k=$nilai_k + 0;						
			}else						$nilai_k=$nilai_k +$row['nominal_k'];						
			//echo $data['nominal']=$row['nominal'] . '<br/>';					
			}										
			//$data['nominal_read'][] = $row_nominal_read;					 				
			}				
			//echo '<br/> hasil _D' . $nilai_d . '<br/> : ';				
			//echo '_K' . $nilai_k;				
			//echo $nilai_d . '-' . $nilai_k;				
			if ($nilai_d!=$nilai_k){					
			//$this->load->view('refund/refund_edit');					
			$this->session->set_flashdata('message', 'Input Nominal Isian Harus Sama Antara Kredit dan Debet');					
			redirect('refund/koreksi/' . $glid);				}else{						if ($id_pilihan=='debet'){							foreach($refund as $rows){														$data_detailJ['AKUNID']=$rows['akunid'];																		if ($rows['nominal_k']!=null){																				$data_detailJ['KREDIT']=$rows['nominal_k'];										$data_detailJ['DEBET']=0;									}																		if ($rows['nominal_d']!=null){										$data_detailJ['DEBET']=$rows['nominal_d'];										$data_detailJ['KREDIT']=0;									}																																																															$data_detailJ['GLID']=$gen_glid;									$data_detailJ['CDATE']=date('Y-m-d');									$data_detailJ['CUID']=get_userid();									$data_detailJ['KETERANGAN']=$keterangan;									$data_detailJ['KOUNIT']=$KOUNIT;									$this->refund->insert_detailJ($data_detailJ);  							}								$this->refund->insert_J($dataJ); 														}elseif($id_pilihan=='kredit'){							foreach($refund as $rows){														$data_detailJ['AKUNID']=$rows['akunid'];																		if ($rows['nominal_k']!=null){										$data_detailJ['DEBET']=0;										$data_detailJ['KREDIT']=$rows['nominal_k'];									}									
			//	$data_detailJ['DEBET']=$rows['nominal_d'];																			
			if ($rows['nominal_d']!=null){										
			$data_detailJ['KREDIT']=0;										
			$data_detailJ['DEBET']=$rows['nominal_d'];									}										
			//$data_detailJ['KREDIT']=$rows['nominal_k'];																											
			$data_detailJ['GLID']=$gen_glid;									
			$data_detailJ['CDATE']=date('Y-m-d');									$data_detailJ['CUID']=get_userid();									$data_detailJ['KETERANGAN']=$keterangan;									$data_detailJ['KOUNIT']=$KOUNIT;									$this->refund->insert_detailJ($data_detailJ);  														}								$this->refund->insert_J($dataJ); 														}											redirect('refund');					}				/*		if ($id_pilihan=='debet'){			$data_detailJ['DEBET']=$nominal;		}else if($id_pilihan=='kredit'){			$data_detailJ['KREDIT']=$nominal;		}				$data_item_detail_j=$this->refund->get_item_jurnal_detail($glid);		foreach ($data_item_detail_j->result() as $row_detail){			$data_detailJ['AKUNID'] = $row_detail->AKUNID;			$data_detailJ['GLID'] = $gen_glid;								}		$this->refund->insert_detailJ($data_detailJ); 		$this->refund->insert_J($dataJ); 				redirect('refund');*/		}	}		function insert()	{				if ($this->can_insert() == FALSE){			redirect('auth/failed');		}				$id_refund		= $this->input->post('id_refund');		$debet			= $this->input->post('debet');		$kredit			= $this->input->post('kredit');		$id_refund		= $this->input->post('id_refund');		$tanggal		= $this->input->post('tanggal');		$id_pilihan		= $this->input->post('id_pilihan');		$akunid		= $this->input->post('akunid');		$jumlah_pemasukan= $this->input->post('jumlah_pemasukan');		$jumlah_pengeluaran= $this->input->post('jumlah_pengeluaran');		$jml=0;		/*		for ($i=0;$i<count($kredit);$i++){			echo "debet" . $debet[$i] . "<br/>" ;			echo "kredit" . $kredit[$i] . "<br/>" ;			$jml = $jml+$debet[$i];		}		echo $jml;*/			$this->open();									$this->form_validation->set_rules('id_refund', 'id_refund', 'required');		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');							$this->form_validation->set_message('required', 'Field %s harus diisi!');		$this->form_validation->set_message('numeric', 'Field %s harus diisi hanya dengan angka!');		
			if ($this->form_validation->run() == FALSE){			
			//$data['results']=$this->refund->get_total_tiap_akun();			
			$this->load->view('refund/refund_add');		}else{			$gen_glid=$this->refund->get_glid_jurnal();						
			$jml_kredit = 0;			$jml = 0;			$data_J['CUID'] = get_userid();									$data_J['CDATE'] = date('Y-m-d');			$data_J['GLID'] =$gen_glid; 			$data_J['KOUNIT'] =get_idcabang(); 			$data_J['TANGGAL'] =$tanggal; 			$data_J['GLID_PARENT'] =$id_refund; 						$data_R['CUID'] = get_userid();									$data_R['CDATE'] = date('Y-m-d');			$data_R['GLID'] =$gen_glid; 			$data_R['KOUNIT'] =get_idcabang(); 			$data_R['TANGGAL'] =$tanggal; 			$data_R['GLID_PARENT'] =$id_refund; 						$this->refund->insert_J($data_J);			$this->refund->insert_R($data_R); 			if ($id_pilihan=='pengeluaran'){				for ($i=0;$i<count($debet);$i++){					if ($debet[$i]!=0){						$data_detail_J['cuid'] = get_userid();						$data_detail_J['cdate'] = date('Y-m-d');						$data_detail_J['glid'] =$gen_glid;						$data_detail_J['akunid'] = $akunid[$i];								$data_detail_J['debet'] = $debet[$i];						$data_detail_J['KOUNIT'] = get_idcabang();						$this->refund->insert_detailJ($data_detail_J);						$this->refund->insert_detailR($data_detail_J);					}else{						$data_origin['cuid'] = get_userid();						$data_origin['cdate'] = date('Y-m-d');						$data_origin['glid'] =$gen_glid;						$data_origin['akunid'] = $akunid[$i];											$data_origin['kredit'] = $jumlah_pengeluaran;						$data_origin['KOUNIT'] = get_idcabang();						$this->refund->insert_detailJ($data_origin);						$this->refund->insert_detailR($data_origin);					}				}											
			}else if($id_pilihan=='pemasukan'){  //kas masuk // refund pembelian				
			for ($i=0;$i<count($kredit);$i++){					if ($kredit[$i]!=0){						
			$data_origin['cuid'] = get_userid();						$data_origin['cdate'] = date('Y-m-d');						$data_origin['glid'] =$gen_glid;						$data_origin['akunid'] = $akunid[$i];											$data_origin['kredit'] = $kredit[$i];						$data_origin['KOUNIT'] = get_idcabang();						$this->refund->insert_detailJ($data_origin);						$this->refund->insert_detailR($data_origin);					}else{						$data_detail_J['cuid'] = get_userid();						$data_detail_J['cdate'] = date('Y-m-d');						$data_detail_J['glid'] =$gen_glid;						$data_detail_J['akunid'] = $akunid[$i];								$data_detail_J['debet'] = $jumlah_pemasukan;						$data_detail_J['KOUNIT'] = get_idcabang();						$this->refund->insert_detailJ($data_detail_J);						$this->refund->insert_detailR($data_detail_J);					}				}			}													/*			$gen_glid=$this->refund->get_glid();			$count_detail = count($detail);			$i=0;						$jml=0;			for($j=0; $j<$count_detail; $j++){				$jml		= $jml + $detail[$i]['jumlah'];				}							if ($jml<=$jumlah_debet){															$data_origin['cuid'] = get_userid();						$data_origin['cdate'] = date('Y-m-d');						$data_origin['glid'] =$this->refund->get_glid();						$data_origin['akunid'] = $kd_kas_debet;											$data_origin['debet'] = $jumlah_debet;						$this->refund->insert_detail($data_origin);												
			$data_origin_J['GLID']= $this->refund->get_glid_jurnal(); 
			//$this->fungsi->gen_glid_counter('/',$gen_glid,$i);						
			$data_origin_J['CUID'] = get_userid();						
			$data_origin_J['CDATE'] = date('Y-m-d');						
			//$data_origin['glid'] =$this->refund->get_glid();						
			$data_origin_J['AKUNID'] = $kd_kas_debet;											
			$data_origin_J['DEBET'] = $jumlah_debet;						
			$this->refund->insert_detail_J($data_origin_J);												
			$data_['cuid'] = get_userid();												$data_['cdate'] = date('Y-m-d');						
			$data_['glid'] =$this->refund->get_glid();												$data_J['CUID'] = get_userid();	
			$data_J['CDATE'] = date('Y-m-d');						$data_J['GLID'] =$this->refund->get_glid_jurnal(); 
			//$this->fungsi->gen_glid_counter('/',$gen_glid,$i);																		
			$total_penjumlahan = 0;						
			for($i=0; $i<$count_detail; $i++)												{							$data_['akunid'] 		= $detail[$i]['akunid'];							$data_['kredit'] 		= $detail[$i]['jumlah'];														
			//$data_J['AKUNID'] 		= $detail[$i]['akunid'];							
			//$data_J['KREDIT'] 		= $detail[$i]['jumlah'];							
			$total_penjumlahan		= $total_penjumlahan + $detail[$i]['jumlah'];														
			//$total_penjumlahan = 2;							$this->refund->insert_detail($data_);							
			$this->refund->insert_detail_J($data_J);						}																					$this->db->flush_cache();							$data['cuid'] = get_userid();							$data['cdate'] = date('Y-m-d');							$data['glid']=$data_['glid'];							$data['jumlah']=$total_penjumlahan;														$data_J['CUID'] = get_userid();							$data_J['CDATE'] = date('Y-m-d');							$data_J['TANGGAL'] = date('Y-m-d');							$data_J['GLID_ANGSURAN']=$data_['glid'];							$data_J['GLID']=$this->refund->get_glid_jurnal(); 
			//$this->fungsi->gen_glid_counter('/',$gen_glid,$i);;																		
			$this->refund->insert($data);						$this->refund->insert_J($data_J);												$this->session->set_flashdata('message', 'Data Penerimaan Kas Berhasil disimpan.');						redirect('refund');				}else{					$this->session->set_flashdata('message', 'Kas tidak mencukupi');					$this->load->view('refund/refund_add');				}*/		}				$this->close();		redirect('refund');	}				function get_form_data(){				$data['txtBookName'] = $this->input->post('txtBookName');		$data['authorName'] = $this->input->post('authorName');		echo $data['txtBookName'].'<br/><br/>';		$i=0;		foreach ($data['authorName'] as $rows_author){			echo $i . '-' .$rows_author . '<br/>';			$i++;		}	}		function show_akun(){		$data['counter']=$this->uri->segment(3);		$filter=$this->uri->segment(4);		$data['result'] = $this->refund->get_master_akun($filter);		$this->load->view('refund/list_akun.php', $data);	}		function get_kas(){		$akunid=$this->uri->segment(3); 		$data_kas = $this->refund->get_total_tiap_akun($akunid);		foreach($data_kas->result() as $row){			echo $data['data_jml_kas']=$row->total_kas;		}	}	function tes(){		$this->open();		$this->load->view('refund/tes.php', $data);		$this->close();	}
	
}