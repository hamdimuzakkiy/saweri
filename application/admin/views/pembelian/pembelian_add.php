<script type="text/javascript">
	var counter_list=0;
	function batal(){
		
		document.location.href = '<?php echo base_url().'index.php/pembelian'?>';
	}

	function tmp(cek)
	{	
		if (cek == true)
		{
			document.getElementById('atm').style.display = 'block';
		}
		else 
		{
			document.getElementById('atm').style.display = 'none';
			document.getElementById('nama_atm').value = "";
			document.getElementById('nomor_atm').value = "";
		}

	}

	function update_card()
	{
		var mCard = document.getElementById('beban_transaksi').value.split('/')[0];		
		if (mCard != -1)			
			tmp(true);
		else
			tmp(false);
		var disc = document.getElementById('diskon').value;
		var beban_transaksi = beban();
		var jum = document.getElementById('sum').value;
		//alert(jum);
		jum = jum * disc/100;

		$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=convert'?>',					
					data: { sum : jum
					},
					success: function(data) {
						$('#harga_diskon').html(data);

					}
				});
		var jum = document.getElementById('sum').value;
		jum = ((jum) * (100-disc)/100)+(jum*(beban_transaksi/100));		
		$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=convert'?>',					
					data: { sum : jum
					},
					success: function(data) {
						$('#finall').html(data);

					}
				});
		//document.getElementById('harga_diskon').innerHTML = convert_rupiah(jum);
	}

	function showKas()
	{
		var kas = document.getElementById('valKas').value;
		kas = kas.split('/')[1];
		document.getElementById('saldo').innerHTML = kas;
	}

	function getKas()
	{
		var kas = document.getElementById('valKas').value;		
		kas = kas.split('/')[2];		
		return kas;
	}
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})
	function save_data(){
		
		var disc = document.getElementById('diskon').value;				
		var beban_transaksi = beban();
		var jum = document.getElementById('sum').value;
		
		var total = ((jum) * (100-disc)/100)+(jum*(beban_transaksi/100));
		var cara_bayar = document.getElementById('cara_bayar').value;
		var saldo = parseInt(getKas());
		
		var jatuh_temp = document.getElementById('pembelian_jatuh_tempoInp').value;

		
		if (cara_bayar == 'Custom' &&  jatuh_temp == '')
		{
			alert('Isi Jatuh Tempo');
			return;
		}


		var Mcard = document.getElementById('beban_transaksi').value.split('/')[0];
		var nama_atm = document.getElementById('nama_atm').value;
		var nomor_atm = document.getElementById('nomor_atm').value;		

		if (saldo < total && cara_bayar == "Cash")
		{			
			alert("Saldo Tidak Mencukupi");
			return;
		}

		var jumlah = document.getElementById('sum_detail').value;		
		for (var i = 0; i < jumlah; i++) {
			
			if (document.getElementById('detail_sn'+i).value == '' && document.getElementById('detail_issn'+i).value == '1' && document.getElementById('sum_detail').hidden == false)
			{				
				alert('Ada Serial Number Yang Belum Terisi');
				return false;
			}

		};		
		
		var isi = document.getElementById('detail').innerHTML;				
		var detail_jatuh_tempo_text = document.getElementById('detail_jatuh_tempo').value;		 		
		var obj_sn = document.getElementsByName("detail[id_barang]");		
		/* var obj_idbarang = document.getElementById("detail_idbarang0").value;		
		 var obj_idjenis = document.getElementById("detail_idjenis0").value;*/		
		 /*		for (var j=0;j<counter_list;j++){							
		 	if ((document.getElementById("detail_sn" + j).value == '' ) && (obj_idjenis = document.getElementById("detail_idjenis"+ j).value=='4')){					
		 	alert("List No " + (parseInt(j)+1) + " SN tidak boleh kosong");					
		 	var sn_id = document.getElementById("detail_sn"+j).focus();										
		 	return ;				}					}*/

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

	function update_disc()
	{		
		var disc = document.getElementById('diskon').value;
		var beban_transaksi = beban();
		var jum = document.getElementById('sum').value;
		//alert(jum);
		jum = jum * disc/100;

		$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=convert'?>',					
					data: { sum : jum
					},
					success: function(data) {
						$('#harga_diskon').html(data);

					}
				});
		var jum = document.getElementById('sum').value;
		jum = ((jum) * (100-disc)/100)+(jum*(beban_transaksi/100));		
		$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=convert'?>',					
					data: { sum : jum
					},
					success: function(data) {
						$('#finall').html(data);

					}
				});
		//document.getElementById('harga_diskon').innerHTML = convert_rupiah(jum);
	}
	
	function ATM()
	{	
		var cek = document.getElementById('cek_atm').checked;
			
		if (cek == true)
			document.getElementById('atm').style.display = 'block';
		else 
			document.getElementById('atm').style.display = 'none';
	}

	function beban()
	{		
		var beban = document.getElementById('beban_transaksi').value;
		beban = beban.split('/')[1];
		return beban;
	}

	function hutang()
	{


		var cek = document.getElementById('cara_bayar').value;
		if (cek =='Custom')	
		{	
			document.getElementById('Mcard').style.display = 'none';
			document.getElementById('atm').style.display = 'none';
			
			document.getElementById('pembelian_jatuh_tempo').style.display = 'block';
			document.getElementById('kas').style.display = 'none';						
		}
		else if (cek =='7' || cek =='21' || cek =='14' || cek =='28')	
		{
			document.getElementById('Mcard').style.display = 'none';
			document.getElementById('atm').style.display = 'none';
			
			document.getElementById('pembelian_jatuh_tempo').style.display = 'none';
			document.getElementById('kas').style.display = 'none';
			document.getElementById('pembelian_jatuh_tempoInp').value = cek;
			
		}		
		else 
		{
			document.getElementById('Mcard').style.display = 'block';			
			
			document.getElementById('pembelian_jatuh_tempo').style.display = 'none';
			document.getElementById('kas').style.display = 'block';
			document.getElementById('pembelian_jatuh_tempoInp').value = '';
			
		}
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#getbarang").fancybox({
			
			
		    
		});
	});
	function set_detail(){			
			var cara_bayar = document.getElementById("cara_bayar").value;		
			var detail_qty = document.getElementById("detail_qty").value;		
			var detail_idjenis = document.getElementById("detail_idjenis").value;		
			var sn = document.getElementById("sn").checked;		
			document.getElementById("sn").value = false;
			
			if(document.getElementById('detail_namabarang').value == ''){
				alert('Isi nama barang terlebih dahulu.');	
			}
			//else if((cara_bayar=='2') && (document.getElementById('detail_jatuh_tempo').value == ''))
			//{			alert('Jatuh Tempo Tidak Boleh Kosong.');					}
			else if (detail_idjenis=='4'){			$.ajax({				type: 'POST',				url: '<?php echo base_url().'asset/admin/js/ajax_pembelian.php?command=add_sn'?>',				data: $('#get_serialize :input').serialize(),				success: function(data) {					$('#detail').html(data);					/*$.fancybox(data);*/				}			});					}
			else if (sn) {

				$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_3'?>',
					data: $('#form1').serialize(),
					success: function(data) {
						$('#detail').html(data);

					}
				});
				document.getElementById('detail_idbarang').value = '';				document.getElementById('detail_namabarang').value = '';			document.getElementById('detail_harga').value = '';			document.getElementById('detail_harga_toko').value = '';			document.getElementById('detail_harga_partai').value = '';			document.getElementById('detail_harga_cabang').value = '';			document.getElementById('detail_qty').value = '';			document.getElementById('detail_jatuh_tempo').value = '';						document.getElementById('detail_idjenis').value = ''; document.getElementById('sn').checked = false;
							counter_list = counter_list + parseInt(detail_qty);
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
				document.getElementById('detail_idbarang').value = '';				document.getElementById('detail_namabarang').value = '';			document.getElementById('detail_harga').value = '';			document.getElementById('detail_harga_toko').value = '';			document.getElementById('detail_harga_partai').value = '';			document.getElementById('detail_harga_cabang').value = '';			document.getElementById('detail_qty').value = '';			document.getElementById('detail_jatuh_tempo').value = '';						document.getElementById('detail_idjenis').value = ''; document.getElementById('sn').value = false;
							counter_list = counter_list + parseInt(detail_qty);
			}		
	}		

	function send_data(){		/*alert('send data');*/				
	$.ajax({				type: 'POST',				url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_1'?>',				
		data: $('#get_detail_sn').serialize(),				success: function(data) {					$('#detail').html(data);				}			});			}
	
	function remove_detail(id){		
	//alert(id)	;
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
								<input type="text" name="tanggal" readonly value="<?=date('Y-m-d')?>">
								<img src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
								<!--input type="text" name="tanggal" id="tanggal" class="datepicker" readonly value="<?=date('Y-m-d')?>"-->
								<!--img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"-->
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

									{
										$query = $this->db->get('supplier');
										if($query->num_rows() > 0)
										{
											foreach($query->result() as $row)
											{
												echo '<option value="'.$row->id_supplier.'">'.$row->kode_supplier.'-'.$row->nama.'</option>';
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
							<input type="number" onchange="javascript:update_disc();" name="diskon" id="diskon">
						</span>
					</p>
					
				</div>				
				<div class="columns">												
					<p class="colx3-left">						
						<label for="complex-en-url">Cara Bayar :</label>						
						<span class="relative">
							<select name="cara_bayar" id="cara_bayar" onchange = "javascript:hutang();">								
							<option value="Cash">Cash</option>								
							<option value="7">1 Minggu</option>
							<option value="14">2 Minggu</option>
							<option value="21">3 Minggu</option>
							<option value="28">4 Minggu</option>
							<option value="Custom">Custom</option>
						</select>						
					</span>			

					<span id="kas">
					<label for="complex-en-url" >Kas :</label>						
						<span class="relative">
							<select id = "valKas" name="kas" onchange = "javascript:showKas();">
							<?php
								$this->db->flush_cache();
								$query = $this->db->get('kas');
								$flag = false;
								foreach($query->result() as $row)
								{
									if ($flag == false)
									{
										$initKas = convert_rupiah($row->saldo);
										$flag = true;
									}
									echo '<option value="'.$row->kode.'/'.convert_rupiah($row->saldo).'/'.$row->saldo.'">'.$row->nama.'</option>';
								}
							?>							
							</select>
							<span id = "saldo"><?php print $initKas; ?></span>
						</span>					
					</span>


					<span style = "display:none;" id="pembelian_jatuh_tempo">
					<label for="complex-en-url" >Jatuh Tempo :</label>
						<span class="relative">							
							<input type="text" name="pembelian_jatuh_tempo" id="pembelian_jatuh_tempoInp"   />  Hari
						</span>
					</span>		
				</p>				
				
					<p class="colx3-right" style = "display:none;" id = "atm">						
						<label for="complex-en-url">Nama Pengguna</label>						
						<span class="relative">							
							<input type = "text" id = "nama_atm" name = "nama_atm" required>
						</span>					
						<label for="complex-en-url">Nomor ATM</label>						
						<span class="relative">							
							<input type = "text" id = "nomor_atm" name = "nomor_atm" required>							
						</span>					
				</p>				
				<p class="colx3-center" id = 'Mcard'>
					<label for="complex-en-url">M Card :</label>
					<span class="relative">
						<!--input type="checkbox" onclick="javascript:ATM();" id = "cek_atm"><br-->
						<select id = "beban_transaksi" name="beban_transaksi" onchange = "javascript:update_card();" >
							<option value = "-1/0">Uang Pas</option>
							<?php

								$this->db->flush_cache();
								$query = $this->db->get('beban_transaksi');
								
								foreach($query->result() as $row)
								{
									echo '<option value="'.$row->id.'/'.$row->beban.'">'.$row->pembayaran.'</option>';
								}

							?>		
						</select>
					</span>
				</p>
			</div>

					
			
			</fieldset>
				<fieldset>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Nama Barang :</label>
						<span class="relative">
								<input type="text" size="35" name="detail_namabarang" id="detail_namabarang" />								
								<a id="getbarang" href="<?=base_url().'index.php/pembelian/show_barang'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
								<input type="hidden" name="detail_idbarang" id="detail_idbarang" />								
								<input type="hidden" name="detail_idjenis" id="detail_idjenis" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Barang :</label>
						<span class="relative">
								<input type="text" name="detail_harga" id="detail_harga" />
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Qty :</label>
						<span class="relative">
								<input type="text" name="detail_qty" id="detail_qty" />
						</span>
					</p>		
					<p hidden class="colx3-center">
						<label for="complex-en-url">SN ? :</label>
						<span class="relative">
								<input type="checkbox" id = 'sn'>Barang Mempunyai Serial Number<br>
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
													 
					<p class="colx3-center" hidden>
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
										<th rowspan="2" scope="col">Sub Total</th>
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

