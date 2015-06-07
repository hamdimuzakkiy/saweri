<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/users_level'?>';
	}
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('users_level/process_update', $attributes);
		?>
			<h1>Maintenance > Edit Level User</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode :</label>
						<span class="relative">
							<?php 
								if (form_error('level_id') != null)
								{
									echo '<input type="text" name="level_id" id="level_id" value="'.set_value('level_id').'" class="duapertiga-width">';
									echo form_error('level_id');
								}else
								{
									echo '<input type="text" name="level_id" id="level_id" value="'.$level_id.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>
				</div>
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Nama Level :</label>
						<span class="relative">
							<?php 
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
									$result = $this->users_level->getItemById($level_id);
									$fields = $this->db->field_data('users_level');
									$row = $result->row_array();
									
									foreach($fields as $field){
										if (($field->name != 'level_id') && ($field->name != 'nama'))
										{
											$field_level = $row[$field->name];
											$level = str_split($field_level);
								?>
											<tr>
												<td><?=str_replace('_', ' ', strtoupper($field->name))?></td>

												<td>
													<?php
														if (isset($level[0]))
														{
															if ($level[0] == '1')															
																$tanda = true;
															
															else
																$tanda = false;
														}
														else
														{
															$tanda = false;
														}
														if ($tanda)
														{
													?>
													<input name="level[<?=$field->name?>][0]" type="checkbox" checked='checked' value="1" />
													<?php 

														} 
														else
														{
													?>
													<input name="level[<?=$field->name?>][0]" type="checkbox"  value="1" />
													<?php } ?>
												</td>


												<td>
													<?php
														if (isset($level[1]))
														{
															if ($level[1] == '1')															
																$tanda = true;
															
															else
																$tanda = false;
														}
														else
														{
															$tanda = false;
														}
														if ($tanda)
														{
													?>
													<input name="level[<?=$field->name?>][1]" type="checkbox" checked='checked' value="1" />
													<?php 

														} 
														else
														{
													?>
													<input name="level[<?=$field->name?>][1]" type="checkbox"  value="1" />
													<?php } ?>
												</td>

												<td>
													<?php
														if (isset($level[2]))
														{
															if ($level[2] == '1')															
																$tanda = true;
															
															else
																$tanda = false;
														}
														else
														{
															$tanda = false;
														}
														if ($tanda)
														{
													?>
													<input name="level[<?=$field->name?>][2]" type="checkbox" checked='checked' value="1" />
													<?php 

														} 
														else
														{
													?>
													<input name="level[<?=$field->name?>][2]" type="checkbox"  value="1" />
													<?php } ?>
												</td>

												<td>
													<?php
														if (isset($level[3]))
														{
															if ($level[3] == '1')															
																$tanda = true;
															
															else
																$tanda = false;
														}
														else
														{
															$tanda = false;
														}
														if ($tanda)
														{
													?>
													<input name="level[<?=$field->name?>][3]" type="checkbox" checked='checked' value="1" />
													<?php 

														} 
														else
														{
													?>
													<input name="level[<?=$field->name?>][2]" type="checkbox"  value="1" />
													<?php } ?>
												</td>

												
												<td>
													<?php
														if (isset($level[4]))
														{
															if ($level[4] == '1')															
																$tanda = true;
															
															else
																$tanda = false;
														}
														else
														{
															$tanda = false;
														}
														if ($tanda)
														{
													?>
													<input name="level[<?=$field->name?>][4]" type="checkbox" checked='checked' value="1" />
													<?php 

														} 
														else
														{
													?>
													<input name="level[<?=$field->name?>][4]" type="checkbox"  value="1" />
													<?php } ?>
												</td>
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