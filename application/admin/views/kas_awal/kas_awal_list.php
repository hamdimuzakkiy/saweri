<script type="text/javascript">
	$(document).ready(function() {		
	$("#getkas").fancybox();	});	function CA(){
	var cIdx = 'VAR_AKUN';		/* alert(counterIdx);		*/
	var cControl = 'control';				
	for (var i=0;i < document.kas_awal.elements.length;i++)		
	{			var e = document.kas_awal.elements[i];			
	if ((e.id == cIdx) && (e.id != cControl) && (e.type=='checkbox'))		
	{				e.checked = document.getElementById(cControl).checked;	
	}		}	}		
	function get_kas(){	
		document.location.href = '<?=base_url().'index.php/kas_awal'?>';	}		
	function batal(){		document.location.href = '<?=base_url().'index.php/kas_awal/show_kas'?>';	}		
	</script><section class="grid_12">	
	<div class="block-border">		
	<?php			
		$attributes = array('name' => 'kas_awal', 'id' => 'kas_awal', 'class'=>'block-content form', 'type'=>'post');		
		/*echo form_open('posting_piutang/posting/', $attributes);			*/
		echo form_open('kas_awal/insert/', $attributes);		
	?>	
		<h1>Kas Dan Bank > Kas Awal</h1>						<div class="block-controls">				<ul class="controls-buttons">		
		<?php echo $this->pagination->create_links(); ?>				
		</ul>			</div>			<div class="columns">				
		<!--<input onclick="javascript:get_kas();" type="submit" name="get_kas" id="get_kas" value="Lihat Kas" /> -->			
		<button id="getkas" href="<?=base_url().'index.php/kas_awal/show_kas'?>" type="button">
		<img src="<?=base_url()?>asset/admin/images/icons/view-icone16.png" width="16" height="16">View Kas</button>			
		<!--<a id="getkas" href="<?/*=base_url().'index.php/kas_awal/show_kas'*/?>">Lihat Kas</a> -->		
		<div class="columns">						 			
		</div>			
		</fieldset>			</div>			
		<fieldset class="grey-bg margin">			
		<div class="columns">							
		<p class="colx2-left">								
		<label for="complex-en-url">Tanggal :</label>								
		<span class="relative">									
		<?php										
		$bulan = $this->fungsi->bulan2(1);									?>								
		<input type="text" name="tanggal_kas_awal" readonly="true" id="tanggal_kas_awal" value="<?='1 ' . $bulan;?>">	
		</span>							</p>													
		<p class="colx2-right">						
		<label for="complex-en-url">Tahun :</label>			
		<span class="relative">									
		<select name="tahun_kas_awal" id="tahun_kas_awal" onchange="tahun_kas_awal">																				<?php 											$tahun_now=date('Y');											$view_tahun=$tahun_now-1;											echo "<option value='" . $view_tahun . "'>" . $view_tahun . "</option>"; 																						
		echo "<option value='" . $tahun_now . "' selected='selected'>" . $tahun_now . "</option>";		
		$view_tahun=$tahun_now+1;										
		echo "<option value='" . $view_tahun . "'>" . $view_tahun . "</option>"; 	
		?>																			
		</select>								
		</span>							</p>						</div>			</fieldset>		
		<div class="no-margin">						<table class="table" cellspacing="0" width="100%">		
		<thead>																<tr>						
		<th align="left" valign="top" scope="col"><input type="checkbox" id="control" onclick="CA(0)"/></th>	
		<th align="left" valign="top" scope="col">Akunid</th>					
		<th align="left" valign="top" scope="col">Nama Akun</th>						
		<th align="left" valign="top" scope="col">Nominal Awal</th>					</tr>	
		</thead>								<tbody>					
		<?php													
		for($i=0;$i<count($AKUNID);$i++){							
		echo '<tr>';									echo "<td>";			
		/*if ($id[$i]!=null){									*/
		/*echo "<input type='checkbox' id='id' name='id[]' value='$id[$i]'/>";	*/
		echo "<input type='checkbox' id='VAR_AKUN' name='VAR_AKUN[$i][AKUNID]' value='$AKUNID[$i]'/>";		
		/*}							*/
		echo"</td>				
		<td align='left'>&nbsp;$AKUNID[$i]</td>		
		<input type='hidden' value='$NAKUN[$i]' id='NAKUN'  name='VAR_AKUN[$i][NAKUN]' />							
		<td align='left'>&nbsp;". $NAKUN[$i] ."<input type='hidden' value='$NAKUN[$i]' id='NAKUN'  name='VAR_AKUN[$i][NAKUN]' /></td>	
		<td><input type='text' name='VAR_AKUN[$i][NOMINAL]' value=''></td>								
		</tr>";									}														?>		
		<?php 
			/* foreach($results->result() as $row) {?>						<?php $i=0; ?>			
		<tr>						<td align="left" valign="top"><input type="checkbox" id='siswa_id' name='siswa_id[]' value="" /></td>	
		<td align="left" valign="top"><?=anchor('pembelian/view/'.$row->id_pembelian, $row->id, array('class'=>'with-tip view','id'=>'view'))?> </td>	
		<td align="left" valign="top"><?=$row->GLID?> </td>						<td align="left" valign="top"><?=$row->TANGGAL?> </td>			
		<td align="left" valign="top"><?=$row->JUMLAH?> </td>								<input type="text" value="<?=$row->TANGGAL[$i]?>">		
		</tr>					<?php } */ ?>			</tbody>			</table>				</div>								
		<ul class="message no-margin">				&nbsp;<!--<li>Results x - y out of z</li>-->			</ul>			<div class="block-footer">	
		</div>				<div  class="tabs-content">					
		<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Posting</button>		
			
	<button type="button" onclick="javascript:batal();" class="red">Batal</button>				
	</div>		</form>	</div></section>