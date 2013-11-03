<?php
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}
if(sshdb_filter_fatal($var.$tag) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($var)){$vars = explode(',',$var);}else{$vars=$var;}$vars_count = count($vars);
if(!is_array($tag)){$tags = explode(',',$tag);}else{$tags=$tag;}$tags_count = count($tags);

$vars_uniq_count = count(array_unique($vars));
if($vars_count != $vars_uniq_count) {return $sshdb_msg_inc = 28;}

for($i=0;$i<$vars_count;$i++){
	if(!isset($vars[$i]) || $vars[$i]==''){return $sshdb_msg_inc = 9;}
	if(in_array($vars[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 7;}
	if(sshdb_filter_preg($vars[$i]) == 0){return $sshdb_msg_inc = 83;}
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
for($j=0;$j<$var_count;$j++){
	$content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $content_split[0];
}

for($k=0;$k<$vars_count;$k++){
	if(isset($var_ids) && in_array($vars[$k],$var_ids)){return $sshdb_msg_inc = 29;}
	array_push($var_split,$vars[$k].SSHDB_EXPLODE1.sshdb_date().SSHDB_EXPLODE1.$tags[$k].SSHDB_EXPLODE1.SSHDB_NULL);
}

$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
if($table_split[3]){
	for($l=0;$l<$ele_count;$l++){
		$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$l]);
		for($m=0;$m<$vars_count;$m++){
		array_push($ele_content_split,SSHDB_NULL);
		}
		$ele_split[$l] = implode($ele_content_split,SSHDB_EXPLODE1);
	}
}
$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_split[2] = implode($var_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>