<?php ini_set("memory_limit","32M"); ?>
<link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	function report_pdf(){
            var site = "<?php echo site_url()?>";
           /* $.ajax({
                url: site+"/laporan_pembelian/index",
                success: function(response){			
                $("#tab").html(response);
                },
            dataType:"html"  		
            });
            return false;*/
			var periode_awal=document.getElementById('tanggal_awal').value;
			var periode_akhir=document.getElementById('tanggal_akhir').value;
			  location.href = site+"/laporan_laba_rugi/report_pdf/"+periode_awal+'/'+periode_akhir;
	}
	
	function report_excel(){
		document.getElementById("rekap_tabel1").value = document.getElementById("div_laporan").innerHTML;
		document.getElementById("myform").submit();
	}
	
	
	function print(){
		/*<form>
		<input type="button" value="Print This Page" onClick="window.print()" />
		</form>*/
	}
	
	
</script>
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="report_pdf()"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">REKAP PDF</button>
					<button type="submit" onclick="report_excel()"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">REKAP EXCEL</button>
					
			</div>	
<?php
	$attributes = array('class' => 'formccs', 'id' => 'myform', 'name'=> 'myform');	
	echo form_open('laporan_laba_rugi/report_excel', $attributes);
?>	
<div id="div_laporan">
	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
	<input name="periode_awal" id="tanggal_awal" type="hidden" value="<?=$periode_awal;?>" />
	<input name="periode_akhir" id="tanggal_akhir" type="hidden" value="<?=$periode_akhir;?>" />
	
	<table class="laporan" width="90%" border="1">
		<tr><td colspan="6"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="6"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="6"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="6"><b></b><br/></td></tr>
		<tr><td colspan="6" div align="center"><b>LAPORAN LABA RUGI</b></td></tr>
		<tr><td colspan="6"><b>PERIODE : <?php echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>
		<tr><td colspan="6"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th scope="col">&nbsp; &nbsp; &nbsp; &nbsp; AKUNID&nbsp; &nbsp; &nbsp; </th>						<th scope="col">KETERANGAN</th>			<th scope="col">Jurnal ID</th>			<th scope="col">DEBET (Rp)</th>			<th scope="col">KREDIT (Rp)</th>
			<th scope="col">LABA RUGI (Rp)</th>
		</tr>
		<?php		$j=0;		
		$nama_supplier = null;		
		$hutang[] = 0;		
		$sum_debet[] = 0;		
		$sum_kredit[] = 0;				
		$var_saldo = 0;		$saldo = 0;		
		$qty_perbrg = 0;  			
		?>			
		<tr>							
		<td>								
		56000							
		</td>							<td>								HPP							
		</td>							<td>								
		<?php									
		$row_pembelian=$results_pembelian->row();									
		$row_kas_awal=$results_kas_awal->row()?$results_kas_awal->row():0;									
		$row_kas_awal_pembelian=$results_kas_awal_pembelian->row();								
		$row_refund=$results_total_refund->row();									
		$row_diskon=$results_total_diskon->row();
		$row_kas_awal_pembelian_total=$row_kas_awal_pembelian?$row_kas_awal_pembelian:0;
		/*									echo convert_rupiah_non_rp($row_pembelian->total_pembelian) . ' ';									
		echo convert_rupiah_non_rp($row_kas_awal->kas_awal). ' ';									
		echo convert_rupiah_non_rp($row_kas_awal_pembelian->total_kas_awal_pembelian). ' ';									
		echo convert_rupiah_non_rp($row_refund->refund_debet) . ' ';									
		echo convert_rupiah_non_rp($row_diskon->total_diskon) . ' ';*/								
		?>							</td>															
		<td></td>							<td></td>							<td>
		<?php								
		echo convert_rupiah_non_rp(($row_kas_awal->kas_awal+$row_kas_awal_pembelian_total) + 
		$row_pembelian->total_pembelian - $row_refund->refund_debet - $row_diskon->total_diskon);
		?></td>						
		</tr>			
		<?php			foreach($results->result() as $row)			{				
		$j=$j+1;			?>						<tr>													
		<?php  if ( ($row->AKUNID[0]!= 0) && ($row->AKUNID[1]== 0) && ($row->AKUNID[2]== 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0) ) {	
		echo '<td align="left" valign="middle">' . $row->AKUNID. '</td>';							
		}else if( ($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]== 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0)){ 													echo '<td align="left" valign="middle">' . $row->AKUNID . ' </td>';							}else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]== 0) && ($row->AKUNID[4]== 0)){								echo '<td align="left" valign="middle">&nbsp; &nbsp; ' . $row->AKUNID .' </td>';							}else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]!= 0) && ($row->AKUNID[4]== 0)){								echo '<td align="left" valign="middle">&nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID .' </td>';							}else if(($row->AKUNID[0]!= 0) && ($row->AKUNID[1]!= 0) && ($row->AKUNID[2]!= 0) && ($row->AKUNID[3]!= 0) && ($row->AKUNID[4]!= 0)){								echo '<td align="left" valign="middle">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row->AKUNID .' </td>';							}							?>							<td align="left" valign="middle"><?=$row->NAKUN?></td>							<td align="right" valign="middle"><?=' '.$row->PO_NO;?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($row->DEBET);?></td>							
		<td align="right" valign="middle"><?=convert_rupiah_non_rp($row->KREDIT);  ?></td>							<td></td>							<?php							/*								if ($saldo==0){									$saldo=$get_kas_awal;								}else{									$saldo=$saldo;								}								if ($row->DEBET==0) {									$saldo=$saldo-$row->KREDIT;								}else if ($row->KREDIT==0){									$saldo =$saldo + $row->DEBET;								}*/															?>																					<?php if (isset($row->DEBET)){$sum_debet[]=$row->DEBET;}?>							<?php if (isset($row->KREDIT)){$sum_kredit[]=$row->KREDIT;}?>							</tr>			<?php			}			?>																	 								<tr>							<td colspan="3"><b>JUMLAH : </b></td>							<td align="right"><b><?php if (isset($row->DEBET)){echo convert_rupiah_non_rp(array_sum($sum_debet));} ?></b></td>							<td align="right"><b><?php if (isset($row->KREDIT)){echo convert_rupiah_non_rp(array_sum($sum_kredit));} ?></b></td>							<td align="right"><b><?php if (isset($row->KREDIT)){echo convert_rupiah_non_rp(array_sum($sum_debet) - array_sum($sum_kredit));} ?></b></td>							 						</tr>						<tr><td colspan="6">&nbsp;</td></tr>									
		<?php			/*$get_kas_awal=$row_kas_awal->JUMLAH_KAS_AWAL;			*/
			$j=$j+1;				
			foreach($results_pendapatan->result() as $row_pendp){			?> 			
		<tr>							
		<?php  if ( ($row_pendp->AKUNID[0]!= 0) && ($row_pendp->AKUNID[1]== 0) && ($row_pendp->AKUNID[2]== 0) && 
			($row_pendp->AKUNID[3]== 0) && ($row_pendp->AKUNID[4]== 0) ) {
			echo '<td align="left" valign="middle">' . $row_pendp->AKUNID. '</td>';							
			}else if( ($row_pendp->AKUNID[0]!= 0) && ($row_pendp->AKUNID[1]!= 0) && ($row_pendp->AKUNID[2]== 0) && ($row_pendp->AKUNID[3]== 0) && ($row_pendp->AKUNID[4]== 0)){
			echo '<td align="left" valign="middle">' . $row_pendp->AKUNID . ' </td>';							
			}else if(($row_pendp->AKUNID[0]!= 0) && ($row_pendp->AKUNID[1]!= 0) && ($row_pendp->AKUNID[2]!= 0) && 
			($row_pendp->AKUNID[3]== 0) && ($row_pendp->AKUNID[4]== 0)){								
			echo '<td align="left" valign="middle">&nbsp; &nbsp; ' . $row_pendp->AKUNID .' </td>';							
			}else if(($row_pendp->AKUNID[0]!= 0) && 
			($row_pendp->AKUNID[1]!= 0) && ($row_pendp->AKUNID[2]!= 0) && ($row_pendp->AKUNID[3]!= 0) && ($row_pendp->AKUNID[4]== 0)){
			echo '<td align="left" valign="middle">&nbsp; &nbsp; &nbsp; &nbsp; ' . $row_pendp->AKUNID .' </td>';							
			}else if(($row_pendp->AKUNID[0]!= 0) && ($row_pendp->AKUNID[1]!= 0) && ($row_pendp->AKUNID[2]!= 0) && ($row_pendp->AKUNID[3]!= 0) && ($row_pendp->AKUNID[4]!= 0)){
			echo '<td align="left" valign="middle">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $row_pendp->AKUNID .' </td>';							
			}							?>							<td align="left" valign="middle"><?=$row_pendp->NAKUN?></td>							
			<td align="right" valign="middle"><?=' '.$row_pendp->PO_NO;?></td>							
			<td align="right" valign="middle"><?=convert_rupiah_non_rp($row_pendp->DEBET);?></td>							
			<td align="right" valign="middle"><?=convert_rupiah_non_rp($row_pendp->KREDIT);  ?></td>							
			<td></td>													
			<?php if (isset($row_pendp->DEBET)){$sum_debet_pendp[]=$row_pendp->DEBET;}?>							
			<?php if (isset($row_pendp->KREDIT)){$sum_kredit_pendp[]=$row_pendp->KREDIT;}?>							
			<?php							
			
			/*								if ($saldo==0){									$saldo=$get_kas_awal;								
			}else{									$saldo=$saldo;								
			}								if ($row->DEBET==0) {									
			$saldo=$saldo-$row->KREDIT;								}else if ($row->KREDIT==0){									
			$saldo =$saldo + $row->DEBET;								}*/				
					}?>					
						<tr>						
			<td colspan="3"><b>JUMLAH : </b></td>						
			<td align="right"><b><?php if (isset($row_pendp->DEBET)){echo convert_rupiah_non_rp(array_sum($sum_debet_pendp));} ?></b></td>						
			<td align="right"><b><?php if (isset($row_pendp->KREDIT)){echo convert_rupiah_non_rp(array_sum($sum_kredit_pendp));} ?></b></td>						
			<td align="right"><b><?php if (isset($row_pendp->KREDIT)){							
			$hasil_pendp=array_sum($sum_debet_pendp) - array_sum($sum_kredit_pendp);							
			if ($hasil_pendp < 0){								$positive =  abs($hasil_pendp);								
			echo '(' . convert_rupiah_non_rp($positive) . ')';							
			}else{								echo convert_rupiah_non_rp($hasil_pendp);							
			}														} ?></b></td>						 					
			</tr>					<tr><td colspan="6">&nbsp;</td></tr>
	</table>	<br/><br/><br/><br/>
</div>
</form>