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
			echo form_open('barang_point/insert', $attributes);
		?>
			<h1>Master > Master Barang : Qty > Tambah Data Barang Penukaran Point</h1>
			
			<fieldset>
				
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
						<label for="complex-en-url">Satuan Barang :</label>
						<span class="relative">
							<select name="id_satuan" id="id_satuan"class="seperempat-width">
								<?php
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
					<p class="colx2-right">
						<label for="complex-en-url">Golongan Barang :</label>
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
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Jumlah Point (*) :</label>
						<span class="relative">
							<input type="text" name="point_barangpoint" id="point_barangpoint" value="<?=set_value('point_barangpoint')?>" class="duapertiga-width">
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