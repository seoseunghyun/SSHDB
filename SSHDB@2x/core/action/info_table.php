<?
//SSHDB
$db_fdir = sshdb_fdir($db);
if(!in_array($attr, sshdb_array('attr_structure'))){return $sshdb_msg_inc = 93;}
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
if(!file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/info.db.sshdb.php')){return $sshdb_msg_inc = 15;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_dir_real = $db_dir.sshdb_hash($table).'/'.$attr;
$table_fs = sshdb_fsize($table_dir_real);
$sshdb_return_val['size'] = sshdb_fsize_format($table_fs['size']);
$sshdb_return_val['realsize'] = $table_fs['size'];
$sshdb_return_val['count'] = $table_fs['count'];
$sshdb_return_val['dircount'] = $table_fs['dircount'];
return $sshdb_return_val;
?>