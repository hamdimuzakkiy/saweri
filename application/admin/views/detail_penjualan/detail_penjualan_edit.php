<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('detail_penjualan/process_update', $attributes);
		?>
			<h1>Edit Detail Penjualan</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Detail Penjualan :</label>
						<span class="relative">
							<? 
								if (form_error('id_detail_penjualan') != null)
								{
									echo '<input type="text" name="id_detail_penjualan" id="id_detail_penjualan" value="'.set_value('id_detail_penjualan').'" class="duapertiga-width">';
									echo form_error('id_detail_penjualan');
								}else
								{
									echo '<input type="text" name="id_detail_penjualan" id="id_detail_penjualan" value="'.$id_detail_penjualan.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">ID Penjualan :</label>
						<span class="relative">
							<select name="id_penjualan" id="id_penjualan" class="seperempat-width">
								<?php
									$query = $this->db->get('penjualan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_penjualan == $row->id_penjualan){
												echo '<option value="'.$row->id_penjualan.'" selected="selected">'.$row->id_penjualan.' - '.$row->penjualan.'</option>';
											}else{
												echo '<option value="'.$row->id_penjualan.'" >'.$row->id_penjualan.' - '.$row->penjualan.'</option>';
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
						<label for="complex-en-url">ID Barang :</label>
						<span class="relative">
							<select name="id_barang" id="id_barang" class="setengah-width">
								<?php
									$query = $this->db->get('barang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_barang == $row->id_barang){
												echo '<option value="'.$row->id_barang.'" selected="selected">'.$row->id_barang.' - '.$row->nama_barang.'</option>';
											}else{
												echo '<option value="'.$row->id_barang.'" >'.$row->id_barang.' - '.$row->nama_barang.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Harga :</label>
						<span class="relative">
							<? 
								if (form_error('harga') != null)
								{
									echo '<input type="text" name="harga" id="harga" value="'.set_value('harga').'" class="duapertiga-width">';
									echo form_error('harga');
								}else
								{
									echo '<input type="text" name="harga" id="harga" value="'.$harga.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">QTY :</label>
						<span class="relative">
							<? 
								if (form_error('qty') != null)
								{
									echo '<input type="text" name="qty" id="qty" value="'.set_value('qty').'" class="duapertiga-width">';
									echo form_error('qty');
								}else
								{
									echo '<input type="text" name="qty" id="qty" value="'.$qty.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Total :</label>
						<span class="relative">
							<? 
								if (form_error('total') != null)
								{
									echo '<input type="text" name="total" id="total" value="'.set_value('total').'" class="duapertiga-width">';
									echo form_error('total');
								}else
								{
									echo '<input type="text" name="total" id="total" value="'.$total.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Karyawan :</label>
						<span class="relative">
							<? 
								if (form_error('id_karyawan') != null)
								{
									echo '<input type="text" name="id_karyawan" id="id_karyawan" value="'.set_value('id_karyawan').'" class="duapertiga-width">';
									echo form_error('id_karyawan');
								}else
								{
									echo '<input type="text" name="id_karyawan" id="id_karyawan" value="'.$id_karyawan.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" class="red">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>