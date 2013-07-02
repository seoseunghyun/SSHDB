<?
//SSHDB
if(!is_array($attr_search)){$attr_searchs = explode(',',$attr_search);}else{$attr_searchs=$attr_search;}$attr_searchs_count = count($attr_searchs);
if(!is_array($attr_get)){$attr_gets = explode(',',$attr_get);}else{$attr_gets=$attr_get;}$attr_gets_count = count($attr_gets);
if(!$search){return $sshdb_msg_inc = 95;}

$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);



$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');
if($table_split[2]){
for($j=0;$j<$var_count;$j++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $var_content_split[0];
	$var_ids_plus[$j+4] = $var_content_split[0];
}
}else{
$var_count = 0;
}
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
if(!$ele_split[0]){return $sshdb_msg_inc = 74;}
for($k=0;$k<$ele_count;$k++){
	$ele_content_split[$k] = explode(SSHDB_EXPLODE1,$ele_split[$k]);
}
if(!$attr_search){
	$attr_searchs = $var_ids_plus;
	$attr_searchs_count = $var_count+4;
}
if(!$attr_get){
	$attr_gets = $var_ids_plus;
	$attr_gets_count = $var_count+4;
}

for($m=0;$m<$attr_gets_count;$m++){
if(!in_array($attr_gets[$m],$var_ids_plus)){return $sshdb_msg_inc = 75;}
$m_no[$m] = array_search($attr_gets[$m], $var_ids_plus);
}
$sshdb_print='';
for($l=0;$l<$attr_searchs_count;$l++){
	if(!in_array($attr_searchs[$l],$var_ids_plus)){return $sshdb_msg_inc = 76;}
	$l_no = array_search($attr_searchs[$l], $var_ids_plus);
	for($n=0;$n<$ele_count;$n++){
		if(strpos($ele_content_split[$n][$l_no], $search)!==false){
			for($o=0;$o<$attr_gets_count;$o++){
			$o_no = $m_no[$o];
			
			if($ele_content_split[$n][$o_no]==SSHDB_EXPLODE_STACK){
			$ele_content_split[$n][$o_no]=sshdb_fopen_r($db_dir.sshdb_hash($table).'/stack/'.sshdb_hash($var_ids_plus[$o_no]).'.'.sshdb_hash($ele_content_split[$n][0]).'.stack.sshdb.php');
			}
			$sshdb_print[$ele_content_split[$n][0]][$var_ids_plus[$o_no]] = $ele_content_split[$n][$o_no];
			}
			
		}
	}
}
if(!$sshdb_print){return $sshdb_msg_inc = 96;}
return $sshdb_print;
/*
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
*/

?>