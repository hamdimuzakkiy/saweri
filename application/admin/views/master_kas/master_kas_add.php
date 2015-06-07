<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/master_kas'?>';
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
			echo form_open('master_kas/insert', $attributes);
		?>
			<h1>Master > Tambah Data Kas</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Kode Kas (*) :</label>
						<span class="relative">
							<input type="text" name="kode" id="kode" value="<?=set_value('kode')?>" class="tigaperempat-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Nama Kas (*) :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="setengah-width">
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Saldo Kas (*) :</label>
						<span class="relative">
							<input type="text" name="saldo" id="saldo" value="<?=set_value('saldo')?>" class="setengah-width">
						</span>
					</p>
				</div>				
				<div class="columns">
					
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
<script type="text/javascript">
function cek()
    {
        if(parseInt($('#saldo_piutang').val()) > parseInt($('#max_piutang').val())){
           alert("Jumlah Piutang Melebihi Maximal Piutang");
		   $('#saldo_piutang').val("");
        }
	}
</script>