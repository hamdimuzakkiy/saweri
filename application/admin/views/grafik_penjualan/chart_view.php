<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

	<script src="<?php echo base_url();?>asset/admin/js/fusioncharts.js" type="text/javascript"></script>


<section class="grid_12">	
		<div class="block-border">
			<h1><center><?php echo $graph_caption ?></center></h1>

			<fieldset>
				<div class="columns">
			<?php
				echo $graph ;
			?>
				</div>
			</fieldset>

		</div>
</section>
