<script type="text/javascript">
	
	$(document).ready(function() {
		$("#getcustomer").fancybox();
		$('.itembarang').attr('disabled', true);
		$('.itembarang').attr('checked', false);
	});
	
	function change_customer(value){
		document.getElementById('getcustomer').href = '<?=base_url().'index.php/penukaran_point/get_customer/'?>' + value
	}
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/penukaran_point'?>';
	}
	
	function changetotal(id){
		document.getElementById('detail_total'+id).value = parseInt(document.getElementById('detail_point_barangpoint'+id).value) * parseInt(document.getElementById('detail_qty'+id).value);
		document.getElementById('detail_divtotal'+id).innerHTML = document.getElementById('detail_total'+id).value;
		
		var x=0;
		var total=0;
		for (var i=0;i < document.form1.elements.length;i++)
		{
			var e = document.form1.elements[i];
			
			if (e.type == 'checkbox')
			{
				if(e.checked){
					total = total + parseInt(document.getElementById('detail_total'+x).value)
				}
				x=x+1;
			}
			
		}
		
		document.getElementById('pointtukar').value = total;
		document.getElementById('pointsisa').value = parseInt(document.getElementById('input_point').value) - total;
		
		//document.getElementById('pointsisa').type="hidden"
	}
	
	function check_enable(id){
		if(document.getElementById('detail_idbarang'+id).checked){
			document.getElementById('detail_qty'+id).type = 'text';
			$('#detail_qty' + id).show();
		}else{
			document.getElementById('detail_qty'+id).type = 'hidden';
			document.getElementById('detail_qty'+id).value = '0';
			document.getElementById('detail_total'+id).value = '0';
			document.getElementById('detail_divtotal'+id).innerHTML = '0';
		}	
		changetotal(id);
	}
	
</script>

	<?php 
		if(validation_errors())
		{
	?>
			<ul class="message error grid_12">
				<li><?=validation_errors()?></li>
				<li class="close-bt"></li>
			</ul>	
	<?php
		} 
	?>

<section class="grid_10">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('penukaran_point/insert', $attributes);
		?>
			<h1>Penjualan > Tambah Data Penukaran Point</h1>
			
			<fieldset>
				
				
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Pelanggan / Karyawan :</label>
						<span class="relative">
							<select name="jeniscustomer" id="jeniscustomer" onchange="javascript:change_customer(this.value)">
								<option value="pelanggan">Pelanggan</option>
								<option value="karyawan">Karyawan</option>
							</select>
							<a id="getcustomer" href="<?=base_url().'index.php/penukaran_point/get_customer/pelanggan'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
						</span>
					</p>
				</div>
					
				<div class="columns">
					<table class="table" border="1" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th scope="col">Nama Pelanggan/Karyawan</th>
								<th scope="col">Membership Expired</th>
								<th scope="col">Jumlah Point</th>
							</tr>
							<tr>
								<td>
									<div id="div_customer"></div>
									<input type="hidden" name="input_tipe" id="input_tipe">
									<input type="hidden" name="input_id" id="input_id">
									<input type="hidden" name="input_customer" id="input_customer">
								</td>
								<td>
									<div id="div_expired"></div>
									<input type="hidden" name="input_expired" id="input_expired">
								</td>
								<td>
									<div id="div_point"></div>
									<input type="hidden" name="input_point" id="input_point">
								</td>
							</tr>
						</thead>						
						<tbody id="detail">
						</tbody>
					</table>
				</div>			
						<label for="complex-en-url">Pilihan Barang :</label>
							<table class="table" border="1" cellspacing="0" width="100%">
							
								<thead>
									<tr>
										<th> </th>
										<th  scope="col">No</th>
										<th  scope="col">Nama Barang</th>
										<th  onkeyup="javascript:total()" scope="col">Point Kredit</th>
										<th  onkeyup="javascript:total()" scope="col">Qty</th>
										<th  readonly="true" scope="col">Total Point</th>								
									</tr>
								</thead>
								
								<tbody id="detail">
									<?php
										$this->db->flush_cache();
										$this->db->select('*');
										$this->db->from('barang');
										$this->db->where('id_jenis', '3');
										$query = $this->db->get();
										
										$i=0;
										foreach($query->result() as $row){
											echo 	'
														<tr>
															<td>
																<input id="detail_idbarang'.$i.'" name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" type="checkbox" class="itembarang" onclick="javascript:check_enable(\''.$i.'\')"/>
															</td>
															<td>'.($i+1).'</td>
															<td>'.$row->nama_barang.'</td>
															<td>'.$row->point_barangpoint.'</td>
																	<input id="detail_point_barangpoint'.$i.'"name="detail['.$i.'][point_barangpoint]" type="hidden" value="'.$row->point_barangpoint.'">
															<td>
																	<input id="detail_qty'.$i.'" name="detail['.$i.'][qty]" class="itemqty" value="0" type="hidden" size="3" onkeyup="javascript:changetotal(\''.$i.'\')">
															</td>
															<td>	<div id="detail_divtotal'.$i.'">0</div>
																	<input id="detail_total'.$i.'" name="detail['.$i.'][total]" type="hidden" size="3" value="0">
															</td>
														</tr>
													';
											$i++;
										}
									?>
								</tbody>
							</table>
							<br></br>
				
							<div class="columns">
								<p class="colx3-left">
									<label for="complex-en-url">Total point yang akan ditukar :</label>
									<span class="relative">
										<input type="text" name="pointtukar" id="pointtukar" value="0" >
									</span>
								</p>
								<p class="colx3-center">
									<label for="complex-en-url">Sisa Point :</label>
									<span class="relative">
										<input type="text" name="pointsisa" id="pointsisa" value="0" >
									</span>
								</p>
							</div>				
				
				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>		
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 					
			</div>
			
		</form>
	</div>
</section>