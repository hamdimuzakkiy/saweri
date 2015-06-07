<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Fungsi
{
function Fungsi()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('fpdf');
		
		@$kbase="8aHe3nUv9Wo4";
	}
function jam()
	{
	$wjam=date('H');
	$wmin=date('i');
	$wsec=date('s');
	$output="$wjam:$wmin:$wsec";
	return $output;
	}
function complete($in,$max)
	{
		$len = $max;
		$len_in = strlen($in);
		$zero_len = $len - $len_in;
		$zero = "";
		for($i=1;$i<=$zero_len;$i++)
		{
			$zero .= '0';
		}
		return $zero.$in;
	}
function bulan()
	{
	$input=date('n');
	if($input=='1'){$output='Januari';}
	if($input=='2'){$output='Februari';}
	if($input=='3'){$output='Maret';}
	if($input=='4'){$output='April';}
	if($input=='5'){$output='Mei';}
	if($input=='6'){$output='Juni';}
	if($input=='7'){$output='Juli';}
	if($input=='8'){$output='Agustus';}
	if($input=='9'){$output='September';}
	if($input=='10'){$output='Oktober';}
	if($input=='11'){$output='November';}
	if($input=='12'){$output='Desember';}
	return $output;
	}
function bulan2($rrr)
	{
	if($rrr=='1' || $rrr=='01'){$ttt='Januari';}
	if($rrr=='2' || $rrr=='02'){$ttt='Februari';}
	if($rrr=='3' || $rrr=='03'){$ttt='Maret';}
	if($rrr=='4' || $rrr=='04'){$ttt='April';}
	if($rrr=='5' || $rrr=='05'){$ttt='Mei';}
	if($rrr=='6' || $rrr=='06'){$ttt='Juni';}
	if($rrr=='7' || $rrr=='07'){$ttt='Juli';}
	if($rrr=='8' || $rrr=='08'){$ttt='Agustus';}
	if($rrr=='9' || $rrr=='09'){$ttt='September';}
	if($rrr=='10'){$ttt='Oktober';}
	if($rrr=='11'){$ttt='November';}
	if($rrr=='12'){$ttt='Desember';}
	return $ttt;
	}
function bulan3($rrr)
	{
	if($rrr=='1' || $rrr=='01'){$ttt='Jan';}
	if($rrr=='2' || $rrr=='02'){$ttt='Feb';}
	if($rrr=='3' || $rrr=='03'){$ttt='Mar';}
	if($rrr=='4' || $rrr=='04'){$ttt='Apr';}
	if($rrr=='5' || $rrr=='05'){$ttt='Mei';}
	if($rrr=='6' || $rrr=='06'){$ttt='Jun';}
	if($rrr=='7' || $rrr=='07'){$ttt='Jul';}
	if($rrr=='8' || $rrr=='08'){$ttt='Ags';}
	if($rrr=='9' || $rrr=='09'){$ttt='Sep';}
	if($rrr=='10'){$ttt='Okt';}
	if($rrr=='11'){$ttt='Nop';}
	if($rrr=='12'){$ttt='Des';}
	return $ttt;
	}
function hari()
	{
	$input=date('D');
	if($input=='Sun'){$output='Minggu';}
	if($input=='Mon'){$output='Senin';}
	if($input=='Tue'){$output='Selasa';}
	if($input=='Wed'){$output='Rabu';}
	if($input=='Thu'){$output='Kamis';}
	if($input=='Fri'){$output='Jumat';}
	if($input=='Sat'){$output='Sabtu';}
	return $output;
	}
function hari2($in)
	{
	$tgl = substr($in,8,2);
	$bln = substr($in,5,2);
	$thn = substr($in,0,4);
	$stamp = mktime(0,0,0,$bln,$tgl,$thn);
	$input= date('D',$stamp);
	if($input=='Sun'){$output='Minggu';}
	if($input=='Mon'){$output='Senin';}
	if($input=='Tue'){$output='Selasa';}
	if($input=='Wed'){$output='Rabu';}
	if($input=='Thu'){$output='Kamis';}
	if($input=='Fri'){$output='Jumat';}
	if($input=='Sat'){$output='Sabtu';}
	return $output;
	}
