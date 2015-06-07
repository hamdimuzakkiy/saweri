<?php ini_set("memory_limit","12M"); ?>
<link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	
	function set_barang(id, nama, harga){
		document.getElementById('detail_idbarang').value = id;	
		document.getElementById('detail_namabarang').value = nama;
		document.getElementById('detail_harga').value = harga;
		document.getElementById('detail_qty').value = '1';
		
		$.fancybox.close();
	}
	
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
			  location.href = site+"/laporan_penjualan/report_pdf/"+periode_awal+'/'+periode_akhir;
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
	echo form_open('laporan_penjualan/report_excel', $attributes);
?>	
<div id="div_laporan">
	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
	<input name="periode_awal" id="tanggal_awal" type="hidden" value="<?=$periode_awal;?>" />
	<input name="periode_akhir" id="tanggal_akhir" type="hidden" value="<?=$periode_akhir;?>" />
	
	<table class="laporan" width="90%" border="1">
		<tr><td colspan="11"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="11"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="11"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="11"><b></b><br/></td></tr>
		<tr><td colspan="11" div align="center"><b>LAPORAN PENJUALAN</b></td></tr>
		<tr><td colspan="11"><b>PERIODE : <?php echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>
		<tr><td colspan="11"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th scope="col">NO</th>
			<th scope="col">TANGGAL </th>
			<th scope="col">SO NOMER</th>
			<th scope="col">PELANGGAN</th>
			<th scope="col">CABANG</th>
			<th scope="col">JATUH TEMPO</th>
			<th scope="col">QTY</th>
			<th scope="col">JUMLAH</th>
			<th scope="col">DISC (%)</th>
			<th scope="col">TAX</th>
			<th scope="col">RUPIAH</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr>
					<td align="right" valign="middle"><?=$j;?></td>
					<td align="left" valign="middle"><?=$row->tanggal?></td>
					<td align="right" valign="middle"><?=' '.$row->so_no?></td>
					<td align="left" valign="middle"><?=$row->nama_pelanggan?></td>
					<td align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td align="right" valign="middle"><?=$row->jatuh_tempo?></td>
					<td align="right" valign="middle"><?=$row->qty?></td>
					<td align="right" valign="middle"><?=$this->fungsi->uangindo($row->total_harga);?></td>
					<td align="right" valign="middle"><?=$row->diskon;?></td>
					<td align="left" valign="middle">&nbsp; </td>
					<td align="right" valign="middle">
					<?php 
						$jmldiskon=(($row->total_harga)-($row->total_harga*$row->diskon)/100);
						$arrjmldiskon[]=$jmldiskon;
						echo $this->fungsi->uangindo($jmldiskon);
						
					?>
					</td>
					<?php if (isset($row->total_harga)){$sum_total[]=$row->total_harga;}?>
					<?php if (isset($row->total_harga)){$sum_qty[]=$row->qty;}?>
				</tr>
		<?php
			}
		?>
			<tr><td colspan="6"><b>JUMLAH : </b></td><td align="right"><b><?php if (isset($row->total_harga)){echo array_sum($sum_qty);} ?></b></td>
			<td align="right"><b><?php if (isset($row->total_harga)){echo $this->fungsi->uangindo(array_sum($sum_total));} ?></b></td>
			<td colspan="2"></td><td align="right"><b><?php if (isset($row->total_harga)){ echo $this->fungsi->uangindo(array_sum($arrjmldiskon)); } ?></b></td></tr>
	</table>
</div>
</form>