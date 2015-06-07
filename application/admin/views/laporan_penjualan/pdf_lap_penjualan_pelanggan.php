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
		<tr><td colspan="8" div align="center"><b>LAPORAN PENJUALAN PERPELANGGAN</b></td></tr>
		<tr><td colspan="8"><b>PERIODE : <?php echo $periode_awal . ' s/d ' .  $periode_akhir; ?></b></td></tr>
		<tr><td colspan="8"><b>TANGGAL CETAK : <?php echo date('d-M-Y') ?></b></td></tr>
		<tr>
			<th class="th_border" scope="col">NO</th>
			<th class="th_border" scope="col">TANGGAL </th>
			<th class="th_border" scope="col">SO</th>
			<th class="th_border" scope="col">NAMA BARANG</th>
			<th class="th_border" scope="col">QTY</th>
			<th class="th_border" scope="col">PELANGGAN</th>
			<th class="th_border" scope="col">CABANG</th>
			<th class="th_border" scope="col">RUPIAH</th>
		</tr>
		
		<?php
		$j=0;
		$nama_sup = '';
		$total_sup = 0;
		$qty_persup = 0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
				
				if ($nama_sup == ''){
					$total_sup = 0;
					$qty_persup = 0;
					$nama_sup = $row->nama_pelanggan;
				}
				
				if($nama_sup != $row->nama_pelanggan){
		?>
					<tr  class="border">
						<td class="use_border" colspan="4"><b>Jumlah : </b></td>
						<td class="use_border" align="right"><b><?=$qty_persup;?></b></td>
						<td class="use_border" colspan="2"></td>
						<td class="use_border" align="right"><b><?=$this->fungsi->uangindo($total_sup)?></b></td>
					</tr>
		<?php
					$nama_sup = '';
				}else{
					$total_sup = $total_sup + $row->total;
					$qty_persup = $qty_persup + $row->qty;
		?>
					<tr class="border">
						<td class="use_border" align="right" valign="middle"><?=$j;?></td>
						<td class="use_border" align="center" valign="middle"><?=$row->tanggal?></td>
						<td class="use_border" align="right" valign="middle"><?=$row->so_no?></td>
						<td class="use_border" align="left" valign="middle"><?=$row->nama_barang?></td>
						<td class="use_border" align="right" valign="middle"><?=$row->qty?></td>
						<?php $sum_qty[]=$row->qty ;?>
						<td class="use_border" align="left" valign="middle"><?=$row->nama_pelanggan?></td>
						<td class="use_border" align="left" valign="middle"><?=$row->nama_cabang?></td>
						<td class="use_border" align="right" valign="middle"><?=$this->fungsi->uangindo($row->total);?></td>
						<?php $sum_total[]=$row->total ;?>
					</tr>
		<?php
				}
		?>
				
		<?php
				
			}
		?>
					<tr  class="border">
						<td class="use_border" colspan="4"><b>Jumlah : </b></td>
						<td class="use_border" align="right"><b><?=$qty_persup;?></b></td>
						<td class="use_border" colspan="2"></td>
						<td class="use_border" align="right"><b><?=$this->fungsi->uangindo($total_sup)?></b></td>
					</tr>

						
		<tr class="border"><td class="use_border" colspan="4"><b>Jumlah Keseluruhan: </b></td><td class="use_border" align="right"><b><?php if(isset($row->qty)){ echo array_sum($sum_qty); }?></b></td><td class="use_border" colspan="2"></td><td class="use_border" align="right"><b><?php if(isset($row->total)){ echo  $this->fungsi->uangindo(array_sum($sum_total));} ?></b></td></tr>
			
	</table>
</div>
