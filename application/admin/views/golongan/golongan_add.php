<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/golongan'?>';
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
			echo form_open('golongan/insert', $attributes);
		?>
			<h1>Setup > Tambah Data Golongan</h1>
			
			<fieldset>
                                <div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Golongan (*) :</label>
						<span class="relative">
							<input type="text" name="id_golongan" id="golongan">
						</span>
					</p>
				</div>
                            
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Golongan (*) :</label>
						<span class="relative">
							<input type="text" name="golongan" id="golongan" value="<?=set_value('golongan')?>" >
						</span>
					</p>
				</div>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Jenis Barang :</label>
						<span class="relative">
							<select name="jenis" id="jenis"class="seperempat-width">
								<option value="1">BARANG</option>
								<option value="2">PULSA</option>
							</select>
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