<script type="text/javascript">
	$(document).ready(function() {
		 $('#pengeluaran_kas').submit(function() { 
			
			$.ajax({
				type: 'POST',
				url: "<?=base_url().'index.php/pengeluaran_kas/view_posting_pengeluaran_kas/'?>",
				data: $('#pengeluaran_kas').serialize(),
				success: function(data) {
					$.fancybox(data, {
						'width' : 440,
						'height': 500
					  });
				}
			});
			return false;		
		}); 
		
		$("#getakun").fancybox();
		
		
		get_total_kas();	
	});
	

	function set_detail(){		
		if(document.getElementById('detail_akunid').value == ''){

			alert('Isi nama barang terlebih dahulu.');

		}else{

			$.ajax({

				type: 'POST',

				url: '<?=base_url().'asset/admin/js/ajax_pengeluaran_kas.php?command=add_1'?>',

				data: $('#pengeluaran_kas').serialize(),

				success: function(data) {

					$('#detail').html(data);

				}

			});

			

			document.getElementById('detail_akunid').value = '';	
			document.getElementById('detail_nakun').value = '';
			document.getElementById('detail_jumlah').value = '';
			document.getElementById('detail_count').value = '';

		}

	}
	
	function save_data(){
		var isi = document.getElementById('detail').innerHTML;
		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';

			alert('kosong');

			$('html, body').stop().animate({

				scrollTop: 0 //$($anchor.attr('href')).offset().top

			}, 700, 'easeInOutExpo');

		}else{

			document.getElementById('alert_yanto').innerHTML = '';
			alert('berisi');
			document.forms["pengeluaran_kas"].submit();
		}

		

	}
	
	
	function remove_detail(id){

		$.ajax({

			type: 'POST',

			url: '<?=base_url().'asset/admin/js/ajax_pengeluaran_kas.php?command=remove&id='?>'+id,

			data: $('#pengeluaran_kas').serialize(),

			success: function(data) {

				$('#detail').html(data);

			}

		});
	}
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/pengeluaran_kas'?>';
	}
	$(function(){

		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });

	})
	function klick_tanggal(){

		var tanggal = document.getElementById("tanggal");

		tanggal.focus();

	}
	function get_total_kas(){
		var getselect=document.getElementById('kd_kas').value;
		load("pengeluaran_kas/get_kas/" + getselect ,"jumlah_debet");	
		//var obj_div=document.getElementById('getkas');
		//document.getElementById('jumlah_debet').value=obj_div.innerHTML;
		
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

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'pengeluaran_kas', 'id' => 'pengeluaran_kas', 'class'=>'block-content form');
			echo form_open('pengeluaran_kas/view_posting_pengeluaran_kas', $attributes);
		?>
			<h1>Kas Dan Bank > Pengeluaran Kas > Tambah Data Pengeluaran Kas</h1>
			
			<fieldset>
				
				
				<legend>Tambah Data Pengeluaran Kas</legend>
				
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Akun Debet (Kode Kas) :</label>
						<span class="relative">
							<select name="kd_kas" id="kd_kas"class="seperempat-width" onchange="get_total_kas();">
								<?php
									$query = $this->db->query('select distinct(AKUNID),NAKUN from master_akun where AKUNID LIKE "11%"');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->AKUNID.'">'.$row->NAKUN.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
						
					<p class="colx3-center">
						<label for="complex-en-url">Jumlah Nominal :</label>
						<span class="relative">
							<input type="text" name="jumlah_debet" id="jumlah_debet" value="" readonly="true" class="duapertiga-width"><div id="getkas"></div>
						</span>
					</p>
					<p class="colx3-right">

						<label for="complex-en-url">Tanggal :</label>

						<span class="relative">

							<span class="input-type-text margin-right relative">

								<input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">

								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">

							</span>

						</span>

					</p>
				</div>

				
				<a id="getakun" href="<?=base_url().'index.php/pengeluaran_kas/show_akun'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
				<div class="columns">

					<p class="colx3-left">

						<label for="complex-en-url">Kode Akun :</label>

						<span class="relative">
								<input type="text" size="35" name="detail_akunid" id="detail_akunid" />
								<input type="hidden" size="35" name="detail_count" value="" id="detail_count" />
								
						</span>
					</p>
					<p class="colx3-center">

						<label for="complex-en-url">Nama Akun :</label>

						<span class="relative">

								<input type="text" name="detail_nakun" id="detail_nakun" />

						</span>

					</p>
					<p class="colx3-right">

						<label for="complex-en-url">Jumlah :</label>

						<span class="relative">
								<input type="text" name="detail_jumlah" id="detail_jumlah" />
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
										<th rowspan="2" scope="col">Kode Akun</th>
										<th rowspan="2" scope="col">Nama Akun</th>
										<th rowspan="2" scope="col">Jumlah</th>
										<th rowspan="2" scope="col">Ket Transaksi</th>
									</tr>
									

								</thead>

								<tbody id="detail">								
								</tbody>

							</table>

							<br/>

				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> View</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 			
			</div>
			
		</form>
	</div>
</section>