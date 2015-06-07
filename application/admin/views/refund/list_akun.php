<script type="text/javascript">
	
	function set_barang(akunid, nakun, count, counter){		tot = 0;		//var count = document.getElementsByName('akunid[]');						/*for(i=0; i<count.length; i++){			tot = tot + parseInt(count[i].value);		}*/		
		document.getElementById('akunid' + counter ).value = akunid;			document.getElementById('nakun' + counter ).value = nakun;			//document.getElementById('akunid1').value = akunid;	
		/*document.getElementById('detail_nakun').value = nakun;
		document.getElementById('detail_jumlah').value = jumlah;		document.getElementById('detail_count').value = '1';
				*/
		$.fancybox.close();
	}
</script>
<table width="450" border="1" align="center" cellpadding="1" cellspacing="1" height="600">
	<tr>
		<th width="250" bgcolor="#D4DFFF" scope="col">Nama Akun ( Akun ID )</th>
	</tr>
	
	<?php
		foreach($result->result() as $row)
		{
	?>
			<tr>				<td align="left" valign="middle">					<a href="javascript:set_barang('<?=$row->AKUNID?>', '<?=$row->NAKUN?>', 0, <?=$counter?>)">												<?php 							if ($row->AKUNID[1]==0){								echo $row->AKUNID . ' - ' . $row->NAKUN;							}else if($row->AKUNID[2]==0){								echo '&nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID . ' - ' . $row->NAKUN;							}else if($row->AKUNID[3]==0){								echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID . ' - ' . $row->NAKUN;							}else if($row->AKUNID[4]==0){								echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID . ' - ' . $row->NAKUN;							}else{								echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID . ' - ' . $row->NAKUN;							}													?>											</a>					</td>			</tr>
	<?php
		}
	?>
</table>