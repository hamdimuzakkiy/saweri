<?php
	# Jenis penjualan
	# 1. Cabang
	# 2. Toko
	# 3. Partai

	//echo '<input name="jenis" value="'.$jenis.'" type="hidden" />';
	
	$i=0;
	$readonly = '';
	
	foreach($query->result() as $row)
	{
		//$harga = 0;
		/*$readonly = '';

		if($row->is_hargajual == '0')
		{
			$readonly = 'readonly = "readonly"';
		}*/
		$harga = $row->harga_cabang;
		
	
		/*if($row->is_hargatoko == '0')
		{
			$readonly = 'readonly = "readonly"';
		}
		$harga = $row->harga_toko;
	
		if($row->is_hargapartai == '0')
		{
			$readonly = 'readonly = "readonly"';
		}
		$harga = $row->harga_partai;*/
	}
	echo	
				'
					<tr class="penjualantemp">
						<td>'.($i + 1).'</td>
							<input name="items['.$i.'][id_barang]" value="'.$row->id_barang.'" type="hidden"  />
							<input name="items['.$i.'][nama_barang]" value="'.$row->nama_barang.'" type="hidden"  />
							<input name="items['.$i.'][sn]" value="'.$row->sn.'" type="hidden"  />	
							<input name="items['.$i.'][satuan]" value="'.$row->satuan.'" type="hidden"  />	

						<td><input name="items['.$i.'][id_detail_pembelian]" value="'.$row->id_detail_pembelian.'" type="checkbox" /></td>
						<td>'.$row->nama_barang.'</td>
						<td><input style = "width:100%;" id="harga" name="items['.$i.'][harga]" value="'.$harga.'" type="text" '.$readonly.' /></td>												
						<td>'.$row->satuan.'</td>
						<td><input style = "width:100%;" id="qty" name="items['.$i.'][qty]" value="'.$row->qty.'" type="text" '.$readonly.' /></td>
						<td><input style = "width:100%;" id="diskon" name="items['.$i.'][diskon]" value="'.$row->diskon.'" type="text" '.$readonly.' /></td>
						<td id="total">'.$row->harga_cabang.'</td>
					</tr>
				'
				;
		//$i++;

	echo '
	<script>
	$(document).ready(function()
	{
				$("#harga").change(function(){
	    			var harga = parseInt($("#harga.").val());
	    			var qty = parseInt($("#qty").val());
	    			var diskon = parseInt($("#diskon").val()) / 100;
	    			var total = harga*qty*diskon;
	    			$("#total").html(total);
    			});
	}
	);
	</script>	';
?>