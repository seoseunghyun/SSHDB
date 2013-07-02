<?
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}
if(sshdb_filter_fatal($ele.$tag) == 0){return $sshdb_msg_inc = 5;}


if(!is_array($ele)){$eles = explode(',',$ele);}else{$eles = $ele;}$eles_count = count($eles);
if(!is_array($tag)){$tags = explode(',',$tag);}else{$tags = $tag;}$tags_count = count($tags);

$eles_uniq_count = count(array_unique($eles));
if($eles_count != $eles_uniq_count) {return $sshdb_msg_inc = 36;}

for($i=0;$i<$eles_count;$i++){
	if(!isset($eles[$i]) || $eles[$i]==''){return $sshdb_msg_inc = 9;}
	if(in_array($eles[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 7;}
	if(sshdb_filter_preg($eles[$i]) == 0){return $sshdb_msg_inc = 83;}
	if(!isset($tags[$i]) || $tags[$i] == ''){$tags[$i] = SSHDB_NULL;}
}

$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);

if(!$var_split[0]){array_splice($var_split,0,1);}
$var_count = count($var_split);

$vars_add = '';
for($j=0;$j<$var_count;$j++){$vars_add .= SSHDB_EXPLODE1.SSHDB_NULL;}
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);

if(!$ele_split[0]){array_splice($ele_split,0,1);}
$ele_count = count($ele_split);

for($k=0;$k<$ele_count;$k++){
	$content_split = explode(SSHDB_EXPLODE1,$ele_split[$k]);
	$ele_ids[$k] = $content_split[0];
}

for($l=0;$l<$eles_count;$l++){
	if(isset($ele_ids) && in_array($eles[$l],$ele_ids)){return $sshdb_msg_inc = 37;}
	array_push($ele_split,$eles[$l].SSHDB_EXPLODE1.sshdb_date().SSHDB_EXPLODE1.$tags[$l].SSHDB_EXPLODE1.SSHDB_NULL.$vars_add);
}
$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>