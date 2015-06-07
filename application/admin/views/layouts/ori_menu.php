
	<!-- Header -->
		<div id="hulu">
			<div id="hulu_kiri"></div>
			<div id="hulu_kanan"></div>
		</div>
	<!-- Server status -->

	<!-- End server status -->

	<!-- Main nav -->
	<nav id="main-nav">
		<ul class="container_12">
			
			<li class="home current">
				<ul> 
						
						<li class=" "><?=anchor('dashboard','Dashboard')?></li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Setup</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										# Menu Setup
										#------------------------------------------------------------------------------
										
										if ($privilage['karyawan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('karyawan','Karyawan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Karyawan</li>'; 
										}
										
										if ($privilage['kategori'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('kategori','Kategori Barang').'</li>'; 
										}else{
											echo '<li class="icon_blog">Kategori Barang</li>'; 
										}
										
										if ($privilage['golongan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('golongan','Golongan Barang').'</li>'; 
										}else{
											echo '<li class="icon_blog">Golongan Barang</li>';
										}
										
										if ($privilage['jenis'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('jenis','Jenis Barang').'</li>'; 
										}else{
											echo '<li class="icon_blog">Jenis Barang</li>'; 
										}
										
										if ($privilage['satuan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('satuan','Satuan Barang').'</li>'; 
										}else{
											echo '<li class="icon_blog">Satuan Barang</li>'; 
										}
										
										if ($privilage['area'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('area','Area / Wilayah').'</li>'; 
										}else{
											echo '<li class="icon_blog">Area / Wilayah</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Master</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<!--<li class="icon_battery"><a href="javascript:void(0)">Master Saldo Elektrik</a></li>-->
									<?php
										if ($privilage['supplier'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('supplier','Master Supplier').'</li>'; 
										}else{
											echo '<li class="icon_blog">Master Supplier</li>'; 
										}
										
									?>
									<li class="icon_blog"><a href="javascript:void(0)">Master Barang : Qty</a>
										<ul>
										<?php
											if ($privilage['barang'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('barang','Master Barang').'</li>'; 
											}else{
												echo '<li class="icon_blog">Master Barang</li>'; 
											}
											
											if ($privilage['barang_point'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('barang_point','Master Barang Point').'</li>'; 
											}else{
												echo '<li class="icon_blog">Master Barang Point</li>'; 
											}
										?>
										</ul>
									</li>
									<!--<li class="icon_server"><a href="javascript:void(0)">Master Pulsa : Saldo</a> </li>-->
									<?php
									if ($privilage['cabang'][0] == 1){ 
										echo '<li class="icon_blog">'.anchor('cabang','Master Cabang').'</li>'; 
									}else{
										echo '<li class="icon_blog">Master Cabang</li>'; 
									}
									
									if ($privilage['pelanggan'][0] == 1){ 
										echo '<li class="icon_blog">'.anchor('pelanggan','Master Pelanggan').'</li>'; 
									}else{
										echo '<li class="icon_blog">Master Pelanggan</li>'; 
									}
									?>
									
									<li class="icon_blog"><a href="javascript:void(0)">Master Harga</a>
										<ul>
											<?php
											if ($privilage['harga_beli'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('harga_beli','Master Harga Beli').'</li>'; 
											}else{
												echo '<li class="icon_blog">Master Harga Beli</li>'; 
											}
											
											if ($privilage['harga_jual'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('harga_jual','Master Harga Jual').'</li>'; 
											}else{
												echo '<li class="icon_blog">Master Harga Jual</li>'; 
											}
											
											?>
										</ul>
									</li>
									<!-- <li class="icon_terminal"><a href="javascript:void(0)">Master Biaya</a></li>
									<li class="icon_battery"><a href="javascript:void(0)">Master kas</a></li> -->
								</ul>
							</div>
						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Pembelian</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<li class="icon_address"><a href="javascript:void(0)">Request Order</a> 
										<ul>
											<?php
											if ($privilage['request_order'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('request_order/index/pusat','Request Order [Pusat]').'</li>'; 
											}else{
												echo '<li class="icon_blog">Request Order [Pusat]</li>'; 
											}
											
											if ($privilage['request_order'][0] == 1){ 
												echo '<li class="icon_blog">'.anchor('request_order/index/cabang','Request Order [Cabang]').'</li>'; 
											}else{
												echo '<li class="icon_blog">Request Order [Cabang]</li>'; 
											}
											
											?>
										</ul>
									</li>
									<?php
										if ($privilage['pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('pembelian','Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Pembelian</li>'; 
										}
										
										if ($privilage['retur_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('retur_pembelian','Return Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Return Pembelian</li>'; 
										}
										
										if ($privilage['po'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('po','Data PO').'</li>'; 
										}else{
											echo '<li class="icon_blog">Data PO</li>'; 
										}
										
									?>
									
									<li class="sep"></li>
									
									<?php
										if ($privilage['laporan_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian','Laporan Pembelian [Periode]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Pembelian [Periode]</li>'; 
										}
										
										if ($privilage['laporan_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_pembelian_barang','Laporan Pembelian [Barang]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Pembelian [Barang]</li>'; 
										}
										
										if ($privilage['laporan_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_pembelian_supplier','Laporan Pembelian [Supplier]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Pembelian [Supplier]</li>'; 
										}
									?>

								
									<?php
										if ($privilage['laporan_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_saldo_stok','Laporan Saldo Stok').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Saldo Stok</li>'; 
										}
									?>
									<?php
										if ($privilage['laporan_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_retur_pembelian','Laporan Retur Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Retur Pembelian</li>'; 
										}
									//	if ($privilage['laporan_pembelian'][0] == 1){ echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_terima_retur_pembelian','Laporan Terima Retur Pembelian').'</li>'; }										
									?>
								</ul>
							</div>
						</li>
						
						<!--<li class=""><?=anchor('inventory/index','Persediaan')?></a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										if ($privilage['inventory'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('inventory/index/pusat','Persediaan [Pusat]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Persediaan [Pusat]</li>'; 
										}
										
										if ($privilage['inventory'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('inventory/index/cabang','Persediaan [Cabang]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Persediaan [Cabang]</li>'; 
										}
									?>
								</ul>
							</div>
						</li>-->
						
						<?php
							if($this->session->userdata('kodecabang') != '001'){
								echo '<li class=""><a href="javascript:void()">Persediaan</a></li>';
							}else{
								echo '<li class="">'.anchor('inventory/index','Persediaan').'</li>';
							}
						?>
						
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Penjualan</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										if ($privilage['penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('penjualan','Penjualan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Penjualan</li>'; 
										}
										
										if ($privilage['retur_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('retur_penjualan','Return Penjualan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Return Penjualan</li>'; 
										}
										
										if ($privilage['service'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('service','Penerimaan Service').'</li>'; 
										}else{
											echo '<li class="icon_blog">Penerimaan Service</li>'; 
										}
										
										if ($privilage['so'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('so','Data SO').'</li>'; 
										}else{
											echo '<li class="icon_blog">Data SO</li>'; 
										}
									?>
									<li class="sep"></li>
									<?php
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_penjualan_periode','Laporan Penjualan [Periode]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Penjualan [Periode]</li>'; 
										}
										
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_penjualan_barang','Laporan Penjualan [Barang]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Penjualan [Barang]</li>'; 
										}
										
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_penjualan_pelanggan','Laporan Penjualan [Pelanggan]').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Penjualan [Pelanggan]</li>'; 
										}
									
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_saldo_stok','Laporan Saldo Stok').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Saldo Stok</li>'; 
										}
									
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_retur_penjualan','Laporan Return Penjualan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Return Penjualan</li>'; 
										} 
									?>
								
									<li class="icon_address"><a href="javascript:void(0)">Laporan Point</a> 
										<ul>
												<?php
													if ($privilage['laporan_penjualan'][0] == 1){ 
														echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_point_member','Member').'</li>'; 
													}else{
														echo '<li class="icon_blog">Member</li>'; 
													}
													
													if ($privilage['laporan_penjualan'][0] == 1){ 
														echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_point_karyawan','Karyawan').'</li>'; 
													}else{
														echo '<li class="icon_blog">Karyawan</li>';
													}
												?>
										</ul>
									</li>
									<?php
										if ($privilage['laporan_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('laporan_penjualan/form_lap_services','Laporan Services').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Services</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
						
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Grafik</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										if ($privilage['grafik_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('grafik_pembelian','Grafik Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Grafik Pembelian</li>'; 
										}
										
										if ($privilage['grafik_penjualan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('grafik_penjualan','Grafik Penjualan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Grafik Penjualan</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
						
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Layanan</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										if ($privilage['layanan_jasa_kredit'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('layanan_jasa_kredit','Layanan  Pihak Ke 3').'</li>'; 
										}else{
											echo '<li class="icon_blog">Layanan  Pihak Ke 3</li>'; 
										}
										
										if ($privilage['layanan_jasa_speedy'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('layanan_jasa_speedy','Layanan  Speedy').'</li>'; 
										}else{
											echo '<li class="icon_blog">Layanan  Speedy</li>'; 
										}
										
										if ($privilage['layanan_jasa_listrik'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('layanan_jasa_listrik','Layanan Listrik').'</li>'; 
										}else{
											echo '<li class="icon_blog">Layanan Listrik</li>'; 
										}
										
										if ($privilage['layanan_jasa_pdam'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('layanan_jasa_pdam','Layanan PDAM').'</li>'; 
										}else{
											echo '<li class="icon_blog">Layanan PDAM</li>'; 
										}
										
										if ($privilage['layanan_jasa_telepon'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('layanan_jasa_telepon','Layanan Telepon').'</li>'; 
										}else{
											echo '<li class="icon_blog">Layanan Telepon</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Maintenance</a>
							<div class="menu">
								<img src="images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<!--<li class="icon_address"><a href="javascript:void(0)">Backup Database</a> </li>
									<li class="icon_export"><a href="javascript:void(0)">Restore Database</a> </li>
									<li class="icon_refresh"><a href="javascript:void(0)">Remove Transaksi</a></li>
									<li class="icon_refresh"><a href="javascript:void(0)">Reset Point Member</a></li>
									<li class="sep"></li>-->
									<?php
										if ($privilage['users_level'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('users_level','User Level').'</li>'; 
										}else{
											echo '<li class="icon_blog">User Level</li>'; 
										}
										
										if ($privilage['users'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('users','User').'</li>'; 
										}else{
											echo '<li class="icon_blog">User</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
				</ul>
			</li>
		</ul>
	</nav>
	<!-- End main nav -->
	
	<!-- Sub nav -->
	<div id="sub-nav"><div class="container_12">
		
		
	</div></div>
	<!-- End sub nav -->
	
	<!-- Status bar -->
	<div id="status-bar"><div class="container_12">
	
		<ul id="status-infos">
			<li class="spaced">Logged as: <strong><?=logged_as()?></strong></li>
			<!--
			<li>
				<a href="javascript:void(0)" class="button" title="1 messages"><img src="images/icons/fugue/mail.png" width="16" height="16"> <strong>1</strong></a>
				<div id="messages-list" class="result-block">
					<span class="arrow"><span></span></span>
					
					<ul class="small-files-list icon-mail">
						<li>
							<a href="javascript:void(0)"><strong>10:15</strong> Please update...<br>
							<small>From: System</small></a>
						</li>
					</ul>
					<p id="messages-info" class="result-info"><a href="javascript:void(0)">Go to inbox &raquo;</a></p>
				</div>
			</li>
			<li>
				<a href="javascript:void(0)" class="button" title="2 comments"><img src="images/icons/fugue/balloon.png" width="16" height="16"> <strong>2</strong></a>
				<div id="comments-list" class="result-block">
					<span class="arrow"><span></span></span>
					
					<ul class="small-files-list icon-comment">
						<li>
							<a href="javascript:void(0)"><strong>Jane</strong>: I don't think so<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="javascript:void(0)"><strong>Ken_54</strong>: What about using a different...<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
					</ul>
					
					<p id="comments-info" class="result-info"><a href="javascript:void(0)">Manage comments &raquo;</a></p>
				</div>
			</li>
			-->
			<li>
				<?=anchor('auth/logout', '<span class="smaller">LOGOUT</span>', array('class'=>'button red', 'title'=>'Logout'))?>
			</li>
		</ul>
		
		<ul id="breadcrumb">
			<li>&nbsp;&nbsp;<?=date('d/m/Y').'&nbsp;&nbsp;'.date('H:i');?>&nbsp;&nbsp;</li>
		</ul>
		<!--
		<ul id="breadcrumb">
			<li><a href="javascript:void(0)" title="Home">Home</a></li>
			<li><a href="javascript:void(0)" title="Dashboard">Dashboard</a></li>
		</ul>
		-->
	
	</div></div>
	<!-- End status bar -->
	
	<div id="header-shadow"></div>
	<!-- End header -->
	
	<!-- Always visible control bar -->
	<div id="control-bar" class="grey-bg clearfix">
		
	</div>
	<!-- End control bar -->
	
	
	<!-- Content -->
	<article class="container_12">
	
	<?php
		$flash_message = $this->session->flashdata('message');
		if (!empty($flash_message)){
	?>
			<ul class="message success grid_12">
				<li><?=$flash_message?></li>
				<li class="close-bt"></li>
			</ul>
	<?php 
		}
	?>