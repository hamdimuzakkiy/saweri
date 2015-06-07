<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Penjualan > Data Retur Penjualan</h1>
			
			<div class="block-controls">
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('retur_penjualan/insert', 'Tambah Data');
							}
						?></li>
				</ul>
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				<thead>
					<tr>
						
						<th align="left" valign="top" scope="col">SO No</th>
						<th align="left" valign="top" scope="col">Kode Pelanggan</th>
						<th align="left" valign="top" scope="col">SN</th>
						<th align="left" valign="top" scope="col">Nama Supplier</th>
						<th align="left" valign="top" scope="col">Nama Pelanggan</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Nama Barang</th>
						<th align="left" valign="top" scope="col">QTY</th>						
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>		
						<td align="left" valign="top"><?=$row->so_no?> </td>
						<td align="left" valign="top"><?=$row->kode_pelanggan?> </td>
						<td align="left" valign="top"><?=$row->sn?></td>
						<td align="left" valign="top"><?=$row->nama_supplier?></td>
						<td align="left" valign="top"><?=$row->nama_pelanggan?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_barang?> </td>
						<td align="left" valign="top"><?=$row->qty?> </td>						
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_delete == TRUE){
									echo anchor('retur_penjualan/delete/'.$row->id_retur_penjualan, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
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
				
				<<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button">Select All</a> 
				<a href="javascript:void(0)" class="button">Unselect All</a>
				<span class="sep"></span>
				<?=anchor('retur_penjualan/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<select name="table-action" id="table-action" class="small">
					<option value="">Action for selected...</option>
					<option value="validate">Validate</option>
					<option value="delete">Delete</option>
				</select>
				<button type="submit" class="small">Ok</button>>
			</div>
				
		</form>
	</div>
</section>