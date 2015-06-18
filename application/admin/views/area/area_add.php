<script type="text/javascript">
	
	function batal(){
		document.location.href = '<?=base_url().'index.php/area'?>';
	}
	$(document).ready(function (){
            var x = <?php echo $usernameValidation ;?>;
            $("#username-error").hide();
            if(x==1){
                $("#username-error").show();
            }
        });
        function getKecamatan(){
            var kabupaten = document.getElementById("id_kabupaten").value;
            $.ajax({
			type: 'POST',
                        url: '<?=base_url().'index.php/area/getKecamatan/'?>'+kabupaten, //url: $(this).attr('action'),
			//data: $('#form1').serialize(),
			success: function(data) {
				$('#id_kecamatan').html(data);
			}
            }); 
        }
</script>
    <div id="percobaan">

        
</div>
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
<div id="username-error">
    <h2>Area telah ada.</h2>
</div>
<section class="grid_8">
	<div class="block-border">
		<?php
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');
			echo form_open('area/insert', $attributes);
		?>
			<h1>Setup > Tambah Data Area / Wilayah</h1>
			
			<fieldset>
				<div class="columns">
                                    <p class="colx2-left">
						<label for="complex-en-url">Kabupaten - Kecamatan (*)  :</label>
						<span class="relative">
                                                    <select name="id_kabupaten" id="id_kabupaten" onchange="getKecamatan()">
                                                        <option value="-" selected>-</option>
								<?php
									$query = $this->db->get('kabupaten');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
                                                                                    echo '<option value="'.$row->id_kabupaten.'">'.$row->kabupaten.'</option>';
										}
									}
								?>
							</select>
                                                    <select name="id_kecamatan" id="id_kecamatan">
								<option value="-" selected>-</option>
							</select>
						</span>
					</p>
				</div>
				<div class="columns">	
					<p class="colx2-left">
						<label for="complex-en-url">Area (*) :</label>
						<span class="relative">
							<input type="text" name="area" id="area" value="<?=set_value('area')?>" >
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