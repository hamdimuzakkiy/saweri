<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/penjualan'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:<?=date('Y')?>'});
	})
	
	function save_data(){
		
		var isi = document.getElementById('detail').innerHTML;
		//document.arrayForm.myResult.value=MultiArray[row][col];

		

		//alert($( "#id_pelanggan" ).val());


		var result_saldo_piutang = "";
		if (document.getElementById('pelanggan').checked==true && $( "#cara_bayar" ).val() == 2){			
			$.ajax({
				type:'POST', 
				url: '<?php echo base_url().'index.php/penjualan/check_saldo_piutang';?>', 
				data:$('#form1').serialize(),
				success: function(response) {
				/*$('#form1').find('.form_result').html(response);*/
					if (response=='berhasil'){
						
						if( isi == false){
							
							document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
							//alert('kosong');
							$('html, body').stop().animate({
								scrollTop: 0 //$($anchor.attr('href')).offset().top
							}, 700, 'easeInOutExpo');
						}else{
							
							document.getElementById('alert_yanto').innerHTML = '';
							//alert('berisi');
							document.forms["form1"].submit();
						}
					}else{
						
						document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>Pelanggan Telah Melebihi Saldo Piutang</li><li class="close-bt"></li></ul><br>';
					}
			}});
		}else{
			if( isi == false){
				document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
				//alert('kosong');
				$('html, body').stop().animate({
					scrollTop: 0 //$($anchor.attr('href')).offset().top
				}, 700, 'easeInOutExpo');
			}else{
				document.getElementById('alert_yanto').innerHTML = '';
				//alert('berisi');
				document.forms["form1"].submit();
			}
		}
		/*
		$.ajax({
			url: '<?php echo base_url().'index.php/penjualan/check_saldo_piutang';?>',
            type:'POST',
            dataType: 'json',
            success: function(output_string){
                    alert(output_string);
                } 
            }); 
			
		
		
		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
			//alert('kosong');
			$('html, body').stop().animate({
				scrollTop: 0 //$($anchor.attr('href')).offset().top
			}, 700, 'easeInOutExpo');
		}else{
			document.getElementById('alert_yanto').innerHTML = '';
			//alert('berisi');
			document.forms["form1"].submit();
		}*/
		
	}
	
	function klick_tanggal()
	{
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
	
	function test()
	{
		$.post('<?php echo base_url()."index.php/penjualan/get_cabang"; ?>', {},function(data){
			alert(data);
		});
	}

	function handleChange(cb)
	{
		var result_checked;
		if (document.getElementById('cabang').checked==true){
			result_checked =  'http://localhost/saweri/index.php/penjualan/get_cabang/cabang';
		}else{						
			result_checked =  'http://localhost/saweri/index.php/penjualan/get_cabang/pelanggan';
		}
		//alert(result_checked);
		$('#id_pelanggan').empty();
		//alert(result_checked);
		$.post(result_checked, {},function(data){
		$("#id_pelanggan").html(data);
		});
		/*var dataString = $(this).val();		
		$.ajax
		({			
			type: "POST",			
			url: "<? echo base_url().'index.php/penjualan/get_cabang/';?>" + result_checked,						
			
			success: function(datas)
			{								
				//test = berubah;
				alert(datas);
				//$("#id_pelanggan").html(berubah);
				//document.getElementById('hamdi').innerHTML = 'hamdi ganteng';
			},*/
			

			//var url = <?php echo base_url()."index.php/penjualan/get_cabang"; ?>
			
				
	}
</script>

<script type="text/javascript">
	
	$(document).ready(function() {		
		$("#getbarang").fancybox();
		/*var saldo_piutang_text = document.getElementById("saldo_piutang_text").value;*/
		/*
		$("#id_pelanggan").click(function(){
			var var_pelanggan =$('#id_pelanggan').val();
			document.getElementById("saldo_piutang_text").value = var_pelanggan;

		});
		*/
		
		
	});
		
	function set_jenispenjualan(id){		
		url = '<?=base_url().'index.php/penjualan/show_barang/'?>' + id;		
		document.getElementById('getbarang').href = url;
	}
	
	function validateForm(formId)
	{
		/*
		var inputs, index;
		var form=document.getElementById(formId);
		inputs = form.getElementsByTagName('input');
		for (index = 0; index < inputs.length; ++index) {
			// deal with inputs[index] element.
			if (inputs[index].value==null || inputs[index].value=="")
			{
				alert("Field is empty");
				return false;
			}
		} */
		if ($('#items').length > 0) {
			alert("Data List Penjualan Kosong");
			return false;
		}
		
	}
	
	function set_detail(){
		/*validateForm(items); */
		
		
		if ($('.penjualantemp').length > 0) {
			var cara_bayar = document.getElementById("cara_bayar").value;
			 if((cara_bayar=='2') && (document.getElementById('jatuh_tempo').value == '')){
				alert('Jatuh Tempo harus diisi jika memilih piutang.');
			}
			else{
				$.ajax({
					type: 'POST',
					url: '<?=base_url().'asset/admin/js/ajax_penjualan.php?command=add_1'?>',
					data: $('#form1').serialize(),
					success: function(data) {
						$('#detail').html(data);
						document.getElementById('items').innerHTML = '';
					}
				});
			}
		}else{
			alert("Tabel Cart tidak boleh kosong");
		}
	}
	
	
	
	function remove_detail(id){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_penjualan.php?command=remove&id='?>'+id,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});
		
	}
	
	function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
	


