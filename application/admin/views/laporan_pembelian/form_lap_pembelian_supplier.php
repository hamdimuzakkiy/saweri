

<script type="text/javascript">
	var site = "<?php echo site_url()?>";
	$(document).ready(function() {
		//$("#getbarang").fancybox();

		
            $.ajax({
                url: site+"/laporan_pembelian/get_supplier/",
                success: function(response){			
                $('#jero_class').html(response);
                },
				dataType:"html"  		
            });
		
		
		    $('#search_box').livesearch({
            searchCallback: searchfunction,
            queryDelay: 200,
            innerText: "pencarian nama supplier",
            minimumSearchLength: 3
        });
        $("#search_box").focus();
	});
	
	function batal(){
		document.location.href='<?=site_url();?>/dashboard';
	}
	

    function searchfunction(str) {
            $.ajax({
                url: site+"/laporan_pembelian/search_supplier/"+str,
                success: function(response){			
                $('#jero_class').html(response);
                },
				dataType:"html"  		
            });
            return false;
    }
	
	function set_detail(){
				

		$.ajax({
			type: 'POST',
			url: '<?=base_url().'index.php/laporan_pembelian/view_lap_pembelian_barang'?>', //url: $(this).attr('action'),
			data: $('#form1').serialize(),
			success: function(data) {
				$('#detail').html(data);
			}
		});

	}
	
	function laporan(title, w, h){

		var tanggal_cetak = document.getElementById('tanggal_cetak').value;
		var cIdx = 'nama_barang';
		var cControl = 'control';		
		var flag = true;
		for (var i=0;i < document.form1.elements.length;i++)
		{
			var e = document.form1.elements[i];
			if (e.checked == true)
				{flag = false; break;}
		}	
		if (flag == true)
			{alert('Check Supplier Terlebih dahulu');  return;}


		var periode_awal=document.getElementById('tanggal_awal').value;
		var periode_akhir=document.getElementById('tanggal_akhir').value;
		if ((periode_awal=='')||(periode_akhir=='')){
			alert('Isilah periode awal dan akhir');
		}else{
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			
			myForm = document.getElementById('form1');
			// open a *BLANK* WINDOW!!!!
			newWin= window.open("", title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left) ;

			// save form info:
			var saveTarget = myForm.target;
			var saveAction = myForm.action;
			var saveMethod = myForm.method; // not needed if already post

			// change form info:
			myForm.target = title;
			myForm.action = "<?=site_url();?>/laporan_pembelian/view_lap_pembelian_supplier/v_html/"+tanggal_cetak;
			myForm.method = "post"; // not needed if <form> was already post
			myForm.submit( );  // invoke the form, submitting to the popup window

			// restore form:
			myForm.target = saveTarget;
			myForm.action = saveAction;
			myForm.method = saveMethod; // if used

			return true ; // why does this matter? ordinary buttons ignore return value
			
		}
	}
	
	$(function(){
		$("#tanggal_awal").datepicker({dateFormat: 'yy-mm-dd' });
	})	
	$(function(){
		$("#tanggal_cetak").datepicker({dateFormat: 'yy-mm-dd' });
	})	
	$(function(){
		$("#tanggal_akhir").datepicker({dateFormat: 'yy-mm-dd' });
	})

	function CA(){
		var cIdx = 'nama';
		//alert(counterIdx);
		var cControl = 'control';		
		for (var i=0;i < document.form1.elements.length;i++)
		{
			var e = document.form1.elements[i];
			if ((e.id == cIdx) && (e.id != cControl) && (e.type=='checkbox'))
			{
				e.checked = document.getElementById(cControl).checked;
			}
		}
	}
	
	function klick_tanggal_awal(){
		var tanggal = document.getElementById("tanggal_awal");
		tanggal.focus();
	}
	function klick_tanggal_cetak()
	{
		var tanggal = document.getElementById("tanggal_cetak");
		tanggal.focus();	
	}
	function klick_tanggal_akhir(){
		var tanggal = document.getElementById("tanggal_akhir");
		tanggal.focus();
	}	
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form', 'target'=>'_top');
			echo form_open('laporan_pembelian/view_lap_pembelian_supplier', $attributes);
		?>
			<h1>Form Laporan Pembelian [Supplier]</h1>
			
			<fieldset>
				
				<div class="columns">
					<input type="hidden" name="id_pembelian" id="id_pembelian" >
					<p class="colx2-left">
						<label for="complex-en-url">Tanggal Cetak :</label>
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="cetak" id="tanggal_cetak" class="datepicker" value="<?=date('Y-m-d')?>">  
								<img onclick="javascript:klick_tanggal_cetak()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>						
					</p>					
				</div>

				<div class="columns">
					<input type="hidden" name="id_pembelian" id="id_pembelian" value="<?=date('YmdHis')?>">
					<p class="colx2-left">
						<label for="complex-en-url">Periode :</label>
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_awal" id="tanggal_awal" class="datepicker" value="<?=date('Y-m-d')?>">  
								<img onclick="javascript:klick_tanggal_awal()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
						S/D
						<span class="relative">
								<span class="input-type-text margin-right relative"><input type="text" name="periode_akhir" id="tanggal_akhir" class="datepicker" value="<?=date('Y-m-d')?>">  
								<img onclick="javascript:klick_tanggal_akhir()" src="<?=base_url()?>asset/admin/images/icons/fugue/calendar-month.png" width="16" height="16"></span>
						</span>
					</p>
				</div>
			</fieldset>
			
			<fieldset>
					<table class="table" cellspacing="0" width="100%">
						<th align="left" valign="top" scope="col"><input type="checkbox" id="control" onclick="CA(0)" /> Check All </th>
						<th align="left" valign="top" scope="col"><input type="text" id="search_box"/></th>
						<th align="left" valign="top" scope="col">&nbsp; &nbsp; </th>
					</table>
					<div class="block-scroll-active">
						<div id="jero_class">
							<!-- load get_barang -->
							
						</div>
					</div>
			</fieldset>
			
			<div id="tab-settings" class="tabs-content">
					<button type="button" onclick="laporan('name',1000,800)"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16">Print Preview</button> 
					<button type="button" onclick="javascript:batal()" class="red">Batal</button> 
			</div>	
			
		</form>
		
		
	</div>
	
</section>



