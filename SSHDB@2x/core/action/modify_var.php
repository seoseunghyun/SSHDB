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
	if(!in_array($attrs[$i],sshdb_array('attr_m'))){return $sshdb_msg_inc = 13;}
	if(!isset($changes[$i]) || $changes[$i]==''){return $sshdb_msg_inc = 9;}
	if(sshdb_filter_preg($changes[$i]) == 0){return $sshdb_msg_inc = 83;}
	if($attrs[$i] == 'id' && in_array($changes[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 14;}
}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);

$var_count = count($var_split);

for($j=0;$j<$var_count;$j++){
	$content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $content_split[0];
}

if(!in_array($var,$var_ids)){return $sshdb_msg_inc = 31;}

$var_no = array_search($var, $var_ids);

for($k=0;$k<$attrs_count;$k++){
	if($attrs[$k] == 'id' && in_array($changes[$k],$var_ids)){return $sshdb_msg_inc = 29;}
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$var_no]);
	
	switch($attrs[$k]){
	case 'id' : $var_content_split[0] = $changes[$k];break;
	case 'tag' : $var_content_split[2] = $changes[$k];break;
	case 'option' : $var_content_split[3] = $changes[$k];break;
	}
	if($attrs[$k] == 'id'){
		$stack_dir = $db_dir.sshdb_hash($table).'/stack';
		$stack_dirs = dir($stack_dir);
		while(false !== ($stack_entry = $stack_dirs->read()))
		{
		if($stack_entry != '.' && $stack_entry != '..'){
		$stack_split = explode('.',$stack_entry);
		if(sshdb_hash($var) == $stack_split[0]){
		$stack_split[0] = sshdb_hash($changes[$k]);
		$stack_entry_rename = implode($stack_split,'.');
		rename($stack_dir.'/'.$stack_entry,$stack_dir.'/'.$stack_entry_rename);
		}
		}
		}
		$stack_dirs->close();
	}
	$var_split[$var_no] = implode($var_content_split,SSHDB_EXPLODE1);
	
}

$table_split[2] = implode($var_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);

sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>