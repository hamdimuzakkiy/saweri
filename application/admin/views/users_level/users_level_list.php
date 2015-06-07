<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Maintenance > Data Level User</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><? 
							if ($can_insert == TRUE){
								echo anchor('users_level/insert', 'Tambah Data');
							}
						?>
					</li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">level ID</th>
						<th align="left" valign="top" scope="col">nama</th>
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$row->level_id?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('users_level/update/'.$row->level_id, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									 echo anchor('users_level/delete/'.$row->level_id, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				<li>&nbsp;</li>
			</ul>
			
			<div class="block-footer">
				<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<?=anchor('users_level/insert', 'Tambah Data', array('class'=>'button'))?>
			</div>
				
		</form>
	</div>
</section>