<script type="text/javascript">
	var counter_list=0;
	function batal(){
		document.location.href = '<?php echo base_url().'index.php/pembelian'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})
	function save_data(){
		var isi = document.getElementById('detail').innerHTML;		var detail_jatuh_tempo_text = document.getElementById('detail_jatuh_tempo').value;		 		var obj_sn = document.getElementsByName("detail[id_barang]");		/* var obj_idbarang = document.getElementById("detail_idbarang0").value;		 var obj_idjenis = document.getElementById("detail_idjenis0").value;*/		/*		for (var j=0;j<counter_list;j++){							if ((document.getElementById("detail_sn" + j).value == '' ) && (obj_idjenis = document.getElementById("detail_idjenis"+ j).value=='4')){					alert("List No " + (parseInt(j)+1) + " SN tidak boleh kosong");					var sn_id = document.getElementById("detail_sn"+j).focus();										return ;				}					}*/
		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
			$('html, body').stop().animate({
				scrollTop: 0
			}, 700, 'easeInOutExpo');
		}else{			
				document.getElementById('alert_yanto').innerHTML = '';
				
				document.forms["form1"].submit(); 					
		}		
	}	
	
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#getbarang").fancybox();
	});
	function set_detail(){		
		
			var cara_bayar = document.getElementById("cara_bayar").value;		
			var detail_qty = document.getElementById("detail_qty").value;		
			var detail_idjenis = document.getElementById("detail_idjenis").value;	
			var sn = document.getElementById("sn").checked;	


			if(document.getElementById('detail_namabarang').value == ''){
				alert('Isi nama barang terlebih dahulu.');	
			}else if((cara_bayar=='2') && (document.getElementById('detail_jatuh_tempo').value == '')){			alert('Jatuh Tempo Tidak Boleh Kosong.');					}else if (detail_idjenis=='4'){			$.ajax({				type: 'POST',				url: '<?php echo base_url().'asset/admin/js/ajax_pembelian.php?command=add_sn'?>',				data: $('#get_serialize :input').serialize(),				success: function(data) {					$('#detail').html(data);					/*$.fancybox(data);*/				}			});					}
			else if (sn)
				{
					var jum = document.getElementById("detail_qty").value;					

					$.ajax({
					type: 'POST',					
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_3'?>',
					data: $('#form1').serialize(),
					success: function(data) {
						$('.detail').html(data);							
						
						
					}
				});		
						

				
				
				}
			else{
				$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_1'?>',
					data: $('#form1').serialize(),
					success: function(data) {
						$('#detail').html(data);
					}
				});
				document.getElementById('detail_idbarang').value = '';				document.getElementById('detail_namabarang').value = '';			document.getElementById('detail_harga').value = '';			document.getElementById('detail_harga_toko').value = '';			document.getElementById('detail_harga_partai').value = '';			document.getElementById('detail_harga_cabang').value = '';			document.getElementById('detail_qty').value = '';			document.getElementById('detail_jatuh_tempo').value = '';						document.getElementById('detail_idjenis').value = '';
							counter_list = counter_list + parseInt(detail_qty);
			}		
	}		

	function send_data(){		/*alert('send data');*/				$.ajax({				type: 'POST',				url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_1'?>',				data: $('#get_detail_sn').serialize(),				success: function(data) {					$('#detail').html(data);				}			});			}
	
	function remove_detail(id){			
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=remove&id='?>'+id,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});				counter_list--;
	}

		function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}	

</script>

	<?php 
		if(validation_errors())
		{
	?>
			<ul class="message error grid_12">
				<li><?=validation_errors()?></li>
				<li class="close-bt"></li>
			</ul>	
	<?php
		} 
	?>
	
