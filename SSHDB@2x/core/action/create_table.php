<?php
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}
if(sshdb_filter_fatal($table.$tag) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($table)){$tables = explode(',',$table);}else{$tables=$table;}$tables_count = count($tables);
if(!is_array($tag)){$tags = explode(',',$tag);}else{$tags=$tag;}$tags_count = count($tags);

$tables_uniq_count = count(array_unique($tables));
if($tables_count != $tables_uniq_count) {return $sshdb_msg_inc = 22;}

for($i=0;$i<$tables_count;$i++){
	if(!isset($tables[$i]) || $tables[$i]==''){return $sshdb_msg_inc = 9;}
	if(in_array($tables[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 7;}
	if(sshdb_filter_preg($tables[$i]) == 0){return $sshdb_msg_inc = 83;}
	if(!isset($tags[$i]) || $tags[$i] == ''){$tags[$i] = SSHDB_NULL;}
}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
for($j=0;$j<$tables_count;$j++){
	$table_dir = $db_dir.sshdb_hash($tables[$j]).'/info.table.sshdb.php';
	if(file_exists($table_dir)){return $sshdb_msg_inc = 23;}
	mkdir($db_dir.sshdb_hash($tables[$j]), 0777);
	mkdir($db_dir.sshdb_hash($tables[$j]).'/stack', 0777);
	mkdir($db_dir.sshdb_hash($tables[$j]).'/backup', 0777);
	sshdb_fopen_w($table_dir,$tables[$j].SSHDB_EXPLODE1.sshdb_date().SSHDB_EXPLODE1.$tags[$j].SSHDB_EXPLODE3.SSHDB_EXPLODE3.SSHDB_EXPLODE3);
}
?>