<?php
//SSHDB
if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
if(!is_array($ele)){$eles = explode(',',$ele);}else{$eles=$ele;}$eles_count = count($eles);
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
$table_content = sshdb_fopen_r($table_dir);
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
for($j=0;$j<$ele_count;$j++){
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$j]);
	$ele_ids[$j] = $ele_content_split[0];
}

$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');
if($table_split[2]){
for($k=0;$k<$var_count;$k++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$k]);
	$var_ids_plus[$k+4] = $var_content_split[0];
}
}else{
$var_count = 0;
}
if(!$ele){
$eles = $ele_ids;
$eles_count = $ele_count;
}
if(!$attr){
	$attrs = $var_ids_plus;
	$attrs_count = $var_count+4;
}
for($l=0;$l<$eles_count;$l++){
if(!in_array($eles[$l],$ele_ids)){return $sshdb_msg_inc = 39;}
$ele_no[$l] = array_search($eles[$l], $ele_ids);
$content_split = explode(SSHDB_EXPLODE1,$ele_split[$ele_no[$l]]);
	for($m=0;$m<$attrs_count;$m++){
		$content_real = $content_split[array_search($attrs[$m], $var_ids_plus)];
		if($content_real==SSHDB_EXPLODE_STACK){
			$content_real = sshdb_fopen_r($db_dir.sshdb_hash($table).'/stack/'.sshdb_hash($attrs[$m]).'.'.sshdb_hash($eles[$l]).'.stack.sshdb.php');
		}
		if(in_array($attrs[$m],$var_ids_plus)){$sshdb_get[$db][$table][$eles[$l]][$attrs[$m]]=$content_real;}
	}
}


?>