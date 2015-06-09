<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Pembelian > Data Retur Pembelian</h1>
			
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
						<th align="left" valign="top" scope="col">Pembayaran</th>
						<th align="left" valign="top" scope="col">Beban</th>						
						<th align="left" valign="top" scope="col">Aksi</th>						
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->pembayaran?> </td>
						<td align="left" valign="top"><?=$row->beban?> </td>						
						<td align="left" valign="top" class="table-actions">
							<?php
								 if ($can_update == TRUE){
									 echo anchor('beban_transaksi/update/'.$row->id, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								 }
								
								if ($can_delete == TRUE){
									echo anchor('beban_transaksi/delete/'.$row->id, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
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

				<?=anchor('retur_pembelian/insert', 'Tambah Data', array('class'=>'button'))?>

			</div>
				
		</form>
	</div>
</section>