function tanggal_lengkap()
	{
	$output=$this->hari()." ".date('j')."-".$this->bulan()."-".date('Y');
	return $output;
	}
function tanggal_resmi()
	{
	$output=date('d')." ".$this->bulan()." ".date('Y');
	return $output;
	}
function tanggal_mysql()
	{
	$output=date('Y-m-d');
	return $output;
	}	
	
function timestamp_to_tanggal($timestamp)
	{
	$tgl = date('d',$timestamp);
	$bln = date('n',$timestamp);
	$thn = date('Y',$timestamp);
	$output=$tgl." ".$this->bulan2($bln)." ".$thn;
	return $output;
	}
function timestamp_to_tanggal2($timestamp)
	{
	$tgl = date('d',$timestamp);
	$bln = date('n',$timestamp);
	$thn = date('Y',$timestamp);
	$output=$tgl." ".$this->bulan3($bln)." ".$thn;
	return $output;
	}
function date_to_tanggal($in)
	{
	$tgl = substr($in,8,2);
	$bln = substr($in,5,2);
	$thn = substr($in,0,4);
	if(checkdate($bln,$tgl,$thn))
	{
	   $out=substr($in,8,2)." ".$this->bulan2(substr($in,5,2))." ".substr($in,0,4);
	}
	else
	{
	   $out = "<span class='error'>-error-</span>";
	}
	return $out;
	}
function date_to_tanggal2($in)
	{
	$tgl = substr($in,8,2);
	$bln = substr($in,5,2);
	$thn = substr($in,0,4);
	if(checkdate($bln,$tgl,$thn))
	{
	   $out=substr($in,8,2)." ".$this->bulan3(substr($in,5,2))." ".substr($in,0,4);
	}
	else
	{
	   $out = "<span class='error'>-error-</span>";
	}
	return $out;
	}
function tanggal()
	{
	$output=date('j')."x".$this->bulan()."x".date('Y');
	return $output;
	}
function tanggal_pendek()
	{
	$tgl=date('d');
	$bln=date('m');
	$thn=date('y');
	$output=$tgl."-".$bln."-".$thn;
	return $output;
	}
function pecah_tanggal($in)
	{
	$out=substr($in,0,2)." ".$this->bulan2(substr($in,2,2))." 20".substr($in,4,2);
	return $out;
	}
function tanggal_jurnal($in)
	{ // yyyy-mm-dd
	$out[]=$this->bulan2(substr($in,5,2)).' '.substr($in,0,4);
	$out[]=substr($in,8,2);
	return $out;
	}
function tg_to_array($in)
	{
		// yyyy-mm-dd
		$out[]=substr($in,0,4);
		$out[]=substr($in,5,2);
		$out[]=substr($in,8,2);
		return $out;			
	}
function query($db,$query,$id)
	{
	$result=mysql_db_query($db,$query,$id) or die("Kesalahan pada query= ".mysql_error()."<br><font color=\"#FF0000\">$query</font>");
	return $result;
	}
function query_lanjut($db,$query,$id)
	{
	$result=mysql_db_query($db,$query,$id) or print("Kesalahan pada query= ".mysql_error()."<br><font color=\"#FF0000\">$query</font>");
	return $result;
	}

function close($id)
	{
	mysql_close($id);
	}

function get_rnd_iv($iv_len)
	{
	$iv = '';
	while ($iv_len-- > 0)
		{
		$iv .= chr(mt_rand() & 0xff);
		}
	return $iv;
	}

function getip()
	{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
	$ip_lok = getenv("HTTP_CLIENT_IP");
	
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	$ip_lok = getenv("HTTP_X_FORWARDED_FOR");
	
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	$ip_lok = getenv("REMOTE_ADDR");
	
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	$ip_lok = $_SERVER['REMOTE_ADDR'];
	else
	$ip_lok = "unknown";
	return($ip_lok);
	}

