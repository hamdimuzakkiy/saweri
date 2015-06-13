<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/member'?>';
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
	$(document).ready(function (){
            var x = <?php echo $usernameValidation ;?>;
            $("#username-error").hide();
            if(x==1){
                $("#username-error").show();
            }
        });
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
<div id="username-error">
    <h2>Kode Member telah tersedia. Silahkan cari kode lain</h2>
</div>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('member/insert', $attributes);
		?>
			<h1>Master > Tambah Data Member</h1>
			
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
					<p class="colx2-right">
						<label for="complex-en-url">Tgl Lahir :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tgl_lahir" id="tgl_lahir" class="datepicker" value="<?=set_value('tgl_lahir')?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Agama :</label>
						<span class="relative">
							<!--<input type="text" name="agama" id="agama" value="<?=set_value('agama')?>" class="duapertiga-width">-->
                                                    <select name="agama" id="agama" class="duapertiga-width">
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                        <option value="Katolik">Katolik</option>
                                                        <option value="Budha">Budha</option>
                                                        <option value="Hindu">Hindu</option>
                                                    </select>
							<?=form_error('agama')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Pekerjaan :</label>
						<span class="relative">
							<input type="text" name="pekerjaan" id="pekerjaan" value="<?=set_value('pekerjaan')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">					
					<p class="colx2-left">
						<label for="complex-en-url">Jenis Pengenal :</label>
						<span class="relative">
							<select name="jenis_pengenal"  id="jenis_pengenal"  class="duapertiga-width">
										<option value="KTP (Kartu Tanda Penduduk)">KTP (Kartu Tanda Penduduk)</option>
										<option value="KTM (Kartu Tanda Mahasiswa)">KTM (Kartu Tanda Mahasiswa)</option>
										<option value="SIM (Surat Izin Mengemudi)">SIM (Surat Izin Mengemudi)</option>
										<option value="Pasport">Pasport</option>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">No Pengenal (*) :</label>
						<span class="relative">
							<input type="password" name="no_pengenal" id="no_pengenal" value="<?=set_value('no_pengenal')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Telepon :</label>
						<span class="relative">
							<input type="text" name="tel" id="tel" value="<?=set_value('tel')?>" class="duapertiga-width">
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
						<label for="complex-en-url">Kabupaten - Kecamatan - Area :</label>
						<span class="relative">
							<select name="id_area" id="id_area"class="seperempat-width" style="width: 50%;">
								<?php
									$query = $this->db->get('area');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
                                                                                        $this->db->flush_cache();
                                                                                        $this->db->select('*');
                                                                                        $this->db->where("id_kecamatan",$row->id_kecamatan);
                                                                                        $query1 = $this->db->get('kecamatan');
                                                                                        
                                                                                        $this->db->flush_cache();
                                                                                        $this->db->select('*');
                                                                                        $this->db->where("id_kabupaten",$row->id_kabupaten);
                                                                                        $query2 = $this->db->get('kabupaten');
                                                                                        
                                                                                        if($query1->num_rows() > 0 || $query2->num_rows() > 0)
                                                                                            foreach ($query1->result() as $rows_kec)foreach ($query2->result() as $rows_kab)
                                                                                                echo '<option value="'.$row->id_area.'">'.$rows_kab->kabupaten." - ".$rows_kec->kecamatan." - ".$row->area.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Point :</label>
						<span class="relative">
							<input type="text" name="point" id="point" value="<?=set_value('point')?>" class="duapertiga-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Expired :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="expired" id="expired" class="datepicker" value="<?=set_value('expired')?>">
								<img onclick="javascript:klick_expired()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
						
					</p>
					
					
					<p class="colx2-right">
						<label for="complex-en-url">Max Piutang :</label>
						<span class="relative">
							<input type="text" name="max_piutang" id="max_piutang" value="<?=set_value('max_piutang')?>" class="duapertiga-width" onkeyup="return cek();">
						</span>
					</p>
					
				</div>
                            <div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">ID Kartu :</label>
						<span class="relative">
							<input type="password" name="id_kartu" id="id_kartu" value="<?=set_value('id_kartu')?>" class="duapertiga-width">
						</span>
					</p>
					
					<p class="colx2-right">
						<label for="complex-en-url">No Kartu :</label>
						<span class="relative">
							<input type="text" name="no_kartu" id="no_kartu" value="<?=set_value('no_kartu')?>" class="duapertiga-width">
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