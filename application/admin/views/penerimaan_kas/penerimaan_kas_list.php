<?php 
/* echo $this->pquery->form_remote_tag(array(	'name'=>'penerimaan_kas',	'id'=>'penerimaan_kas',	'url'=>site_url('penerimaan_kas/view_posting/'),	
'update'=>'#viewPosting',	'type'=>'post'))*/?>
<script type="text/javascript">	$(document).ready(function() {
		 $('#penerimaan_kas').submit(function() { 			$.ajax({		
		 type: 'POST',				url: "<?=base_url().'index.php/penerimaan_kas/view_posting/'?>",		
		 data: $('#penerimaan_kas').serialize(),				success: function(data) {			
		 $.fancybox(data, {'width' : 440,'height': 500					  });				}			});			return false;				}); 		
		 });	function CA(){		var cIdx = 'PO_NO';		
		 /* alert(counterIdx);		*/
		 var cControl = 'control';				
		 for (var i=0;i < document.penerimaan_kas.elements.length;i++)		
		 {			var e = document.penerimaan_kas.elements[i];			
		 if ((e.id == cIdx) && (e.id != cControl) && (e.type=='checkbox'))			
		 {				e.checked = document.getElementById(cControl).checked;						}
		 }	}		function push_akunid(count){		for (var j=0;j<=count;j++){			
		 var obj_select=document.getElementById("AKUNID"+j).value;			
		 var obj_out=document.getElementById("OUT_AKUNID"+j);			
		 obj_out.value=obj_select;		}	}	function batal(){	
		 document.location.href = '<?=base_url().'index.php/penerimaan_kas'?>';	}</script>
		 <div id="viewPosting_data"></div><section class="grid_12">	<div class="block-border">	
		 <!--<form class="block-content form" id="penerimaan_kas" method="post" name="penerimaan_kas" action="">-->	
		 <?php			$attributes = array('name' => 'penerimaan_kas', 'id' => 'penerimaan_kas', 'class'=>'block-content form', 'type'=>'post');	
		 /*echo form_open('penerimaan_kas/posting/', $attributes);		*/
		 echo form_open('penerimaan_kas/view_posting/', $attributes);		?>	
		 <h1>Kas Dan Bank > Penerimaan Kas</h1>				
		 <div class="block-controls">			
		 <ul class="controls-buttons">					<?php echo $this->pagination->create_links(); ?>					<li class="sep"></li>					<li><?						if ($can_insert == TRUE){							echo anchor('penerimaan_kas/insert', 'Tambah Data');						}					?></li>				</ul>			</div>			<div class="no-margin"><table class="table" cellspacing="0" width="100%">				<thead>					<tr>						<th align="left" valign="top" scope="col">Jurnal ID</th>						<th align="left" valign="top" scope="col">Akun Id</th>									<th align="left" valign="top" scope="col">Debet</th>										<th align="left" valign="top" scope="col">Kredit</th>										
		 <th align="left" valign="top" scope="col">Ket Transaksi</th>										</tr>				</thead>								<tbody>				<?php foreach($results->result() as $row) {?>					<tr>						<td align="left" valign="top"><?=$row->GLID_PARENT?> </td>						<td align="left" valign="top"><?=$row->AKUNID?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->DEBET);?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->KREDIT);?> </td>						<td align="left" valign="top"><?=$row->KETERANGAN?> </td>					</tr>					<?php } ?>				</tbody>			</table>				</div>							
		 <ul class="message no-margin">				&nbsp;<!--<li>Results x - y out of z</li>-->			</ul>			<div class="block-footer">				<!--<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 				<a href="javascript:void(0)" class="button">Select All</a> 				<a href="javascript:void(0)" class="button">Unselect All</a>				<span class="sep"></span>				<?=anchor('pembelian/insert', 'Tambah Data', array('class'=>'button'))?>				<span class="sep"></span>				<select name="table-action" id="table-action" class="small">					<option value="">Action for selected...</option>					<option value="validate">Validate</option>					<option value="delete">Delete</option>				</select>				<button type="submit" class="small">Ok</button>-->			</div>				<div  class="tabs-content">				
		 <button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Posting</button>					<button type="button" onclick="javascript:batal();" class="red">Batal</button>				</div>		</form>	</div></section>