<div id="alert_yanto"></div><br>
<!--<?php/*	foreach($total_kas->result() as $row){	echo $row->total_kas;}*/	?> 	-->
<section class="grid_12">
		<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('pembelian/insert', $attributes);
		?>
			<h1>Pembelian > Tambah Data Pembelian</h1>				
						<div id="get_serialize">
				<fieldset class="grey-bg margin">			
							
				
				<div class="columns">
					<input type="hidden" name="id_pembelian" id="id_pembelian" value="<?=date('YmdHis')?>">					<input type="hidden" name="glid" id="glid" value="<?=$this->hutang->get_glid()?>">
					<p class="colx3-left">
						<label for="complex-en-url">PO No :</label>
						<span class="relative">							
							<input type="text" name="po_no" id="po_no" value="<?=$this->pembelian->get_po($kode_transaksi)?>">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang" >
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if(get_idcabang() == $row->id_cabang){
												echo '<option value="'.$row->id_cabang.'">'.$row->nama_cabang.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>	
					<p class="colx3-right">
						<label for="complex-en-url">Tanggal Pembelian :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Supplier :</label>
						<span class="relative">
							<select name="id_supplier" id="id_supplier" >
								<?php
									if(get_kodecabang() == '001'){
										$query = $this->db->get('supplier');
										if($query->num_rows() > 0)
										{
											foreach($query->result() as $row)
											{
												echo '<option value="'.$row->id_supplier.'">'.$row->kode_supplier.'-'.$row->nama.'</option>';
											}
										}
									}else{
										$this->db->flush_cache();
										$this->db->from('cabang');
										$this->db->where('kode_cabang', '001');
										$query = $this->db->get();
										
										if($query->num_rows() > 0)
										{
											foreach($query->result() as $row)
											{
												echo '<option value="'.$row->id_cabang.'">'.$row->kode_cabang.'-'.$row->nama_cabang.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Diskon (%) :</label>
						<span class="relative">
							<input type="text" name="diskon" id="diskon" />
						</span>
					</p>
				</div>				<div class="columns">												<p class="colx3-left">						<label for="complex-en-url">Cara Bayar :</label>						<span class="relative">							<select name="cara_bayar" id="cara_bayar" >								<option value="1">Tunai</option>								<option value="2">Hutang</option>							</select>						</span>					</p>									</div>
			</fieldset>
				<fieldset>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Nama Barang :</label>
						<span class="relative">
								<input type="text" size="35" name="detail_namabarang" id="detail_namabarang" />
								<a id="getbarang" href="<?=base_url().'index.php/pembelian/show_barang'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
								<input type="hidden" name="detail_idbarang" id="detail_idbarang" />								<input type="hidden" name="detail_idjenis" id="detail_idjenis" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Barang :</label>
						<span class="relative">
								<input type="text" name="detail_harga" id="detail_harga" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">SN ? :</label>
						<span class="relative">
								<input type="checkbox" id = 'sn' name="sn" value="bersn">Barang Mempunyai Serial Number<br>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Harga Toko :</label>
						<span class="relative">
								<input type="text" name="detail_harga_toko" id="detail_harga_toko" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Partai :</label>
						<span class="relative">
								<input type="text" name="detail_harga_partai" id="detail_harga_partai" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Cabang :</label>
						<span class="relative">
								<input type="text" name="detail_harga_cabang" id="detail_harga_cabang" />
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Qty :</label>
						<span class="relative">
								<input type="text" name="detail_qty" id="detail_qty" />
						</span>
					</p>										 
					<p class="colx3-center">
						<label for="complex-en-url">Jatuh Tempo :</label>
						<span class="relative">							<input type="text" name="detail_jatuh_tempo" id="detail_jatuh_tempo" /> 
						
						</span>
					</p>	
				</div>				
			
						<div class="columns">
							<p class="colx2-left">
								<input onclick="set_detail()" type="button" name="button2" id="button2" value="Tambah Ke List" />
							</p>
						</div>
							<table class="table" border="1" cellspacing="0" width="100%">								<thead>									<tr>										<th scope="col">No</th>										<th scope="col">Nama Barang</th>										<th scope="col">SN</th>										<th scope="col">QTY</th>									</tr>																	</thead>																<tbody id="form_detail_sn">																	</tbody>							</table>							<br/>					</fieldset>				</div>						
							<table class="table" border="1" cellspacing="0" width="100%">
							
								<thead>
									<tr>
										<th rowspan="2" scope="col">No</th>
										<th rowspan="2" scope="col">Nama Barang</th>
										<th rowspan="2" scope="col">Harga Barang</th>
										<th colspan="3" scope="col">Harga Jual</th>
										<th rowspan="2" scope="col">SN</th>
										<th rowspan="2" scope="col">QTY</th>
										<th rowspan="2" scope="col">Jatuh Tempo</th>
									</tr>
									<tr>
										<th>Toko</th>
										<th>Partai</th>
										<th>Cabang</th>
									</tr>
								</thead>
								
								<tbody id="detail">
									
								</tbody>
							</table>
							<br/>						
				

				
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 		
			</div>	
			
		</form>
		
		
	</div>
	
</section>



