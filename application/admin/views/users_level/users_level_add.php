<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/users_level'?>';
	}
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('users_level/insert', $attributes);
		?>
			<h1>Maintenance > Tambah Level User</h1>
			
			<fieldset class="grey-bg">
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode :</label>
						<span class="relative">
							<input type="text" name="level_id" id="level_id" value="<?=set_value('level_id')?>" class="duapertiga-width">
							<?=form_error('level_id')?>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nama Level :</label>
						<span class="relative">
							<input type="text" name="nama" id="nama" value="<?=set_value('nama')?>" class="duapertiga-width">
							<?=form_error('nama')?>
						</span>
					</p>
				</div>
			</fieldset>
				
			<fieldset>
					<div class="no-margin">
						<table class="table" border="1" cellspacing="0" width="100%">
						
							<thead>
								<tr>
									<th scope="col">Form</th>
									<th scope="col">Akses</th>
									<th scope="col">View</th>
									<th scope="col">Insert</th>
									<th scope="col">Update</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							
							<tbody>
								<?php
									$fields = $this->db->field_data('users_level');
									
									foreach($fields as $field){
										if (($field->name != 'level_id') && ($field->name != 'nama'))
										{
								?>
											<tr>
												<td><?=str_replace('_', ' ', strtoupper($field->name))?></td>
												<td><input name="level[<?=$field->name?>][0]" type="checkbox" checked="checked" value="1" /></td>
												<td><input name="level[<?=$field->name?>][1]" type="checkbox" checked="checked" value="1" /></td>
												<td><input name="level[<?=$field->name?>][2]" type="checkbox" checked="checked" value="1" /></td>
												<td><input name="level[<?=$field->name?>][3]" type="checkbox" checked="checked" value="1" /></td>
												<td><input name="level[<?=$field->name?>][4]" type="checkbox" checked="checked" value="1" /></td>
											</tr>
								<?php 
										}
									}
								?>
							</tbody>
						</table>
					</div>
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	
			</div>	
			
		</form>
		
		
	</div>
	
</section>



