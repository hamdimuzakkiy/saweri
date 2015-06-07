<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('detail_pembelian/insert', $attributes);
		?>
			<h1>Tambah Detail Pembelian</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Detail Pembelian :</label>
						<span class="relative">
							<input type="text" name="id_detail_pembelian" id="id_detail_pembelian" value="<?=set_value('id_detail_pembelian')?>" class="duapertiga-width">
							<?=form_error('id_detail_pembelian')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">ID Pembelian :</label>
						<span class="relative">
							<select name="id_pembelian" id="id_pembelian"class="seperempat-width">
								<?php
									$query = $this->db->get('pembelian');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_pembelian.'">'.$row->id_pembelian.' - '.$row->pembelian.'</option>';
										}
									}
								?>
							</select>
							<?=form_error('id_pembelian')?>
						</span>
					</p>				
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Barang :</label>
						<span class="relative">
							<select name="id_barang" id="id_barang"class="setengah-width">
								<?php
									$query = $this->db->get('barang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_barang.'">'.$row->id_barang.' - '.$row->nama_barang.'</option>';
										}
									}
								?>
							</select>
							<?=form_error('id_barang')?>
						</span>
					</p>	
					<p class="colx2-right">
						<label for="complex-en-url">Harga :</label>
						<span class="relative">
							<input type="text" name="harga" id="harga" value="<?=set_value('harga')?>" class="duapertiga-width">
							<?=form_error('harga')?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">QTY :</label>
						<span class="relative">
							<input type="text" name="qty" id="qty" value="<?=set_value('qty')?>" class="duapertiga-width">
							<?=form_error('qty')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Total :</label>
						<span class="relative">
							<input type="text" name="total" id="total" value="<?=set_value('total')?>" class="duapertiga-width">
							<?=form_error('total')?>
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