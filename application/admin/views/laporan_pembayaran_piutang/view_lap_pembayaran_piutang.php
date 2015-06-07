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
			  location.href = site+"/laporan_pembayaran_piutang/report_pdf/"+periode_awal+'/'+periode_akhir;
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
	echo form_open('laporan_pembayaran_piutang/report_excel', $attributes);
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
		<tr><td colspan="10" div align="center"><b>LAPORAN PEMBAYARAN PIUTANG</b></td></tr>
		<tr><td colspan="10"><b>PERIODE : <?php echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>
		<tr><td colspan="10"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th scope="col">NO</th>
			<th scope="col">TANGGAL</th>						<th scope="col">TANGGAL PIUTANG</th>			<th scope="col">REF PIUTANG</th>
			<th scope="col">PO NOMER</th>						<th scope="col">KET</th>
			<th scope="col">PEMBELI</th>
			<th scope="col">PENJUAL</th>			<th scope="col">PEMBAYARAN</th>						<th scope="col">PIUTANG (Rp)</th>
						<th scope="col">BAYAR (Rp)</th>
		</tr>
		
		<?php
		$j=0;		$piutang[] = 0;			foreach($results->result() as $row)			{																		$query2=$this->db->query("SELECT sum(angsuran_piutang.ANGSURAN) as total_bayar FROM (`angsuran_piutang`) WHERE `angsuran_piutang`.GLID='" . $row->GLID . "'");							$value=$query2->row();						if ($value->total_bayar!=0){							$total_bayar=$value->total_bayar;						}else{							$total_bayar=0; 						}				$j=$j+1;		?>				<tr>					<td align="right" valign="middle"><?=$j;?></td>					<td align="left" valign="middle"><?=convert_date_mysql_indo($row->tanggal);?></td>					<td align="left" valign="middle"><?=convert_date_mysql_indo($row->tanggal_piutang);?></td>					<td align="right" valign="middle"><?=$row->GLID;?></td>					<td align="right" valign="middle"><?=' '.$row->so_no;?></td>					<td align="left" valign="middle"><??></td>					<td align="left" valign="middle"><?=$row->nama_pelanggan?></td>					<td align="right" valign="middle"><?=$row->nama_cabang;?></td>					<td align="center" valign="middle"><?=$row->pembayaran?></td>					<td align="right" valign="middle"><?=convert_rupiah_non_rp($row->total);?></td>										<td align="right" valign="middle"><?=convert_rupiah_non_rp($total_bayar);?></td>					<?php if (isset($row->total)){$sum_piutang[]=$row->total;}?>					<?php if (isset($total_bayar)){$sum_bayar[]=$total_bayar;}?>				</tr>		<?php			}					?>			<tr>				<td colspan="9"><b>JUMLAH : </b></td>				<td align="right"><?php if (isset($row->total)){echo convert_rupiah_non_rp(array_sum($sum_piutang));} ?></td>				<td align="right"><?php if (isset($total_bayar)){echo convert_rupiah_non_rp(array_sum($sum_bayar));} ?></td>			</tr>
	</table>
</div>
</form>