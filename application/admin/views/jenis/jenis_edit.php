<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?php echo base_url().'index.php/jenis'?>';
	}
	
</script>

	<?php 
		if(validation_errors())
		{
	?>
			<ul class="message error grid_12">
				<li><?phpvalidation_errors()?></li>
				<li class="close-bt"></li>
			</ul>	
	<?php
		} 
	?>

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('jenis/process_update', $attributes);
		?>
			<h1>Setup > Edit Data Jenis Barang</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Jenis (*) :</label>
						<input type="hidden" name="id_jenis" value="<?php echo $id_jenis;?>">
						<span class="relative">
							<?php 
								if (form_error('jenis') != null)
								{
									echo '<input type="text" name="jenis" id="jenis" value="'.set_value('jenis').'" >';
								}else
								{
									echo '<input type="text" name="jenis" id="jenis" value="'.$result->row()->jenis.'" >';
								}
							?>
						</span>
					</p>
				</div>
				
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?phpbase_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>