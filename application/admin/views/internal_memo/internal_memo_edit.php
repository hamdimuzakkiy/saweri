
<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/internal_memo'?>';
	}
	function klick_tanggal(){	
		var tanggal = document.getElementById("tanggal");		
		tanggal.focus();	
	}		
		$(function(){
			$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });	
			//$("#tanggal").DateTimePicker();
			})
	
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
			echo form_open('internal_memo/process_update', $attributes);
		?>
			<h1>Master > Edit Data internal_memo</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Kode internal_memo :</label>
						<input type="hidden" name="id_internal_memo"  value="<?=$id_internal_memo?>">
						<span class="relative">
							<?php
								if (form_error('id_internal_memo') != null)
								{
									echo '<input type="text" name="id_internal_memo" id="id_internal_memo" readOnly="true" value="'.set_value('id_internal_memo').'" class="duapertiga-width">';
								}else
								{
									echo '<input type="text" name="id_internal_memo" id="id_internal_memo" readOnly="true" value="'.$id_internal_memo.'" class="duapertiga-width">';
								}
							?>
						</span>
					</p>										
					
					<p class="colx2-left">						
					<label for="complex-en-url">Tanggal (*) :</label>						
						<span class="relative">							
						<span class="input-type-text margin-right relative">	
						<?php 								
							if (form_error('nama') != null){									
								echo '<input type="tanggal" name="tanggal" id="tanggal" class="datepicker" value="'.set_value('tanggal').'">';								
							}else{
								echo '<input type="text" name="tanggal" id="tanggal" value="'.$tanggal.'" class="datepicker" >';								
							}							
						?>								
							<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">							
							</span>								
							</span>					
							</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Memo :</label>
						<span class="relative">
							<?php 
								if (form_error('memo') != null)
								{									
									echo '<textarea name="memo" id="memo" class="setengah-width">"'.set_value('memo').'"</textarea>';
								}else
								{									
									echo '<textarea name="memo" id="memo" class="setengah-width">"'.$memo.'"</textarea>';
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