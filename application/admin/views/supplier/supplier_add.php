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
			echo form_open('supplier/insert', $attributes);
		?>
			<h1>Master > Tambah Data Suplier</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Supplier :</label>
						<span class="relative">
							<!--input type="text" name="kode_supplier" id="kode_supplier" readOnly="true" value="<?=$this->supplier->get_kode_supplier()?>" class="duapertiga-width"-->
							<input type="text" name="kode_supplier" id="kode_supplier"   class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="setengah-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Alamat :</label>
						<span class="relative">
							<input type="text" name="alamat" id="alamat" value="<?=set_value('alamat')?>" class="setengah-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Telepon :</label>
						<span class="relative">
							<input type="text" name="telpon" id="telpon" value="<?=set_value('telpon')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Saldo Hutang :</label>
						<span class="relative">
							<input type="text" name="saldo_hutang" id="saldo_hutang" value="<?=set_value('saldo_hutang')?>" class="setengah-width">
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