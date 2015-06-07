<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/users'?>';
	}
	
</script>

<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('users/process_update', $attributes);
		?>
			<h1>Edit Data User</h1>
			
			<fieldset class="grey-bg">
				
				
		<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Username :</label>
						<input type="hidden" name="userid" value="<?=$userid?>">
						<span class="relative">
							<? 
								if (form_error('username') != null)
								{
									echo '<input type="text" name="username" id="username" value="'.set_value('username').'" class="duapertiga-width">';
									echo form_error('username');
								}else
								{
									echo '<input type="text" name="username" id="username" value="'.$username.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Password :</label>
						<span class="relative">
							<? 
								if (form_error('password') != null)
								{
									echo '<input type="password" name="password" id="password" value="'.set_value('password').'" class="duapertiga-width">';
									echo form_error('password');
								}else
								{
									echo '<input type="password" name="password" id="password" value="'.$password.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama :</label>
						<span class="relative">
							<? 
								if (form_error('nama') != null)
								{
									echo '<input type="text" name="nama" id="nama" value="'.set_value('nama').'" class="duapertiga-width">';
									echo form_error('nama');
								}else
								{
									echo '<input type="text" name="nama" id="nama" value="'.$nama.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Level :</label>
						<span class="relative">
							<select name="level_id" id="level_id" class="duapertiga-width">
								<?php
									$query = $this->db->get('users_level');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($level_id == $row->level_id){
												echo '<option value="'.$row->level_id.'" selected="selected">'.$row->nama.'</option>';
											}else{
												echo '<option value="'.$row->level_id.'" >'.$row->nama.'</option>';
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
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang" class="duapertiga-width">
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($id_cabang == $row->id_cabang){
												echo '<option value="'.$row->id_cabang.'" selected="selected">'.$row->nama_cabang.'</option>';
											}else{
												echo '<option value="'.$row->id_cabang.'" >'.$row->nama_cabang.'</option>';
											}
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