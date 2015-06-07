<script type="text/javascript">
	
	function set_barang(akunid, nakun, jumlah, count){
		document.getElementById('detail_akunid').value = akunid;	
		document.getElementById('detail_nakun').value = nakun;
		document.getElementById('detail_jumlah').value = jumlah;		document.getElementById('detail_count').value = '1';
		
		$.fancybox.close();
	}
	
</script>

<table width="666" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<th width="305" bgcolor="#D4DFFF" scope="col">Akun ID</th>
		<th width="158" bgcolor="#D4DFFF" scope="col">Nama Akun</th>
	</tr>
	
	<?php
		foreach($result->result() as $row)
		{
	?>
			<tr>
				<td align="left" valign="middle"><a href="javascript:set_barang('<?=$row->AKUNID?>', '<?=$row->NAKUN?>', 0)"><?=$row->NAKUN?></a></td>
				<td align="left" valign="middle"><?=$row->NAKUN?></td>
			</tr>
	<?php
		}
	?>
</table>