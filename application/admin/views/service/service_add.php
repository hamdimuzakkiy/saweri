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
			echo form_open('service/insert', $attributes);
		?>
			<h1>Penjualan > Tambah Data Service</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Pelanggan (*):</label>
						<span class="relative">
							<!--<select name="nama_pelanggan" id="nama_pelanggan"class="setengah-width">-->								<input type="text" name="nama_pelanggan" value="">
								<?php									/*
									$query = $this->db->get('pelanggan');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->nama.'">'.$row->nama.'</option>';
										}
									}									*/
								?>
							<!--</select>-->
						</span>
					</p>	
					<p class="colx2-right">
						<label for="complex-en-url">Nama Barang (*) :</label>
						<span class="relative">
							<input type="text" name="nama_barang" id="nama_barang" value="<?=set_value('nama_barang')?>" class="setengah-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Tanggal (*) :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">
								<img onclick="javascript:klick_tanggal_bayar()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Kerusakan :</label>
						<span class="relative">
							<input type="text" name="kerusakan" id="kerusakan" value="<?=set_value('kerusakan')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Total Bayar :</label>
						<span class="relative">
							<input type="text" name="total_bayar" id="total_bayar" value="<?=set_value('total_bayar')?>" class="duapertiga-width">
						</span>
					</p>					
					<p class="colx2-right">
						<label for="complex-en-url">Status :</label>
						<span class="relative">
							<select name="status" id="status" class="setengah-width">																
							<?php																		
							$query = $this->db->get('service_status');									
							if($query->num_rows() > 0)									{										
							foreach($query->result() as $row)										{												
							echo '<option value="'.$row->id.'" >'.$row->deskripsi.'</option>';										
							}									
							}																	
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