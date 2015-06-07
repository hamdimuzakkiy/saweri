<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/master_saldo_elektrik'?>';
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
			echo form_open('master_saldo_elektrik/insert', $attributes);
		?>
			<h1>Master > Master Saldo Elektrik</h1>
			
			<fieldset>
				<legend>Tambah Data Master Saldo</legend>
				
				<input type="hidden" name="id" value="<?=$id;?>">
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Saldo (*) :</label>
						<span class="relative">
							<input type="text" name="nama_mastersaldo" id="nama_mastersaldo" value="<?=set_value('nama_mastersaldo')?>" class="setengah-width">
						</span>
					</p>
					</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Saldo :</label>
						<span class="relative">
							<input type="text" name="saldo" id="saldo" value="<?=set_value('saldo')?>" class="setengah-width">
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