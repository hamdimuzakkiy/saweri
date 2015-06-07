<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Layanan > Data Layanan Jasa Listrik</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('layanan_jasa_listrik/insert', 'Tambah Data');
							}
						?></li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">Jenis Layanan</th>						
						<th align="left" valign="top" scope="col">Periode Awal</th>
						<th align="left" valign="top" scope="col">Periode Akhir</th>
						<th align="left" valign="top" scope="col">No Pelanggan</th>
						<th align="left" valign="top" scope="col">Nama</th>
						<th align="left" valign="top" scope="col">Alamat</th>
						<th align="left" valign="top" scope="col">Tagihan</th>
						<th align="left" valign="top" scope="col">Biaya Admin</th>
						<th align="left" valign="top" scope="col">Total Bayar</th>
						<!--<th align="left" valign="top" scope="col">Status</th>-->
		
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->jenis_layanan?> </td>
						<td align="left" valign="top"><?=$row->periode_start?> </td>
						<td align="left" valign="top"><?=$row->periode_end?> </td>
						<td align="left" valign="top"><?=$row->no_pelanggan?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->alamat?> </td>
						<td align="left" valign="top"><?=convert_rupiah($row->tagihan)?> </td>
						<td align="left" valign="top"><?=convert_rupiah($row->biaya_admin)?> </td>
						<td align="left" valign="top"><?=convert_rupiah($row->total_bayar)?> </td>
						<!--<td align="left" valign="top"><?//=$row->status?> </td>-->
		
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('layanan_jasa_listrik/update/'.$row->id_layanan_jasa, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									echo anchor('layanan_jasa_listrik/delete/'.$row->id_layanan_jasa, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
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
				<?=anchor('layanan_jasa_listrik/insert', 'Tambah Data', array('class'=>'button'))?>
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