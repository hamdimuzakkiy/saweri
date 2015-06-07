<?php
	function convert_rupiah($number=0)
	{
		if($number==''){
			$rupiah = number_format(0, 0, ',', '.').',-';
			$rupiah2 = 'Rp. '.str_pad($rupiah, 15, '#', STR_PAD_LEFT);

			return str_replace('#', '&nbsp;', $rupiah2);
			
		}else{
			$rupiah = number_format($number, 0, ',', '.').',-';
			$rupiah2 = 'Rp. '.str_pad($rupiah, 15, '#', STR_PAD_LEFT);

			return str_replace('#', '&nbsp;', $rupiah2);
		}
		
	}
?>