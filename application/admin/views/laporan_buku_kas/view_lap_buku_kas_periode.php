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
			  location.href = site+"/laporan_buku_kas/report_pdf/"+periode_awal+'/'+periode_akhir;
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
	echo form_open('laporan_buku_kas/report_excel', $attributes);
?>	
<div id="div_laporan">
	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
	<input name="periode_awal" id="tanggal_awal" type="hidden" value="<?=$periode_awal;?>" />
	<input name="periode_akhir" id="tanggal_akhir" type="hidden" value="<?=$periode_akhir;?>" />
	
	<table class="laporan" width="90%" border="1">
		<tr><td colspan="10"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="10"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="10"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="10"><b></b><br/></td></tr>
		<tr><td colspan="10" div align="center"><b>LAPORAN BUKU KAS</b></td></tr>
		<tr><td colspan="10"><b>PERIODE : <?php echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>
		<tr><td colspan="10"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th scope="col">NO</th>
			<th scope="col">TANGGAL</th>
			<th scope="col">PO NOMER</th>			<th scope="col">KET</th>			<th scope="col">DEBET (Rp)</th>
						<th scope="col">KREDIT (Rp)</th>			<th scope="col">SALDO (Rp)</th>
		</tr>
		
		<?php
		$j=0;		$nama_supplier = null;		$hutang[] = 0;		$sum_debet[] = 0;		$sum_kredit[] = 0;				$var_saldo = 0;		$saldo = 0;		$qty_perbrg = 0;			//get_kas_awal			$row_kas_awal = $get_kas_awal->row(); 			$get_kas_awal=0-$row_kas_awal->JUMLAH_KAS_AWAL;			$j=$j+1;			?>						<tr>							<td align="right" valign="middle"><?=$j;?></td>							<td align="left" valign="middle"><?=convert_date_mysql_indo($row_kas_awal->TANGGAL);?></td>							<!--<td align="right" valign="middle"><?//=' '.$row_kas_awal->PO_NO . '(' . $row_kas_awal->GLID . ')';?></td>-->							<td align="right" valign="middle"><?=' '.$row_kas_awal->PO_NO;?></td>							<td align="left" valign="middle"><?=$row_kas_awal->KETERANGAN?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($row_kas_awal->DEBET);?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($row_kas_awal->JUMLAH_KAS_AWAL);  ?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($get_kas_awal);?></td>						</tr>			<?			$j=1;			foreach($results->result() as $row)			{				$j=$j+1;		?>						<tr>							<td align="right" valign="middle"><?=$j;?></td>							<td align="left" valign="middle"><?=convert_date_mysql_indo($row->TANGGAL);?></td>							<!--<td align="right" valign="middle"><?//=' '.$row->PO_NO . '(' . $row->GLID . ')' . '<' . $row->AKUNID . '>';?></td>-->							<td align="right" valign="middle"><?=' '.$row->PO_NO;?></td>							<td align="left" valign="middle"><?=$row->KETERANGAN?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($row->DEBET);?></td>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($row->KREDIT);  ?></td>							<?php								if ($saldo==0){									$saldo=$get_kas_awal;								}else{									$saldo=$saldo;								}								if ($row->DEBET==0) {									$saldo=$saldo-$row->KREDIT;								}else if ($row->KREDIT==0){									$saldo=$saldo+$row->DEBET;								}							?>							<td align="right" valign="middle"><?=convert_rupiah_non_rp($saldo);?></td>							<?php if (isset($row->DEBET)){$sum_debet[]=$row->DEBET;}?>							<?php if (isset($row->KREDIT)){$sum_kredit[]=$row->KREDIT;}?>												</tr>				<?php			}		?>			<tr>				<td colspan="4"><b>JUMLAH : </b></td>				<td align="right"><?php if (isset($row->DEBET)){echo convert_rupiah_non_rp(array_sum($sum_debet));} ?></td>				<td align="right"><?php if (isset($row->KREDIT)){echo convert_rupiah_non_rp(array_sum($sum_kredit));} ?></td>				<td align="right"><?php echo convert_rupiah_non_rp($saldo); ?></td>			</tr>
	</table>
</div>
</form>