<?php
require('conn.php');

$now=date('Y-m-d');
$id_filter1 = $_GET['id_filter1'];
$id_filter2 = $_GET['id_filter2'];

if (($id_filter1!=null) && ($id_filter2!=null)){
	$sql = "SELECT * from pr_property_detail where id_kota=" . $id_filter1 . " and id_jenis_jaminan=" . $id_filter2;
}elseif(($id_filter1!=null)&& ($id_filter2==null)){
	$sql = "SELECT * from pr_property_detail where id_kota=" . $id_filter1;
}elseif (($id_filter1==null)&& ($id_filter2!=null)){
	$sql = "SELECT * from pr_property_detail where id_jenis_jaminan=" . $id_filter2;
}else{
	$sql = "SELECT * from pr_property_detail";
}
$res= mysql_query($sql); 

while($r = mysql_fetch_assoc($res)) {
	 $arr['posts'][] = array('id' => $r['id'],'lokasi_jaminan' => $r['lokasi_jaminan'],'luas_bangunan' => $r['luas_bangunan']);
}
print json_encode($arr);
?>