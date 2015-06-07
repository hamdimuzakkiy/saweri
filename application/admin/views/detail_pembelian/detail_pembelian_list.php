<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Data Detail Pembelian</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('detail_pembelian/insert', 'Tambah Data');
							}
						?></li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">ID Detail Pembelian</th>
						<th align="left" valign="top" scope="col">ID Pembelian</th>
						<th align="left" valign="top" scope="col">ID Barang</th>
						<th align="left" valign="top" scope="col">Harga</th>
						<th align="left" valign="top" scope="col">QTY</th>
						<th align="left" valign="top" scope="col">Total</th>
		
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->id_detail_pembelian?> </td>
						<td align="left" valign="top"><?=$row->id_pembelian?> </td>
						<td align="left" valign="top"><?=$row->id_barang?> </td>
						<td align="left" valign="top"><?=$row->harga?> </td>
						<td align="left" valign="top"><?=$row->qty?> </td>
						<td align="left" valign="top"><?=$row->total?> </td>
		
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('detail_pembelian/update/'.$row->id_detail_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									echo anchor('detail_pembelian/delete/'.$row->id_detail_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				&nbsp;<!--<li>Results x - y out of z</li>-->
			</ul>
			
			<div class="block-footer">
				
				<!--<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button">Select All</a> 
				<a href="javascript:void(0)" class="button">Unselect All</a>
				<span class="sep"></span>
				<?=anchor('detail_pembelian/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<select name="table-action" id="table-action" class="small">
					<option value="">Action for selected...</option>
					<option value="validate">Validate</option>
					<option value="delete">Delete</option>
				</select>
				<button type="submit" class="small">Ok</button>-->
			</div>
				
		</form>
	</div>
</section>