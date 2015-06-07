<script type="text/javascript">
	function set_items(id_jenis, id_pembelian, id_barang){
	
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'index.php/penjualan/set_items/'.$jenis.'/'?>' + id_jenis + '/' + id_pembelian + '/' + id_barang,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#items').html(data);
			}
		});
		
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
				<td align="left" valign="middle"><a href="javascript:set_items('<?=$row->id_jenis?>','<?=$row->id_pembelian?>', '<?=$row->id_barang?>')"><?=$row->nama_barang?></a></td>
				<td align="left" valign="middle"><?=$row->jenis?></td>
				<td align="left" valign="middle"><?=$row->kategori?></td>
			</tr>
	<?php
		}
	?>
</table>