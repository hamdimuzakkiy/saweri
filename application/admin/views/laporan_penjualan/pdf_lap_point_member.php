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
		<tr ><td align="left" colspan="8"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td align="left" colspan="8"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td align="left" colspan="8"><b>TELP (0333)-411345</b></td></tr>
		<tr><td align="left" colspan="8"><b></b><br/></td></tr>
		<tr><td colspan="8" div align="center"><b>LAPORAN POINT MEMBER</b></td></tr>
		<tr><td align="left" colspan="8"><b>TANGGAL CETAK : <?php echo date('d '. ' M' . ' Y') ?></b></td></tr>
		<tr class="border">
			<th class="th_border" scope="col">NO</th>
			<th class="th_border" scope="col">KODE MEMBER</th>
			<th class="th_border" scope="col">NAMA</th>
			<th class="th_border" scope="col">CABANG</th>
			<th class="th_border" scope="col">AREA</th>
			<th class="th_border" scope="col">ALAMAT</th>
			<th class="th_border" scope="col">TELEPON</th>
			<th class="th_border" scope="col">POINT</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
			$j=$j+1;
		?>

				<tr class="border">
					<td class="use_border" align="right" valign="middle"><?=$j;?></td>
					<td class="use_border" align="center" valign="middle"><?=$row->kode_pelanggan?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->nama?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->nama_area?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->alamat?></td>
					<td class="use_border" align="left" valign="middle"><?=$row->tel?></td>
					<td class="use_border" align="right" valign="middle"><?=$row->point;?></td>
					<?php $sum_total[]=$row->point ;?>
				</tr>
		<?php

			}
		?>
		<tr class="border"><td colspan="7" align="left" class="use_border"><b>Jumlah Keseluruhan: </b></td><td align="right" class="use_border"><b><?php if(isset($row->point)){ echo  array_sum($sum_total);} ?></b></td></tr>
			
	</table>
</div>
