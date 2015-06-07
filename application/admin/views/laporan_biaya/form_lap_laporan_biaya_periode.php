<script type="text/javascript">
	$(document).ready(function() {	});
	function laporan(pageURL, title,w,h){
		var periode_awal=document.getElementById('tanggal_awal').value;
		var periode_akhir=document.getElementById('tanggal_akhir').value;
		if ((periode_awal=='')||(periode_akhir=='')){
			alert('Isilah periode awal dan akhir');
		}else{
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			var targetWin = window.open ('<?=site_url();?>/laporan_biaya/view_lap_biaya_periode/'+periode_awal+'/'+periode_akhir, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
			
			document.getElementById('tanggal_awal').value='';
			document.getElementById('tanggal_akhir').value='';
		}	}
	
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
	
	function batal(){
		document.location.href="<?=site_url();?>/dashboard";
	}
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('laporan_biaya/view_lap_biaya_periode', $attributes);
		?>
			<h1>Form Laporan Biaya</h1>
			
			<fieldset>
				<div class="columns">
					<input type="hidden" name="id_biaya" id="id_biaya" value="<?=date('YmdHis')?>">
					<p class="colx2-left">
						<label for="complex-en-url">Periode :</label>
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_awal" id="tanggal_awal" class="datepicker">  
								<img onclick="javascript:klick_tanggal_awal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
						S/D
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_akhir" id="tanggal_akhir" class="datepicker">  
								<img onclick="javascript:klick_tanggal_akhir()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
					</p>
				</div>
			</fieldset>
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="laporan('<?=site_url();?>/laporan_biaya/view_lap_biaya_periode/','name',1000,800)"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">Print Preview</button> 
					<button type="button" class="red" onclick="javascript:batal()">Batal</button> 
					
			</div>	
			
		</form>
		
		
	</div>
	
</section>



