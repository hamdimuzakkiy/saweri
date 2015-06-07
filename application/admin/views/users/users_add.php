<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/users'?>';
	}
	
</script>

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('users/insert', $attributes);
		?>
			<h1>Tambah Data User</h1>
			
			<fieldset class="grey-bg">
				
		<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">User Name :</label>
						<span class="relative">
							<input type="text" name="username" id="username" value="<?=set_value('username')?>" class="duapertiga-width">
							<?=form_error('username')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Password :</label>
						<span class="relative">
							<input type="password" name="password" id="password" value="<?=set_value('password')?>" class="duapertiga-width">
							<?=form_error('password')?>
						</span>
					</p>
				</div>
		<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Lengkap :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="duapertiga-width">
							<?=form_error('nama')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Level :</label>
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
				<div class="columns">
					<p class="colx2-left">
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
				</div>
		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	
			</div>
			
		</form>
	</div>
</section>