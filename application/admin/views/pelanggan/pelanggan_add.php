<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/pelanggan'?>';
	}
	
	$(function(){
		$("#tgl_lahir").datepicker({dateFormat: 'yy-mm-dd', yearRange: '1945:2020' });
	})
	
	$(function(){
		$("#expired").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2020' });
	})
	
	$(function(){
		$("#tanggal_piutang").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2020' });
	})
	
	function klick_tanggal(){
		var tanggal = document.getElementById("tgl_lahir");
		tanggal.focus();
	}
	function klick_piutang(){
		var tanggal = document.getElementById("tanggal_piutang");
		tanggal.focus();
	}
	function klick_expired(){
		var tanggal = document.getElementById("expired");
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
			echo form_open('pelanggan/insert', $attributes);
		?>
			<h1>Master > Tambah Data Pelanggan</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Pelanggan :</label>
						<span class="relative">
							<input type="text" name="kode_pelanggan" id="kode_pelanggan" value="<?=set_value('kode_pelanggan')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="setengah-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Alamat :</label>
						<span class="relative">
							<input type="text" name="alamat" id="alamat" value="<?=set_value('alamat')?>" class="setengah-width">
						</span>
					</p>					
				</div>																
				<div class="columns">	
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal Saldo Piutang :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<?php
									if ($get_date_now!=null) {
										echo '<input type="text" name="tanggal_piutang" id="tanggal_piutang" class="datepicker" value="' . $get_date_now .  '">';
									}else{
								?>
									<input type="text" name="tanggal_piutang" id="tanggal_piutang" class="datepicker" value="<?=set_value('tanggal_piutang')?>">
								<?php } ?>
								<img onclick="javascript:klick_piutang()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				
					<p class="colx2-right">
						<label for="complex-en-url">Saldo Piutang :</label>
						<span class="relative">
							<input type="text" name="saldo_piutang" id="saldo_piutang" value="<?=set_value('saldo_piutang')?>" class="duapertiga-width" >
						</span>
					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Area :</label>
						<span class="relative">
							<select name="id_area" id="id_area"class="seperempat-width">
								<?php
									$query = $this->db->get('area');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_area.'">'.$row->area.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>					
				</div>
				<div class="columns">					
					<p class="colx2-right">
						<label for="complex-en-url">Max Piutang :</label>
						<span class="relative">
							<input type="text" name="max_piutang" id="max_piutang" value="<?=set_value('max_piutang')?>" class="duapertiga-width" onkeyup="return cek();">
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
<script type="text/javascript">
function cek()
    {
        if(parseInt($('#max_piutang').val()) > parseInt($('#saldo_piutang').val())){
           alert("Max Piutang Tidak Boleh Melebihi Saldo Piutang");
		   $('#max_piutang').val("");
        }
	}
</script>