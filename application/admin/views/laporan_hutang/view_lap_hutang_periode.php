<?php ini_set("memory_limit","12M"); ?>
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
			  location.href = site+"/laporan_hutang/report_pdf/"+periode_awal+'/'+periode_akhir;
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
	echo form_open('laporan_hutang/report_excel', $attributes);
?>	<div id="div_laporan">	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />	<input name="periode_awal" id="tanggal_awal" type="hidden" value="<?=$periode_awal;?>" />	<input name="periode_akhir" id="tanggal_akhir" type="hidden" value="<?=$periode_akhir;?>" />		<table class="laporan" width="90%" border="1">		<tr><td colspan="10"><b>SAWERI GADING CELL</b></td></tr>		<tr><td colspan="10"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>		<tr><td colspan="10"><b>TELP (0333)-411345</b></td></tr>		<tr><td colspan="10"><b></b><br/></td></tr>		<tr><td colspan="10" div align="center"><b>LAPORAN HUTANG</b></td></tr>		<tr><td colspan="10"><b>PERIODE : <?php echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>		<tr><td colspan="10"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>		<tr>			<th scope="col">NO</th>			<th scope="col">TANGGAL</th>			<th scope="col">PO NOMER</th>						<th scope="col">KET</th>			<th scope="col">JATUH TEMPO</th>			<th scope="col">PEMBELI</th>			<th scope="col">PENJUAL</th>			<th scope="col">TOTAL HUTANG (Rp)</th>						<th scope="col">ANGSURAN (Rp)</th>			<th scope="col">SISA (Rp)</th>		</tr>				<?php		$j=0;		$nama_supplier = null;		$array_total_hutang[] = 0;		$array_total_semua_hutang[] = 0;		$array_total_semua_angsuran[] = 0;		$array_total_semua_sisa[] = 0;		$sum_angsuran = 0;		$sum_sisa = 0;				$var_angsuran = 0;		$var_sisa = 0;		$qty_perbrg = 0;			foreach($results->result() as $row)			{				$j=$j+1;										if ($nama_supplier==null){					$nama_supplier=$row->id_supplier;												$total_hutang=($row->hutang + $row->saldo_hutang) - $sum_sisa;						$array_total_hutang[] = $total_hutang;										$array_total_semua_hutang[] = $total_hutang;										$counter_numb_supplier = 0;							unset($array_total_hutang);					}else{					$counter_numb_supplier++;							}								if($row->id_supplier!= $nama_supplier){							?>					<tr class="rowjumlah">						<td colspan="1"></td>						<td colspan="6">Jumlah</td>						<td align="right"><?php echo convert_rupiah_non_rp(array_sum($array_total_hutang)) ;?></td>						<td align="right"><?php echo convert_rupiah_non_rp($var_angsuran);?></td>						<td align="right"><?php echo convert_rupiah_non_rp($var_sisa);?></td>					</tr>					<?php									$qty_perbrg=0;						$nama_supplier=$row->id_supplier;						$var_angsuran=0;						$var_sisa=0;												$counter_numb_supplier = 0;								unset($array_total_hutang);									}														$query = $this->db->query("SELECT angsuran_hutang.GLID,  							angsuran_hutang.TOTAL as total,							sum(angsuran_hutang.ANGSURAN) as angsuran, (pembelian.total-sum(angsuran_hutang.ANGSURAN)) as sisa 							FROM (`angsuran_hutang`) 							JOIN `daftar_hutang` ON `daftar_hutang`.`GLID` = `angsuran_hutang`.`GLID` 							JOIN `pembelian` ON `daftar_hutang`.`po_no` = `pembelian`.`po_no` 							WHERE  `angsuran_hutang`.GLID='" . $row->GLID . "' group by `angsuran_hutang`.`GLID`");				foreach($query->result() as $row_angsuran)				{					$sum_angsuran=$row_angsuran->angsuran;									}				if ($counter_numb_supplier==0){					$total_hutang=($row->hutang + $row->saldo_hutang);							$saldo_hutang = $row->saldo_hutang;					$array_total_hutang[] = $total_hutang;														}else{					$total_hutang=$row->hutang;							$saldo_hutang =0;							$array_total_hutang[] = $total_hutang;																}								$sum_sisa=$total_hutang - $sum_angsuran ;				$array_total_semua_hutang[] = $total_hutang;		?>				<tr>					<td align="right" valign="middle"><?=$j . '-' . $counter_numb_supplier?></td>					<td align="left" valign="middle"><? if ($row->TANGGAL) echo convert_date_mysql_indo($row->TANGGAL); else echo '';?></td>					<td align="right" valign="middle"><?=' '.$row->po_no;?></td>					<td align="left" valign="middle"><?=$row->KET_TRANSASKSI?></td>					<td align="left" valign="middle"><??></td>					<td align="left" valign="middle"><?=$row->nama_cabang;?></td>					<td align="right" valign="middle"><?=$row->nama_supplier;?></td>					<td align="right" valign="middle"><?php echo convert_rupiah_non_rp($total_hutang);?></td>					<td align="right" valign="middle"><?=convert_rupiah_non_rp($sum_angsuran);  ?></td>					<td align="right" valign="middle"><?=convert_rupiah_non_rp($sum_sisa);  ?></td>					<?php if (isset($row->hutang)){$sum_hutang[]=$total_hutang;}?>					<?php if (isset($row->hutang)){$all_sum_angsuran[]=$sum_angsuran;}?>					<?php if (isset($row->hutang)){$all_sum_sisa[]=$sum_sisa;}?>				</tr>		<?php					$array_total_semua_angsuran[] = $sum_angsuran;					$array_total_semua_sisa[] = $sum_sisa;										$var_angsuran=$var_angsuran+$sum_angsuran;										$var_sisa=$var_sisa+$sum_sisa;					$sum_angsuran=0;					$sum_sisa=0;										}					?>						<tr class="rowjumlah">						<td colspan="7">Jumlah : </td>						<td align="right"><?=convert_rupiah_non_rp(array_sum($array_total_hutang))?></td>						<td align="right"><?=convert_rupiah_non_rp($var_angsuran=$var_angsuran+$sum_angsuran)?></td>						<td align="right"><?=convert_rupiah_non_rp($var_sisa=$var_sisa+$sum_sisa)?></td>				</tr>			<tr>				<td colspan="7"><b>JUMLAH : </b></td>				<td align="right"><?php echo convert_rupiah_non_rp(array_sum($array_total_semua_hutang)); ?></td>				<td align="right"><?php echo convert_rupiah_non_rp(array_sum($array_total_semua_angsuran)); ?></td>				<td align="right"><?php echo convert_rupiah_non_rp(array_sum($array_total_semua_sisa)); ?></td>			</tr>	</table></div>
</form>