
	<!-- Content -->
	<article class="container_12">
		
		<section class="grid_4">
			<!--<div class="block-border"><div class="block-content">-->
				<h1>Menu Favorit</h1>
				
				<ul class="favorites no-margin with-tip" title="Silakan klik untuk melanjutkan!">
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/add.png" width="48" height="48">
						<a href="<?=base_url().'index.php/pembelian'?>">Pembelian<br>						
						<small>Daftar Pembelian &gt; Tambah Pembelian</small></a>
					</li>
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/loading.png" width="48" height="48">
						<a href="<?=base_url().'index.php/inventory_pusat'?>">Persediaan<br>
						<small>Persediaan</small></a>
					</li>
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/modify.png" width="48" height="48">
						<a href="<?=base_url().'index.php/penjualan'?>">Penjualan<br>
						<small>Daftar Penjualan &gt; Tambah Penjualan</small></a>
					</li>
					

					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/line-chart.png" width="48" height="48">
						<a href="<?=base_url().'index.php/laporan_pembelian'?>">Laporan Pembelian<br>
						<small>Laporan Pembelian</small></a>
					</li>
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/bar-chart.png" width="48" height="48">
						<a href="<?=base_url().'index.php/laporan_penjualan/form_lap_penjualan_periode'?>">Laporan Penjualan<br>
						<small>Laporan Penjualan</small></a>
					</li>
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/dashboard.png" width="48" height="48">
						<a href="<?=base_url().'index.php/setting_view'?>">Dashboard<br>
						<small>Setting dashboard &gt; Teks awal, gambar, dll</small></a>
					</li>
					
					<li>
						<img src="<?=base_url()?>asset/admin/images/icons/web-app/48/Check.png" width="48" height="48">
						<a href="javascript:void();" >Layanan</a>
						<a title="Layanan Pihak Ke 3" href="<?=base_url().'index.php/layanan_jasa_kredit'?>"><img src="<?=base_url()?>asset/admin/images/icons/web-app/48/Adira-Finance2.png" width="92" height="32"></a>
						<a title="Layanan Speedy" href="<?=base_url().'index.php/layanan_jasa_speedy'?>"><img src="<?=base_url()?>asset/admin/images/icons/web-app/48/speedy.png" width="92" height="32"></a>
						<a title="Layanan Listrik" href="<?=base_url().'index.php/layanan_jasa_listrik'?>"><img src="<?=base_url()?>asset/admin/images/icons/web-app/48/pln.png" width="92" height="32"></a>
						<a title="Layanan PDAM" href="<?=base_url().'index.php/layanan_jasa_pdam'?>"><img src="<?=base_url()?>asset/admin/images/icons/web-app/48/pdam.png" width="92" height="32"></a>
						<a title="Layanan Telepon" href="<?=base_url().'index.php/layanan_jasa_telepon'?>"><img src="<?=base_url()?>asset/admin/images/icons/web-app/48/telkom.jpg" width="92" height="32"></a>
					</li>
					
				</ul>
				
				
			<!--</div></div>-->
		</section>
		
		<section class="grid_80">
			<div class="block-border"><div class="block-content">
				<div class="h1 with-menu">
					<h1>Dashboard</h1>
					
				</div>
			
				<div class="block-controls">
					
					<ul class="controls-tabs js-tabs same-height with-children-tip">
						<li><a href="#tab-stats" title="&nbsp" width="24" height="24"></a></li>
					</ul>
					
				</div>
				
				<form class="form" id="tab-stats" method="post" action="">						
						
					<div class="task with-legend">
							<div class="legend"><img src="images/icons/fugue/status-away.png" width="16" height="16">SAWERIGADING</div>
							
							<div class="task-description">		
								<div align="justify">
								<br> </br>
								<center><img src="<?=base_url()?>asset/admin/upload/dashboard/<?=$gambar1?>" width="400" height="300"></center>
								<br>
								<center><img src="<?=base_url()?>asset/admin/upload/dashboard/<?=$gambar2?>" width="400" height="300"></center>
								<br/>
								<?=$judul?>
								<br/>
								<?=$detail?>

								</div>
							</div>
							</ul>
					</div>
				</form>
				
				<ul class="message no-margin">
					<li> <strong>Tentang SAWERIGADING</strong></li>
				</ul>
				
			</div></div>
		</section>
		
		<div class="clear"></div>
		
	</article>
	
	<!-- End content -->
	
	