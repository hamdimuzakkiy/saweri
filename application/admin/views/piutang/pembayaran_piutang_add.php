<script type="text/javascript">
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:<?=date('Y')?>'});
	})
	
	function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/pembayaran_piutang'?>';
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
			echo form_open('barang/insert', $attributes);
		?>
			<h1>Piutang > Pembayaran Piutang > Tambah Data Pembayaran Piutang</h1>
			
			<fieldset>
				<legend>Tambah Data Pembayaran Piutang</legend>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Akun (Kode Kas) :</label>
						<span class="relative">
							<select name="kd_kas" id="kd_kas"class="seperempat-width">
								<?php
									$query = $this->db->get('coa');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->kode_coa 	.'">'.$row->deskripsi.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-left">
						<label for="complex-en-url">Pelanggan / Cabang :</label>
						<span class="relative">
							<select name="id_pelanggan" id="id_pelanggan" >
								<?php
									$query = $this->db->get('pelanggan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_pelanggan.'">'.$row->kode_pelanggan.' - '.$row->nama.'</option>';
										}
									}
								?>
							</select>
							<?=form_error('id_pelanggan')?>
						</span>
					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal Piutang:</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
					
					<p class="colx2-left">
						<label for="complex-en-url">Jumlah Piutang:</label>
						<span class="relative">
							<input type="text" name="jumlah" id="jumlah" value="<?=set_value('jumlah')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				
				<div class="columns">			
					<p class="colx2-left">
						<label for="complex-en-url">Angsuran Piutang:</label>
						<span class="relative">
							<input type="text" name="angsuran_piutang" id="angsuran_piutang" value="<?=set_value('angsuran_piutang')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-left">
						<label for="complex-en-url">Sisa Piutang :</label>
						<span class="relative">
							<input type="text" name="sisa_piutang" id="sisa_piutang" value="<?=set_value('sisa_piutang')?>" class="duapertiga-width">
						</span>
					</p>
				</div>

				<!--<div class="columns">					
					<p class="colx3-left">
						<label for="complex-en-url">Harga Toko :</label>
						<span class="relative">
							<input type="text" name="harga_toko" id="harga_toko" value="<?=set_value('harga_toko')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Open price ? </label>
						<span class="relative">
							<select name="is_hargatoko"  id="is_hargatoko"  class="duapertiga-width">
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
							</select>
						</span>
					</p>		
				</div>
				<div class="columns">					
					<p class="colx3-left">
						<label for="complex-en-url">Harga Cabang :</label>
						<span class="relative">
							<input type="text" name="harga_cabang" id="harga_cabang" value="<?=set_value('harga_cabang')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Open price ?</label>
						<span class="relative">
							<select name="is_hargajual"  id="is_hargajual"  class="duapertiga-width">
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
							</select>
						</span>
					</p>		
				</div>
				<div class="columns">					
					<p class="colx3-left">
						<label for="complex-en-url">Harga Partai :</label>
						<span class="relative">
							<input type="text" name="harga_partai" id="harga_partai" value="<?=set_value('harga_partai')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Open price ? </label>
						<span class="relative">
							<select name="is_hargapartai"  id="is_hargapartai"  class="duapertiga-width">
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
							</select>
						</span>
					</p>		
				</div>-->
					
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 			
			</div>
			
		</form>
	</div>
</section>