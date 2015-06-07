<script type="text/javascript" >
		function check_all()
		{
			var cIdx = 'id'; //manggil id chekbok	
			for (var i=0;i < document.table_form.elements.length;i++)
			{
				var e = document.table_form.elements[i];
				if ((e.id == 'id') && (e.type=='checkbox'))
				{
					e.checked = 'checked';
				}
			}
		}
		
		function uncheck_all()
		{
			var cIdx = 'id'; //manggil id chekbok	
			for (var i=0;i < document.table_form.elements.length;i++)
			{
				var e = document.table_form.elements[i];
				if ((e.id == 'id') && (e.type=='checkbox'))
				{
					e.checked = '';
				}
			}
		}
		
</script>

<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" name="table_form" id="table_form" method="post" action="">
			<h1>Pembelian > Data PO</h1>
			
			<div class="block-controls">
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">PO No</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Supplier</th>
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->po_no?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_supplier?> </td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				<li>&nbsp;</li>
			</ul>
			
			<div class="block-footer">
				
				<!--img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button" onClick="check_all(0)" >Select All</a> 
				<a href="javascript:void(0)" class="button" onClick="uncheck_all(0)" >Unselect All</a>
				<span class="sep"></span>
				<?=anchor('po_list/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<select name="table-action" id="table-action" class="small">
					<option value="">Action for selected...</option>
					<option value="validate">Validate</option>
					<option value="delete">Delete</option>
				</select>
				<button type="submit" class="small">Ok</button-->
			</div>
				
		</form>
	</div>
</section>