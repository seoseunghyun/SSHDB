<?
//SSHDB
$log_array = sshdb_array('log');
if($log_array[0]==0){return;}

switch ($attr_no){
	case 0 : $attr='error';break;
	case 1 : $attr='connect';break;
	case 2 : $attr='modify';break;
	case 3 : $attr='view';break;
	case 4 : $attr='msg';break;
}
if($log_array[$attr_no+1]==0){return;}

$log_date = date('Ymd',time());
if(!$val){$val='__EXECUTE__';}
$log_dir = SSHDB_DIR.'data/log/'.$log_date.'/';
if(!is_dir($log_dir)){
	mkdir($log_dir,0777);
	chmod($log_dir,0777);
}
$log_attr_dir = $log_dir.$attr.'.log.sshdb.php';

$log_content = $attr_no.SSHDB_EXPLODE2.$action.SSHDB_EXPLODE2.$path.SSHDB_EXPLODE2.substr($val,0,$log_array[6]).SSHDB_EXPLODE2.date('YmdHis',time()).SSHDB_EXPLODE2.$_SERVER['REMOTE_ADDR'];
if(!file_exists($log_attr_dir)){
	sshdb_fopen_w($log_attr_dir,$log_content);
}else{
	$fdir = $log_attr_dir;
	$fopen = fopen($fdir, 'a');
	fwrite($fopen,SSHDB_EXPLODE3.$log_content);
	fclose($fopen);
	clearstatcache();
}

?>