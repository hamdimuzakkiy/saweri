<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/penjualan'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:<?=date('Y')?>'});
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
	
	function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}
	
</script>

<script type="text/javascript">
	
	$(document).ready(function() {
		$("#getbarang").fancybox();
	});
	
	function set_jenispenjualan(id){
		url = '<?=base_url().'index.php/penjualan/show_barang/'?>' + id;
		document.getElementById('getbarang').href = url;
	}
	
	function set_detail(){
	
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_penjualan.php?command=add_1'?>',
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
				document.getElementById('items').innerHTML = '';
			}
		});
		
	}
	
	function remove_detail(id){
		$.ajax({
			type: 'POST',
			url: '<?=base_url().'asset/admin/js/ajax_penjualan.php?command=remove&id='?>'+id,
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

<div id="alert_yanto"></div><br>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('penjualan/process_update', $attributes);
		?>
			<h1>Penjualan > Edit Data Penjualan</h1>
			
			<fieldset >			
				
							
				<div class="columns">

					<input type="hidden" name="id_penjualan" value="<?=date('Ymdhis')?>" >					<p class="colx2-left">						<label for="complex-en-url">SO No :</label>						<span class="relative">								<input type="text" name="so_no" id="so_no" value="<?=$this->penjualan->get_so($kode_transaksi)?>" class="satu-width">						</span>					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Tanggal :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=$result->row()->tanggal?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>
						</span>
					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">
						<label for="complex-en-url">Pelanggan :</label>
						<span class="relative">
							<select name="id_pelanggan" id="id_pelanggan" >
								<?php
									$query = $this->db->get('cabang');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											if($row->id_cabang == $result->row()->id_cabang){
												echo '<option value="'.$row->id_cabang.'" selected="selected">'.$row->kode_cabang.' - '.$row->nama_cabang.'</option>';
											}else{
												echo '<option value="'.$row->id_cabang.'">'.$row->kode_cabang.' - '.$row->nama_cabang.'</option>';
											}
											
										}
									}
								?>
							</select>
						</span>
					</p>	
					<p class="colx2-right">						<label for="complex-en-url">Jatuh Tempo :</label>						<span class="relative">							<input type="text" name="jatuh_tempo" id="jatuh_tempo" value="<?=set_value('jatuh_tempo')?>" class="duapertiga-width"> Hari						</span>					</p>					
				</div>
				
				<div class="columns">
					<p class="colx2-left">						<label for="complex-en-url">Cabang :</label>						<span class="relative">							<select name="id_cabang" id="id_cabang" >								<?php									$query = $this->db->get('cabang');									if($query->num_rows() > 0)									{										foreach($query->result() as $row)										{											if($row->id_cabang == get_idcabang()){												echo '<option value="'.$row->id_cabang.'">'.$row->nama_cabang.'</option>';											}										}									}									/*foreach($query->result() as $row)									{										if($row->id_cabang == get_idcabang()){											echo "<input type='text' name='id_cabang' id='id_cabang' value='" . $row->id_cabang . "'>";										}									}*/																										?>							</select>							<?=form_error('id_cabang')?>						</span>					</p>
					<p class="colx2-right">						<label for="complex-en-url">Diskon (%) :</label>						<span class="relative">							<input type="text" name="diskon" id="diskon" value="<?=set_value('diskon')?>" class="duapertiga-width">						</span>					</p>
				</div>
				<div class="columns">
					<p class="colx2-left">						<label for="complex-en-url">Jenis Penjualan :</label>						<span class="relative">							<select name="id_jenis_penjualan" id="id_jenis_penjualan" onChange="javascript:set_jenispenjualan(this.value)">								<?php									$query = $this->db->get('jenis_penjualan');									if($query->num_rows() > 0)									{										foreach($query->result() as $row)										{											echo '<option value="'.$row->id_jpenjualan.'">'.$row->jenis_penjualan.'</option>';										}									}								?>							</select>						</span>					</p>
				</div>				
			</fieldset>	
			<fieldset>
						<div class="columns">
							<p class="colx3-left">
								<a id="getbarang" href="<?=base_url().'index.php/penjualan/show_barang/1'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
							</p>
						</div>
						
						<table class="table" border="1" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col" width="18px"></th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Harga</th>
									<th scope="col">SN</th>
								</tr>
							</thead>
							<tbody id="items">
								
							</tbody>
						</table>
						<br>
						<div class="columns">
							<p class="colx2-left">
								<input onclick="set_detail()" type="button" name="button2" id="button2" value="Tambah Ke List" />
							</p>
						</div>
						
						<table class="table" border="1" cellspacing="0" width="100%">
						
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Harga</th>
									<th scope="col">Qty</th>
									<th scope="col">SN</th>
									<th scope="col">Total</th>								
								</tr>
							</thead>
							
							<tbody id="detail">
								<?php
									# isi detail penjualan
									$query = $this->penjualan->get_detail_send_ro($id_request);
									$i = 0;
									
									foreach($query->result() as $row){
										echo '
												<tr>
													<td>'.($i + 1).'</td>
													<td>
														'.$row->nama_barang.'
														<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$row->nama_barang.'" />
														<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$row->id_barang.'" />
														
													</td>
													<td>														'.convert_rupiah($row->harga_cabang).'														<input type="hidden" name="detail['.$i.'][harga]" value="'.$row->harga_cabang.'" />													</td>													<td>														'.$row->qty.'														<input type="hidden" name="detail['.$i.'][qty]" value="'.$row->qty.'" />													</td>													<td align="center">														<a href="Javascript:remove_detail('.$i.')">Batal</a>													</td>
													
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