<?php
//SSHDB
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$dir = $db_dir.sshdb_hash($table).'/backup/';
if(!file_exists($dir)){mkdir($dir);}
$sshdb_get[$db][$table]['backup']['list'] = array();
	$dirs = dir($dir);
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') &&($entry!='.DS_Store')){
			if(is_dir($dir.$entry)){
						array_push($sshdb_get[$db][$table]['backup']['list'], $entry);
				
			}
		}
	}
	$dirs->close();
?>