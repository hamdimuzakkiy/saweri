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

tr.border,th.th_border,td.use_border {
  border:0.5px solid #ccc;
  padding:2pt;
}


</style>
<div id="div_laporan">
	<table class="laporan" width="90%">
		<tr><td colspan="8"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="8"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="8"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="8"><b></b><br/></td></tr>
		<tr><td colspan="8" div align="center"><b>LAPORAN RETUR PEMBELIAN</b></td></tr>
		<tr><td colspan="8"><b>PERIODE : <?php echo $periode_awal . ' s/d ' .  $periode_akhir; ?></b></td></tr>
		<tr><td colspan="8"><b>TANGGAL CETAK : <?php echo date('d-M-Y') ?></b></td></tr>
		<tr>
			<th class="th_border" scope="col">NO</th>
			<th class="th_border" scope="col">TANGGAL </th>
			<th class="th_border" scope="col">REF RETUR PEMBELIAN</th>
			<th class="th_border" scope="col">PO</th>
			<th class="th_border" scope="col">NAMA BARANG</th>
			<th class="th_border" scope="col">SUPPLIER</th>
			<th class="th_border" scope="col">CABANG</th>
			<th class="th_border" scope="col">QTY</th>
		</tr>
		
		<?php
		$j=0;
		$nama_brg = '';
		$total_brg = 0;
		$qty_perbrg = 0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr class="border">
					<td class="use_border" align="right" valign="middle"><?=$j;?></td>
					<td class="use_border" align="center" valign="middle"><?=$row->tanggal?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->id_retur_pembelian?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->po_no?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_barang?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_supplier?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->qty?></td>
					<?php if (isset($row->qty)){$sum_total[]=$row->qty;}?>
				</tr>
		<?php
			}
		?>

		<tr class="border"><td class="use_border" colspan="7"><b>Jumlah Keseluruhan : </b></td><td class="use_border" align="right"><b><?php if(isset($row->qty)){ echo  array_sum($sum_total);} ?></b></td></tr>
			
	</table>
</div>