<?php
//SSHDB
if(!$attr){return $sshdb_msg_inc = 11;}
if(!$change){return $sshdb_msg_inc = 12;}
if(sshdb_filter_fatal($change) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
if(!is_array($change)){$changes = explode(',',$change);}else{$changes=$change;}$changes_count = count($changes);

$attrs_uniq_count = count(array_unique($attrs));
if($attrs_count != $attrs_uniq_count) {return $sshdb_msg_inc = 16;}
for($i=0;$i<$attrs_count;$i++){
	if(!isset($changes[$i]) || $changes[$i]==''){return $sshdb_msg_inc = 9;}
	if($attrs[$i] == 'id' && sshdb_filter_preg($changes[$i]) == 0){return $sshdb_msg_inc = 83;}
	if($attrs[$i] == 'id' && in_array($changes[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 14;}
}

$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
$table_stack_dir = $db_dir.sshdb_hash($table).'/stack/';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);

$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
for($j=0;$j<$ele_count;$j++){
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$j]);
	$ele_ids[$j] = $ele_content_split[0];
}

if(!in_array($ele,$ele_ids)){return $sshdb_msg_inc = 39;}
$ele_no = array_search($ele, $ele_ids);


$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');

for($k=0;$k<$var_count;$k++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$k]);
	$var_ids[$k] = $var_content_split[0];
	$var_ids_plus[$k+4] = $var_content_split[0];
}

$content_split = explode(SSHDB_EXPLODE1,$ele_split[$ele_no]);

for($l=0;$l<$attrs_count;$l++){
	if(file_exists($table_stack_dir.sshdb_hash($attrs[$l]).'.'.sshdb_hash($ele).'.stack.sshdb.php')){
		unlink($table_stack_dir.sshdb_hash($attrs[$l]).'.'.sshdb_hash($ele).'.stack.sshdb.php');
	}
	
	if(strlen($changes[$l]) > SSHDB_SIZE_STACK){
		sshdb_fopen_w($table_stack_dir.sshdb_hash($attrs[$l]).'.'.sshdb_hash($ele).'.stack.sshdb.php',$changes[$l]);
		$changes[$l] = SSHDB_EXPLODE_STACK;
	}
	if(!in_array($attrs[$l],$var_ids_plus)){return $sshdb_msg_inc = 31;}
	if($attrs[$l] == 'id' && in_array($changes[$l],$ele_ids)){return $sshdb_msg_inc = 37;}
	$attr_no[$l] = array_search($attrs[$l], $var_ids_plus);
	$content_split[$attr_no[$l]] = $changes[$l];
	if($attrs[$l] == 'id'){
		$stack_dir = $db_dir.sshdb_hash($table).'/stack';
		$stack_dirs = dir($stack_dir);
		while(false !== ($stack_entry = $stack_dirs->read()))
		{
		if($stack_entry != '.' && $stack_entry != '..'){
		$stack_split = explode('.',$stack_entry);
		if(sshdb_hash($ele) == $stack_split[1]){
		$stack_split[1] = sshdb_hash($changes[$l]);
		$stack_entry_rename = implode($stack_split,'.');
		rename($stack_dir.'/'.$stack_entry,$stack_dir.'/'.$stack_entry_rename);
		}
		}
		}
		$stack_dirs->close();
	}
}

$ele_split[$ele_no] = implode($content_split,SSHDB_EXPLODE1);
$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>