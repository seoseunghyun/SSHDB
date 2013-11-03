<?php
//SSHDB
$db_content = sshdb_fopen_r(SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/info.db.sshdb.php');
if(!file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/info.db.sshdb.php')){return $sshdb_msg_inc = 15;}
$db_split_b = explode(SSHDB_EXPLODE3,$db_content);
$db_split = explode(SSHDB_EXPLODE1,$db_split_b[0]);
switch($attr){
	case 'id' : $sshdb_get[$db][$attr]=$db_split[0];break;
	case 'id,date' : $sshdb_get[$db]['id']=$db_split[0];$sshdb_get[$db]['date']=$db_split[1];break;
	case 'id,tag' : $sshdb_get[$db]['id']=$db_split[0];$sshdb_get[$db]['tag']=$db_split[2];break;
	case 'date' : $sshdb_get[$db][$attr]=$db_split[1];break;
	case 'date,id' : $sshdb_get[$db]['id']=$db_split[0];$sshdb_get[$db]['date']=$db_split[1];break;
	case 'date,tag' : $sshdb_get[$db]['tag']=$db_split[2];$sshdb_get[$db]['date']=$db_split[1];break;
	case 'tag' : $sshdb_get[$db][$attr]=$db_split[2];break;
	case 'tag,id' : $sshdb_get[$db]['tag']=$db_split[2];$sshdb_get[$db]['id']=$db_split[0];break;
	case 'tag,date' : $sshdb_get[$db]['tag']=$db_split[2];$sshdb_get[$db]['date']=$db_split[1];break;
	default : 
	$sshdb_get[$db]['id']=$db_split[0];
	$sshdb_get[$db]['date']=$db_split[1];
	$sshdb_get[$db]['tag']=$db_split[2];
	break;
}
?>