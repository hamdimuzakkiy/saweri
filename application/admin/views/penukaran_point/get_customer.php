<script type="text/javascript">
	
	function set_customer(tipe, id, nama, point, expired){
		document.getElementById('input_tipe').value = tipe;
		document.getElementById('input_id').value = id;
		document.getElementById('input_customer').value = nama;
		document.getElementById('input_expired').value = expired;
		document.getElementById('input_point').value = point;
		
		document.getElementById('div_customer').innerHTML = nama;
		document.getElementById('div_expired').innerHTML = expired;
		document.getElementById('div_point').innerHTML = point;
		
		$.fancybox.close();
		$('.itembarang').attr('checked', false);
		$('.itembarang').attr('disabled', false);
		$('.itemqty').hide(); 
		$('.itemqty').val("0"); 
		/*$('.itemqty').get(0).setAttribute('type', 'hidden'); //tidak berfungsi */
		
		/*var inputs = document.getElementsByTagName('input');
		alert(inputs.length);
		
		for (var i = 0; i < inputs.length; i++) {
			
			document.getElementById('detail_qty'+i).type = 'hidden';
			
			
		} */
		
	}
	
</script>

<table width="666" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<th width="305" bgcolor="#D4DFFF" scope="col">Nama <?=$tipe?></th>
		<th width="158" bgcolor="#D4DFFF" scope="col">Point</th>
		<th width="158" bgcolor="#D4DFFF" scope="col">Membership Expired</th>
	</tr>
	
	<?php
		foreach($result->result() as $row)
		{
			if($tipe == 'pelanggan'){
				$expired = $row->expired;
				$id = $row->id_pelanggan;
			}else{
				$expired = date('Y-m-d');
				$id = $row->id_karyawan;
			}
			
	?>
			<tr>
				<td align="left" valign="middle"><a href="javascript:set_customer('<?=$tipe?>','<?=$id?>','<?=$row->nama?>','<?=$row->point?>','<?=$expired?>')"><?=$row->nama?></a></td>
				<td align="left" valign="middle"><?=$row->point?></td>
				<td align="left" valign="middle"><?=$expired?></td>
			</tr>
	<?php
		}
	?>
</table>