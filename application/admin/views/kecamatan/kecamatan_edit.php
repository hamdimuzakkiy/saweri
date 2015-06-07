<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/kecamatan'?>';
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
			echo form_open('kecamatan/process_update', $attributes);
		?>
			<h1>Setup > Edit Data Kecamatan</h1>
			
			<fieldset>

				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kabupaten :</label>
						<span class="relative">
							<select name="id_kabupaten" id="id_kabupaten" >
								<?php
									$query = $this->db->get('kabupaten');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($result->row()->id_kabupaten == $row->id_kabupaten){
												echo '<option value="'.$row->id_kabupaten.'" selected="selected">'.$row->kabupaten.'</option>';
											}else{
												echo '<option value="'.$row->id_kabupaten.'">'.$row->kabupaten.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Kecamatan (*) :</label>
						<input type="hidden" name="id_kecamatan" value="<?=$id_kecamatan?>">
						<span class="relative">
							<?php 
								if (form_error('kecamatan') != null)
								{
									echo '<input type="text" name="kecamatan" id="kecamatan" value="'.set_value('kecamatan').'" >';
								}else
								{
									echo '<input type="text" name="kecamatan" id="kecamatan" value="'.$kecamatan.'" >';
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