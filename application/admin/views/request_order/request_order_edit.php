<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/request_order/index'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021'});
	})
	
	function save_data(){
		
		var isi = document.getElementById('detail').innerHTML;

		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
			//alert('kosong');
		}else{
			document.getElementById('alert_yanto').innerHTML = '';
			//alert('berisi');
			document.forms["form1"].submit();
		}
		
	}
	
	function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
</script>

<script type="text/javascript">
	
	
	$(document).ready(function() {
		$("#getbarang").fancybox();
	});
	
	
	function set_detail(){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_ro.php?command=add_2'?>', //url: $(this).attr('action'),
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});
		
		document.getElementById('detail_idbarang').value = '';	
		document.getElementById('detail_namabarang').value = '';
		//document.getElementById('detail_harga').value = '';
		document.getElementById('detail_qty').value = '';
	}
	
	function remove_detail(id){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_ro.php?command=remove&id='?>'+id,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});
		
	}
	
</script>

<div id="alert_yanto"></div><br>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('request_order/process_update', $attributes);
		?>
			<h1>Pembelian > Edit Data Request Order</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<input type="hidden" name="id_request_order" id="id_request_order" value="<?=$id_request?>">
					<p class="colx3-left">
						<label for="complex-en-url">Tanggal (*) :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=$tanggal?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Cabang (*) :</label>
						<span class="relative">
							<?php
								$this->db->flush_cache();
								$this->db->where('id_cabang', $this->session->userdata('idcabang'));
								$qq = $this->db->get('cabang');
							?>
						
							<input type="hidden" name="id_cabang" id="id_cabang" value="<?=$qq->row()->id_cabang?>" />
							<input type="text" name="nama_cabang" id="nama_cabang" readonly="true" value="<?=$qq->row()->nama_cabang?>" />
						</span>
					</p>
				</div>
				
			</fieldset>
				
				<fieldset>
					
						<div class="columns">
							<p class="colx3-left">
								<label for="complex-en-url">Nama Barang :</label>
								<span class="relative">
										<input type="text" name="detail_namabarang" id="detail_namabarang" />
										<a id="getbarang" href="<?=base_url().'index.php/request_order/show_barang'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
										<input type="hidden" name="detail_idbarang" id="detail_idbarang" />
								</span>
							</p>
							<!--<p class="colx3-center">
								<label for="complex-en-url">Harga Barang :</label>
								<span class="relative">
										<input type="text" name="detail_harga" id="detail_harga" readOnly="true"/>
								</span>
							</p>-->
							<p class="colx3-center">
								<label for="complex-en-url">Qty :</label>
								<span class="relative">
										<input type="text" name="detail_qty" id="detail_qty" />
								</span>
							</p>
						</div>
						
						
						<div class="columns">
							<p class="colx2-left">
								<input onclick="set_detail()" type="button" name="button2" id="button2" value="Tambah Ke List" />
							</p>
						</div>
					
							<table class="table" border="1" cellspacing="0" width="100%">
							
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama Barang</th>
										<th scope="col">Qty</th>
									</tr>
								</thead>
								
								<tbody id="detail">
									<?php
										$this->db->flush_cache();
										$this->db->select('detail_request_order.*, barang.nama_barang, barang.id_barang');
										$this->db->from('detail_request_order');
										$this->db->join('barang', 'barang.id_barang = detail_request_order.id_barang');
										$this->db->where('id_request', $id_request);
										$query = $this->db->get();
										
										$i=0;
										foreach($query->result() as $row){
											echo '
													<tr>
														<td>'.($i + 1).'</td>
														<td>
															'.$row->nama_barang.'
															<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$row->nama_barang.'" />
															<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" />
														</td>
														<td>
															<input type="text" name="detail['.$i.'][qty]" value="'.$row->qty.'" />
														</td>
														<td align="center">
															<a href="Javascript:remove_detail('.$i.')">Batal</a>
														</td>
													</tr>';
											$i++;
										}
									?>
								</tbody>
							</table>
							<br/>
							
							<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
					
				</fieldset>

				
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	
			</div>	
			
		</form>
		
		
	</div>
	
</section>