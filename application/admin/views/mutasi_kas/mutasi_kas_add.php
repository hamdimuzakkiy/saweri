<script type="text/javascript">
		$(document).ready(function() {

		$("#getakun").fancybox();
		get_total_kas();
	});
	
	function set_detail(){

		

		if(document.getElementById('detail_akunid').value == ''){

			alert('Isi nama barang terlebih dahulu.');

		}else{

			$.ajax({

				type: 'POST',

				url: '<?=base_url().'asset/admin/js/ajax_mutasi.php?command=add_1'?>',

				data: $('#form1').serialize(),

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

			document.forms["form1"].submit();

		}

		

	}
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/mutasi_kas'?>';
	}
	
	
	function get_total_kas(){
		var getselect=document.getElementById('kd_kas').value;
		load("mutasi_kas/get_kas/" + getselect ,"jumlah_debet");	
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
<div id="alert_yanto"></div><br>
<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('mutasi_kas/insert', $attributes);
		?>
			<h1>Kas Dan Bank > Mutasi Kas > Tambah Data Mutasi Kas</h1>

				
			<fieldset>
				
				
				<legend>Tambah Data Mutasi Kas</legend>
				
				<div class="columns">
					<p class="colx3-left">
						<label for="complex-en-url">Akun Debet (Kode Kas) :</label>
						<span class="relative">
							<select name="kd_kas" id="kd_kas"class="seperempat-width" onchange="get_total_kas();">
								<option value=""></option>
								<?php
									$query = $this->db->query('select distinct(AKUNID), NAKUN from master_akun where AKUNID LIKE "11%" ');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->AKUNID.'">' . $row->AKUNID . '-' .$row->NAKUN.'</option>';
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

				</div>
				
				<a id="getakun" href="<?=base_url().'index.php/mutasi_kas/show_akun'?>"><img src="<?=base_url()?>asset/admin/images/icons/fugue/application-export.png" width="16" height="16"></a>
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
									</tr>
									

								</thead>

								

								<tbody id="detail">

									

								</tbody>

							</table>

							<br/>

				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
				
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 			
			</div>
			
		</form>
	</div>
</section>