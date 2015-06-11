<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?php echo base_url();?>index.php/kategori';
	}
	
</script>

	<?php 
		if(validation_errors())
		{
	?>
			<ul class="message error grid_12">
				<li><?php validation_errors()?></li>
				<li class="close-bt"></li>
			</ul>	
	<?php
		} 
	?>

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('kategori/process_update', $attributes);
		?>
			<h1>Setup > Edit Data Kategori</h1>
			
			<fieldset>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kategori (*) :</label>
						<input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>">
						<span class="relative">
							<?php 
								if (form_error('kategori') != null)
								{
									echo '<input type="text" name="kategori" id="kategori" value="'.set_value('kategori').'" >';
								}else
								{
									echo '<input type="text" name="kategori" id="kategori" value="'.$kategori.'" >';
								}
							?>
						</span>
					</p>
				</div>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Jenis Barang :</label>
						<span class="relative">
							<select name="jenis" id="jenis" class="seperempat-width">
                                                            <?php 
                                                            $query = $this->db->get('jenis');
                                                            if($query->num_rows() > 0)
                                                            foreach ($query->result() as $jenis){ 
                                                                ?>
								<option value="<?php echo $jenis->id_jenis ?>"><?php echo $jenis->jenis; ?></option>
                                                            <?php } ?>
							</select>
						</span>
					</p>
				</div>
		
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?php base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 				
			</div>
			
		</form>
	</div>
</section>