
<script type="text/javascript">	
	
	
	function set_barang(id, nama, harga, idjenis,sn){
		//alert(id);
		$.fancybox.close();
		document.getElementById('detail_idbarang').value = id;			
		document.getElementById('detail_namabarang').value = nama;
		document.getElementById('detail_idjenis').value = idjenis;
		document.getElementById('detail_qty').value = '1';		
		if (sn == 0)
		{
			document.getElementById('sn').checked = false;
		}
		else
		{
			document.getElementById('sn').checked = true;
		}		
		$.fancybox.close();
	}
	
	function search()
	{

		var total = document.getElementById('TotalBarang').innerHTML;		
		var wordS = document.getElementById('sch').value;
		wordS = wordS.toLowerCase();
		wordS = new RegExp( wordS, 'g' );
		for (i = 0; i < total; i++) {
			var word = document.getElementById('NamaBarang'+i).innerHTML;
			word = word.toLowerCase();
			if (word.match(wordS))
			{
				document.getElementById('BarangKe'+i).hidden = false;
			}
			else
			{
				document.getElementById('BarangKe'+i).hidden = true;	
			}
		//document.getElementById('sch').value = '';
		}
	}
</script>
<span>	
	<p class="">
		<label for="complex-en-url">Search</label>
		<span class="relative">
				<input type="text" onchange="javascript:search();"  id="sch">
		</span>
	</p>	
<div style = "height:300px; overflow-x:hidden;">
<table width="666" border="1" align="center"  cellpadding="1" cellspacing="1">	
	<tr>
		<th width="305" bgcolor="#D4DFFF" scope="col">Nama Barang</th>
		<th width="158" bgcolor="#D4DFFF" scope="col">HPP</th>
		<th width="181" bgcolor="#D4DFFF" scope="col">Stok</th>
	</tr>
	
	<?php
		$ids = 0;
		foreach($result->result() as $row)
		{
				?>
			<tr id = '<?php print  "BarangKe".$ids;?>'>
				<td align="left" valign="middle"><a id = "<?php print  "NamaBarang".$ids++;?>" href="javascript:set_barang('<?=$row->id_barang?>', '<?=$row->nama_barang?>', 0,<?=$row->id_jenis?>,<?=$row->sn?>)"><?=$row->nama_barang?></a></td>

				<td align="left" valign="middle"><?php 
				if ($row->StokBarang == 0)
					print convert_rupiah('0');
				else
					{					
						$res = ($row->hpp/$row->StokBarang);
						print  convert_rupiah($res);
					}
				?></td>
				<td align="left" valign="middle"><?=$row->StokBarang?></td>
			</tr>
	<?php
		}
		print "<span hidden id = 'TotalBarang'>".$ids."</span>"
	?>
	
</table>

</div>
</span>