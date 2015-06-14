<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/barang_point'?>';
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
			echo form_open('barang_point/process_update', $attributes);
		?>
			<h1>Master > Master Barang Point : Qty > Edit Data Barang Point</h1>
			
			<fieldset>				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Barang :</label>
						<input type="hidden" name="id_barang" value="<?=$id_barang?>">
						<span class="relative">
							<?php
								if (form_error('nama_barang') != null)
								{
									echo '<input type="text" name="nama_barang" id="nama_barang" value="'.set_value('nama_barang').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="nama_barang" id="nama_barang" value="'.$nama_barang.'" class="setengah-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Kategori :</label>
						<span class="relative">
							<select name="id_kategori" id="id_kategori" lass="seperempat-width">
								<?php
									$query = $this->db->get('kategori');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_kategori == $row->id_kategori){
												echo '<option value="'.$row->id_kategori.'" selected="selected">'.$row->kategori.'</option>';
											}else{
												echo '<option value="'.$row->id_kategori.'" >'.$row->kategori.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Golongan :</label>
						<span class="relative">
							<select name="id_golongan" id="id_golongan" lass="seperempat-width">
								<?php
									$query = $this->db->get('golongan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_golongan == $row->id_golongan){
												echo '<option value="'.$row->id_golongan.'" selected="selected">'.$row->golongan.'</option>';
											}else{
												echo '<option value="'.$row->id_golongan.'" >'.$row->golongan.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Jenis Barang :</label>
						<span class="relative">
							<select name="id_jenis" id="id_jenis" class="seperempat-width">
								<?php
									$query = $this->db->get('jenis');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_jenis == $row->id_jenis){
												echo '<option value="'.$row->id_jenis.'" selected="selected">'.$row->jenis.'</option>';
											}else{
												echo '<option value="'.$row->id_jenis.'" >'.$row->jenis.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
				</div>
				<div class="columns">					
					<p class="colx3-left">
						<label for="complex-en-url">Satuan :</label>
						<span class="relative">
							<select name="id_satuan" id="id_satuan" lass="seperempat-width">
								<?php
									$this->db->flush_cache();
									$this->db->order_by('satuan', 'ASC');
									$query = $this->db->get('satuan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_satuan == $row->id_satuan){
												echo '<option value="'.$row->id_satuan.'" selected="selected">'.$row->satuan.'</option>';
											}else{
												echo '<option value="'.$row->id_satuan.'" >'.$row->satuan.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>										
				</div>
				<div class = "columns">
					<p class="colx2-left">
						<label for="complex-en-url">Point Barang :</label>
						<span class="relative">
							<?php 
								if (form_error('point_karyawan') != null)
								{
									echo '<input type="text" name="point_barangpoint" id="point_karyawan" value="'.set_value('point_barangpoint').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="point_barangpoint" id="point_karyawan" value="'.$point_barangpoint.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>					
				</div>
				<div class="columns">						
					<p class="colx2-left">
						<label for="complex-en-url">HPP :</label>
						<span class="relative">
							<?php 
								if (form_error('hpp') != null)
								{
									echo '<input readonly type="text" name="hpp" id="hpp" value="'.set_value('hpp').'" class="duapertiga-width" >';
								}else
								{
									echo '<input readonly type="text" name="hpp" id="hpp" value="'.$hpp.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Serial Number :</label>
						<span class="relative">
							<?php if ($sn == 1) { ?>
							<input type="checkbox" name="sn" id="sn" value = '1' class="duapertiga-width" checked >
							
							<?php } else { ?>
							<input type="checkbox" name="sn" id="sn" value = "1" class="duapertiga-width" >
							<?php } ?>
						</span>
					</p>
				</div>					
				<div class="columns">		
					<p class="colx3-left">
						<label for="complex-en-url">Harga Toko :</label>
						<span class="relative">
							<?php 
								if (form_error('harga_toko') != null)
								{
									echo '<input type="text" name="harga_toko" id="harga_toko" value="'.set_value('harga_toko').'" class="duapertiga-width" >';
								}else
								{
									echo '<input type="text" name="harga_toko" id="harga_toko" value="'.$harga_toko.'" class="duapertiga-width" >';
								}
							?>
						</span>
					</p>						
					<p class="colx3-center">
						<label for="complex-en-url">Open price ? :</label>
						<span class="relative">
							<select name="is_hargatoko" id="is_hargatoko" class="duapertiga-width">
								<?php
											echo 	'
														<option value="1" '.($is_hargatoko==1?'selected="selected"':'').'>Ya</option>
														<option value="0" '.($is_hargatoko==0?'selected="selected"':'').'>Tidak</option>
													';
										?>
							</select>
						</span>
					</p>
					
				</div>	
				<div class="columns">		
					<p class="colx3-left">
						<label for="complex-en-url">Harga Cabang :</label>
						<span class="relative">
							<?php 
								if (form_error('harga_cabang') != null)
								{
									echo '<input type="text" name="harga_cabang" id="harga_cabang" value="'.set_value('harga_cabang').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="harga_cabang" id="harga_cabang" value="'.$harga_cabang.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>				
					<p class="colx3-center">
						<label for="complex-en-url">Open price ? :</label>
						<span class="relative">
							<select name="is_hargajual"  id="is_hargajual"  class="duapertiga-width">
										<?php
											echo 	'
														<option value="1" '.($is_hargajual==1?'selected="selected"':'').'>Ya</option>
														<option value="0" '.($is_hargajual==0?'selected="selected"':'').'>Tidak</option>
													';
										?>
							</select>
						</span>
					</p>
				</div>	
				<div class="columns">		
					<p class="colx3-left">
						<label for="complex-en-url">Harga partai :</label>
						<span class="relative">
							<?php 
								if (form_error('harga_partai') != null)
								{
									echo '<input type="text" name="harga_partai" id="harga_partai" value="'.set_value('harga_partai').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="harga_partai" id="harga_partai" value="'.$harga_partai.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>				
					<p class="colx3-center">
						<label for="complex-en-url">Open price ? </label>
						<span class="relative">
							<select name="is_hargapartai"  id="is_hargapartai"  class="duapertiga-width">
										<?php
											echo 	'
														<option value="1" '.($is_hargapartai==1?'selected="selected"':'').'>Ya</option>
														<option value="0" '.($is_hargapartai==0?'selected="selected"':'').'>Tidak</option>
													';
										?>
							</select>
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