<?php
//SSHDB
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
if(!file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/info.db.sshdb.php')){return $sshdb_msg_inc = 15;}
$db_fs = sshdb_fsize($db_dir);
$sshdb_return_val['size'] = sshdb_fsize_format($db_fs['size']);
$sshdb_return_val['count'] = $db_fs['count'];
$sshdb_return_val['dircount'] = $db_fs['dircount'];
return $sshdb_return_val;
?>