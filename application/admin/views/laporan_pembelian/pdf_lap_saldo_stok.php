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
	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
	<input name="periode_awal" id="tanggal_awal" type="hidden" value="<?=$periode_awal;?>" />
	<input name="periode_akhir" id="tanggal_akhir" type="hidden" value="<?=$periode_akhir;?>" />
	
	<table class="laporan" width="90%">
		<tr><td colspan="9"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="9"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="9"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="9"><b></b><br/></td></tr>
		<tr><td colspan="9" div align="center"><b>LAPORAN SALDO STOK</b></td></tr>
		<tr><td colspan="9"><b>PERIODE : <?php echo $periode_awal . ' S/D ' .  $periode_akhir; ?></b></td></tr>
		<tr><td colspan="9"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th >NO</th>
			<th scope="col">TANGGAL </th>
			<th scope="col">NAMA BARANG</th>
			<th scope="col">SUPPLIER</th>
			<th scope="col">DEBIT</th>
			<th scope="col">KREDIT</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr>
						<td align="left" valign="top"><?=$j?> </td>
						<td align="left" valign="top"><?=$row->tanggal?> </td>
						<td align="left" valign="top"><?=$row->nama_barang?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->qty?> </td>
						<?php
							$q = $this->inventory->getItempenjualan_cabang($row->id_barang);
							$kredit=0;
							if($q->num_rows() > 0){
								$kredit= $q->row()->kredit;
							}
						?>
						<td align="left" valign="top"><?=$kredit?> </td>
						
						<?php if (isset($row->qty)){$sum_total_jumlah[]=$row->qty;}?>
						<?php if (isset($row->debit)){$sum_total_debit[]=$row->debit;}?>
						<?php if (isset($q->row()->kredit)){$sum_total_kredit[]=$q->row()->kredit;}?>
						<?php if (isset($row->saldo)){$sum_total_saldo[]=$row->saldo;}?>
				</tr>
		<?php
			}
		?>
			<!--
			<tr><td colspan="2">JUMLAH : </td>
				<td align="right"><?php if (isset($row->saldo)){ echo array_sum($sum_total_jumlah); } ?></td>
				<td align="right"><?php if (isset($row->saldo)){ echo array_sum($sum_total_debit); } ?></td>
				<td align="right"><?php if (isset($row->saldo)){ echo array_sum($sum_total_kredit); } ?></td>
				<td align="right"><?php if (isset($row->saldo)){ 
					// echo array_sum($sum_total_saldo); 
				} ?></td>
				
			</tr>
			-->
	</table>
</div>