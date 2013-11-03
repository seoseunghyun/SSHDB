<?php
//SSHDB
//$log_array = sshdb_array('log');
//if($log_array[0]==0){return;}
switch ($attr){
	case '0' : $attr='error';break;
	case '1' : $attr='connect';break;
	case '2' : $attr='modify';break;
	case '3' : $attr='view';break;
	case '4' : $attr='msg';break;

}
$log_dir = SSHDB_DIR.'data/log/'.$log.'/';
$log_attr_dir = $log_dir.$attr.'.log.sshdb.php';
if(!in_array($attr, sshdb_array('attr_log'))){
	return $sshdb_msg_inc = 90;
}
if(!file_exists($log_attr_dir)){
	return $sshdb_msg_inc = 89;
}
$logs = explode(SSHDB_EXPLODE3, sshdb_fopen_r($log_attr_dir));
$logs_count = count($logs);
for($i=0;$i<$logs_count;$i++){
	$log_b = explode(SSHDB_EXPLODE2, $logs[$i]);
	$sshdb_return[$i] = sshdb_parser_log($log_b[0],$log_b[1],$log_b[2],$log_b[3],$log_b[4],$log_b[5]);
}
clearstatcache();
return $sshdb_return;
?>