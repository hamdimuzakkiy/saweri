<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/internal_memo'?>';
	}
	function klick_tanggal(){		
		var tanggal = document.getElementById("tanggal");		tanggal.focus();	
		}		
		$(function(){
			$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });	
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
			echo form_open('internal_memo/insert', $attributes);
		?>
			<h1>Master > Tambah Data Memo</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal (*) :</label>						<span class="relative">							<span class="input-type-text margin-right relative">								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">							</span>						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Memo :</label>
						<span class="relative">
							<textarea name="memo" id="memo" class="setengah-width"></textarea>
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