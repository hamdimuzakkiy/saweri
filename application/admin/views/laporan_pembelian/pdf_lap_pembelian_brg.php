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
	<table class="laporan" width="90%">
		<tr><td align="left" colspan="8"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td align="left" colspan="8"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td align="left" colspan="8"><b>TELP (0333)-411345</b></td></tr>
		<tr><td align="left" colspan="8"><b></b><br/></td></tr>
		<tr><td colspan="8" div align="center"><b>LAPORAN PEMBELIAN</b></td></tr>
		<tr><td align="left" colspan="8"><b>PERIODE : <?php echo $periode_awal . ' s/d ' .  $periode_akhir; ?></b></td></tr>
		<tr><td align="left" colspan="8"><b>TANGGAL CETAK : <?php echo date('d '. ' M' . ' Y') ?></b></td></tr>
		<tr>
			<th class="th_border" scope="col">NO</th>
			<th class="th_border" scope="col">TANGGAL </th>
			<th class="th_border" scope="col">ID PEMBELIAN</th>
			<th class="th_border" scope="col">NAMA BARANG</th>
			<th class="th_border" scope="col">QTY</th>
			<th class="th_border" scope="col">SUPPLIER</th>
			<th class="th_border" scope="col">CABANG</th>
			<th class="th_border" scope="col">RUPIAH</th>
		</tr>
		
		<?php
		$j=0;
		$nama_brg = '';
		$total_brg = 0;
		$qty_perbrg = 0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
				if ($nama_brg == ''){
					$total_brg = 0;
					$qty_perbrg = 0;
					$nama_brg = $row->id_barang;
				}
				
				if($nama_brg != $row->id_barang){
		?>
			<tr class="border">
				<td class="use_border" colspan="4" align="left"><b>Jumlah : </b></td>
				<td class="use_border" align="right"><b><?=$qty_perbrg;?></b></td>
				<td class="use_border" colspan="2"></td>
				<td class="use_border" align="right"><b><?=$this->fungsi->uangindo($total_brg)?></b></td>
			</tr>
		<?php
					$nama_brg = '';
				}else{
					$total_brg = $total_brg + $row->total;
					$qty_perbrg = $qty_perbrg + $row->qty;
		?>
				<tr class="border">
					<td class="use_border" align="right" valign="middle"><?=$j;?></td>
					<td class="use_border" align="center" valign="middle"><?=$row->tanggal?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->id_pembelian?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_barang?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->qty?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_supplier?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td class="use_border" align="right" valign="middle"><?=$this->fungsi->uangindo($row->total);?></td>
					<?php $sum_total[]=$row->total ;?>
				</tr>
		<?php
				}
			}
		?>
			<tr class="border">
				<td class="use_border" align="left" colspan="4"><b>Jumlah : </b></td>
				<td class="use_border" align="right"><b><?=$qty_perbrg;?></b></td>
				<td class="use_border" colspan="2"></td>
				<td class="use_border" align="right"><b><?=$this->fungsi->uangindo($total_brg)?></b></td>
			</tr>
		<tr class="border"><td colspan="7" align="left" class="use_border"><b>Jumlah Keseluruhan: </b></td><td align="right" class="use_border"><b><?php if(isset($row->total)){ echo  $this->fungsi->uangindo(array_sum($sum_total));} ?></b></td></tr>
			
	</table>
</div>
