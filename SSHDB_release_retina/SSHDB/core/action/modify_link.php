<?
//SSHDB
if(!$dir){return $sshdb_msg_inc = 53;}
if(sshdb_filter_fatal($dir) == 0){return $sshdb_msg_inc = 5;}

$db_dir = SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/';
$link_dir = $db_dir.'link.db.sshdb.php';
$db_info_dir = $db_dir.'info.db.sshdb.php';

if(!file_exists($db_info_dir)){return $sshdb_msg_inc = 15;}
if(!file_exists($link_dir)){return $sshdb_msg_inc = 54;}
if(!file_exists($dir)){return $sshdb_msg_inc = 47;}

$link_perm = fileperms($dir);$link_permi = $link_perm - 16384;
$link_permiss = decoct($link_permi);
if(!in_array($link_permiss,sshdb_array('link_permission'))){return $sshdb_msg_inc = 49;}

$slash1 = '/';$slash1_pos = strpos($dir,$slash1);
$slash2 = '\\';$slash2_pos = strpos($dir,$slash2);
if(($slash1_pos !== false && substr($dir, -1)!='/') || ($slash2_pos !== false && substr($dirs, -1) != '\\')){return $sshdb_msg_inc = 51;}


sshdb_fopen_w($link_dir,$dir);

$sshdb_global_memory[$link_dir] = $dir;
?>