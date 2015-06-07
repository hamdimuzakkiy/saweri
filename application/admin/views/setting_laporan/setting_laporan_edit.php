<script type="text/javascript">

	

	function batal(){

		document.location.href = '<?=base_url().'index.php/setting_laporan'?>';

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

			echo form_open('setting_laporan/process_update', $attributes);
			
		

		?>
			<h1>Master > Edit Kode Transaksi</h1>
			<?php // if($error!=null) echo $error; else echo '';?>
			

			<fieldset>

				

				<input type="hidden" name="id" value="<?=$id;?>">
				
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">Footer Pembelian (*) :</label>

						<span class="relative">

							<?php 
								
								if (form_error('footer_pembelian') != null)

								{

									echo '<textarea name="footer_pembelian" id="footer_pembelian" >' . set_value('footer_pembelian') . '<textarea>';

								}else

								{ 
									echo '<textarea name="footer_pembelian" id="footer_pembelian">' . $footer_pembelian . '</textarea>';
								}

							?>

						</span>

					</p>
				</div>
				
				
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">Footer Penjualan :</label>

						<span class="relative">

							<?php 
								
								if (form_error('footer_penjualan') != null)

								{
									echo '<textarea name="footer_penjualan" id="footer_penjualan">' . set_value('footer_penjualan') . '</textarea>';
								}else

								{ 

									
									echo '<textarea name="footer_penjualan" id="footer_penjualan">' . $footer_penjualan . '</textarea>';
								}

							?>

						</span>

					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">Footer Service :</label>

						<span class="relative">

							<?php 
								
								if (form_error('footer_service') != null)

								{
									echo '<textarea name="footer_service" id="footer_service">' . set_value('footer_service') . '</textarea>';
								}else

								{ 

									
									echo '<textarea name="footer_service" id="footer_service">' . $footer_service . '</textarea>';
								}

							?>

						</span>

					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">Footer Tukar Tambah :</label>

						<span class="relative">

							<?php 
								
								if (form_error('footer_tukar_tambah') != null)

								{
									echo '<textarea name="footer_tukar_tambah" id="footer_tukar_tambah">' . set_value('footer_tukar_tambah') . '</textarea>';
								}else

								{ 
									echo '<textarea name="footer_tukar_tambah" id="footer_tukar_tambah">' . $footer_tukar_tambah . '</textarea>';
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