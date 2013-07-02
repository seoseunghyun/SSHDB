<?
//SSHDB
	
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}

if(!is_array($backup)){$backups = explode(',',$backup);}else{$backups=$backup;}$backups_count = count($backups);

$backups_uniq_count = count(array_unique($backups));
if($backups_count != $backups_uniq_count) {return $sshdb_msg_inc = 63;}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
for($i=0;$i<$backups_count;$i++){
	$backup_dir = $db_dir.sshdb_hash($table).'/backup/'.$backups[$i];
	if(!file_exists($backup_dir)){return $sshdb_msg_inc = 61;}
	sshdb_fdelete($backup_dir);
}

?>