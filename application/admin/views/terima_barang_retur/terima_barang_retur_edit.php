<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/retur_pembelian'?>';
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
			echo form_open('retur_pembelian/process_update', $attributes);
		?>
			<h1>Pembelian > Edit Data Retur Pembelian</h1>
			
			<fieldset class="grey-bg ">				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">PO No (*) :</label>
						<input type="hidden" name="id_retur_pembelian" value="<?=$id_retur_pembelian?>">
						<span class="relative">
							<select name="id_pembelian" id="id_pembelian" class="seperempat-width">
								<?php
									$query = $this->db->get('pembelian');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_pembelian == $row->id_pembelian){
												echo '<option value="'.$row->id_pembelian.'" selected="selected">'.$row->pembelian.'</option>';
											}else{
												echo '<option value="'.$row->id_pembelian.'" >'.$row->po_no.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Tanggal (*) :</label>
						<span class="relative">
							<? 
								if (form_error('tanggal') != null)
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.set_value('tanggal').'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}else
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.$tanggal.'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}
							?>
						</span>
					</p>
				</div>
			</fieldset>
			<fieldset>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Barang (*) :</label>
						<span class="relative">
							<select name="id_barang" id="id_barang" class="duapertiga-width">
								<?php
									$query = $this->db->get('barang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_barang == $row->id_barang){
												echo '<option value="'.$row->id_barang.'" selected="selected">'.$row->nama_barang.'</option>';
											}else{
												echo '<option value="'.$row->id_barang.'" >'.$row->nama_barang.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">QTY (*) :</label>
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