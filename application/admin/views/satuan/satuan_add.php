<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/satuan'?>';
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
					<button type="button" class="red" onclick="javascript:batal();">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>