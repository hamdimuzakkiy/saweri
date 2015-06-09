<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/beban_transaksi'?>';
	}
	
		$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})	

		function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
	
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('beban_transaksi/process_update', $attributes);
		?>
			<h1>Pembelian > Edit Data Retur Pembelian</h1>
			
			<fieldset class="grey-bg ">				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Pembayaran (*) :</label>
						<input type="hidden" name="id_retur_pembelian" value="<?=$id?>">
						<span class="relative">
													
								<?php
									print '<input type="text" name="pembayaran" id="qty" value="'.$pembayaran.'" class="duapertiga-width" readonly>'
								?>
								<?php
									print '<input type="hidden" name="id" id="qty" value="'.$id.'" class="duapertiga-width" readonly>'
								?>
							
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Beban (*) :</label>
						<span class="relative">
							<?php 
								print '<input type="text" name="beban" id="qty" value="'.$beban.'" class="duapertiga-width" >%';
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