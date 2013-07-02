<?
//SSHDB
if(!$var){return $sshdb_msg_inc = 33;}

if(!is_array($var)){$vars = explode(',',$var);}else{$vars=$var;}$vars_count = count($vars);

$vars_uniq_count = count(array_unique($vars));
if($vars_count != $vars_uniq_count) {return $sshdb_msg_inc = 28;}

for($i=0;$i<$vars_count;$i++){
	if(!isset($vars[$i]) || $vars[$i]==''){return $sshdb_msg_inc = 9;}
	if(in_array($vars[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 34;}
}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
if(!$var_split[0]){array_splice($var_split,0,1);}
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
if(!$ele_split[0]){array_splice($ele_split,0,1);}
$var_count = count($var_split);
$ele_count = count($ele_split);
for($j=0;$j<$var_count;$j++){
	$content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $content_split[0];
}
if(!isset($var_ids)||!$var_ids){return $sshdb_msg_inc = 31;}
for($k=0;$k<$vars_count;$k++){

	if(!in_array($vars[$k],$var_ids)){return $sshdb_msg_inc = 31;}
	$var_no = array_search($vars[$k], $var_ids);
	array_splice($var_split, $var_no,1);
	array_splice($var_ids, $var_no,1);
		for($l=0;$l<$ele_count;$l++){
		$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$l]);
		array_splice($ele_content_split, $var_no+4,1);
		$ele_split[$l] = implode($ele_content_split,SSHDB_EXPLODE1);
		}
	$stack_dir = $db_dir.sshdb_hash($table).'/stack';
	$stack_dirs = dir($stack_dir);
	while(false !== ($stack_entry = $stack_dirs->read()))
	{
	if($stack_entry != '.' && $stack_entry != '..'){
	$stack_split = explode('.',$stack_entry);
	if(sshdb_hash($vars[$k]) == $stack_split[0]){
	unlink($stack_dir.'/'.$stack_entry);
	}
	}
	}
	$stack_dirs->close();
}

$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_split[2] = implode($var_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>