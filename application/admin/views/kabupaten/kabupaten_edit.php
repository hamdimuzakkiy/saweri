<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/kabupaten'?>';
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
			echo form_open('kabupaten/process_update', $attributes);
		?>
			<h1>Setup > Edit Data kabupaten</h1>
			
			<fieldset>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">kabupaten (*) :</label>
						<input type="hidden" name="id_kabupaten" value="<?=$id_kabupaten?>">
						<span class="relative">
							<?php 
								if (form_error('kabupaten') != null)
								{
									echo '<input type="text" name="kabupaten" id="kabupaten" value="'.set_value('kabupaten').'" >';
								}else
								{
									echo '<input type="text" name="kabupaten" id="kabupaten" value="'.$kabupaten.'" >';
								}
							?>
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