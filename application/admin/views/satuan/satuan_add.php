<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('satuan/insert', $attributes);
		?>
			<h1>Setup > Tambah Data Satuan</h1>
			
			<fieldset>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Satuan (*) :</label>
						<span class="relative">
							<input type="text" name="satuan" id="satuan" value="<?=set_value('satuan')?>" class="setengah-width">
							<?=form_error('satuan')?>
						</span>
					</p>
				</div>
				
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" class="red">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>