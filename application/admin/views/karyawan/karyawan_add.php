<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/karyawan'?>';
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
    <h2>Username <?php echo $username; ?> telah ada. Silahkan cari username lain</h2>
</div>

<section class="grid_10">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('karyawan/insert', $attributes);
		?>
			<h1>Setup > Tambah Data Karyawan</h1>
			
			<fieldset>	
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang"class="duapertiga-width">
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_cabang.'">'.$row->nama_cabang.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Kode Karyawan (*) :</label>
						<span class="relative">
							<input type="text" name="kode_karyawan" id="kode_karyawan" readOnly="True" value="<?=$this->karyawan->get_idkaryawan()?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Nama (*) :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="setengah-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Alamat :</label>
						<span class="relative">
							<input type="text" name="alamat" id="alamat" value="<?=set_value('alamat')?>" class="setengah-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Jenis Pengenal (*) :</label>
						<span class="relative">
							<select name="jenis_pengenal"  id="jenis_pengenal"  class="duapertiga-width">
										<option value="KTP (Kartu Tanda Penduduk)">KTP (Kartu Tanda Penduduk)</option>
										<option value="KTM (Kartu Tanda Mahasiswa)">KTM (Kartu Tanda Mahasiswa)</option>
										<option value="SIM (Surat Izin Mengemudi)">SIM (Surat Izin Mengemudi)</option>
										<option value="Pasport">Pasport</option>
							</select>
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">No Pengenal (*) :</label>
						<span class="relative">
							<input type="text" name="no_pengenal" id="no_pengenal" value="<?=set_value('no_pengenal')?>" class="setengah-width">
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Telepon 1 :</label>
						<span class="relative">
							<input type="text" name="telp1" id="telp1" value="<?=set_value('telp1')?>" class="duapertiga-width">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Status Karyawan :</label>
						<span class="relative">
							<select name="status"  id="status"  class="duapertiga-width">
										<option value="Masih Bekerja">Masih Bekerja</option>
										<option value="Sudah Resign">Sudah Resign</option>
										<option value="Cuti">Cuti</option>
										<option value="Lain-lain">Lain-lain</option>
							</select>
						</span>
					</p>

					<p class="colx3-right">
						<label for="complex-en-url">Point :</label>
						<span class="relative">
							<input type="text" name="point" id="point" value="<?=set_value('point')?>" class="duapertiga-width">
						</span>
					</p>
				</div>

			</fieldset>
			
			<fieldset class="grey-bg margin">
			<div class="columns">
					<?php
						$this->db->flush_cache();
						$query1 = $this->db->query("SHOW TABLE STATUS LIKE 'users'");
						
						// ngambil no autoincrement dan akhirnya jadi-> '000x'
						$tmp_no = $query1->row()->Auto_increment;
						$userid = str_pad($tmp_no, 4, '0', STR_PAD_LEFT);
					?>
					<input type="hidden" name="userid" value="<?=$userid?>" >
					<p class="colx3-left">
						<label for="complex-en-url">Username (*) :</label>
						<span class="relative">
							<input type="text" size="25" name="username" id="username" value="<?=set_value('username')?>" >
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Password (*) :</label>
						<span class="relative">
							<input type="password" size="20" name="password" id="password" value="<?=set_value('password')?>" >
						</span>
					</p>
					<p class="colx3-right">
						<label for="complex-en-url">Confirm Password (*) :</label>
						<span class="relative">
							<input type="password" size="20" name="confpassword" id="confpassword" >
						</span>
					</p>
			</div>
			<div class="columns">
				<p class="colx2-left">
						<label for="complex-en-url">Level (*) :</label>
						<span class="relative">
							<select name="level_id" id="level_id"class="duapertiga-width">
							<?php
								$query = $this->db->get('users_level');
								if($query->num_rows() > 0)
								{
									foreach($query->result() as $row)
									{
										echo '<option value="'.$row->level_id.'">'.$row->nama.'</option>';
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