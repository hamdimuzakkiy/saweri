<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/pembelian'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})
	
	function save_data(){
		
		var isi = document.getElementById('detail').innerHTML;

		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
			//alert('kosong');
			$('html, body').stop().animate({
				scrollTop: 0 //$($anchor.attr('href')).offset().top
			}, 700, 'easeInOutExpo');
		}else{
			document.getElementById('alert_yanto').innerHTML = '';
			//alert('berisi');
			document.forms["form1"].submit();
		}
		
	}
	
</script>

<script type="text/javascript">
	function hutang()
	{
		var cek = document.getElementById('cara_bayar').value;
		if (cek =='2')	
			document.getElementById('pembelian_jatuh_tempo').style.display = 'block';				
		else 
			document.getElementById('pembelian_jatuh_tempo').style.display = 'none';
	}
	
	function ATM()
	{	
		var cek = document.getElementById('cek_atm').checked;
			
		if (cek == true)
			document.getElementById('atm').style.display = 'block';
		else 
			document.getElementById('atm').style.display = 'none';
	}

	$(document).ready(function() {
		$("#getbarang").fancybox();
	});
	
	
	function set_detail(){
		
		if(document.getElementById('detail_namabarang').value == ''){
			alert('Isi nama barang terlebih dahulu.');
		}else{
			$.ajax({
				type: 'POST',
				url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=add_1'?>',
				data: $('#form1').serialize(),
				success: function(data) {
					$('#detail').html(data);
				}
			});
			
			document.getElementById('detail_idbarang').value = '';	
			document.getElementById('detail_namabarang').value = '';
			document.getElementById('detail_harga').value = '';
			document.getElementById('detail_harga_toko').value = '';
			document.getElementById('detail_harga_partai').value = '';
			document.getElementById('detail_harga_cabang').value = '';
			document.getElementById('detail_qty').value = '';
			document.getElementById('detail_jatuh_tempo').value = '';
		}
	}
	
	function remove_detail(id){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_pembelian.php?command=remove&id='?>'+id,
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});
		
	}

		function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
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
	
