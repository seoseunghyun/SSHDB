<?
//SSHDB
$db_dir = SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/';
$link_dir = $db_dir.'link.db.sshdb.php';
$db_info_dir = $db_dir.'info.db.sshdb.php';

if(!file_exists($db_info_dir)){return $sshdb_msg_inc = 15;}
if(!file_exists($link_dir)){return $sshdb_msg_inc = 54;}

$sshdb_get[$db]['link'] = sshdb_fopen_r($link_dir);

?>