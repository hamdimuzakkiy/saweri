<?php

	# memasukan detail barang ke list detail di form add barang
	function add_detail_1()
	{
		$data['detail_namabarang'] = $_POST['detail_namabarang'];
		$data['detail_idbarang'] = $_POST['detail_idbarang'];
		$data['detail_qty'] = $_POST['detail_qty'];
		
		$i=0;
		
		//print_r($detail);
		
		if (isset($_POST['detail']))
		{
			$detail = $_POST['detail'];
			$count_detail = count($detail);
			
			
			for($i=0; $i<$count_detail; $i++)
			{
				echo '
						<tr>
							<td>'.($i + 1).'</td>
							<td>
								'.$detail[$i]['nama_barang'].'
								<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$detail[$i]['nama_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$detail[$i]['id_barang'].'" />
							</td>
							<td>
								'.$detail[$i]['qty'].'
								<input type="hidden" name="detail['.$i.'][qty]" value="'.$detail[$i]['qty'].'" />
							</td>
							<td align="center">
								<a href="Javascript:remove_detail('.$i.')">Batal</a>
							</td>
						</tr>';
			}
		}
		
		echo '
					<tr>
						<td>'.($i + 1).'</td>
						<td>
							'.$data['detail_namabarang'].'
							<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$data['detail_namabarang'].'" />
							<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$data['detail_idbarang'].'" />
						</td>
						<td>
							'.$data['detail_qty'].'
							<input type="hidden" name="detail['.$i.'][qty]" value="'.$data['detail_qty'].'" />
						</td>
						<td align="center">
							<a href="Javascript:remove_detail('.$i.')">Batal</a>
						</td>
					</tr>';
	}

	function add_detail_2()
	{
		$data['detail_namabarang'] = $_POST['detail_namabarang'];
		$data['detail_idbarang'] = $_POST['detail_idbarang'];
		$data['detail_qty'] = $_POST['detail_qty'];
		
		$detail = $_POST['detail'];
		$count_detail = count($detail);
		$i=0;
		
		//print_r($detail);
		
		if ($detail)
		{
			for($i=0; $i<$count_detail; $i++)
			{
				echo '
						<tr>
							<td>'.($i + 1).'</td>
							<td>
								'.$detail[$i]['nama_barang'].'
								<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$detail[$i]['nama_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$detail[$i]['id_barang'].'" />
							</td>
							<td>
								<input type="text" name="detail['.$i.'][qty]" value="'.$detail[$i]['qty'].'" />
							</td>
							<td align="center">
								<a href="Javascript:remove_detail('.$i.')">Batal</a>
							</td>
						</tr>';
			}
		}
		
		echo '
					<tr>
						<td>'.($i + 1).'</td>
						<td>
							'.$data['detail_namabarang'].'
							<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$data['detail_namabarang'].'" />
							<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$data['detail_idbarang'].'" />
						</td>
						<td>
							<input type="text" name="detail['.$i.'][qty]" value="'.$data['detail_qty'].'" />
						</td>
						<td align="center">
							<a href="Javascript:remove_detail('.$i.')">Batal</a>
						</td>
					</tr>';
	}
	
	function remove_detail($id)
	{
		$detail = $_POST['detail'];
		$count_detail = count($detail);
		$i=0;
		$x=0;
		
		if ($detail)
		{
			for($x=0; $x<$count_detail; $x++)
			{
				if($x != $id)
				{
					echo '
						<tr>
							<td>'.($i + 1).'</td>
							<td>
								'.$detail[$x]['nama_barang'].'
								<input type="hidden" name="detail['.$i.'][nama_barang]" value="'.$detail[$x]['nama_barang'].'" />
								<input type="hidden" name="detail['.$i.'][id_barang]" value="'.$detail[$x]['id_barang'].'" />
							</td>
							<td>
								'.$detail[$x]['qty'].'
								<input type="hidden" name="detail['.$i.'][qty]" value="'.$detail[$x]['qty'].'" />
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
		
	}
?>