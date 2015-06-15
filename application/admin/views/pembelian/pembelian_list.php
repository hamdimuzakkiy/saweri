<script type="text/javascript">
	
	
	$(document).ready(function() {
		$(".view").fancybox();
	});



	function laporan(id){
			
			var w = 1000;
			
			var h = 800;
			var title = 'name';
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);

			window.open ('<?=site_url();?>/pembelian/view_lap_pembelian/'+id, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		}
	
</script>
<style type="text/css">
	#mouse{
		cursor: pointer;
	}
</style>

<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" id="table_form" method="post" action="">
			<h1>Pembelian > Data Pembelian</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li><?
							if ($can_insert == TRUE){
								echo anchor('pembelian/insert', 'Tambah Data');
							}
						?></li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<th align="left" valign="top" scope="col">PO No</th>
						<th align="left" valign="top" scope="col">Tanggal</th>
						<th align="left" valign="top" scope="col">Supplier</th>
						<th align="left" valign="top" scope="col">Cabang</th>
						<th align="left" valign="top" scope="col">Total</th>
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<td align="left" valign="top"><?=anchor('pembelian/view/'.$row->id_pembelian, $row->po_no, array('class'=>'with-tip view','id'=>'view'))?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_supplier?> </td>
						<td align="left" valign="top"><?=$row->nama_cabang?> </td>
						<td align="left" valign="top"><?php echo convert_rupiah($row->total); ?> </td>
						<td align="left" valign="top" class="table-actions">
							<?php

								if ($can_view == TRUE){
									//echo anchor('request_order/view/'.$row->id_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/application-blog.png" width="16" height="16">', array('class'=>'with-tip view'));
									echo '<span id = "mouse"><img  onclick="laporan('.$row->id_pembelian.')" src="'.base_url().'asset/admin/images/icons/fugue/application-blog.png" width="16" height="16"></span>';
									
								}

								/*if ($can_update == TRUE){
									echo anchor('pembelian/update/'.$row->id_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}*/
								
								if ($can_delete == TRUE){
									echo anchor('pembelian/delete/'.$row->id_pembelian, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
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
				
				<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button">Select All</a> 
				<a href="javascript:void(0)" class="button">Unselect All</a>
				<span class="sep"></span>
				<?=anchor('pembelian/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<select name="table-action" id="table-action" class="small">
					<option value="">Action for selected...</option>
					<option value="validate">Validate</option>
					<option value="delete">Delete</option>
				</select>
				<button type="submit" class="small">Ok</button>
			</div>
				
		</form>
	</div>
</section>

