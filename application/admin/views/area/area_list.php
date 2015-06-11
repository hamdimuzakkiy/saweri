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

<section class="grid_8">
	<div class="block-border">
		<form class="block-content form" name="table_form" id="table_form" method="post" action="">
			<h1>Setup > Data Area / Wilayah</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li>
						<?
							if ($can_insert == TRUE){
								echo anchor('area/insert', 'Tambah Data');
							}
						?>
					</li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<!--<th align="left" valign="top" scope="col">&nbsp;</th>-->
                                                <th align="center" valign="top" scope="col">Kabupaten</th>
                                                <th align="center" valign="top" scope="col">Kecamatan</th>
						<th align="center" valign="top" scope="col">Area </th>
						<th align="center" valign="top" scope="col">Jumlah Pelanggan </th>
						<th align="center" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_area?>" type="checkbox" /></td>-->
						<td align="center" valign="top"><?=$row->kabupaten?> </td>
                                                <td align="center" valign="top"><?=$row->kecamatan?> </td>												
						<td align="center" valign="top"><?=$row->area?> </td>
						<td align="center" valign="top"><?=$row->jumlah_pelanggan?> </td>
		
						<td align="center" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('area/update/'.$row->id_area, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit')).'&nbsp;&nbsp;';
								}
								
								if ($can_delete == TRUE){
									 echo anchor('area/delete/'.$row->id_area, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				&nbsp;
				<!--<li>Results x - y out of z</li>-->
			</ul>
			
			<div class="block-footer">
				&nbsp;
				
				<!--<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button" onClick="check_all(0)" >Select All</a> 
				<a href="javascript:void(0)" class="button" onClick="uncheck_all(0)" >Unselect All</a>-->
				<span class="sep"></span>
				<?=anchor('area/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<!--<select name="table-action" id="table-action" class="small">
					<option value="">Aksi</option>
					<option value="validate">Validasi</option>
					<option value="delete">Hapus</option>
				</select>
				<button type="submit" class="small">Ok</button>-->
				
			</div>
				
		</form>
	</div>
</section>