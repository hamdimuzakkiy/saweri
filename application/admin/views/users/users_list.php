<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Data User</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('users/insert', 'Tambah Data');
							}
					?></li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">User Name</th>
						<th align="left" valign="top" scope="col">Nama Pengguna</th>
						<th align="left" valign="top" scope="col">Level</th>
						<th align="left" valign="top" scope="col">Cabang</th>
		
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->username?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->level?> </td>
						<td align="left" valign="top"><?=$row->nama_cabang?> </td>
		
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('users/update/'.$row->userid, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									echo anchor('users/delete/'.$row->userid, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
			</ul>
			
			<div class="block-footer">
				<?=anchor('users/insert', 'Tambah Data', array('class'=>'button'))?>
			</div>
				
		</form>
	</div>
</section>