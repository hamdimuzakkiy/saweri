<script type="text/javascript">
	
	function set_barang(id, nama, harga){
		document.getElementById('detail_idbarang').value = id;	
		document.getElementById('detail_namabarang').value = nama;
		document.getElementById('detail_qty').value = '1';
		
		$.fancybox.close();
	}
	
</script>

<table width="666" border="1" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<th width="158" bgcolor="#D4DFFF" scope="col">AKUNID</th>
		<th width="305" bgcolor="#D4DFFF" scope="col">NAMA AKUN</th>
		<th width="181" bgcolor="#D4DFFF" scope="col">KAS</th>
	</tr>
	
	<?php
		foreach($sum_kas->result() as $row)
		{
	?>
			<tr>
				<td align="left" valign="top"><?=$row->AKUNID?> </td>						<td align="left" valign="top"><?=$row->NAKUN?> </td>						<td align="left" valign="top"><?=convert_rupiah_non_rp($row->DEBET)?> </td>		 
			</tr>
	<?php
		}
	?>
</table>