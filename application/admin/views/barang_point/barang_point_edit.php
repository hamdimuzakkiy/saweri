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
			<h1>Master > Master Barang : Qty > Edit Data Barang Penukaran Point</h1>
			
			<fieldset>				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Barang (*) :</label>
						<input type="hidden" name="id_barang" value="<?=$id_barang?>">
						<span class="relative">
							<? 
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
						<label for="complex-en-url">Kategori Barang :</label>
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
						<label for="complex-en-url">Satuan Barang :</label>
						<span class="relative">
							<select name="id_satuan" id="id_satuan" lass="seperempat-width">
								<?php
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
					<p class="colx2-right">
						<label for="complex-en-url">Golongan Barang :</label>
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
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kredit Point (*) :</label>
						<span class="relative">
							<? 
								if (form_error('point_barangpoint') != null)
								{
									echo '<input type="text" name="point_barangpoint" id="point_barangpoint" value="'.set_value('point_barangpoint').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="point_barangpoint" id="point_barangpoint" value="'.$point_barangpoint.'" class="setengah-width">';
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