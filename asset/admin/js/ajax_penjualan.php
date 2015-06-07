<?php
	#
	include('convert_rupiah.php');
	
	# memasukan detail barang ke list detail di form add barang
	function add_detail_1()
	{
		$data = $_POST['items'];
		
		$i=0;
		
		if (isset($_POST['detail']))
		{
			$detail = $_POST['detail'];
			$count_detail = count($detail);
			
			for($i=0; $i<$count_detail; $i++)
			{				
				$total = $detail[$i]['harga'] * $detail[$i]['qty'];
				echo '
						<tr id="ajaxpenjualan">
							<td>'.($i + 1).'</td>
							<td>
								'.$detail[$i]['nama_barang'].'
								<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$detail[$i]['nama_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$detail[$i]['id_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_detail_pembelian]" value="'.$detail[$i]['id_detail_pembelian'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($detail[$i]['harga']).'
								<input type="hidden" name="detail['.$i.'][harga]" value="'.$detail[$i]['harga'].'" />
							</td>
							<td align="right">
								'.$detail[$i]['qty'].'
								<input type="hidden" name="detail['.$i.'][qty]" value="'.$detail[$i]['qty'].'" />
							</td>
							<td>
								'.$detail[$i]['sn'].'
								<input type="hidden" name="detail['.$i.'][sn]" value="'.$detail[$i]['sn'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($total).'
								<input type="hidden" name="detail['.$i.'][total]" value="'.$total.'" />
							</td>
							<td align="center">
								<a href="Javascript:remove_detail('.$i.')">Batal</a>
							</td>
						</tr>';
			}
		}
		
		$xx = 0;
		foreach($data as $row){
			if(isset($data[$xx]['id_detail_pembelian'])){				$total = $data[$xx]['harga'] * $data[$xx]['qty'];
				echo '
						<tr id="ajaxpenjualan">
							<td>'.($i + 1).'</td>
							<td>
								'.$data[$xx]['nama_barang'].'
								<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$data[$xx]['nama_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$data[$xx]['id_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_detail_pembelian]" value="'.$data[$xx]['id_detail_pembelian'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($data[$xx]['harga']).'
								<input type="hidden" name="detail['.$i.'][harga]" value="'.$data[$xx]['harga'].'" />
							</td>
							
							<td align="right">
								'.$data[$xx]['satuan'].'
								<input type="hidden" name="detail['.$i.'][satuan]" value="'.$data[$xx]['satuan'].'" />
							</td>

							<td align="right">
									'.$data[$xx]['qty'].'
								<input type="hidden" name="detail['.$i.'][qty]" value="'.$data[$xx]['qty'].'" />
							</td>
							<td>
								'.$data[$xx]['sn'].'
								<input type="hidden" name="detail['.$i.'][sn]" value="'.$data[$xx]['sn'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($total).'
								<input type="hidden" name="detail['.$i.'][total]" value="'.$total.'" />
							</td>
							<td align="center">
								<a href="Javascript:remove_detail('.$i.')">Batal</a>
							</td>
						</tr>';
				$i++;
			}
			$xx++;
		}
	}

	function add_detail_2()
	{
		$data['detail_namabarang'] = $_POST['detail_namabarang'];
		$data['detail_idbarang'] = $_POST['detail_idbarang'];
		$data['detail_harga'] = $_POST['detail_harga'];
		$data['detail_transaksi'] = $_POST['detail_transaksi'];
		$data['detail_qty'] = $_POST['detail_qty'];
		$data['detail_sn'] = $_POST['detail_sn'];
		$data['detail_total'] = $data['detail_transaksi'] * $data['detail_qty'];
		
		
		$i=0;
		
		//print_r($detail);
		
		if (isset($_POST['detail']))
		{
			$detail = $_POST['detail'];
			$count_detail = count($detail);
		
			for($i=0; $i<$count_detail; $i++)
			{								$total = $detail[$i]['harga'] * $detail[$i]['qty'];				
				echo '					
						<tr id="ajaxpenjualan">
							<td>'.($i + 1).'</td>
							<td>
								'.$detail[$i]['nama_barang'].'
								<input type="hidden" id="nama_barang'.$i.'" name="detail['.$i.'][nama_barang]" value="'.$detail[$i]['nama_barang'].'" />
								<input type="hidden" id="id_barang'.$i.'" name="detail['.$i.'][id_barang]" value="'.$detail[$i]['id_barang'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($detail[$i]['harga']).'
								<input type="hidden" id="harga'.$i.'" name="detail['.$i.'][harga]" value="'.$detail[$i]['harga'].'" />
							</td>
							<td align="right">
								<input type="text" size="3" id="qty'.$i.'" name="detail['.$i.'][qty]" value="'.$detail[$i]['qty'].'" onkeyup="change_total('.$i.')" />
							</td>
							<td>
								'.$detail[$i]['sn'].'
								<input type="hidden" name="detail['.$i.'][sn]" value="'.$detail[$i]['sn'].'" />
							</td>
							<td align="right">
								<div id="label_total'.$i.'">'.convert_rupiah($total).'</div>
								<input type="hidden" id="total'.$i.'" name="detail['.$i.'][total]" value="'.$total.'" />
							</td>
						</tr>';
			}
		}
						$total = $data['detail_harga'] * $data['detail_qty'];
				echo '
						<tr>
							<td>'.($i + 1).'</td>
							<td>
								'.$data['detail_namabarang'].'
								<input type="hidden" id="nama_barang'.$i.'" name="detail['.$i.'][nama_barang]" value="'.$data['detail_namabarang'].'" />
								<input type="hidden" id="id_barang'.$i.'" name="detail['.$i.'][id_barang]" value="'.$data['detail_idbarang'].'" />
							</td>
							<td align="right">
								'.convert_rupiah($data['detail_harga']).'
								<input type="hidden" id="harga'.$i.'" name="detail['.$i.'][harga]" value="'.$data['detail_harga'].'" />
							</td>
							<td align="right">
								<input type="text" size="3" id="qty'.$i.'" name="detail['.$i.'][qty]" value="'.$data['detail_qty'].'" onkeyup="change_total('.$i.')" />
							</td>
							<td>
								'.$data['detail_sn'].'
								<input type="hidden" name="detail['.$i.'][sn]" value="'.$data['detail_sn'].'" />
							</td>
							<td align="right">
								<div id="label_total'.$i.'">'.convert_rupiah($total).'</div>
								<input type="hidden" id="total'.$i.'" name="detail['.$i.'][total]" value="'.$total.'" />
							</td>
						</tr>';
	}
	
	function remove_detail($id)
	{
		$i=0;
		$x=0;
		
		if (isset($_POST['detail']))
		{
			$detail = $_POST['detail'];
			$count_detail = count($detail);
			
			for($x=0; $x<$count_detail; $x++)
			{
				if($x != $id)
				{
					echo '
							<tr id="ajaxpenjualan">
								<td>'.($i + 1).'</td>
								<td>
									'.$detail[$x]['nama_barang'].'
									<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$detail[$x]['nama_barang'].'" />
									<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$detail[$x]['id_barang'].'" />
								</td>
								<td align="right">
									'.convert_rupiah($detail[$x]['harga']).'
									<input type="hidden" name="detail['.$i.'][harga]" value="'.$detail[$x]['harga'].'" />
								</td>
								<td align="right">
									'.$detail[$x]['qty'].'
									<input type="hidden" name="detail['.$i.'][qty]" value="'.$detail[$x]['qty'].'" />
								</td>
								<td>
									'.$detail[$x]['sn'].'
									<input type="hidden" name="detail['.$i.'][sn]" value="'.$detail[$x]['sn'].'" />
								</td>
								<td align="right">
									'.convert_rupiah($detail[$x]['total']).'
									<input type="hidden" name="detail['.$i.'][total]" value="'.$detail[$x]['total'].'" />
								</td>
								<td align="center">
									<a href="Javascript:remove_detail('.$i.')">Batal</a>
								</td>
							</tr>';
					$i++;
				}
			}
		}
	}
	
	$command = $_GET['command'];
	
	if($command == 'add_1')
	{
		add_detail_1();
	
	}else if($command == 'add_2')
	{
		add_detail_2();
	
	}else if($command == 'remove')
	{
		$id 	 = $_GET['id'];
		remove_detail($id);
		
	}else if($command == 'change_total')
	{
		echo convert_rupiah($_GET['total']);
	}
?>