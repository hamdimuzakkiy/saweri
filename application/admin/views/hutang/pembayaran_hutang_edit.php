<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/hutang'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})
	
	function save_data(){
		
		var isi = document.getElementById('detail').innerHTML;

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
	
</script>

<script type="text/javascript">
	
	
	$(document).ready(function() {
		$("#getbarang").fancybox();
	});
	
	
	function set_detail(){
		
		if(document.getElementById('detail_namabarang').value == ''){
			alert('Isi nama barang terlebih dahulu.');
		}else{
			$.ajax({
				type: 'POST',
				url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_1'?>',
				data: $('#form1').serialize(),
				success: function(data) {
					$('#detail').html(data);
				}
			});
			
			document.getElementById('detail_idbarang').value = '';	
			document.getElementById('detail_namabarang').value = '';
			document.getElementById('detail_harga').value = '';
			document.getElementById('detail_harga_toko').value = '';
			document.getElementById('detail_harga_partai').value = '';
			document.getElementById('detail_harga_cabang').value = '';
			document.getElementById('detail_qty').value = '';
			document.getElementById('detail_jatuh_tempo').value = '';
		}
	}
	
	function remove_detail(id){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=remove&id='?>'+id,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});
		
	}		function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}			function bayar_hutang(){		var var_pembayaran;		var var_total_tagiahan;		var sisa;				var_pembayaran=document.getElementById("pembayaran").value;		var_total_tagiahan=document.getElementById("total_tagihan").value;		sisa=var_total_tagiahan - var_pembayaran;				document.getElementById('sisa').value = sisa;					}

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

<section class="grid_12">	<div class="block-border">		
<form class="block-content form"  name="table_form" id="table_form" method="post" action="">			<h1>Piutang > Historical Pembayaran Hutang</h1>						<div class="block-controls">								<ul class="controls-buttons">					<?php echo $this->pagination->create_links(); ?>					<li class="sep"></li>					<li></li>				</ul>							</div>					<div class="no-margin"><table class="table" cellspacing="0" width="100%">							<thead>					<tr>						<th align="left" valign="top" scope="col">Penjual</th>						<th align="left" valign="top" scope="col">Tanggal</th>						<th align="left" valign="top" scope="col">GLID</th>						<th align="left" valign="top" scope="col">Pembeli</th>						<th align="left" valign="top" scope="col">Total (Rp)</th>						<th align="left" valign="top" scope="col">Angsuran (Rp)</th>						<th align="left" valign="top" scope="col">Sisa (Rp)</th>						<!--<th align="left" valign="top" scope="col">Saldo</th>-->					</tr>				</thead>								<tbody>										<?php foreach($results->result() as $row) {?>					<tr>						<td align="left" valign="top"><?=$row->nama_cabang?> </td>						<td align="left" valign="top"><?=$row->TANGGAL?> </td>						<td align="left" valign="top"><?=$row->GLID?> </td>						<td align="left" valign="top"><?=$row->nama_supplier?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->TOTAL)?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->ANGSURAN)?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->SISA)?> </td>						<!--<td align="left" valign="top"> </td>-->					</tr>					<?php } ?>									</tbody>						</table></div>						<ul class="message no-margin">				<li>&nbsp;</li>			</ul>						</form>	</div>
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('hutang/process_update', $attributes);
		?>
			<h1>Hutang > Form Data Pembayaran Hutang</h1>
			
			<fieldset class="grey-bg margin">
				
				
				<div class="columns">

					<p class="colx3-left">
						<label for="complex-en-url">PO No :</label>
						<span class="relative">
							<input type="text" name="po_no" id="po_no" readonly="true" value="<?=$result->row()->po_no?>">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang" readonly="true" >
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($result->row()->id_cabang == $row->id_cabang){
												echo '<option value="'.$row->id_cabang.'" selected="selected">'.$row->nama_cabang.'</option>';
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
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=$result->row()->TANGGAL?>" >
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Supplier :</label>
						<span class="relative">
					
								<?php
									$query = $this->db->get('supplier');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($result->row()->id_supplier == $row->id_supplier){
												echo '<option value="'.$row->id_supplier.'" selected="selected">'.$row->kode_supplier.'-'.$row->nama.'</option>';												echo '<input type="text" name="name_supplier" value="' . $row->nama . '" readonly="true">';												echo '<input type="hidden" name="id_supplier" value="' . $row->id_supplier . '" readonly="true">';
											}else{
												echo '<option value="'.$row->id_supplier.'">'.$row->kode_supplier.'-'.$row->nama.'</option>';												
											}
										}
									}
								?>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Total Tagihan :</label>
						<span class="relative">
							<input type="text" name="total_tagihan" id="total_tagihan" value="<?=$result->row()->JUMLAH?>" readonly="true" />
						</span>
					</p>										<p class="colx3-center">						<label for="complex-en-url">Biaya Pembayaran :</label>						<span class="relative">							<input type="text" name="pembayaran" id="pembayaran" onchange="bayar_hutang()" value="" />							<input type="hidden" name="glid" id="glid" value="<?=$result->row()->GLID?>">						</span>					</p>										
				</div>				<div class="columns">				<p class="colx3-left">						<label for="complex-en-url">Pembayaran :</label>						<span class="relative">							<select name="cara_bayar" id="cara_bayar" >								<option value="Kas">Kas</option>								<option value="Bank">Bank</option>							</select>						</span>					</p>				</div>				<div class="columns">					<p class="colx3-left">						<label for="complex-en-url">Sisa :</label>						<span class="relative">							<input type="text" name="sisa" id="sisa" value="" />						</span>					</p>				</div>
			</fieldset>			
			<div id="tab-settings" class="tabs-content">
					<!--<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>-->					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 		
			</div>	
			
		</form>
		
		
	</div>
	
</section>



