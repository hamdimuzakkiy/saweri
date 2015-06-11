<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?php echo base_url().'index.php/satuan'?>';
	}
	$(document).ready(function (){
            var x = <?php echo $usernameValidation ;?>;
            $("#username-error").hide();
            if(x==1){
                $("#username-error").show();
            }
        });
</script>
<div id="username-error">
    <h2>Satuan Sudah Tersedia</h2>
</div>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('satuan/process_update', $attributes);
		?>
			<h1>Setup > Edit Data Satuan</h1>
			
			<fieldset>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Satuan (*) :</label>
						<input type="hidden" name="id_satuan" value="<?php echo $id_satuan?>">
						<span class="relative">
							<?php
								if (form_error('satuan') != null)
								{
									echo '<input type="text" name="satuan" id="satuan" value="'.set_value('satuan').'" class="setengah-width" readonly>';
									echo form_error('satuan');
								}else
								{
									echo '<input type="text" name="satuan" id="satuan" value="'.$satuan.'" class="setengah-width">';
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