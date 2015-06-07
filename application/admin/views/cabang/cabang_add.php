<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/cabang'?>';
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

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('cabang/insert', $attributes);
		?>
			<h1>Master > Tambah Data Cabang</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Cabang (*) :</label>
						<span class="relative">
							<input type="text" name="kode_cabang" id="kode_cabang" value="<?=set_value('kode_cabang')?>" class="tigaperempat-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama Cabang (*) :</label>
						<span class="relative">
							<input type="text" name="nama_cabang" id="nama_cabang" value="<?=set_value('nama_cabang')?>" class="setengah-width">
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
							<input type="text" name="telepon" id="telepon" value="<?=set_value('telepon')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Max Piutang :</label>
						<span class="relative">
							<input type="text" name="max_piutang" id="max_piutang" value="<?=set_value('max_piutang')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Saldo Piutang :</label>
						<span class="relative">
							<input type="text" name="saldo_piutang" id="saldo_piutang" value="<?=set_value('saldo_piutang')?>" class="duapertiga-width"  onkeyup="return cek();">
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
<script type="text/javascript">
function cek()
    {
        if(parseInt($('#saldo_piutang').val()) > parseInt($('#max_piutang').val())){
           alert("Jumlah Piutang Melebihi Maximal Piutang");
		   $('#saldo_piutang').val("");
        }
	}
</script>