function cet_tanggal($a) {
 $b=substr($a,8,2); //tanggal
 $c=substr($a,5,2); //bulan
 $d=substr($a,0,4); //tahun
 if ($b>0 && $c>0 && $d>0){

 echo $b."-";
 if ($c==1){
   echo "Januari";
 } elseif ($c==2){
   echo "Februari";
 } elseif ($c==3){
   echo "Maret";
 } elseif ($c==4){
   echo "April";
 } elseif ($c==5){
   echo "Mei";
 } elseif ($c==6){
   echo "Juni";
 } elseif ($c==7){
   echo "Juli";
 } elseif ($c==8){
   echo "Agustus";
 } elseif ($c==9){
   echo "September";
 } elseif ($c==10){
   echo "Oktober";
 } elseif ($c==11){
   echo "November";
 } elseif ($c==12){
   echo "Desember";
 } else {
   echo " xx ";
 }
   echo "-".$d;
 }else{
    echo "<font color=red><i>(data tanggal tidak tersedia)</i></font>";
  }
}
function tanggalan($a) {
 $b=substr($a,8,2); //tanggal
 $c=substr($a,5,2); //bulan
 $d=substr($a,0,4); //tahun
 if ($b>0 && $c>0 && $d>0){

 echo $b.".".$c.".".$d;
 }else{
    echo "<font color=red><i>(data tanggal tidak tersedia)</i></font>";
  }
}

