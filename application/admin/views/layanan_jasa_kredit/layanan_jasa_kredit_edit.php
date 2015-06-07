<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/layanan_jasa_kredit'?>';
	}
	
		$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd' });
		$(".tgl").datepicker({dateFormat: 'yy-mm-dd' });
	})
	
</script>

<script type="text/javascript">
	
	
	$(document).ready(function() {
		$("#getbarang").fancybox();
	});

	function laporan(pageURL, title,w,h){
		var periode_awal=document.getElementById('tanggal_awal').value;
		var periode_akhir=document.getElementById('tanggal_akhir').value;
		if ((periode_awal=='')||(periode_akhir=='')){
			alert('Isilah periode awal dan akhir');
		}else{
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			var targetWin = window.open ('<?=site_url();?>/laporan_pembelian/show_report/'+periode_start+'/'+periode_end, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
			
			document.getElementById('tanggal_awal').value='';
			document.getElementById('tanggal_akhir').value='';
		}
		

	}
	
	$(function(){
		$("#tanggal_awal").datepicker({dateFormat: 'yy-mm-dd' });
	})	
	
	$(function(){
		$("#tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd' });
	})	
	
		function total(){
		document.getElementById('total_bayar').value = parseInt(document.getElementById('tagihan').value) + parseInt(document.getElementById('biaya_admin').value);
	}
	
	
	function klick_tanggal_awal(){
		var tanggal = document.getElementById("periode_start");
		tanggal.focus();
	}
	
	function klick_tanggal_akhir(){
		var tanggal = document.getElementById("periode_end");
		tanggal.focus();
	}
	
	function klick_tanggal_bayar(){
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

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('layanan_jasa_kredit/process_update', $attributes);
		?>
			<h1>Layanan > Edit Data Layanan Jasa Pihak Ke 3</h1>
			
			<fieldset class="grey-bg margin">
				
				<div class="columns">						
					<p class="colx2-left">
						<label for="complex-en-url">Periode Pembayaran Pihak Ke 3 (*) :</label>
						<input type="hidden" name="id_layanan_jasa" value="<?=$id_layanan_jasa?>">
						<span class="relative">
							<? 
								if (form_error('periode_start') != null)
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="periode_start" id="periode_start" value="'.set_value('periode_start').'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_awal()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}else
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="periode_start" id="periode_start" value="'.$periode_start.'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_awal()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}
							?>
						</span>
					S/D
						<span class="relative">
							<? 
								if (form_error('periode_end') != null)
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="periode_end" id="periode_end" value="'.set_value('periode_end').'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_akhir()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}else
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="periode_end" id="periode_end" value="'.$periode_end.'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_akhir()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}
							?>
						</span>
					</p>
				</div>	
				</fieldset>
				
				<fieldset>
				<legend>Info Pelanggan</legend>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">No Pelanggan Pihak Ke-3 (*) :</label>
						<span class="relative">
							<? 
								if (form_error('no_pelanggan') != null)
								{
									echo '<input type="text" name="no_pelanggan" id="no_pelanggan" value="'.set_value('no_pelanggan').'" class="duapertiga-width">';
									echo form_error('no_pelanggan');
								}else
								{
									echo '<input type="text" name="no_pelanggan" id="no_pelanggan" value="'.$no_pelanggan.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<? 
								if (form_error('nama') != null)
								{
									echo '<input type="text" name="nama" id="nama" value="'.set_value('nama').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="nama" id="nama" value="'.$nama.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Alamat (*) :</label>
						<span class="relative">
							<? 
								if (form_error('alamat') != null)
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.set_value('alamat').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.$alamat.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
			</fieldset>
			
			<fieldset class="grey-bg no-margin">
			 <legend> Info Rekening </legend>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Tanggal Pembayaran Pihak ke-3 (*) :</label>
						<span class="relative">
							<? 
								if (form_error('tanggal') != null)
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.set_value('tanggal').'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_bayar()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}else
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.$tanggal.'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_bayar()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}
							?>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Tagihan (*) :</label>
						<span class="relative">
							<? 
								if (form_error('tagihan') != null)
								{
									echo '<input type="text" name="tagihan" id="tagihan" value="'.set_value('tagihan').'" onkeyup="javascript:total()" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="tagihan" id="tagihan" value="'.$tagihan.'" onkeyup="javascript:total()" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Biaya Admin (*) :</label>
						<span class="relative">
							<? 
								if (form_error('biaya_admin') != null)
								{
									echo '<input type="text" name="biaya_admin" id="biaya_admin" value="'.set_value('biaya_admin').'" onkeyup="javascript:total()" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="biaya_admin" id="biaya_admin" value="'.$biaya_admin.'" onkeyup="javascript:total()" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>	
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Total Bayar :</label>
						<span class="relative">
							<? 
								if (form_error('total_bayar') != null)
								{
									echo '<input type="text" name="total_bayar" id="total_bayar" value="'.set_value('total_bayar').'" class="duapertiga-width" readonly="true"" >';
								}else
								{
									echo '<input type="text" name="total_bayar" id="total_bayar" value="'.$total_bayar.'" class="duapertiga-width" readonly="true" >';
								}
							?>
						</span>
					</p>
					<!--<p class="colx3-center">
						<label for="complex-en-url">Status (*) :</label>
						<span class="relative">
							<select name="status"  id="status"  class="duapertiga-width">
										<option value="Sudah Bayar">Sudah Bayar</option>
										<option value="Belum Bayar">Belum Bayar</option>
							</select>
						</span>
					</p>-->
					
					
				</div>	
				
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
				
			</fieldset>
			
			
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 		
			</div>
			
		</form>
	</div>
</section>