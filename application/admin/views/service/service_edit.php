<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/service'?>';
	}
	
		$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:<?=date('Y')?>' });
	})
	
		function klick_tanggal_bayar(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
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
			echo form_open('service/process_update', $attributes);
		?>
			<h1>Penjualan > Edit Data Service</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Pelanggan (*) :</label>
						<input type="hidden" name="id_service" value="<?=$id_service?>">
						<span class="relative">							
							<!--<select name="nama_pelanggan" id="nama_pelanggan" readonly="true" class="setengah-width ">-->								<input type="text" name="nama_pelanggan" value="<?=$nama_pelanggan?>">
								<?php								/*	
									$query = $this->db->get('pelanggan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if(nama_pelanggan== $row->nama){
												echo '<option value="'.$row->nama.'" selected="selected">'.$row->nama_pelanggan.$row->nama.'</option>';
											}else{
												echo '<option value="'.$row->nama.'" >'.$row->nama.'</option>';
											}
										}
									}								*/
								?>
							<!--</select>-->
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama Barang (*) :</label>
							
						<span class="relative">							<input type="text" name="nama_barang" value="<?=$nama_barang?>">
							<!--<select name="nama_barang" id="nama_barang" class="setengah-width">-->
								<?php									/*
									$query = $this->db->get('barang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($nama_barang == $row->nama_barang){
												echo '<option value="'.$row->nama_barang.'" selected="selected">'.$row->nama_barang.$row->nama.'</option>';
											}else{
												echo '<option value="'.$row->nama_barang.'" >'.$row->nama_barang.$row->nama_barang.'</option>';
											}
										}
									}									*/
								?>
							<!--</select>-->
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal (*) :</label>
						<span class="relative">
							<?php 
								if (form_error('tanggal') != null)
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.set_value('tanggal').'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_bayar()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}else
								{
									echo '	<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal" id="tanggal" value="'.$tanggal.'" class="duapertiga-width tgl">
												<img onclick="javascript:klick_tanggal_bayar()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16" alt="hah">
											</span>'
										 ;
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Kerusakan (*) :</label>
						<span class="relative">
							<?php 
								if (form_error('kerusakan') != null)
								{
									echo '<input type="text" name="kerusakan" id="kerusakan" value="'.set_value('kerusakan').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="kerusakan" id="kerusakan" value="'.$kerusakan.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Total Bayar :</label>
						<span class="relative">
							<?php 
								if (form_error('total_bayar') != null)
								{
									echo '<input type="text" name="total_bayar" id="total_bayar" value="'.set_value('total_bayar').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="total_bayar" id="total_bayar" value="'.$total_bayar.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Status (*) :</label>
						<span class="relative">														<select name="status" id="status" class="setengah-width">								<?php																		$query = $this->db->get('service_status');									if($query->num_rows() > 0)									{										foreach($query->result() as $row)										{											if($status == $row->id){												echo '<option value="'.$row->id.'" selected="selected">'.$row->deskripsi.'</option>';											}else{												echo '<option value="'.$row->id.'" >'.$row->deskripsi.'</option>';											}										}									}																	?>							</select>
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