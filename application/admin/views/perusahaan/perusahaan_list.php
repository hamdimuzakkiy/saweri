<script type="text/javascript" >
		function check_all()
		{
			var cIdx = 'id'; //manggil id chekbok	
			for (var i=0;i < document.table_form.elements.length;i++)
			{
				var e = document.table_form.elements[i];
				if ((e.id == 'id') && (e.type=='checkbox'))
				{
					e.checked = 'checked';
				}
			}
		}
		
		function uncheck_all()
		{
			var cIdx = 'id'; //manggil id chekbok	
			for (var i=0;i < document.table_form.elements.length;i++)
			{
				var e = document.table_form.elements[i];
				if ((e.id == 'id') && (e.type=='checkbox'))
				{
					e.checked = '';
				}
			}
		}
		
		function laporan(title, w, h){
			//var periode_awal=document.getElementById('tanggal_awal').value;
			//var periode_akhir=document.getElementById('tanggal_akhir').value;
			
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			
			myForm = document.getElementById('table_form');
			// open a *BLANK* WINDOW!!!!
			newWin= window.open("", title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left) ;

			// save form info:
			var saveTarget = myForm.target;
			var saveAction = myForm.action;
			var saveMethod = myForm.method; // not needed if already post

			// change form info:
			myForm.target = title;
			myForm.action = "<?=site_url();?>/karyawan/prepare_report_excel";
			myForm.method = "post"; // not needed if <form> was already post
			myForm.submit( );  // invoke the form, submitting to the popup window

			// restore form:
			myForm.target = saveTarget;
			myForm.action = saveAction;
			myForm.method = saveMethod; // if used

			//return true ; // why does this matter? ordinary buttons ignore return value

	}	
</script>
<?php echo $row = $this->session->userdata('userlevel'); ?>
<section class="grid_12">
	<div class="block-border">
		<form class="block-content form" name="table_form" id="table_form" method="post" action="">
			<h1>Setup > Data Karyawan</h1>
			
			<div class="block-controls">
				
				<ul class="controls-buttons">
					<?php echo $this->pagination->create_links(); ?>
					<li class="sep"></li>
					<li>
						<?
							if ($can_insert == TRUE){
								echo anchor('karyawan/insert', 'Tambah Data');
							}
						?>
					</li>
					<li>
						<a href="javascript:laporan('name',1000,800);"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">&nbsp;&nbsp;Print Preview</a>
					</li>
				</ul>
				
			</div>
		
			<div class="no-margin"><table class="table" cellspacing="0" width="100%">
			
				<thead>
					<tr>
						<!--<th align="left" valign="top" scope="col">&nbsp;</th>-->
						<th align="left" valign="top" scope="col">Cabang</th>
						<th align="left" valign="top" scope="col">Kode Karyawan</th>
						<th align="left" valign="top" scope="col">Nama</th>
						<th align="left" valign="top" scope="col">Alamat</th>
						<th align="left" valign="top" scope="col">Telepon</th>
						<th align="left" valign="top" scope="col">Jenis Pengenal</th>
						<th align="left" valign="top" scope="col">No Pengenal</th>
						<th align="left" valign="top" scope="col">Status Karyawan</th>
						<th align="left" valign="top" scope="col">Point</th>
						<th align="left" valign="top" scope="col">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php foreach($results->result() as $row){?>
					<tr>
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_karyawan?>" type="checkbox" /></td>-->
						<td align="left" valign="top"><?=$row->nama_cabang?> </td>
						<td align="left" valign="top"><?=$row->kode_karyawan?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->alamat?> </td>
						<td align="left" valign="top"><?=$row->telp1?> </td>
						<td align="left" valign="top"><?=$row->jenis_pengenal?> </td>
						<td align="left" valign="top"><?=$row->no_pengenal?> </td>
						<td align="left" valign="top"><?=$row->status?> </td>
						<td align="left" valign="top"><?=$row->point?> </td>
		
						<td align="left" valign="top" class="table-actions">
							<?php
								if ($can_update == TRUE){
									echo anchor('karyawan/update/'.$row->id_karyawan, '<img src="'.base_url().'asset/admin/images/icons/fugue/pencil.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit'));
								}
								
								if ($can_delete == TRUE){
									echo anchor('karyawan/delete/'.$row->id_karyawan.'/'.$row->userid, '<img src="'.base_url().'asset/admin/images/icons/fugue/cross-circle.png" width="16" height="16">', array('class'=>'with-tip', 'title'=>'Edit', 'onclick'=>"return confirm('Anda yakin akan menghapus data ini?')"));
								}
							?>
						</td>
					</tr>

					<?php
				} ?>
					
				</tbody>
			
			</table></div>
			
			<ul class="message no-margin">
				&nbsp;<!--<li>Results x - y out of z</li>-->
			</ul>
			
			<div class="block-footer">
				
				<!--<img src="images/icons/fugue/arrow-curve-000-left.png" width="16" height="16" class="picto"> 
				<a href="javascript:void(0)" class="button" onClick="check_all(0)" >Select All</a> 
				<a href="javascript:void(0)" class="button" onClick="uncheck_all(0)" >Unselect All</a>-->
				<span class="sep"></span>
				<?=anchor('karyawan/insert', 'Tambah Data', array('class'=>'button'))?>
				<span class="sep"></span>
				<!--<select name="table-action" id="table-action" class="small">
					<option value="">Aksi</option>
					<option value="validate">Validasi</option>
					<option value="delete">Hapus</option>
				</select>
				<button type="submit" class="small">Ok</button>-->
			</div>
				
		</form>
	</div>
</section>