<div id="alert_yanto"></div><br>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('pembelian/process_update', $attributes);
		?>
			<h1>Pembelian > Edit Data Pembelian</h1>
			
			<fieldset class="grey-bg margin">
				
				
				<div class="columns">
					<input type="hidden" name="id_pembelian" id="id_pembelian" value="<?=$result->row()->id_pembelian?>">
					<p class="colx3-left">
						<label for="complex-en-url">PO No :</label>
						<span class="relative">
							<input type="text" name="po_no" id="po_no" value="<?=$result->row()->po_no?>">
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Cabang :</label>
						<span class="relative">
							<select name="id_cabang" id="id_cabang" >
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($result->row()->id_cabang == $row->id_cabang){
												echo '<option value="'.$row->id_cabang.'" selected="selected">'.$row->nama_cabang.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>	
					<p class="colx3-right">
						<label for="complex-en-url">Tanggal Pembelian :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=$result->row()->tanggal?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Supplier :</label>
						<span class="relative">
							<select name="id_supplier" id="id_supplier" >
								<?php
									$query = $this->db->get('supplier');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($result->row()->id_supplier == $row->id_supplier){
												echo '<option value="'.$row->id_supplier.'" selected="selected">'.$row->kode_supplier.'-'.$row->nama.'</option>';
											}else{
												echo '<option value="'.$row->id_supplier.'">'.$row->kode_supplier.'-'.$row->nama.'</option>';
											}
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Diskon (%) :</label>
						<span class="relative">
							<input type="text" name="diskon" id="diskon" value="<?=$result->row()->diskon?>" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">ATM :</label>
						<span class="relative">
							<input type="checkbox" onclick="javascript:ATM();" id = "cek_atm"><br>
						</span>
					</p>
				</div>
				<div class="columns">												
					<p class="colx3-left">						
						<label for="complex-en-url">Cara Bayar :</label>						
						<span class="relative">
							<select name="cara_bayar" id="cara_bayar" onchange = "javascript:hutang();">								
							<option value="1">Tunai</option>								
							<option value="2">Hutang</option>							
						</select>						
					</span>			
					<span style = "display:none;" id="pembelian_jatuh_tempo">
					<label for="complex-en-url" >Jatuh Tempo :</label>
						<span class="relative">							
							<input type="text" name="pembelian_jatuh_tempo" value="<?=$result->row()->jatuh_tempo?>" /> 
						</span>
					</span>		
				</p>				

				<p class="colx3-center">						
						<label for="complex-en-url">Kas :</label>						
						<span class="relative">
							<select name="kas" required>							
							<?php

								$this->db->flush_cache();
								$query = $this->db->get('kas');
								
								foreach($query->result() as $row)
								{

									if ($row->kode == $result->row()->kode_kas)
									echo '<option selected readonly value="'.$row->kode.'">'.$row->nama.'<span class="colx3-right">-</span>'.convert_rupiah($row->saldo).'</option>';
										//else
									//echo '<option value="'.$row->kode.'">'.$row->nama.'<span class="colx3-right">-</span>'.convert_rupiah($row->saldo).'</option>';

								}

							?>							
						</select>						
					</span>					
				</p>																				
					<p class="colx3-right" style = "display:none;" id = "atm">						
						<label for="complex-en-url">Nama Pengguna</label>						
						<span class="relative">							
							<input type = "text" name = "nama_atm" value="<?=$result->row()->nama_atm?>">							
						</span>					
						<label for="complex-en-url">Nomor ATM</label>						
						<span class="relative">							
							<input type = "text" name = "nomor_atm" value="<?=$result->row()->nomor_atm?>"	>							
						</span>					
				</p>
			</div>

			</fieldset>
			
			<fieldset>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Nama Barang :</label>
						<span class="relative">
								<input type="text" size="35" name="detail_namabarang" id="detail_namabarang" />
								<a id="getbarang" href="<?=base_url().'index.php/pembelian/show_barang'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
								<input type="hidden" name="detail_idbarang" id="detail_idbarang" /> <input type="hidden" name="detail_idjenis" id="detail_idjenis" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Barang :</label>
						<span class="relative">
								<input type="text" name="detail_harga" id="detail_harga" />
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Harga Toko :</label>
						<span class="relative">
								<input type="text" name="detail_harga_toko" id="detail_harga_toko" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Partai :</label>
						<span class="relative">
								<input type="text" name="detail_harga_partai" id="detail_harga_partai" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Harga Cabang :</label>
						<span class="relative">
								<input type="text" name="detail_harga_cabang" id="detail_harga_cabang" />
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Qty :</label>
						<span class="relative">
								<input type="text" name="detail_qty" id="detail_qty" />
						</span>
					</p>
					<p class="colx3-center">
						<label for="complex-en-url">Jatuh Tempo :</label>
						<span class="relative">
							<input type="text" name="detail_jatuh_tempo" id="detail_jatuh_tempo" /> Hari
						</span>
					</p>	
				</div>
			
						<div class="columns">
							<p class="colx2-left">
								<input onclick="set_detail()" type="button" name="button2" id="button2" value="Tambah Ke List" />
							</p>
						</div>
					
							<table class="table" border="1" cellspacing="0" width="100%">
							
								<thead>
									<tr>
										<th rowspan="2" scope="col">No</th>
										<th rowspan="2" scope="col">Nama Barang</th>
										<th rowspan="2" scope="col">Harga Barang</th>
										<th colspan="3" scope="col">Harga Jual</th>
										<th rowspan="2" scope="col">SN</th>
										<th rowspan="2" scope="col">QTY</th>
										<th rowspan="2" scope="col">Jatuh Tempo</th>
									</tr>
									<tr>
										<th>Toko</th>
										<th>Partai</th>
										<th>Cabang</th>
									</tr>
								</thead>
								
								<tbody id="detail">
									<?php
										$this->db->flush_cache();
										//$this->db->select('detail_pembelian.*, barang.*,sum(detail_pembelian.qty) as qty');
										$this->db->select('detail_pembelian.*, barang.*,detail_pembelian.sn as sn');
										$this->db->from('detail_pembelian');
										$this->db->join('barang', 'barang.id_barang = detail_pembelian.id_barang');
										$this->db->where('id_pembelian', $id_pembelian);																				
										//$this->db->group_by('barang.id_barang');
										$this->db->order_by('id_detail_pembelian', 'ASC');										
										$q = $this->db->get();
										
										//print $this->db->last_query();

										$i=0;
										foreach($q->result() as $row){
											echo '
													<tr>
														<td>'.($i + 1).'</td>
														<td>
															'.$row->nama_barang.'
															<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$row->nama_barang.'" />
															<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" />
															<input type="hidden" name="detail['.$i.'][id_jenis]" value="'.$row->id_jenis.'" />
														</td>
														<td>
															'.convert_rupiah($row->harga).'
															<input type="hidden" name="detail['.$i.'][harga]" value="'.$row->harga.'" />
															<input type="hidden" name="detail['.$i.'][total]" value="'.$row->total.'" />
														</td>
														<td>
															'.convert_rupiah($row->harga_toko).'
															<input type="hidden" name="detail['.$i.'][harga_toko]" value="'.$row->harga_toko.'" />
														</td>
														<td>
															'.convert_rupiah($row->harga_partai).'
															<input type="hidden" name="detail['.$i.'][harga_partai]" value="'.$row->harga_partai.'" />
														</td>
														<td>
															'.convert_rupiah($row->harga_cabang).'
															<input type="hidden" name="detail['.$i.'][harga_cabang]" value="'.$row->harga_cabang.'" />
														</td>
														<td>
															<input class="tblInput" type="text" name="detail['.$i.'][sn]" value="'.$row->sn.'" />

														</td>
														<td>
															'.$row->qty.'
															<input type="hidden" name="detail['.$i.'][qty]" value="'.$row->qty.'" />
														</td>
														<td>
															'.$row->jatuh_tempo.'
															<input type="hidden" name="detail['.$i.'][jatuh_tempo]" value="'.$row->jatuh_tempo.'" />
														</td>
														<td align="center">
															<a href="Javascript:remove_detail('.$i.')">Batal</a>
														</td>
													</tr>';
													
											$i++;
										}
										
									?>
								</tbody>
							</table>
							<br/>
				</fieldset>

				
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 		
			</div>	
			
		</form>
		
		
	</div>
	
</section>



