<?php ini_set("memory_limit","12M"); ?>
<link href="<?=base_url()?>asset/admin/css/style.css" rel="stylesheet" type="text/css">
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
<script type="text/javascript" >
	function report_excel(){
		document.getElementById("rekap_tabel1").value = document.getElementById("div_laporan").innerHTML;
		document.getElementById("myform").submit();
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

			  location.href = site+"/karyawan/pdf_lap_karyawan";
	}
	
		
		
</script>

<div id="tab-settings" class="tabs-content">
		<button type="button" onclick="report_pdf()"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">REKAP PDF</button>
		<button type="submit" onclick="report_excel()"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">REKAP EXCEL</button>
		
</div>	
<?php
	$attributes = array('class' => 'formccs', 'id' => 'myform', 'name'=> 'myform');	
	echo form_open('karyawan/report_excel', $attributes);
?>
<input name="rekap_tabel1" id="rekap_tabel1" type="hidden" value="rekap_tabel1" />
<div id="div_laporan">
<table class="laporan" width="90%" border="1">
		<tr><td colspan="9"><b>SAWERI GADING CELL</b></td></tr>
		<tr><td colspan="9"><b>JL. S PARMAN 18 BANYUWANGI</b></td></tr>
		<tr><td colspan="9"><b>TELP (0333)-411345</b></td></tr>
		<tr><td colspan="9"><b></b><br/></td></tr>
		<tr><td colspan="9" div align="center"><b>LAPORAN KARYAWAN</b></td></tr>
		<!--<tr><td colspan="9"><b>PERIODE : <?php //echo $periode_awal . ' s/d ' .  $periode_akhir; ?></b></td></tr>-->
		<tr><td colspan="9"><b>TANGGAL CETAK : <?php echo date('d-M-Y') ?></b></td></tr>
		<tr>
			<th align="left" valign="top" scope="col">Cabang</th>
			<th align="left" valign="top" scope="col">Kode Karyawan</th>
			<th align="left" valign="top" scope="col">Nama</th>
			<th align="left" valign="top" scope="col">Alamat</th>
			<th align="left" valign="top" scope="col">Telepon</th>
			<th align="left" valign="top" scope="col">Jenis Pengenal</th>
			<th align="left" valign="top" scope="col">No Pengenal</th>
			<th align="left" valign="top" scope="col">Status Karyawan</th>
			<th align="left" valign="top" scope="col">Point</th>
		</tr>
				
	
					
					<?php foreach($results->result() as $row) {?>
					<tr>
						<!--<td align="left" valign="top"><input name="id[]" id="id" value="<?=$row->id_karyawan?>" type="checkbox" /></td>-->
						<td align="left" valign="top"><?=$row->nama_cabang?> </td>
						<td align="left" valign="top"><?=$row->kode_karyawan?> </td>
						<td align="left" valign="top"><?=$row->nama?> </td>
						<td align="left" valign="top"><?=$row->alamat?> </td>
						<td align="left" valign="top"><?=$row->telp1?> </td>
						<td align="left" valign="top"><?=$row->jenis_pengenal?> </td>
						<td align="left" valign="top"><?=$row->no_pengenal?> </td>
						<td align="left" valign="top"><?=$row->status?> </td>
						<td align="left" valign="top"><?=$row->point?> </td>
					</tr>
					<?php } ?>
					

			
			</table>			
		</form>
</div>