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
<div id="div_laporan" align="center">

	<table class="laporan" >
		<tr><td colspan="11" align="left"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="11" align="left"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="11" align="left"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="11" align="left"><b></b><br/></td></tr>
		<tr><td colspan="11" div align="center"><b>LAPORAN PENJUALAN</b></td></tr>
		<tr><td colspan="11" align="left"><b>PERIODE : <?php echo $periode_awal.' S/D '.$periode_akhir ?></b></td></tr>
		<tr><td colspan="11" align="left"><b>TANGGAL CETAK : <?php echo $date_now; ?></b></td></tr>
		<tr class="border">
			<th class="th_border" scope="col">NO</th>
			<th class="th_border" scope="col">TANGGAL </th>
			<th class="th_border" scope="col">SO NOMER</th>
			<th class="th_border" scope="col">PELANGGAN</th>
			<th class="th_border" scope="col">CABANG</th>
			<th class="th_border" scope="col">JATUH TEMPO</th>
			<th class="th_border" scope="col">QTY</th>
			<th class="th_border" scope="col">JUMLAH</th>
			<th class="th_border" scope="col">DISC (%)</th>
			<th class="th_border" scope="col">TAX</th>
			<th class="th_border" scope="col">RUPIAH</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr class="border">
					<td class="use_border" align="left" valign="middle"><?=$j;?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->tanggal?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->so_no?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_pelanggan?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->jatuh_tempo?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->qty?></td>
					<td class="use_border" align="right" valign="middle"><?=$this->fungsi->uangindo($row->total_harga);?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->diskon;?></td>
					<td class="use_border" align="left" valign="middle">&nbsp;</td>
					<td align="right" valign="middle" class="use_border">
					<?php 
						$jmldiskon=(($row->total_harga)-($row->total_harga*$row->diskon)/100);
						$arrjmldiskon[]=$jmldiskon;
						echo $this->fungsi->uangindo($jmldiskon);
						
					?>
					</td>
					
					<?php if (isset($row->total_harga)){$sum_total[]=$row->total_harga;}?>
					<?php if (isset($row->total_harga)){$sum_qty[]=$row->qty;}?>
				</tr>
		<?php
			}
		?>
			<tr class="border">
			<td colspan="6" class="use_border" align="left"><b>JUMLAH : </b></td>
			<td align="right" class="use_border"><b><?php if (isset($row->total_harga)){echo array_sum($sum_qty);} ?></b></td>
			<td align="right" class="use_border"><b><?php if (isset($row->total_harga)){echo $this->fungsi->uangindo(array_sum($sum_total));} ?></b></td>
			<td class="use_border" colspan="2"></td>
			<td class="use_border" align="right"><b><?php if (isset($row->total_harga)){ echo $this->fungsi->uangindo(array_sum($sum_total)); } ?></b></td>
			</tr>
	</table>
</div>