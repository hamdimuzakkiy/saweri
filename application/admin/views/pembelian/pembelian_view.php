<div align="center">
<strong>Detail Pembelian</strong>
<div>
<br/>
<table width="800" border="1" cellpadding="1" cellspacing="1" style = "overflow-x:hidden;">	
<?php
		
		foreach ($results->result() as $i) {					
	?>
<tr>
	<td>Tanggal</td>
	<td><?php
		print $i->tanggal;
		 ?></td>
</tr>
<tr>
	<td>Suplier</td>
	<td><?php
		print $i->nama_supplier;
		 ?></td>
</tr>
<tr>
	<td>Kode Kas</td>
	<td><?php		
		print $i->nama_kas;			
	?></td>
</tr>
<tr>
	<td>Rupiah</td>
	<td><?php
		print $i->tanggal;
		 ?></td>
</tr>
<tr>
	<td>Jatuh Tempo</td>
	<td><?php
		print $i->jatuh_tempo;
		 ?></td>
</tr>
<tr>
	<td>Diskon</td>
	<td><?php
			$diskon = $i->diskon;
		print $i->diskon.' %';
		 ?></td>
</tr>
<?php } ?>

  <!--
  <tr>
    <td width="64" align="left" valign="top"><strong>Tanggal</strong></td>
    <td width="372" align="left" valign="top" colspan="4"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><strong>Cabang</strong></td>
    <td align="left" valign="top" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" colspan="5">&nbsp;</td>
  </tr>
  -->

  <tr>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>No</strong></td>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>Nama Barang</strong></td>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>Satuan</strong></td>
	<!--td align="left" valign="top" bgcolor="#CCCCFF"><strong>SN</strong></td-->
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>Qty</strong></td>
	<td align="left" valign="top" bgcolor="#CCCCFF"><strong>Subtotal</strong></td>
  </tr>
	<?php
			$i=1;
			$total_bayar=0;			
			foreach($result->result() as $row){
				$total_bayar = $total_bayar+$row->subtotal;
	?>
			  <tr>
				<td align="left" valign="top"><?=$i++?></td>
				<td align="left" valign="top"><?=$row->nama_barang?></td>
				<td align="left" valign="top"><?=$row->satuan?></td>
				<!--td align="left" valign="top"><?=$row->sn?></td-->
				<td align="left" valign="top"><?=$row->jumlah?></td>
				<td align="left" valign="top"><?=$row->subtotal?></td>
			  </tr>
	<?php
				//$total_bayar = $total_bayar + $row->total;
			}

			
	?>
	<tr>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> Total </td>
	<td > <?php print ($total_bayar); ?> </td>
	</tr>
	<tr>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> Diskon </td>
	<td > <?php print ($total_bayar/100*$diskon); ?> </td>
	</tr>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> </td>
	<td style = 'border-color:white;'> Bayar </td>
	<td > <?php print ($total_bayar/100*(100-$diskon)); ?> </td>
	<!---
 	  <tr>
		<td align="left" valign="top" colspan="7">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" bgcolor="#CCCCFF" colspan="6"><div align="right"><strong>Total Bayar&nbsp;&nbsp;:&nbsp;&nbsp;</strong></div></td>
	  </tr>
	-->
</table>
<br>
<br>