</script>

<div id="alert_yanto"></div><br>
<div class="form_result"></div>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('penjualan/insert', $attributes);
		?>
			<h1>Penjualan > Tambah Data Penjualan</h1>
				<br/>
				<?php  if ( (isset($message)) && ($message !== '') ) { echo $message;  } ?>
			<fieldset >
				
				
				<div class="columns">
					<input type="hidden" name="id_penjualan" value="<?=date('Ymdhis')?>" >
					<p class="colx2-left">
						<label for="complex-en-url">REF NO :</label>
						<span class="relative">	
							<input type="text" name="so_no" id="so_no" value="<?=$this->penjualan->get_so($kode_transaksi)?>" class="satu-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">TANGGAL :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">	
						<!--label for="complex-en-url">Jenis Pembeli :</label-->
						<input type="radio" name="pil_penjualan" value="cabang" id="cabang" onchange='handleChange(this)';>CABANG &nbsp; &nbsp; &nbsp;
						<input type="radio" name="pil_penjualan" value="pelanggan" id="pelanggan" onchange='handleChange(this)'; >PELANGGAN<br/><br/>						
						<span class="relative" id="id_pelanggan">
							<!--select name="id_pelanggan" >
								
								<?php
									
									echo '<option value="-">Pilih Nama Pelanggan</option>';
				
								
								?>
							</select-->
							<?=form_error('id_pelanggan')?>
						</span>
					</p>			
											
				</div>
				
				<div class="columns">
					<!--p class="colx2-left">
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang" >
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($row->id_cabang == get_idcabang()){
												echo '<option value="'.$row->id_cabang.'">'.$row->nama_cabang.'</option>';
											}
										}
									}
									/*foreach($query->result() as $row)
									{
										if($row->id_cabang == get_idcabang()){
											echo "<input type='text' name='id_cabang' id='id_cabang' value='" . $row->id_cabang . "'>";
										}
									}*/
									
									
								?>
							</select>
							<?=form_error('id_cabang')?>
						</span>
					</p-->
		
					<!--<p class="colx2-right">
						<label for="complex-en-url">DISKON (%) :</label>
						<span class="relative">
							<input type="text" name="diskon" id="diskon" value="<?=set_value('diskon')?>" class="duapertiga-width">
						</span>
					</p>-->
				</div>

				<div class="columns">

				<p class="colx2-left">
					<label for="complex-en-url">ALAMAT</label>
					<span class="relative">
						<input type="text" name="alamat" id="alamat" value="<?=set_value('alamat')?>" class="duapertiga-width">
					</span>
				</p>	

				<p class="colx2-right">						
					<label for="complex-en-url">KODE KAS :</label>						
					<span class="relative">
						<select name="kas" required>							
							<?php

								$this->db->flush_cache();
								$query = $this->db->get('kas');
								
								foreach($query->result() as $row)
								{
									echo '<option value="'.$row->kode.'">'.$row->nama.'<span class="colx3-right">-</span>'.convert_rupiah($row->saldo).'</option>';
								}

							?>							
						</select>						
					</span>					
				</p>
				
				</div>

				<div class="columns">
					<!--<p class="colx2-left">
						<label for="complex-en-url">JENIS PENJUALAN :</label>
						<span class="relative">
							<select name="id_jenis_penjualan" id="id_jenis_penjualan" onChange="javascript:set_jenispenjualan(this.value)">
								<?php
									$query = $this->db->get('jenis_penjualan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_jpenjualan.'">'.$row->jenis_penjualan.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>-->
					<p class="colx2-left">
						<label for="complex-en-url">PEMBAYARAN :</label>
						<span class="relative">
							<select name="cara_bayar" id="cara_bayar" >
								<option value="1">Tunai</option>
								<option value="2">Piutang</option>
							</select>
						</span>
					</p>

					<p class="colx2-right">						
					<label for="complex-en-url">M CARD :</label>						
					<span class="relative">
						<select name="atm" required>							
								<option value="UANG PAS">UANG PAS</option>
								<option value="VISA">VISA</option>					
								<option value="MASTER">MASTER</option>
								<option value="BNI CARD">BNI CARD</option>
								<option value="BCA CARD">BCA CARD</option>
						</select>						
					</span>					
					</p>	
	
				</div>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">JATUH TEMPO :</label>
						<span class="relative">
							<input type="text" name="jatuh_tempo" id="jatuh_tempo" value="<?=set_value('jatuh_tempo')?>" class="duapertiga-width"> Hari
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">NAMA REKENING</label>
						<span class="relative">
							<input type="text" name="nama_rekening" id="nama_rekening" value="" class="duapertiga-width"> 
						</span>
					</p>
				</div>

				<div class="columns">
					<p class="colx2-right">
						<label for="complex-en-url">NO REKENING :</label>
						<span class="relative">
							<input type="text" name="nomor_atm" id="nomor_atm" value="<?=set_value('nomor_atm')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
			</fieldset>
			
			<fieldset>
						<div class="columns">
							<p class="colx3-left">
								<a id="getbarang" href="<?=base_url().'index.php/penjualan/show_barang/1'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
							</p>
						</div>
						
						Tabel Cart<br/>
						<table class="table" border="1" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col">NO</th>
									<th scope="col"></th>
									<th scope="col">NAMA BARANG</th>
									<th scope="col">HARGA JUAL</th>
									<th scope="col">SATUAN</th>
									<th scope="col">Qty</th>
									<th scope="col">DISKON</th>
									<th scope="col">RUPIAH</th>
								</tr>
							</thead>

							<tbody id="items" >
							</tbody>
						</table>
						<br>
						<div class="columns">
							<p class="colx2-left">
								<input onclick="set_detail()" type="button" name="button2" id="button2" value="Tambah Ke List" />
							</p>
						</div>
						
						<table class="table" border="1" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">NAMA BARANG</th>
									<th scope="col">HARGA JUAL</th>
									<th scope="col">SATUAN</th>
									<th scope="col">Qty</th>
									<th scope="col">DISKON</th>
									<th scope="col">RUPIAH</th>
									<th scope="col">AKSI</th>						
								</tr>
							</thead>

							<tbody id="detail">						
							</tbody>
						</table>
						<br/>
			</fieldset>

				
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	
			</div>
			
		</form>
	</div>
</section>