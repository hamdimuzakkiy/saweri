<script type="text/javascript">
	
	function set_barang(id, nama){
		document.getElementById('detail_idbarang').value = id;	
		document.getElementById('detail_namabarang').value = nama;
		document.getElementById('detail_qty').value = '1';
		
		$.fancybox.close();
	}
	
</script>

<table width="666" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<th width="305" bgcolor="#D4DFFF" scope="col">Nama Barang</th>
		<th width="158" bgcolor="#D4DFFF" scope="col">Jenis</th>
		<th width="181" bgcolor="#D4DFFF" scope="col">Kategori</th>
	</tr>
	
	<?php
		foreach($result->result() as $row)
		{
	?>
			<tr>
				<td align="left" valign="middle"><a href="javascript:set_barang('<?=$row->id_barang?>', '<?=$row->nama_barang?>')"><?=$row->nama_barang?></a></td>
				<td align="left" valign="middle"><?=$row->jenis_barang?></td>
				<td align="left" valign="middle"><?=$row->kategori_barang?></td>
			</tr>
	<?php
		}
	?>
</table>