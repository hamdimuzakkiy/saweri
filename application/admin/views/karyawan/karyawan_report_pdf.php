<?php ini_set("memory_limit","32M"); ?>
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
		<tr><td colspan="8" div align="center"><b>LAPORAN KARYAWAN</b></td></tr>
		<tr><td align="left" colspan="8"><b>TANGGAL CETAK : <?php echo date('d '. ' M' . ' Y') ?></b></td></tr>
		<tr class="border">
			<th class="th_border" align="left" valign="top" scope="col">Cabang</th>
			<th class="th_border" align="left" valign="top" scope="col">Kode Karyawan</th>
			<th class="th_border" align="left" valign="top" scope="col">Nama</th>
			<th class="th_border" align="left" valign="top" scope="col">Alamat</th>
			<th class="th_border" align="left" valign="top" scope="col">Telepon</th>
			<th class="th_border" align="left" valign="top" scope="col">Jenis Pengenal</th>
			<th class="th_border" align="left" valign="top" scope="col">No Pengenal</th>
			<th class="th_border" align="left" valign="top" scope="col">Status Karyawan</th>
			<th class="th_border" align="left" valign="top" scope="col">Point</th>
		</tr>
					
					<?php foreach($results->result() as $row) {?>
					<tr class="border">
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_karyawan?>" type="checkbox" /></td>-->
						<td class="use_border" align="left" valign="top"><?=$row->nama_cabang?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->kode_karyawan?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->nama?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->alamat?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->telp1?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->jenis_pengenal?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->no_pengenal?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->status?> </td>
						<td class="use_border" align="left" valign="top"><?=$row->point?> </td>
					</tr>
					<?php } ?>		
			</table>			

</div>