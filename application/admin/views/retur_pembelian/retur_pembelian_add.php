<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/retur_pembelian'?>';
	}
	
	$(function(){
		$("#tanggal").datepicker({dateFormat: 'yy-mm-dd', yearRange: '2001:2021' });
	})
	
	
	function cek(){
		var x=0;
		for (var i=0;i < document.form1.elements.length;i++)
		{
			var e = document.form1.elements[i];
			
			if (e.type == 'checkbox')
			{
				if(e.checked){
					x++;
				}
			}
		}
		
		if(x > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function save_data(){
		
		var isi = document.getElementById('detail').innerHTML;

		if( isi == false){
			document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>List data barang tidak boleh kosong</li><li class="close-bt"></li></ul><br>';
			//alert('kosong');
		}else{
			document.getElementById('alert_yanto').innerHTML = '';
			//alert('berisi');
			if(cek()){
				document.forms["form1"].submit();
			}else{
				document.getElementById('alert_yanto').innerHTML = '<ul class="message error grid_12"><li>Harus ada data yang diceklis untuk diretur</li><li class="close-bt"></li></ul><br>';
			}
			
		}
		
	}
	
	function get_po(po){
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url().'index.php/retur_pembelian/get_barang_by_po/'?>' + po, //url: $(this).attr('action'),
			//data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}						
		});			
	}
	


		function klick_tanggal(){
		var tanggal = document.getElementById("tanggal");
		tanggal.focus();
	}

	function test(){

		//alert('<?php echo base_url().'index.php/retur_pembelian/test/'?>');
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url().'index.php/retur_pembelian/test/'?>', //url: $(this).attr('action'),
			//data: $('#form1').serialize(),
			success: function(data) {				
				$('#detail').html(data);
			}

		});	
		alert('kanto');		
	}
	
	
</script>

<div id="alert_yanto"></div><br>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('retur_pembelian/insert', $attributes);
		?>
			<h1>Pembelian > Tambah Data Retur Pembelian</h1>
			
			<fieldset class="grey-bg ">	
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">PO No (*) :</label>
						<span class="relative">
							<select name="po_no" id="po_no" onchange="javascript:get_po(this.value);">
								<option value="0">- Pilih No PO -</option>
								<?php
									$query = $this->db->get('pembelian');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->id_pembelian.'">'.$row->po_no.'</option>';
										}
									}
								?>
							</select>
							<?=form_error('po_no')?>
						</span>
					</p>	
					<p class="colx2-right">
						<label for="complex-en-url">Tanggal (*) :</label>
						<span class="relative">
							<span class="input-type-text margin-right relative">
								<!--input type="text" name="tanggal" id="tanggal" class="datepicker" value="<?=date('Y-m-d')?>">
								<img onclick="javascript:klick_tanggal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"-->
								<input type="text" name="tanggal" readonly value="<?=date('Y-m-d')?>">
								<img  src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16">
							</span>

						</span>
					</p>	
				</div>
			</fieldset>
			<fieldset>
				<div class="columns">
					<table class="table" border="1" cellspacing="0" width="100%">
								
						<thead>
							<tr>
								<th scope="col">&nbsp;</th>
								<th scope="col">No</th>
								<th scope="col">Nama Barang</th>
								<th scope="col">SN</th>
								<th scope="col">Supplier</th>
								<th scope="col">Qty Sebelumnya</th>
								<th scope="col">Qty</th>
							</tr>
						</thead>
						
						<tbody id="detail">
							
						</tbody>
					</table>
				</div>		

				<p><i> Field yang diberi tanda (*) harus di isi ! </i></p>
					
			</fieldset>
				
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="javascript:save_data();"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>
					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	
			</div>
			
		</form>
	</div>
</section>
<button onclick="javascript:test();">button</button>