function warning($input,$goTo='')
	{
	if($goTo=='')
	{
	   $goTo = site_url().'/admin';
	}
	$output="<script> 
                alert(\"$input\");
                location = '$goTo';
            </script>";
	return $output;
	}

function rupiah($uang)
{
	$rupiah="";
	$panjang = strlen($uang);
	while($panjang > 3)
	{
		$rupiah = "." . substr($uang,-3) . $rupiah;
		$lebar=strlen($uang)-3;
		$uang = substr($uang,0,$lebar);
		$panjang = strlen($uang);
	}
	$rupiah = "Rp ".$uang.$rupiah.",-";
	return $rupiah;
}

function pecah($uang,$delimiter='.')
{
	if($uang == '' || $uang == 0)
	{
		$rupiah = '0';
		return $rupiah;
	}
	$neg = false;
	if($uang<0)
	{
		$neg = true;
		$uang = abs($uang);
	}
	$rupiah = number_format($uang,0,',',$delimiter);
	if($neg)
	{
		$rupiah = '('.$rupiah.')';
	}
	return $rupiah;
}


function terbilang($bilangan)
{
    if($bilangan=='' || $bilangan==0)
            return "nol";
      $angka = array('0','0','0','0','0','0','0','0','0','0',
                     '0','0','0','0','0','0');
      $kata = array('','satu','dua','tiga','empat','lima',
                    'enam','tujuh','delapan','sembilan');
      $tingkat = array('','ribu','juta','milyar','triliun');
    
      $panjang_bilangan = strlen($bilangan);
    
      /* pengujian panjang bilangan */
      if ($panjang_bilangan > 15) {
        $kalimat = "Diluar Batas";
        return $kalimat;
      }
    
      /* mengambil angka-angka yang ada dalam bilangan,
         dimasukkan ke dalam array */
      for ($i = 1; $i <= $panjang_bilangan; $i++) {
        $angka[$i] = substr($bilangan,-($i),1);
      }
    
      $i = 1;
      $j = 0;
      $kalimat = "";
    
    
      /* mulai proses iterasi terhadap array angka */
      while ($i <= $panjang_bilangan) {
    
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
    
        /* untuk ratusan */
        if ($angka[$i+2] != "0") {
          if ($angka[$i+2] == "1") {
            $kata1 = "seratus";
          } else {
            $kata1 = $kata[$angka[$i+2]] . " ratus";
          }
        }
    
        /* untuk puluhan atau belasan */
        if ($angka[$i+1] != "0") {
          if ($angka[$i+1] == "1") {
            if ($angka[$i] == "0") {
              $kata2 = "sepuluh";
            } elseif ($angka[$i] == "1") {
              $kata2 = "sebelas";
            } else {
              $kata2 = $kata[$angka[$i]] . " belas";
            }
          } else {
            $kata2 = $kata[$angka[$i+1]] . " puluh";
          }
        }
    
        /* untuk satuan */
        if ($angka[$i] != "0") {
          if ($angka[$i+1] != "1") {
            $kata3 = $kata[$angka[$i]];
          }
        }
    
        /* pengujian angka apakah tidak nol semua,
           lalu ditambahkan tingkat */
        if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
            ($angka[$i+2] != "0")) {
          $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
    
        /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
           ke variabel kalimat */
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;
    
      }
    
      /* mengganti satu ribu jadi seribu jika diperlukan */
      if (($angka[5] == "0") AND ($angka[6] == "0")) {
        $kalimat = str_replace("satu ribu","seribu",$kalimat);
      }
    
      return trim($kalimat);

}
function catat($kegiatan,$awal ='',$isData=false)
{
    $this->CI->load->database();
    if($isData)
    {
        $gab='';
		foreach($kegiatan as $key=>$val):
			if($val==''){ $val='kosong';}
			$keg='<li><b>'.$key.'</b> dengan value <b>'.$val.'</b></li>';
			$gab=$gab.$keg;
		endforeach;
		$str = $awal.'<br />
			<ul>'.$gab.'</ul>';
    }
    else
    {
        $str = $kegiatan;
    }
	$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
		 ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	$ip_name = gethostbyaddr ( $ip );//masuk ke server
	$waktu=date('Y-m-d H:i:s');
	$sudahbaca='0';
	$creator=$this->CI->session->userdata('username');
	if($creator == ''){ $creator = 'Tamu';}	
	//catat ke log
	$this->CI->db->insert('catatan',array('ip'=>$ip,
	                                      'server'=>$ip_name,
	                                      'user'=>$creator,
	                                      'kegiatan'=>$str,
	                                      'waktu'=>$waktu,
										  'sudahbaca'=>$sudahbaca));
	//if(!$act){ echo mysql_error();}
}
function array_delete(&$ary,$key_to_be_deleted)
    {
        // $new = array();
        // if(is_string($key_to_be_deleted)) {
            // if(!array_key_exists($key_to_be_deleted,$ary)) {
                // return;
            // }
            // foreach($ary as $key => $value) {
                // if($key != $key_to_be_deleted) {
                    // $new[$key] = $value;
                // }
            // }
            // $ary = $new;
        // }
        // if(is_array($key_to_be_deleted)) {
            // foreach($key_to_be_deleted as $del) {
                // $this->array_delete(&$ary,$del);
            // }
        // }
    } 
    function romawi($num)
    {
        $n = intval($num);
        $res = '';
         
        /*** Array untuk nilai-nilai tertentu aturan romawi  ***/
        $roman_numerals = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);
         
        foreach ($roman_numerals as $roman => $number)
        {
            /*** melakukan penyesuaian terhadap nilai ***/
            $matches = intval($n / $number);
             
            /*** Melakukan penggantian ke romawi ***/
            $res .= str_repeat($roman, $matches);
             
            /*** pemisahan bilangan ***/
            $n = $n % $number;
        }
         
        return $res;
    }
    function make_cell($txt,$w,$h,$p1=0.3,$p2=0.1,$align='L',$multi=0,$special=false)
    {
        $x = $this->CI->fpdf->GetX();
        $y = $this->CI->fpdf->GetY();
        $this->CI->fpdf->Cell($w,$h,"",1,2);
        $akx = $this->CI->fpdf->GetX();
        $aky = $this->CI->fpdf->GetY();
        $this->CI->fpdf->SetXY($x+$p1,$y+$p2);
        if($multi==0)
        {
            if($special)
            {
                $text = explode(',',$txt);
                $this->CI->fpdf->SetFontSize(12);
                $this->CI->fpdf->Cell(0,0.6,$text[0],0,0,$align); 
                $this->CI->fpdf->Ln();
                $x = $this->CI->fpdf->GetX();
                $y = $this->CI->fpdf->GetY();
                $this->CI->fpdf->SetFontSize(15);
                $this->CI->fpdf->Cell(0,0.8,$text[1],0,0,$align); 
                $this->CI->fpdf->Ln();
                $this->CI->fpdf->SetFontSize(12);
                $this->CI->fpdf->Cell(0,0.5,$text[2],0,0,$align); 
                $this->CI->fpdf->SetXY($x,$y);
                $stw = $this->CI->fpdf->GetStringWidth($text[1]);
                $this->CI->fpdf->Line($x+3.5,$y+0.7,$x+14,$y+0.7);
            }
            else
            {
                $this->CI->fpdf->Cell(0,0.5,$txt,0,0,$align);             
            }
        }
        else
        {
            $this->CI->fpdf->MultiCell(0,0.5,$txt,0,$align); 
        }   
        $this->CI->fpdf->SetXY($akx,$aky);
        $data['x'] = $akx+$w;
        $data['y'] = $aky-$h;
        return $data;
    }
    function random_color(){
        mt_srand((double)microtime()*1000000);
        $c = '';
        while(strlen($c)<6){
            $c .= sprintf("%02X", mt_rand(220, 255));
        }
        return $c;
    }
    function is_allowed_filetype($filetype,$allowed)
	{
		if (count($allowed) == 0 OR ! is_array($allowed))
		{
			return FALSE;
		}			 	
		foreach ($allowed as $mime)
		{		
			if (is_array($mime))
			{
				if (in_array($filetype, $mime, TRUE))
				{
					return TRUE;
				}
			}
			else
			{
				if ($mime == $filetype)
				{
					return TRUE;
				}	
			}		
		}
		
		return FALSE;
	}
	
	function date_diff($d1, $d2)
	{
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);
		$diff_secs = abs($d1 - $d2);
		$base_year = min(date("Y", $d1), date("Y", $d2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array(
			"years" => date("Y", $diff) - $base_year,
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
			"months" => date("n", $diff) - 1,
			"days_total" => floor($diff_secs / (3600 * 24)),
			"days" => date("j", $diff) - 1,
			"hours_total" => floor($diff_secs / 3600),
			"hours" => date("G", $diff),
			"minutes_total" => floor($diff_secs / 60),
			"minutes" => (int) date("i", $diff),
			"seconds_total" => $diff_secs,
			"seconds" => (int) date("s", $diff)
		);
	}
	
	function DateIndo($varSplit, $varDataDate){
		$varSplitDate=explode($varSplit, $varDataDate);
			$varGetDate=$varSplitDate[2];
			$varGetMonth=$varSplitDate[1];
			$varGetYear=$varSplitDate[0];
			
			$varMonthStr=$this->bulan2($varGetMonth);
			
		$varDateIna = $varGetDate . " " . $varMonthStr . " " . $varGetYear ; 
		return $varDateIna;
	}
	
	function DateIndo3($varSplit, $varDataDate){
		$varSplitDate=explode($varSplit, $varDataDate);
			$varGetDate=$varSplitDate[2];
			$varGetMonth=$varSplitDate[1];
			$varGetYear=$varSplitDate[0];
			
			$varMonthStr=$this->bulan3($varGetMonth);
			
		$varDateIna = $varGetDate . " " . $varMonthStr . " " . $varGetYear ; 
		return $varDateIna;
	}

	function uangindo($angka)
	{
		$rupiah="";
		$rp=strlen($angka);
			while ($rp>3)
			{
				$rupiah = ".". substr($angka,-3). $rupiah;
				$s=strlen($angka) - 3;
				$angka=substr($angka,0,$s);
				$rp=strlen($angka);
			}
		$rupiah = "Rp. " . $angka . $rupiah . ",-";
		return $rupiah;
	}
	
	function getColName($optPilihan,$varTanggal){
		if ($optPilihan=="Perbulan"){
			$susunTgl=substr($varTanggal,5,2);
			return	 $this->bulan2($susunTgl);
		}elseif($optPilihan=="Pertanggal"){
			return	$this->DateIndo3("-", $varTanggal);
		}
	}
	
	function gen_glid_counter($split,$name_glid,$counter){
		$var_result=explode($split, $name_glid);
		$result0=$var_result[0];
		$result1=$var_result[1];
		$result2=$var_result[2];
		
		$result2=$result2 + $counter;
		
		$no = str_pad($result2, 4, '0', STR_PAD_LEFT);
		$fin_result=$result0 . '/' . $result1 . '/' . $no;
		
		return $fin_result;
	}
	
	function explode_date($split,$name_glid,$counter){
		$var_result=explode($split, $name_glid);
		$result0=$var_result[0];
		$result1=$var_result[1];
		$result2=$var_result[2];
		
		$result2=$result2 + $counter;
		
		$no = str_pad($result2, 4, '0', STR_PAD_LEFT);
		$fin_result=$result0 . '/' . $result1 . '/' . $no;
		
		return $fin_result;
	}
}
