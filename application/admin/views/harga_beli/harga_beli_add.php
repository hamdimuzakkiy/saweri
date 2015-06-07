<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/harga_beli'?>';
	}
	
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
	
	
	function klick_tanggal_awal(){
		var tanggal = document.getElementById("tanggal_awal");
		tanggal.focus();
	}
	
	function klick_tanggal_akhir(){
		var tanggal = document.getElementById("tanggal_akhir");
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
			echo form_open('harga_beli/insert', $attributes);
		?>
			<h1>Tambah Data Harga Beli</h1>
			
			<fieldset class="grey-bg margin">
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Periode Harga Beli (*) :</label>
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_start" id="tanggal_awal" class="datepicker">  
								<img onclick="javascript:klick_tanggal_awal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
						S/D
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_end" id="tanggal_akhir" class="datepicker">  
								<img onclick="javascript:klick_tanggal_akhir()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
					</p>
				</div>
			</fieldset>
				<fieldset>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Nama Barang (*) :</label>
						<span class="relative">
							<select name="id_barang" id="id_barang"class="setengah-width">
								<?php
									$query = $this->db->get('barang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_barang.'">'.$row->nama_barang.'</option>';
										}
									}
								?>
							</select>
							<?=form_error('id_barang')?>
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Harga Beli (*) :</label>
						<span class="relative">
							<input type="text" name="harga_beli" id="harga_beli" value="<?=set_value('harga_beli')?>" class="duapertiga-width">
						</span>
					</p>
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