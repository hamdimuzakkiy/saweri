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
			<h1>Master > Master Barang : Qty > Tambah Data Barang</h1>
			
			<fieldset>
				<legend>Tambah Data Barang</legend>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Barang (*) :</label>
						<span class="relative">
							<input type="text" name="nama_barang" id="nama_barang" value="<?=set_value('nama_barang')?>" class="setengah-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Kategori Barang :</label>
						<span class="relative">
							<select name="id_kategori" id="id_kategori"class="seperempat-width">
								<?php
									$query = $this->db->get('kategori');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_kategori.'">'.$row->kategori.'</option>';
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
							<select name="id_golongan" id="id_golongan"class="seperempat-width">
								<?php
									$query = $this->db->get('golongan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_golongan.'">'.$row->golongan.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Jenis Barang :</label>
						<span class="relative">
							<select name="id_jenis" id="id_jenis"class="seperempat-width">
								<?php
									$query = $this->db->get('jenis');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if ($row->id_jenis != 3){
												echo '<option value="'.$row->id_jenis.'">'.$row->jenis.'</option>';
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
							<select name="id_satuan" id="id_satuan"class="seperempat-width">
								<?php
									$this->db->flush_cache();
									$this->db->order_by('satuan', 'ASC');
									$query = $this->db->get('satuan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
				</div>						
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Point Karyawan :</label>
						<span class="relative">
							<input type="text" name="point_karyawan" id="point_karyawan" value="<?=set_value('point_karyawan')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Point Member :</label>
						<span class="relative">
							<input type="text" name="point_member" id="point_member" value="<?=set_value('point_member')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">		
					<p class="colx2-left">
						<label for="complex-en-url">HPP :</label>
						<span class="relative">
							<input type="text" readonly name="hpp" id="hpp" value="<?=set_value('hpp')?>" class="duapertiga-width">
						</span>
					</p>

						<!--p class="colx2-right">
						<label for="complex-en-url">Serial Number :</label>
						<span class="relative">
							<input type="text" name="sn" id="sn" value="<?=set_value('sn')?>" class="duapertiga-width">
						</span>
					</p-->		
					<p class="colx2-right">
						<label for="complex-en-url">Serial Number :</label>
						<span class="relative">
							<input type="checkbox" name="sn" id="sn" value = '1' class="duapertiga-width">
						</span>
					</p>
				</div>

				<div class="columns">					
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
				</div>
					
				<p><i> Field yang diberi tanda (*) harus diisi ! </i></p>
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 			
			</div>
			
		</form>
	</div>
</section>