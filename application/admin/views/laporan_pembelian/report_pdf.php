<?php ini_set("memory_limit","16M"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>
#div_laporan{
	margin:0 auto;
}
table.laporan {
	  border-spacing: 0;
	  margin:0 auto;
	   font-size: 0.8em;
	     font-family: sans-serif;
}

tr,th,td {
  border:0.5px solid #ccc;
  padding:2pt;
}


</style>
<div id="div_laporan" align="center">

	<table class="laporan" >
		<tr><td colspan="10" align="left"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="10" align="left"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="10" align="left"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="10" align="left"><b></b><br/></td></tr>
		<tr><td colspan="10" div align="center"><b>LAPORAN PEMBELIAN</b></td></tr>
		<tr><td colspan="10" align="left"><b>PERIODE : <?php echo $periode_awal.' S/D '.$periode_akhir ?></b></td></tr>
		<tr><td colspan="10" align="left"><b>TANGGAL CETAK : <?php echo $date_now; ?></b></td></tr>
		<tr>
			<th width="30" scope="col">NO</th>
			<th width="70" scope="col">TANGGAL </th>
			<th width="70" scope="col">PO NOMER</th>
			<th width="90" scope="col">SUPPLIER</th>
			<th width="90" scope="col">CABANG</th>
			<th width="50" scope="col">JATUH TEMPO</th>
			<th width="30" scope="col">QTY</th>
			<th width="30" scope="col">DISC (%)</th>
			<th width="40" scope="col">TAX</th>
			<th width="90" scope="col">RUPIAH</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr>
					<td align="left" valign="middle"><?=$j;?></td>
					<td align="left" valign="middle"><?=$row->tanggal?></td>
					<td align="right" valign="middle"><?=$row->po_no?></td>
					<td align="left" valign="middle"><?=$row->nama_supplier?></td>
					<td align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td align="right" valign="middle"><?=$row->jatuh_tempo?></td>
					<td align="right" valign="middle"><?=$row->qty?></td>
					<td align="right" valign="middle"><?=$row->diskon;?></td>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="right" valign="middle"><?php echo $this->fungsi->uangindo($row->total_harga);?></td>
					<?php if (isset($row->total_harga)){$sum_total[]=$row->total_harga;}?>
				</tr>
		<?php
			}
		?>
			<tr><td colspan="9" align="left">JUMLAH : </td><td align="right"><?php if (isset($row->total_harga)){ echo $this->fungsi->uangindo(array_sum($sum_total)); } ?></td></tr>
	</table>
</div>