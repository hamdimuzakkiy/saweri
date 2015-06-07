<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('privilege/process_update', $attributes);
		?>
			<h1>Tukar Tambah</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">id_privilege :</label>
						<span class="relative">
							<? 
								if (form_error('id_privilege') != null)
								{
									echo '<input type="text" name="id_privilege" id="id_privilege" value="'.set_value('id_privilege').'" class="duapertiga-width">';
									echo form_error('id_privilege');
								}else
								{
									echo '<input type="text" name="id_privilege" id="id_privilege" value="'.$id_privilege.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
		<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">privilege :</label>
						<span class="relative">
							<? 
								if (form_error('privilege') != null)
								{
									echo '<input type="text" name="privilege" id="privilege" value="'.set_value('privilege').'" class="duapertiga-width">';
									echo form_error('privilege');
								}else
								{
									echo '<input type="text" name="privilege" id="privilege" value="'.$privilege.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
		<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">deskripsi :</label>
						<span class="relative">
							<? 
								if (form_error('deskripsi') != null)
								{
									echo '<input type="text" name="deskripsi" id="deskripsi" value="'.set_value('deskripsi').'" class="duapertiga-width">';
									echo form_error('deskripsi');
								}else
								{
									echo '<input type="text" name="deskripsi" id="deskripsi" value="'.$deskripsi.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="button" class="red">Batal</button> 
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
			</div>
			
		</form>
	</div>
</section>