<?
//SSHDB
if(!$attr){return $sshdb_msg_inc = 11;}
if(!$change){return $sshdb_msg_inc = 12;}
if(sshdb_filter_fatal($change) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
if(!is_array($change)){$changes = explode(',',$change);}else{$changes=$change;}$changes_count = count($changes);

$attrs_uniq_count = count(array_unique($attrs));
if($attrs_count != $attrs_uniq_count) {return $sshdb_msg_inc = 16;}

for($i=0;$i<$attrs_count;$i++){
	if(!in_array($attrs[$i],sshdb_array('attr_n'))){return $sshdb_msg_inc = 13;}
	if(!isset($changes[$i]) || $changes[$i]==''){return $sshdb_msg_inc = 9;}
	if($attrs[$i] == 'id' && sshdb_filter_preg($changes[$i]) == 0){return $sshdb_msg_inc = 83;}
	if($attrs[$i] == 'id' && in_array($changes[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 14;}
}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split_b = explode(SSHDB_EXPLODE3,$table_content);
$table_split = explode(SSHDB_EXPLODE1,$table_split_b[0]);

for($j=0;$j<$attrs_count;$j++){
	if($attrs[$j]=='id' && file_exists($db_dir.sshdb_hash($changes[$j]).'/info.table.sshdb.php')){return $sshdb_msg_inc = 23;}
	switch($attrs[$j]){
	case 'id' : $table_split[0] = $changes[$j];$attrs_modify_id = $changes[$j];break;
	case 'tag' : $table_split[2] = $changes[$j];break;
	}
}
	$table_split_b[0] = implode($table_split,SSHDB_EXPLODE1);
	$table_complete = implode($table_split_b,SSHDB_EXPLODE3);
	sshdb_fopen_w($table_dir,$table_complete);
	if(isset($attrs_modify_id)){
		rename($db_dir.sshdb_hash($table),$db_dir.sshdb_hash($attrs_modify_id));
	}
$sshdb_global_memory[$table_dir] = $table_complete;
?>