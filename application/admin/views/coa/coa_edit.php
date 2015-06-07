<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('coa/process_update', $attributes);
		?>
			<h1>Edit COA</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID COA :</label>
						<span class="relative">
							<? 
								if (form_error('id_coa') != null)
								{
									echo '<input type="text" name="id_coa" id="id_coa" value="'.set_value('id_coa').'" class="duapertiga-width">';
									echo form_error('id_coa');
								}else
								{
									echo '<input type="text" name="id_coa" id="id_coa" value="'.$id_coa.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode COA :</label>
						<span class="relative">
							<? 
								if (form_error('kode_coa') != null)
								{
									echo '<input type="text" name="kode_coa" id="kode_coa" value="'.set_value('kode_coa').'" class="duapertiga-width">';
									echo form_error('kode_coa');
								}else
								{
									echo '<input type="text" name="kode_coa" id="kode_coa" value="'.$kode_coa.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Deskripsi :</label>
						<span class="relative">
							<? 
								if (form_error('deskripsi') != null)
								{
									echo '<input type="text" name="deskripsi" id="deskripsi" value="'.set_value('deskripsi').'" class="setengah-width">';
									echo form_error('deskripsi');
								}else
								{
									echo '<input type="text" name="deskripsi" id="deskripsi" value="'.$deskripsi.'" class="setengah-width">';
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