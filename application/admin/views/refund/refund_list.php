<section class="grid_12">
	<div class="block-border">
		<form class="block-content form"  name="table_form" id="table_form" method="post" action="">
			<h1>Kas dan Bank > Refund</h1>
			
			<div class="block-controls">								<ul class="controls-buttons">					<?php echo $this->pagination->create_links(); ?>				</ul>							</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">No</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Penjual</th>
						<th align="left" valign="top" scope="col">Pembeli</th>
						<th align="left" valign="top" scope="col">Glid</th>						
						<th align="left" valign="top" scope="col">Aksi</th>						
					</tr>
				</thead>
				
				<tbody>
					
					<?php 
						$i=1;
					foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=$i?></td>
						<td align="left" valign="top"><?=$row->TANGGAL?> </td>
						<td align="left" valign="top"><?=$row->nama_supplier?></td>
						<td align="left" valign="top"><?=$row->nama_pelanggan?> </td>
						<td align="left" valign="top"><?=$row->GLID?></td>
						<td align="left" valign="top" class="table-actions">
						<?php
							if ($can_update == TRUE){

								echo anchor('refund/koreksi/'.$row->GLID, 'Koreksi', array('class'=>'with-tip', 'title'=>'Koreksi'));

							}
						?>
						</td>
					</tr>
					<?php 
						$i++;
					} ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				<li>&nbsp;</li>
			</ul>
				
		</form>
	</div>
</section>