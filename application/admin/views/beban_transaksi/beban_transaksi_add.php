<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/beban_transaksi'?>';
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

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('beban_transaksi/insert', $attributes);
		?>
			<h1>Setup > Tambah Beban Transaksi</h1>
			
			<fieldset>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Pembayaran (*) :</label>
						<span class="relative">
							<input type="text" name="pembayaran" id="golongan" value="<?=set_value('pembayaran')?>" >
						</span>
					</p>
				</div>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Beban (*) :</label>
						<span class="relative">
							<input type="text" name="beban" id="golongan" value="<?=set_value('beban')?>" >
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