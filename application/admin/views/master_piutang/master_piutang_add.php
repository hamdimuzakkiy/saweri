<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/barang'?>';
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
			<h1>Piutang > Master Piutang > Tambah Data Master Piutang</h1>
			
			<fieldset>
				<legend>Tambah Data Master Piutang</legend>
				
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
						<label for="complex-en-url">Reff Transaksi :</label>
						<span class="relative">
							<input type="text" name="reff_transaksi" id="reff_transaksi" value="<?=set_value('reff_transaksi')?>" class="duapertiga-width">
						</span>
					</p>
					
					<p class="colx2-left">
						<label for="complex-en-url">Jumlah :</label>
						<span class="relative">
							<input type="text" name="jumlah" id="jumlah" value="<?=set_value('jumlah')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				
				<div class="columns">			
					<p class="colx2-left">
						<label for="complex-en-url">Kode Unit :</label>
						<span class="relative">
							<input type="text" name="kode_unit" id="kode_unit" value="<?=set_value('kode_unit')?>" readonly="true" class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-left">
						<label for="complex-en-url">Operator :</label>
						<span class="relative">
							<input type="text" name="operator" id="operator" value="<?=set_value('operator')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Keterangan Transaksi :</label>
						<span class="relative">
							<textarea name="ket_transaksi" id="ket_transaksi" rows="5" cols="50" value="<?=set_value('ket_transaksi')?>" > </textarea>
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