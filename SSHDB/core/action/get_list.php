<?php
//SSHDB
if(!is_array($ele)){$eles = explode(',',$ele);}else{$eles=$ele;}$eles_count = count($eles);
if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);

$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);

$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
for($j=0;$j<$ele_count;$j++){
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$j]);
	$ele_ids[$j] = $ele_content_split[0];
}


$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');

for($k=0;$k<$var_count;$k++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$k]);
	$var_ids[$k] = $var_content_split[0];
	$var_ids_plus[$k+4] = $var_content_split[0];
}


for($l=0;$l<$eles_count;$l++){
	if(!in_array($eles[$l],$ele_ids)){return $sshdb_msg_inc = 39;}
	$eles_no[$l] = array_search($eles[$l], $ele_ids);
	$content_split = explode(SSHDB_EXPLODE1,$ele_split[$eles_no[$l]]);
	
	for($m=0;$m<$attrs_count;$m++){
		if(!in_array($attrs[$m],$var_ids_plus)){return $sshdb_msg_inc = 31;}
	
		$attr_no[$m] = array_search($attrs[$m], $var_ids_plus);
		if($content_split[$attr_no[$m]]==SSHDB_EXPLODE_STACK){
			$content_split[$attr_no[$m]]=sshdb_fopen_r($db_dir.sshdb_hash($table).'/stack/'.sshdb_hash($attrs[$m]).'.'.sshdb_hash($eles[$l]).'.stack.sshdb.php');
		}
		$sshdb_get[$db][$table][$eles[$l]][$attrs[$m]] = $content_split[$attr_no[$m]];
	}
}


?>