<?php ini_set("memory_limit","32M"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15"><style>#div_laporan{	margin:0 auto;}table.laporan {	  border-spacing: 0;	  margin:0 auto;	   font-size: 0.8em;	     font-family: sans-serif;}tr.border,th.th_border,td.use_border {  border:0.5px solid #ccc;  padding:2pt;}</style><div id="div_laporan" align="center">	<table class="laporan" >
<tr><td colspan="7" align="left"><b>SAWERI GADING CELL</b></td></tr>		
<tr><td colspan="7" align="left"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
<tr><td colspan="7" align="left"><b>TELP (0333)-411345</b></td></tr>		
<tr><td colspan="7" align="left"><b></b><br/></td></tr>		
<tr><td colspan="7" div align="center"><b>LAPORAN BIAYA</b></td></tr>		
<tr><td colspan="7" align="left"><b>PERIODE : <?php echo $periode_awal.' S/D '.$periode_akhir ?></b></td></tr>
<tr><td colspan="7" align="left"><b>TANGGAL CETAK : <?php echo $date_now; ?></b></td></tr>		
<tr class="border">	
	<th class="th_border" scope="col">NO</th>
	<th class="th_border" scope="col">AKUNID</th>			
	<th class="th_border" scope="col">KET</th>			
	<th class="th_border" scope="col">NAMA AKUN</th>			
	<th class="th_border" scope="col">PO NOMER</th>			
	<th class="th_border" scope="col">DEBET (Rp)</th>						
	<th class="th_border" scope="col">KREDIT (Rp)</th></tr>
	<?php
	$j=0;		
	$nama_supplier = null;		
	$hutang[] = 0;		
	$sum_debet[] = 0;		
	$sum_kredit[] = 0;				
	$var_saldo = 0;		
	$saldo = 0;		
	$qty_perbrg = 0;  						
	foreach($results->result() as $row)			
	{				
		$j=$j+1;			?>						
		<tr class="border">							
			<td class="use_border" align="right" valign="middle"><?=$j;?></td>							
			<td class="use_border" align="left" valign="middle"><?=$row->AKUNID?></td> 							
			<td class="use_border" align="left" valign="middle"><?=$row->KETERANGAN?></td>							
			<?php 
			if ( ($row->AKUNID[0]!= 0) && ($row->AKUNID[1]== 0) && ($row->AKUNID[2]== 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0) ) 
			{
				echo '<td align="left" valign="middle" class="use_border" >' . $row->NAKUN. '</td>';							
			}
			else if( ($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]== 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0))
			{ 													
				echo '<td align="left" valign="middle" class="use_border" >' . $row->NAKUN . ' </td>';		
			}
			else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0))
			{
				echo '<td align="left" valign="middle" class="use_border" >&nbsp; &nbsp; ' . $row->NAKUN .' </td>';	
			}
			else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]!= 0) && ($row->AKUNID[4]== 0))
			{	
				echo '<td align="left" valign="middle" class="use_border" >&nbsp; &nbsp; &nbsp; &nbsp; ' . $row->NAKUN .' </td>';							
			}
			else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]!= 0) && ($row->AKUNID[4]!= 0))
			{
				echo '<td align="left" valign="middle" class="use_border" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row->NAKUN .' </td>';
			}
			?>
			<td class="use_border" align="right" valign="middle"><?=' '.$row->PO_NO;?></td>							
			<td class="use_border" align="right" valign="middle"><?=convert_rupiah_non_rp($row->DEBET);?></td>							
			<td class="use_border" align="right" valign="middle"><?=convert_rupiah_non_rp($row->KREDIT);  ?></td>							
			<?php							
		/*								
		if ($saldo==0){									
			$saldo=$get_kas_awal;								
		}else{									
			$saldo=$saldo;								
		}								
		if ($row->DEBET==0) {									
			$saldo=$saldo-$row->KREDIT;								
		}else if ($row->KREDIT==0){									
			$saldo =$saldo + $row->DEBET;								
		}*/															
		?>																					
		<?php if (isset($row->DEBET)){$sum_debet[]=$row->DEBET;}?>							
		<?php if (isset($row->KREDIT)){$sum_kredit[]=$row->KREDIT;}?>							
	</tr>			
	<?php			
}			
?>			
<tr class="border">							
	<td class="use_border" colspan="5" align="left"><b>JUMLAH : </b></td>							
	<td class="use_border" align="right"><b><?php if (isset($row->DEBET)){echo convert_rupiah_non_rp(array_sum($sum_debet));} ?></b></td>							
	<td class="use_border" align="right"><b><?php if (isset($row->KREDIT)){echo convert_rupiah_non_rp(array_sum($sum_kredit));} ?></b></td>							 						
</tr>						
<tr><td class="use_border" colspan="7">&nbsp;</td></tr>	
<?php			
$row_kas_awal = $get_kas_awal->row(); 			
$get_kas_awal=$row_kas_awal->JUMLAH_KAS_AWAL;			
$j=$j+1;			 			
?> 						
<tr class="border">							
	<td class="use_border" align="right" valign="middle"><?=$j;?></td> 							
	<td class="use_border" align="right" valign="middle"> </td> 							
	<td class="use_border" colspan ="3" align="left" valign="middle">PENDAPATAN</td>							
	<td class="use_border" align="right" valign="middle"><?=convert_rupiah_non_rp($row_kas_awal->DEBET);?></td>							
	<td class="use_border" align="right" valign="middle"><?=convert_rupiah_non_rp($row_kas_awal->JUMLAH_KAS_AWAL);  ?></td>							 						
</tr>							
<?php //if (isset($row->DEBET)){$sum_debet[]=$row->DEBET;}?>							
<?php //if (isset($row->KREDIT)){$sum_kredit[]=$row->KREDIT;}?>						
<tr class="border">													
	<td class="use_border" colspan="5" align="left"><b>JUMLAH : </b></td>							
	<td class="use_border" align="right"><b><?php if (isset($row->DEBET)){echo convert_rupiah_non_rp(array_sum($sum_debet)+$row_kas_awal->DEBET);} ?></b></td>							
	<td class="use_border" align="right"><b><?php if (isset($row->KREDIT)){echo ' ( '. convert_rupiah_non_rp(array_sum($sum_kredit)+$row_kas_awal->JUMLAH_KAS_AWAL);} ?> ) </b></td>							 						
</tr>						
<?php						
$jumlah_akhir_debet = array_sum($sum_debet)+$row_kas_awal->DEBET;						
$jumlah_akhir_kredit = array_sum($sum_kredit)+$row_kas_awal->JUMLAH_KAS_AWAL;						
?>						
<tr class="border">							
	<td class="use_border" colspan="6"></td>														
	<td class="use_border" align="right"><b><?php echo convert_rupiah_non_rp($jumlah_akhir_debet-$jumlah_akhir_kredit) ?></b></td>						
</tr>	</table></div>

