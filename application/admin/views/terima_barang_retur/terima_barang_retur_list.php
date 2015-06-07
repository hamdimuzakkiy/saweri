<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Pembelian > Data Terima Retur Pembelian</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('retur_pembelian/insert', 'Tambah Data');
							}
						?></li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">PO No</th>
						<th align="left" valign="top" scope="col">Kode Supplier</th>
						<th align="left" valign="top" scope="col">SN</th>
						<th align="left" valign="top" scope="col">Nama Supplier</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Nama Barang</th>
						<th align="left" valign="top" scope="col">QTY</th>						
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->id_retur_penerimaan?> </td>
						<td align="left" valign="top"><?=$row->kode_supplier?> </td>
						<td align="left" valign="top"><?=$row->sn?> </td>
						<td align="left" valign="top"><?=$row->nama_supplier?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_barang?> </td>
						<td align="left" valign="top"><?=$row->qty?> </td>								
						<td align="left" valign="top" class="table-actions">
							<?php
								// if ($can_update == TRUE){
									// echo anchor('retur_pembelian/update/'.$row->id_retur_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								// }
								
								if ($can_delete == TRUE){
									echo anchor('retur_pembelian/delete/'.$row->id_retur_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
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

				<?=anchor('terima_barang_retur/insert', 'Tambah Data', array('class'=>'button'))?>

			</div>
				
		</form>
	</div>
</section>