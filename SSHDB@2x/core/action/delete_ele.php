<?
//SSHDB
if(!$ele){return $sshdb_msg_inc = 41;}

if(!is_array($ele)){$eles = explode(',',$ele);}else{$eles=$ele;}$eles_count = count($eles);

$eles_uniq_count = count(array_unique($eles));
if($eles_count != $eles_uniq_count) {return $sshdb_msg_inc = 36;}

for($i=0;$i<$eles_count;$i++){
	if(!isset($eles[$i]) || $eles[$i]==''){return $sshdb_msg_inc = 9;}
}

$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
if(!$ele_split[0]){array_splice($ele_split,0,1);}

$ele_count = count($ele_split);
for($j=0;$j<$ele_count;$j++){
	$content_split = explode(SSHDB_EXPLODE1,$ele_split[$j]);
	$ele_ids[$j] = $content_split[0];
}
if(!isset($ele_ids)||!$ele_ids){return $sshdb_msg_inc = 39;}
for($k=0;$k<$eles_count;$k++){

	if(!in_array($eles[$k],$ele_ids)){return $sshdb_msg_inc = 39;}
	$ele_no = array_search($eles[$k], $ele_ids);
	array_splice($ele_split, $ele_no,1);
	array_splice($ele_ids, $ele_no,1);
	
	$stack_dir = $db_dir.sshdb_hash($table).'/stack';
	$stack_dirs = dir($stack_dir);
	while(false !== ($stack_entry = $stack_dirs->read()))
	{
	if($stack_entry != '.' && $stack_entry != '..'){
	$stack_split = explode('.',$stack_entry);
	if(sshdb_hash($eles[$k]) == $stack_split[1]){
	unlink($stack_dir.'/'.$stack_entry);
	}
	}
	}
	$stack_dirs->close();
	
}
$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>