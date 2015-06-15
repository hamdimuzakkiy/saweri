<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/master_saldo_elektrik'?>';
	}
	$(document).ready(function (){
            var x = <?php echo $usernameValidation ;?>;
            $("#username-error").hide();
            if(x==1){
                $("#username-error").show();
            }
        });
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
<div id="username-error">
    <h2>Nama Master Saldo telah ada.</h2>
</div>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('master_saldo_elektrik/process_update', $attributes);
		?>
			<h1>Master > Edit Master Saldo</h1>
			
			<fieldset>				
				
				<div class="columns">
					<p class="colx2-left">
					
						<label for="complex-en-url">Nama Master Saldo (*) :</label>
						<input type="hidden" name="id_saldo" value="<?=$id_saldo;?>">
                                                <input type="hidden" name="nama_mastersaldo_temp" value="<?=$nama_mastersaldo;?>">
						<span class="relative">
							<?php 

								if (form_error('nama_saldo_elektrik') != null)

								{

									echo '<input type="text" name="nama_mastersaldo" id="nama_mastersaldo" value="'.set_value('nama_mastersaldo').'" class="duapertiga-width">';

								}else

								{

									echo '<input type="text" name="nama_mastersaldo" id="nama_mastersaldo" value="'.$nama_mastersaldo.'" class="duapertiga-width">';

								}

							?>
						</span>
					</p>
					</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Saldo :</label>
						<span class="relative">
							<?php 

								if (form_error('saldo') != null)

								{

									echo '<input type="text" name="saldo" id="saldo" value="'.set_value('saldo').'" class="duapertiga-width">';

								}else

								{

									echo '<input type="text" name="saldo" id="saldo" value="'.$saldo.'" class="duapertiga-width">';

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