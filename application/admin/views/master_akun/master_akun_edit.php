<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/master_akun'?>';
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
			echo form_open('master_akun/process_update', $attributes);
		?>
			<h1>Master > Edit Data Akun</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Akun (*) :</label>
						<!--<input type="hidden" name="AKUNID" value="<?=$AKUNID?>" readonly="readonly">-->
						<span class="relative">
							<?php 
								if (form_error('AKUNID') != null)
								{
									echo '<input type="text" name="AKUNID" id="AKUNID" value="'.set_value('AKUNID').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="AKUNID" id="AKUNID" value="'.$AKUNID.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Akun (*) :</label>
						<span class="relative">
							<?php 
								if (form_error('NAKUN') != null)
								{
									echo '<input type="text" name="NAKUN" id="NAKUN" value="'.set_value('NAKUN').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="NAKUN" id="NAKUN" value="'.$NAKUN.'" class="setengah-width">';
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
<script type="text/javascript">
function cek()
    {
        if(parseInt($('#saldo_piutang').val()) > parseInt($('#max_piutang').val())){
           alert("Jumlah Piutang Melebihi Maximal Piutang");
		   $('#saldo_piutang').val("");
        }
	}
</script>