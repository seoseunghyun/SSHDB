<?php
//SSHDB

if(!$db){return $sshdb_msg_inc = 6;}

if(!is_array($db)){$dbs = explode(',',$db);}else{$dbs=$db;}$dbs_count = count($dbs);

$dbs_uniq_count = count(array_unique($dbs));
if($dbs_count != $dbs_uniq_count) {return $sshdb_msg_inc = 19;}

for($i=0;$i<$dbs_count;$i++){
	$db_dir = SSHDB_DIR.'data/storage/'.sshdb_hash($dbs[$i]).'/';
	if(!file_exists($db_dir.'info.db.sshdb.php')){return $sshdb_msg_inc = 15;}
	sshdb_fdelete($db_dir);
}
?>