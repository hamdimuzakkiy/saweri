<section class="grid_12">
	<div class="block-border">
		<form class="block-content form"  name="table_form" id="table_form" method="post" action="">
			<h1>Piutang > Pembayaran Piutang</h1>
			
			<div class="block-controls">								<ul class="controls-buttons">					<?php echo $this->pagination->create_links(); ?>					<li class="sep"></li>					<li><?							if ($can_insert == TRUE){								echo anchor('pembayaran_piutang/insert', 'Tambah Data');							}						?></li>				</ul>							</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">Nama Barang</th>
						<th align="left" valign="top" scope="col">Jenis</th>
						<th align="left" valign="top" scope="col">Kategori</th>
						<!--<th align="left" valign="top" scope="col">Tanggal</th>-->
						<th align="left" valign="top" scope="col">Supplier</th>
						<th align="left" valign="top" scope="col">Debit</th>
						<th align="left" valign="top" scope="col">Kredit</th>
						<!--<th align="left" valign="top" scope="col">Saldo</th>-->
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->nama_barang?> </td>
						<td align="left" valign="top"><?=$row->jenis?> </td>
						<td align="left" valign="top"><?=$row->kategori?> </td>
						<!--<td align="left" valign="top"><?=$row->tanggal?> </td>-->
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->qty?> </td>
						<?php
							$q = $this->inventory->getItempenjualan($row->id_barang);
							$kredit=0;
							if($q->num_rows() > 0){
								$kredit= $q->row()->kredit;
							}
						?>
						<td align="left" valign="top"><?=$kredit?></td>
						<!--<td align="left" valign="top"> </td>-->
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				<li>&nbsp;</li>
			</ul>
				
		</form>
	</div>
</section>