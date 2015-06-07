<section class="grid_12">
	<div class="block-border">
		<form class="block-content form"  name="table_form" id="table_form" method="post" action="">
			<h1>Kas dan Bank > Mutasi Kas</h1>
			
			<div class="block-controls">								<ul class="controls-buttons">					<?php echo $this->pagination->create_links(); ?>					<li class="sep"></li>					<li><?							if ($can_insert == TRUE){								echo anchor('mutasi_kas/insert', 'Tambah Data');							}						?></li>				</ul>							</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">No</th>
						<th align="left" valign="top" scope="col">Glid</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Akunid</th>
						<th align="left" valign="top" scope="col">Debet (Rp)</th>
						<th align="left" valign="top" scope="col">Kredit (Rp)</th>
						
						<!--<th align="left" valign="top" scope="col">Saldo</th>-->
					</tr>
				</thead>
				
				<tbody>
					
					<?php $i=0;
					foreach($results->result() as $row) { $i++;?>
					<tr>
						<td align="left" valign="top"><?=$i?> </td>
						<td align="left" valign="top"><?=$row->GLID_PARENT?> </td>
						<td align="left" valign="top"><?=convert_date_mysql_indo($row->TANGGAL);?> </td>
						<td align="left" valign="top"><?=$row->AKUNID?> </td>
						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->DEBET)?> </td>
						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->KREDIT)?> </td>					
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