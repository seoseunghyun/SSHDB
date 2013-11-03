<?php
//SSHDB
	
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}

if(!is_array($table)){$tables = explode(',',$table);}else{$tables=$table;}$tables_count = count($tables);

$tables_uniq_count = count(array_unique($tables));
if($tables_count != $tables_uniq_count) {return $sshdb_msg_inc = 22;}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
for($i=0;$i<$tables_count;$i++){
	$table_dir = $db_dir.sshdb_hash($tables[$i]).'/';
	if(!file_exists($table_dir.'info.table.sshdb.php')){return $sshdb_msg_inc = 24;}
	sshdb_fdelete($table_dir);
}

?>