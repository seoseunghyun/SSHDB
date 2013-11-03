<?php
//SSHDB
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split_b = explode(SSHDB_EXPLODE3,$table_content);
$table_split = explode(SSHDB_EXPLODE1,$table_split_b[0]);
switch($attr){
	case 'id' : $sshdb_get[$db][$table][$attr]=$table_split[0];break;
	case 'id,date' : $sshdb_get[$db][$table]['id']=$table_split[0];$sshdb_get[$db][$table]['date']=$table_split[1];break;
	case 'id,tag' : $sshdb_get[$db][$table]['id']=$table_split[0];$sshdb_get[$db][$table]['tag']=$table_split[2];break;
	case 'date' : $sshdb_get[$db][$table][$attr]=$table_split[1];break;
	case 'date,id' : $sshdb_get[$db][$table]['id']=$table_split[0];$sshdb_get[$db][$table]['date']=$table_split[1];break;
	case 'date,tag' : $sshdb_get[$db][$table]['tag']=$table_split[2];$sshdb_get[$db][$table]['date']=$table_split[1];break;
	case 'tag' : $sshdb_get[$db][$table][$attr]=$table_split[2];break;
	case 'tag,id' : $sshdb_get[$db][$table]['tag']=$table_split[2];$sshdb_get[$db][$table]['id']=$table_split[0];break;
	case 'tag,date' : $sshdb_get[$db][$table]['tag']=$table_split[2];$sshdb_get[$db][$table]['date']=$table_split[1];break;
	default : 
	$sshdb_get[$db][$table]['id']=$table_split[0];
	$sshdb_get[$db][$table]['date']=$table_split[1];
	$sshdb_get[$db][$table]['tag']=$table_split[2];
	break;
}
?>