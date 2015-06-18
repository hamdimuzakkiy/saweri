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
	function getKecamatan(){
            var kabupaten = document.getElementById("id_kabupaten").value;
            $.ajax({
			type: 'POST',
                        url: '<?=base_url().'index.php/pelanggan/getKecamatan/'?>'+kabupaten, //url: $(this).attr('action'),
			//data: $('#form1').serialize(),
			success: function(data) {
				$('#id_kecamatan').html(data);
			}
            }); 
        }
        function getArea(){
            var kecamatan = document.getElementById("id_kecamatan").value;
            $.ajax({
			type: 'POST',
                        url: '<?=base_url().'index.php/pelanggan/getArea/'?>'+kecamatan, //url: $(this).attr('action'),
			//data: $('#form1').serialize(),
			success: function(data) {
				$('#id_area').html(data);
			}
            }); 
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
			echo form_open('pelanggan/process_update', $attributes);
		?>
			<h1>Master > Edit Data Pelanggan</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode Pelanggan :</label>
						<input type="hidden" name="id_pelanggan" value="<?=$id_pelanggan?>">
						<span class="relative">
							<?php 
								if (form_error('kode_pelanggan') != null)
								{
									echo '<input type="text" name="kode_pelanggan" id="kode_pelanggan" readOnly="true" value="'.set_value('kode_pelanggan').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="kode_pelanggan" id="kode_pelanggan" readOnly="true" value="'.$kode_pelanggan.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<?php 
								if (form_error('nama') != null)
								{
									echo '<input type="text" name="nama" id="nama" value="'.set_value('nama').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="nama" id="nama" value="'.$nama.'" class="setengah-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Alamat :</label>
						<span class="relative">
							<?php 
								if (form_error('alamat') != null)
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.set_value('alamat').'" class="setengah-width">';
								}else
								{
									echo '<input type="text" name="alamat" id="alamat" value="'.$alamat.'" class="setengah-width">';
								}
							?>
						</span>
					</p>					
				</div>															
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal Saldo Piutang :</label>
						<span class="relative">
							<?php 
								if (form_error('tanggal_piutang') != null)
								{
									echo '
											<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal_piutang" id="tanggal_piutang" class="datepicker" value="'.set_value('tanggal_piutang').'">
												<img onclick="javascript:klick_piutang()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
											</span>';
								}else
								{
									echo '
											<span class="input-type-text margin-right relative">
												<input type="text" name="tanggal_piutang" id="tanggal_piutang" class="datepicker" value="'.$tanggal_piutang.'">
												<img onclick="javascript:klick_piutang()" src="'.base_url().'asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
											</span>';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Saldo Piutang :</label>
						<span class="relative">
							<?php 
								if (form_error('saldo_piutang') != null)
								{
									echo '<input type="text" name="saldo_piutang" id="saldo_piutang" value="'.set_value('saldo_piutang').'" class="duapertiga-width"  onkeyup="return cek();">';
								}else
								{
									echo '<input type="text" name="saldo_piutang" id="saldo_piutang" value="'.$saldo_piutang.'" class="duapertiga-width"  onkeyup="return cek();">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kabupaten</label>
						<span class="relative">
                                                    <select name="id_kabupaten" id="id_kabupaten" class="seperempat-width" onchange="getKecamatan()">
                                                                <?php
									$query = $this->db->get('kabupaten');
                                                                        $this->db->flush_cache();
                                                                        $this->db->where("id_area",$id_area);
                                                                        $query2 = $this->db->get("area");
									if($query->num_rows() > 0)
									{
                                                                                foreach ($query2->result() as $rows){}
										foreach($query->result() as $row)
										{
                                                                                    if($rows->id_kabupaten==$row->id_kabupaten)
                                                                                        echo '<option value="'.$row->id_kabupaten.'" selected>'.$row->kabupaten.'</option>';
                                                                                    else
                                                                                        echo '<option value="'.$row->id_kabupaten.'">'.$row->kabupaten.'</option>';
										}
									}
								?>
							</select>
						</span>
						<label for="complex-en-url">Kecamatan</label>
						<span class="relative">
                                                    <select name="id_kecamatan" id="id_kecamatan" class="seperempat-width" onchange="getArea()">
                                                            <option value="0">-</option>
                                                            <?php
                                                                $this->db->flush_cache();
                                                                $this->db->where("id_Kecamatan",$rows->id_kecamatan);
                                                                $query = $this->db->get("kecamatan");
                                                                foreach ($query->result() as $row)
                                                                echo '<option value="'.$row->id_kecamatan.'" selected>'.$row->kecamatan.'</option>';
                                                            ?>
							</select>
						</span>
                                                <label for="complex-en-url">Area</label>
						<span class="relative">
							<select name="id_area" id="id_area" class="seperempat-width">
                                                            <option value="0">-</option>
                                                            <?php
                                                                $this->db->flush_cache();
                                                                $this->db->where("id_area",$rows->id_area);
                                                                $query = $this->db->get("area");
                                                                foreach ($query->result() as $row)
                                                                echo '<option value="'.$row->id_area.'" selected>'.$row->area.'</option>';
                                                            ?>
							</select>
						</span>
					</p>			
				</div>
				<div class="columns">					
					<p class="colx2-right">
						<label for="complex-en-url">Max Piutang :</label>
						<span class="relative">
							
							<?php 
								if (form_error('max_piutang') != null)
								{
									echo '<input type="text" name="max_piutang" id="max_piutang" value="'.set_value('max_piutang').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="max_piutang" id="max_piutang" value="'.$max_piutang.'" class="duapertiga-width">';
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
<script type="text/javascript">
function cek()
    {
        if(parseInt($('#saldo_piutang').val()) > parseInt($('#max_piutang').val())){
           alert("Jumlah Piutang Melebihi Maximal Piutang");
		   $('#saldo_piutang').val("");
        }
	}
</script>