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
			
			myForm = document.getElementById('myform');
			// open a *BLANK* WINDOW!!!!
			
			// save form info:
			var saveTarget = myForm.target;
			var saveAction = myForm.action;
			var saveMethod = myForm.method; // not needed if already post
			// change form info:
			myForm.target = 'report_pdf';
			myForm.action = "<?=site_url();?>/laporan_penjualan/pdf_lap_point_karyawan";
			myForm.method = "post"; // not needed if <form> was already post
			myForm.submit( );  // invoke the form, submitting to the popup window

			// restore form:
			myForm.target = saveTarget;
			myForm.action = saveAction;
			myForm.method = saveMethod; // if used

			return true ; // why does this matter? ordinary buttons ignore return value
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
	echo form_open('laporan_penjualan/view_lap_point_karyawan/v_excel', $attributes);
	

?>	
<div id="div_laporan">
	<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
	<?php
		$i=0;
		foreach ($kode_karyawan as $nama){
			echo "<input type='hidden' id='nama' name='nama[$i]' value='" . $nama . "' checked />";
			$i++;
		}
	?>
	
	<table class="laporan" width="90%" border="1">
		<tr><td colspan="7"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="7"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="7"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="7"><b></b><br/></td></tr>
		<tr><td colspan="7" div align="center"><b>LAPORAN POINT KARYAWAN</b></td></tr>
		<tr><td colspan="7"><b>PERIODE : <?php // echo $this->fungsi->dateindo3('-',$periode_awal) . ' S/D ' .  $this->fungsi->dateindo3('-',$periode_akhir); ?></b></td></tr>
		<tr><td colspan="7"><b>TANGGAL CETAK : <?php echo $this->fungsi->dateindo3('-',date('Y-m-d')) ?></b></td></tr>
		<tr>
			<th scope="col">NO</th>
			<th scope="col">KODE KARYAWAN </th>
			<th scope="col">NAMA</th>
			<th scope="col">CABANG</th>
			<th scope="col">ALAMAT</th>
			<th scope="col">TELEPON</th>
			<th scope="col">POINT</th>
		</tr>
		
		<?php
		$j=0;
			foreach($results->result() as $row)
			{
				$j=$j+1;
		?>
				<tr>
					<td align="right" valign="middle"><?=$j;?></td>
					<td align="left" valign="middle"><?=$row->kode_karyawan?></td>
					<td align="left" valign="middle"><?=$row->nama?></td>
					<td align="left" valign="middle"><?=$row->nama_cabang?></td>
					<td align="left" valign="middle"><?=$row->alamat?></td>
					<td align="left" valign="middle"><?=$row->telp1?></td>
					<td align="right" valign="middle"><?php echo $row->point;?></td>
					<?php if (isset($row->point)){$sum_total[]=$row->point;}?>
				</tr>
		<?php
			}
		?>
			<tr>
				<td colspan="6"><b>JUMLAH : </b></td><td align="right"><b><?php if (isset($row->point)){ echo array_sum($sum_total); } ?></b></td>
			</tr>
	</table>
</div>
</form>