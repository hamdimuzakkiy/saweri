<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/supplier'?>';
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
    <h2>Kode supplier yang anda masukkan sudah ada.</h2>
</div>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('supplier/process_update', $attributes);
		?>
			<h1>Master > Edit Data Supplier</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Supplier :</label>
						<input type="hidden" name="id_supplier"  value="<?=$id_supplier?>">
						<span class="relative">
							<?php 
								if (form_error('kode_supplier') != null)
								{
									echo '<input type="text" name="kode_supplier" id="kode_supplier"  value="'.set_value('kode_supplier').'" class="duapertiga-width" readonly>';
								}else
								{
									echo '<input type="text" name="kode_supplier" id="kode_supplier"  value="'.$kode_supplier.'" class="duapertiga-width" readonly>';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<?php 
								if (form_error('nama') != null)
								{
									echo '<input type="text" name="nama" id="nama" value="'.set_value('nama').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="nama" id="nama" value="'.$nama.'" class="setengah-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Alamat :</label>
						<span class="relative">
							<?php 
								if (form_error('alamat') != null)
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.set_value('alamat').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.$alamat.'" class="setengah-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Telepon :</label>
						<span class="relative">
							<?php 
								if (form_error('telpon') != null)
								{
									echo '<input type="text" name="telpon" id="telpon" value="'.set_value('telpon').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="telpon" id="telpon" value="'.$telpon.'" class="setengah-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Saldo Hutang :</label>
						<span class="relative">
							<?php 
								if (form_error('saldo_hutang') != null)
								{
									echo '<input type="text" name="saldo_hutang" id="saldo_hutang" value="'.set_value('saldo_hutang').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="saldo_hutang" id="saldo_hutang" value="'.$saldo_hutang.'" class="setengah-width">';
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