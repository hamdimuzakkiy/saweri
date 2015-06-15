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
		<form class="block-content form"  name="table_form" id="table_form" method="post" action="">
			<h1>Master > Master Barang : Qty > Master Barang Point</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li>
						<?
							if ($can_insert == TRUE)
							{
								echo anchor('barang_point/insert', 'Tambah Data');
							}
						?>
					</li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<!--<th align="left" valign="top" scope="col">&nbsp;</th>-->
						<th align="left" valign="top" scope="col">Nama Barang</th>
						<th align="left" valign="top" scope="col">Jenis</th>
						<th align="left" valign="top" scope="col">Kategori</th>
						<th align="left" valign="top" scope="col">Satuan</th>
						<th align="left" valign="top" scope="col">Golongan</th>
						<th align="left" valign="top" scope="col">Jumlah Point</th>						
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($results->result() as $row) {?>
					
					<tr>
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_barang?>" type="checkbox" /></td>-->
						<td align="left" valign="top"><?=$row->nama_barang?> </td>
						<td align="left" valign="top"><?=$row->nama_jenis?> </td>
						<td align="left" valign="top"><?=$row->nama_kategori?> </td>
						<td align="left" valign="top"><?=$row->nama_satuan?> </td>
						<td align="left" valign="top"><?=$row->nama_golongan?> </td>
						<td align="left" valign="top"><?=$row->point_barangpoint?> </td>
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('barang_point/update/'.$row->id_barang, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									echo anchor('barang_point/delete/'.$row->id_barang, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>
					
					<?php } ?>	
				</tbody>
			
			</table>
			</div>
			
			<ul class="message no-margin">
				&nbsp;
				<!--<li>Results x - y out of z</li>-->
			</ul>
			
			<div class="block-footer">
				<!--<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button" onClick="check_all(0)" >Select All</a> 
				<a href="javascript:void(0)" class="button" onClick="uncheck_all(0)" >Unselect All</a>-->
				<span class="sep"></span>
				<?=anchor('barang_point/insert', 'Tambah Data', array('class'=>'button'))?>
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