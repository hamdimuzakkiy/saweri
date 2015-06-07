<!-- <script type="text/javascript" src="<?=base_url()?>asset/admin/js/table_addrow/jquery.table.addrow.js"></script> -->
<!--<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
-->

<script type="text/javascript">
	
	var site = "<?php echo site_url()?>";
	$(document).ready(function() {
            $.ajax({
                url: site+"/laporan_penjualan/get_karyawan/",
                success: function(response){			
                $('#jero_class').html(response);
                },
				dataType:"html"  		
            });
		
		
		    $('#search_box').livesearch({
            searchCallback: searchfunction,
            queryDelay: 200,
            innerText: "pencarian nama karyawan",
            minimumSearchLength: 3
        });
        $("#search_box").focus();
	});
	
	function searchfunction(str) {
            $.ajax({
                url: site+"/laporan_penjualan/search_karyawan/"+str,
                success: function(response){			
                $('#jero_class').html(response);
                },
				dataType:"html"  		
            });
            return false;
    }
	
	function laporan(title, w, h){
	//	var periode_awal=document.getElementById('tanggal_awal').value;
	//	var periode_akhir=document.getElementById('tanggal_akhir').value;
	//	if ((periode_awal=='')||(periode_akhir=='')){
		//	alert('Isilah periode awal dan akhir');
	//	}else{
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			
			myForm = document.getElementById('form1');
			// open a *BLANK* WINDOW!!!!
			newWin= window.open("", title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left) ;

			// save form info:
			var saveTarget = myForm.target;
			var saveAction = myForm.action;
			var saveMethod = myForm.method; // not needed if already post

			// change form info:
			myForm.target = title;
			myForm.action = "<?=site_url();?>/laporan_penjualan/view_lap_point_karyawan/v_html";
			myForm.method = "post"; // not needed if <form> was already post
			myForm.submit( );  // invoke the form, submitting to the popup window

			// restore form:
			myForm.target = saveTarget;
			myForm.action = saveAction;
			myForm.method = saveMethod; // if used

			return true ; // why does this matter? ordinary buttons ignore return value
			
		//}
	}
	
		$(function(){
		$("#tanggal_awal").datepicker({dateFormat: 'yy-mm-dd' });
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
	
		function batal(){
		document.location.href="<?=site_url();?>/dashboard";
	}
	
</script>

<section class="grid_12">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form', 'target'=>'_top');
			echo form_open('laporan_penjualan/view_lap_point_karyawan', $attributes);
		?>
			<h1>Form Laporan Point Karyawan</h1>
			
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
					<button type="button" class="red" onclick="javascript:batal()">Batal</button> 
			</div>	
			
		</form>
		
		
	</div>
	
</section>



