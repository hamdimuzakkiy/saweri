<?php ini_set("memory_limit","32M"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15"><style>#div_laporan{	margin:0 auto;}table.laporan {	  border-spacing: 0;	  margin:0 auto;	   font-size: 0.8em;	     font-family: sans-serif;}tr.border,th.th_border,td.use_border {  border:0.5px solid #ccc;  padding:2pt;}</style><div id="div_laporan" align="center">	<table class="laporan" >

<?php

			$query = $this->db->get('setting_laporan');

			foreach($query->result() as $row)
			{
				$footer = $row->footer_pembelian;
			}
		?>
<?php foreach($results->result() as $row) {?>
<tr><td colspan="7" align="left"><b>SAWERI GADING CELL</b></td><td colspan="1" align="left"><b>Dari :</b></td></tr>		
<tr><td colspan="7" align="left"><b><?php echo $row->nama_cabang;?></b></td> <td colspan="1" align="left"><b><?php echo $row->nama_supplier;?></b></td> </tr>
<tr><td colspan="7" align="left"><b>JL. S PARMAN 18 BANYUWANGI</b></td> <td colspan="1" align="left"><b><?php echo $row->alamat;?></b></td> </tr>
<tr><td colspan="7" align="left"><b>TELP (0333)-411345</b></td></tr>		
<tr><td colspan="7" align="left"><b></b><br/></td></tr>		
<tr><td colspan="12" div align="center"><b>LAPORAN BIAYA</b></td></tr>		
<tr><td colspan="0" div align="left"><b>&nbsp;</b></td></tr>
<tr><td colspan="7" align="left"><b>Nomor Faktur : <?php echo $row->po_no?></b></td><td colspan="1" align="left"><b>TANGGAL : <?php echo $this->fungsi->dateindo3('-',$row->tanggal) ?></b></td></tr>		



	<!--tr><td colspan="0" div align="left"><b>Nomor PO : <?php echo $row->po_no?></b></td></tr>
	<tr><td colspan="0" div align="left"><b>Tanggal Pembelian : <?php echo $this->fungsi->dateindo3('-',$row->tanggal) ?></b></td></tr>
	<tr><td colspan="0" div align="left"><b>Cabang : <?php echo $row->nama_cabang;?></b></td></tr>
	<tr><td colspan="0" div align="left"><b>Suplier : <?php echo $row->nama_supplier;?></td></tr>
	<tr><td colspan="0" div align="left"><b>Diskon : <?php echo $row->diskon;?> %</b></td></tr>
	<tr><td colspan="0" div align="left"><b>Kas : <?php echo $row->nama_kas;?></b></td></tr>
	<tr><td colspan="0" div align="left"><b>Cara Pembayaran : <?php  
			if($row->cara_bayar == 1)
				{print "Tunai";}
			else if ($row->cara_bayar == 2)
				{
					print  "Hutang ";
					print $row->jatuh_tempo;
					print " Hari"; 
				}?></b></td></tr-->
	

<tr><td colspan="0" div align="left"><b>&nbsp;</b></td></tr>
<tr class="border">
	<th class="th_border" colspan="0" scope="col">NO</th>
	<th class="th_border" scope="col">KODE</th>
	<th colspan="4" class="th_border" scope="col">NAMA</th>	
	<th class="th_border" scope="col">SATUAN</th>
	<th class="th_border" scope="col">QTY</th>
	<th class="th_border" scope="col">Harga</th>	
	<th colspan="1" class="th_border" scope="col">RUPIAH</th>	
<?php 
	$i=1;
			$total_bayar=0;
			foreach($results2->result() as $rows){
?>

<tr class="border">
		<td class="use_border" align="right" valign="middle"><?=$i++?></td>
		<td  class="use_border" align="right" valign="middle"><?=$rows->id_barang?></td>
		<td colspan="4" class="use_border" align="right" valign="middle"><?=$rows->nama_barang?></td>		
		<td class="use_border" align="right" valign="middle"><?=$rows->satuan?></td>
		<td class="use_border" align="right" valign="middle"><?=$rows->jumlah?></td>
		<td class="use_border" align="right" valign="middle"><?=convert_rupiah($rows->harga)?></td>
		<td colspan="1" class="use_border" align="right" valign="middle"><?=convert_rupiah($rows->harga*$rows->qty)?></td>		
	</tr>	
</tr>

	<?php
}


	?>
	<tr>
		
		<td colspan="8"></td>
		<td colspan="1">Disc [%]</td>
		<td colspan="1"><?=$row->diskon?> % </td>
	</tr>
	<tr>
		<td colspan="8"></td>
		<td colspan="1">Tax [%]</td>
		<td colspan="1"></td>
	</tr>
	<tr>
		<td colspan="8"></td>
		<td colspan="1">Total [Rp]</td>
		<td colspan="1"><?=convert_rupiah($row->total)?></td>
	</tr>

	<?php print $footer;  }?>
