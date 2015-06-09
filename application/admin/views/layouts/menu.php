
	<!-- Header -->
		<div id="hulu"> 
			<div id="hulu_kiri" ><img src="<?=base_url()?>asset/admin/upload/dashboard/<?=$header1?>" width="439" height="86"></div>			<div id="hulu_kanan"><img src="<?=base_url()?>asset/admin/upload/dashboard/<?=$header2?>" width="357" height="86"></div>
		</div>
	<!-- End server status -->

	<!-- Main nav -->
	<nav id="main-nav">
		<ul class="container_12">
			
			<li class="home current">
				<ul> 
						<li class=" "><?=anchor('dashboard','Dashboard')?></li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Setup</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										# Menu Setup
										#------------------------------------------------------------------------------
										/*
										if ($privilage['setup_perusahaan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('setup_perusahaan','Setup Perusahaan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Setup Perusahaan</li>'; 
										} */
										
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
										if ($privilage['beban_transaksi'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('beban_transaksi','Beban Transaksi').'</li>'; 
										}else{
											echo '<li class="icon_blog">Beban Transaksi</li>'; 
										}
										if ($privilage['kabupaten'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('kabupaten','Kabupaten').'</li>'; 
										}else{
											echo '<li class="icon_blog">Kabupaten</li>'; 
										}
										if ($privilage['kecamatan'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('kecamatan','Kecamatan').'</li>'; 
										}else{
											echo '<li class="icon_blog">Kecamatan</li>'; 
										}										
										if ($privilage['area'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('area','Area / Wilayah').'</li>'; 
										}else{
											echo '<li class="icon_blog">Area / Wilayah</li>'; 
										}																				
										if ($privilage['setting_kode_trans'][0] == 1){ 										
										echo '<li class="icon_blog">'.anchor('setting_kode_trans','Atur Kode Transaksi').'</li>'; 										}else{											echo '<li class="icon_blog">Atur Kode Transaksi</li>'; 										}																				if ($privilage['setting_laporan'][0] == 1){ 										echo '<li class="icon_blog">'.anchor('setting_laporan','Setup Footer Laporan').'</li>'; 										}else{											echo '<li class="icon_blog">Setup Footer Laporan</li>'; 										}																														if ($privilage['setting_view'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('setting_view','Setup Dashboard').'</li>'; 										}else{											echo '<li class="icon_blog">Setup Dashboard</li>'; 										}																																								if ($privilage['setting_login'][0] == 1){ 										echo '<li class="icon_blog">'.anchor('setting_login','Setup Login').'</li>'; 										}else{										echo '<li class="icon_blog">Setup Login</li>'; 										}																				if ($privilage['internal_memo'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('internal_memo','Internal Memo').'</li>'; 										}else{											echo '<li class="icon_blog">Internal Memo</li>'; 										}
									?>
								</ul>
							</div>
						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Master</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
								<ul>
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
									if ($privilage['master_akun'][0] == 1){ 										
										echo '<li class="icon_blog">'.anchor('master_akun','Master Akun').'</li>'; 									}
										else{										
											echo '<li class="icon_blog">Master Akun</li>'; 									
										}																		
										if ($privilage['master_saldo_elektrik'][0] == 1){ 										
											echo '<li class="icon_blog">'.anchor('master_saldo_elektrik','Master Saldo Elektrik').'</li>'; 									
										}
										else{										
											echo '<li class="icon_blog">Master Saldo Elektrik</li>'; 
										}																		
										if ($privilage['master_pulsa'][0] == 1){ 										
											echo '<li class="icon_blog">'.anchor('master_pulsa','Master Pulsa').'</li>'; 	
										}
										else{										
											echo '<li class="icon_blog">Master Pulsa</li>'; 									
										}
										if ($privilage['master_kas'][0] == 1){ 										
											echo '<li class="icon_blog">'.anchor('master_kas','Master Kas').'</li>'; 	
										}
										else{										
											echo '<li class="icon_blog">Master Kas</li>'; 									
										}
									?>
								</ul>
							</div>
						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Pembelian</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<!--<li class="icon_address"><a href="javascript:void(0)">Request Order</a> 
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
									</li>-->
									<?php
										if ($privilage['request_order'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('request_order/index','Request Order').'</li>'; 
										}else{
											echo '<li class="icon_blog">Request Order</li>'; 
										}
									?>
									<?php
										if ($privilage['pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('pembelian','Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Pembelian</li>'; 
										}																														
										/*if ($privilage['pengajuan'][0] == 1){ 											
											echo '<li class="icon_blog">'.anchor('pengajuan','Pengajuan').'</li>'; 										
										}
										else{											
											echo '<li class="icon_blog">Pengajuan</li>'; 										
										} */
										
										if ($privilage['retur_pembelian'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('retur_pembelian','Return Pembelian').'</li>'; 
										}else{
											echo '<li class="icon_blog">Return Pembelian</li>'; 
										}
										
										if ($privilage['terima_barang_retur'][0] == 1){  /*buat nerima barang yg di retur dari pusat ke supp dan menerima kembali barang yang dari supplier ke pusat*/
											echo '<li class="icon_blog">'.anchor('terima_barang_retur','Terima Barang Retur').'</li>'; 
										}else{
											echo '<li class="icon_blog">Terima Barang Retur</li>'; 
										}
										
										if ($privilage['po'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('po','Data PO').'</li>'; 
										}else{
											echo '<li class="icon_blog">Data PO</li>'; 
										}									?>																		<li class="sep"></li>
									
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
						
						
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Persediaan</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
								<ul>
									<?php
										if ($privilage['inventory_pusat'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('inventory_pusat','Persediaan Pusat').'</li>'; 
										}else{
											echo '<li class="icon_blog">Persediaan Pusat</li>'; 
										}
										
										if ($privilage['inventory_cabang'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('inventory_cabang','Persediaan Cabang').'</li>'; 
										}else{
											echo '<li class="icon_blog">Persediaan Cabang</li>'; 
										}
									?>
								</ul>
							</div>
						</li>
						
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Penjualan</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
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
										if ($privilage['penukaran_point'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('penukaran_point','Penukaran Point').'</li>'; 
										}else{
											echo '<li class="icon_blog">Penukaran Point</li>'; 
										}
										
										if ($privilage['so'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('so','Data SO').'</li>'; 
										}else{
											echo '<li class="icon_blog">Data SO</li>'; 
										}									?>									<li class="sep"></li>
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
											echo '<li class="icon_blog">'.anchor('laporan_pembelian/form_lap_saldo_stok','Laporan Saldo Elektrik').'</li>'; 
										}else{
											echo '<li class="icon_blog">Laporan Saldo Elektrik</li>'; 
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
												<li class="with-menu"><a href="javascript:void(0)" title="My settings">Kas dan Bank</a>							<div class="menu">								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">								<ul>									<?php																			if ($privilage['kas_awal'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('kas_awal/index','Kas Awal').'</li>'; 										}else{											echo '<li class="icon_blog">Kas Awal</li>'; 										}																						if ($privilage['penerimaan_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('penerimaan_kas/index','Penerimaan Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Penerimaan Kas</li>'; 										}																				if ($privilage['pengeluaran_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('pengeluaran_kas/index','Pengeluaran Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Pengeluaran Kas</li>'; 										}																														/*if ($privilage['pengeluaran_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('pengeluaran_kas/index','Pengeluaran Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Pengeluaran Kas</li>'; 										} */																														if ($privilage['mutasi_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('mutasi_kas/index','Mutasi Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Mutasi Kas</li>'; 										}																																								if ($privilage['refund'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('refund/index','Refund').'</li>'; 										}else{											echo '<li class="icon_blog">Refund</li>'; 										}																				?>										<li class="sep"></li>										<?php																				if ($privilage['hutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('hutang/pembayaran','Pembayaran Hutang').'</li>'; 										}else{											echo '<li class="icon_blog">Pembayaran Hutang</li>'; 										}																				if ($privilage['posting_hutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('posting_hutang/index','Posting Hutang').'</li>'; 										}else{											echo '<li class="icon_blog">Posting Hutang</li>'; 										}																			?>									<li class="sep"></li>									<?php																					if ($privilage['piutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('piutang/pembayaran','Pembayaran Piutang').'</li>'; 										}else{											echo '<li class="icon_blog">Pembayaran Piutang</li>'; 										}																				if ($privilage['posting_piutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('posting_piutang/index','Posting Piutang').'</li>'; 										}else{											echo '<li class="icon_blog">Posting Piutang</li>'; 										}																					?>																			<?php /*										if ($privilage['posting_mutasi_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('posting_mutasi_kas/index','Posting Mutasi Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Posting Mutasi Kas</li>'; 										}*/																			?>																	</ul>							</div>						</li>												<!--						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Hutang</a>							<div class="menu">								<img src="images/menu-open-arrow.png" width="16" height="16">								<ul>									<?php/*										if ($privilage['master_hutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('hutang/index','Master Hutang').'</li>'; 										}else{											echo '<li class="icon_blog">Master Hutang</li>'; 										}										*/																																												?>								</ul>							</div>						</li>-->											<!--	<li class="with-menu"><a href="javascript:void(0)" title="My settings">PIUTANG</a>							<div class="menu">								<img src="images/menu-open-arrow.png" width="16" height="16">								<ul>									<?php  /*										if ($privilage['piutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('piutang/index','Master Piutang ').'</li>'; 										}else{											echo '<li class="icon_blog">Master Piutang</li>'; 										}																														*/									?>								</ul>							</div>						</li>-->																		<li class="with-menu"><a href="javascript:void(0)" title="My settings">Laporan</a>							<div class="menu">								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">								<ul>									<?php										if ($privilage['laporan_biaya'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_biaya','Laporan Biaya').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Biaya</li>'; 										}																				if ($privilage['laporan_buku_kas'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_buku_kas','Laporan Buku Kas').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Buku Kas</li>'; 										}																				if ($privilage['laporan_laba_rugi'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_laba_rugi','Laporan Laba Rugi').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Laba Rugi</li>'; 										}																				if ($privilage['laporan_hutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_hutang','Laporan Hutang [Supplier]').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Hutang [Supplier]</li>'; 										}																				if ($privilage['laporan_piutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_piutang','Laporan Piutang [Pelanggan]').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Piutang [Pelanggan]</li>'; 										}																				if ($privilage['laporan_piutang_cabang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_piutang/laporan_piutang_cabang','Laporan Piutang [Cabang]').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Piutang [Cabang]</li>'; 										}									?>										<li class="sep"></li>									<?php																																						if ($privilage['laporan_pembayaran_hutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_pembayaran_hutang','Laporan Pembayaran Hutang').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Pembayaran Hutang</li>'; 										}																														if ($privilage['laporan_pembayaran_piutang'][0] == 1){ 											echo '<li class="icon_blog">'.anchor('laporan_pembayaran_piutang','Laporan Pembayaran Piutang').'</li>'; 										}else{											echo '<li class="icon_blog">Laporan Pembayaran Piutang</li>'; 										}									?>								</ul>							</div>						</li>
						<li class="with-menu"><a href="javascript:void(0)" title="My settings">Grafik</a>
							<div class="menu">
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
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
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
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
								<img src="asset/admin/images/menu-open-arrow.png" width="16" height="16">
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
										
										/* if ($privilage['users'][0] == 1){ 
											echo '<li class="icon_blog">'.anchor('users','User').'</li>'; 
										}else{
											echo '<li class="icon_blog">User</li>'; 
										} */
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
			<li>&nbsp;&nbsp;<?/*=date('d/m/Y').'&nbsp;&nbsp;'.date('H:i');*/?>&nbsp;&nbsp;</li>
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