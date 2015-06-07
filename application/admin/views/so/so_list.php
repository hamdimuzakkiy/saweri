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
			<h1>Penjualan > Data SO</h1>
			
			<div class="block-controls">
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<!--<th align="left" valign="top" scope="col">&nbsp;</th>-->
						<th align="left" valign="top" scope="col">SO No</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Pelanggan</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_cabang?>" type="checkbox" /></td>-->
						<td align="left" valign="top"><?=$row->so_no?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_pelanggan?> </td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				<li>&nbsp</li>
			</ul>
			

				
		</form>
	</div>
</section>