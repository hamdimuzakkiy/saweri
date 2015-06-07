<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"><!-- saved from url=(0044)http://www.logntimber.com/seeint/default.htm -->
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>Login Administrator</title>
		<meta name="description"		content="" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="<?=base_url()?>/asset/login/js/jquery-1.4.2.min.js" ></script>
		
		<!-- Login javscript--> 
		<script type="text/javascript" src="<?=base_url()?>/asset/login/js/loginui.js"></script> 
		
		<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>/asset/login/css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>/asset/login/css/login.css" />
		
		<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>/asset/login/css/blue.css" />
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>/asset/login/css/extra.css" />
		
		<!--   <script type="text/javascript"></script>    -->
	</head>
		
	<body>
		
<?php
$username = array(
	'name'	=> 'username',
	'class' => 'sText',
	'id'	=> 'username',
	'value' => set_value('username'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => 'sText',
	'size'	=> 30,
);
?>

		<div class="boxLogin clearfix">
			
			 <!-- Gambar Login -->
			 <div id="logo_login">
			 <img align="left" src="<?=base_url()?>asset/admin/upload/login/<?=$login1?>" width="300" height="200">
			 </div>
			 
			 <!-- Tooltip styles  --> 
			<?php if (form_error($username['name'])){ ?>
						<div class="toolTip tpRed clearfix" >
							<p>
								<img src="img/icons/exclamation-red.png" alt="Tip!" />
								Username harus diisi.
							</p>
							<a class="close" title="Close"></a>
						</div>
			<?php } ?>
			
			<?php if (form_error($password['name'])){ ?>
						<div class="toolTip tpRed clearfix" >
							<p>
								<img src="img/icons/exclamation-red.png" alt="Tip!" />
								Password harus diisi.
							</p>
							<a class="close" title="Close"></a>
						</div>
			<?php } ?>
			
			<?php if ($message){ ?>
						<div class="toolTip tpRed clearfix" >
							<p>
								<img src="img/icons/exclamation-red.png" alt="Tip!" />
								<?=$message?>
							</p>
							<a class="close" title="Close"></a>
						</div>
			<?php } ?>
			
			<?php echo form_open('auth/login'); ?>
				<div class="fields">
					<p class="sep error">
						<?php echo form_label('Username', $username['id'], array('class'=>'small')); ?>
						<?php echo form_input($username); ?>
					</p>
					
					<p class="sep">
						<?php echo form_label('Password', $password['id'], array('class' => 'small')); ?>
						<?php echo form_password($password); ?>
					</p>

					<div class="action">
						<input type="submit" class="butDef" value="Login" />
					</div>
					<!--<div id="joinproduct">Join Product @ AJD & CCM 2011</div>-->
				</div>
			<?php echo form_close(); ?>
		</div>
	</body>
</html>
