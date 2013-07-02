<?
//SSHDB

$log_dir = SSHDB_DIR.'data/log/'.$log.'/';
if(!is_dir($log_dir)){return $sshdb_msg_inc = 89;}
if(!$attr){
	sshdb_fdelete($log_dir);
}else{
if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
$attrs_uniq_count = count(array_unique($attrs));
if($attrs_count != $attrs_uniq_count) {return $sshdb_msg_inc = 92;}

for($i=0;$i<$attrs_count;$i++){
	$log_attr_dir = $log_dir.$attrs[$i].'.log.sshdb.php';
	if(!in_array($attrs[$i],sshdb_array('attr_log'))){return $sshdb_msg_inc = 90;}
	if(!file_exists($log_attr_dir)){return $sshdb_msg_inc = 89;}
	echo $log_attr_dir;
	sshdb_fdelete($log_attr_dir);
}
}

?>