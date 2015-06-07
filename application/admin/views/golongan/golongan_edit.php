<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?php echo base_url().'index.php/golongan'?>';
	}
	
</script>

	<?php 
		if(validation_errors())
		{
	?>
			<ul class="message error grid_12">
				<li><?php echo validation_errors()?></li>
				<li class="close-bt"></li>
			</ul>	
	<?php
		} 
	?>

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('golongan/process_update', $attributes);
		?>
			<h1>Setup > Edit Data Golongan</h1>
			
			<fieldset>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Golongan (*) :</label>
						<input type="hidden" name="id_golongan" value="<?php echo $id_golongan?>">
						<span class="relative">
							<?php 
								if (form_error('golongan') != null)
								{
									echo '<input type="text" name="golongan" id="golongan" value="'.set_value('golongan').'" >';
								}else
								{
									echo '<input type="text" name="golongan" id="golongan" value="'.$golongan.'" >';
								}
							?>
						</span>
					</p>
				</div>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Jenis Barang :</label>
						<span class="relative">
							<select name="jenis" id="jenis"class="seperempat-width">
								<option value="BARANG">BARANG</option>
								<option value="PULSA">PULSA</option>
							</select>
						</span>
					</p>
				</div>
				
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
				<button type="submit"><img src="<?php echo base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
				<button type="button" onclick="javascript:batal();" class="red">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>