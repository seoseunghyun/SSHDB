<?php

include('../lib/set.php');

$db =$_GET['db'];
$tb =$_GET['tb'];
$bu =$_GET['bid'];
$backup_entire = sshdb_print_backup($db,$tb,$bu,'');

if($sshdb_msg!=62){
echo sshdb_parser_msg($sshdb_msg);
}else{
/*
	header('Content-type: text/xml');
	$xmlResponse = '<?phpxml version="1.0" encoding="UTF-8" ?>';
*/
$var_ids = array('id','date','tag','option');
	foreach($backup_entire['var'] as $key => $val){
		array_push($var_ids, $backup_entire['var'][$key][0]);
	}
	foreach($backup_entire['ele'] as $keys => $vals){

		echo $backup_entire['ele'][$keys]['id'];
	}
}
?>