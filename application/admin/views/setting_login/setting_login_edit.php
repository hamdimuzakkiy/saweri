<script type="text/javascript">

	

	function batal(){

		document.location.href = '<?=base_url().'index.php/#'?>';

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
		/*
			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');

			echo form_open_multipart('setting_view/process_update', $attributes);
			
			*/

		?>
		<form method="post" action="<?php echo base_url(); ?>/index.php/setting_login/process_update/" enctype="multipart/form-data">
			<h1>Master > Edit Gambar Login</h1>
			<?php // if($error!=null) echo $error; else echo '';?>
			

			<fieldset>

				

				

				<div class="columns">

					<p class="colx2-left">

						<label for="complex-en-url">Nama Fungsi :</label>

						<input type="hidden" name="id"  value="<?=$id?>">

						<span class="relative">

							<?php 
							
								echo '<input type="text" name="name" id="name" readonly="readonly" value="'.$name.'" class="duapertiga-width  ">';
								/*
								if (form_error('name ') != null)

								{

									echo '<input type="text" name="name " id="name"  value="'.set_value('name ').'" class="duapertiga-width">';

								}else

								{ 

									echo '<input type="text" name="name " id="name" value="'.$name .'" class="duapertiga-width">';

								}*/

							?>

						</span>

					</p>
					
					
					
				</div>
				
				
				<div class="columns">
					<p class="colx2-left">

						<label for="complex-en-url">Gambar Login :</label>

						<input type="hidden" name="id"  value="<?=$id?>">

						<span class="relative">

							<?php 

								if (form_error('header1') != null)

								{
									echo '<input name="login1" id="header1" type="file" value="'.set_value('login1 ').'"  size="42" class="duapertiga-width" />';
								}else

								{
									echo '<input name="login1" id="header1" type="file" value="' . $login1 .'"  size="42" class="duapertiga-width" />';											
								}

							?>

						</span>

					</p>
					
				</div>
				

			<div id="tab-settings" class="tabs-content">

					<button type="submit"><img src="<?=base_url()?>asset/admin/images/icons/fugue/tick-circle.png" width="16" height="16"> Simpan</button>

					<button type="button" onclick="javascript:batal();" class="red">Batal</button> 	

			</div>

			

		</form>

	</div>

</section>