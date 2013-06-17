<?
//SSHDB

include (SSHDB_DIR.'core/parse/sshdb_msg.php');
function sshdb_connect($id,$password){
	global $sshdb_msg;
	$data_files = array('','storage','sign','log'); //Template 기능 제거됨 (거의 사용하지 않음으로.)
	$perm_array = array('707','757','777');
	$data_files_count = count($data_files);

	for($i=0;$i<$data_files_count;$i++){
		if(!is_dir(SSHDB_DIR.'data/'.$data_files[$i])){
			mkdir(SSHDB_DIR.'data/'.$data_files[$i], 0777);
			chmod(SSHDB_DIR.'data/'.$data_files[$i], 0777);
		}
	}
	
	$hta_dir = SSHDB_DIR.'data/.htaccess';
	if(!file_exists($hta_dir)){
	$hta_open = fopen($hta_dir, 'w');
	$hta_content = 'RewriteEngine On
RedirectMatch /(.*)$ http://sshdb.seoseunghyun.com/report/hacking';
	fwrite($hta_open,$hta_content);
	fclose($hta_open);
	}
	
	for($j=0;$j<$data_files_count;$j++){
	$data_perm = fileperms(SSHDB_DIR.'data/'.$data_files[$j]);$data_permi = $data_perm - 16384;
	$data_permiss = decoct($data_permi);
	if(!in_array($data_permiss,$perm_array)){return $sshdb_msg = 84;}
	}
	
	$key_file_path = SSHDB_DIR.'data/sign/owner.key.sshdb.php';
	
	if(!file_exists($key_file_path)){return $sshdb_msg = 2;}
	$key_file_open = fopen($key_file_path, 'r');
	$key_file_content = fread($key_file_open,filesize($key_file_path));
	fclose($key_file_open);
	
	$key_split_b = explode(SSHDB_EXPLODE_SECURE,$key_file_content);
	$key_split = explode(SSHDB_EXPLODE1,$key_split_b[1]);
	$key_id = $key_split[0];
	$key_password = $key_split[1];
	
	if($id == $key_id && sshdb_hash($password) == $key_password){
		define('SSHDB_CONNECT',1);
		$sshdb_msg = 3;
		include(SSHDB_DIR.'core/function.php');
		sshdb_push_log(1,'CONNECT',$id,$sshdb_msg);
	}else{
		return $sshdb_msg = 4;
	}
}
function sshdb_dconnect($id,$password){
	global $sshdb_msg;
	$data_files = array('','storage','sign','log');
	$perm_array = array('707','757','777');
	$data_files_count = count($data_files);

	for($i=0;$i<$data_files_count;$i++){
		if(!is_dir(SSHDB_DIR.'data/'.$data_files[$i])){
			mkdir(SSHDB_DIR.'data/'.$data_files[$i], 0777);
			chmod(SSHDB_DIR.'data/'.$data_files[$i], 0777);
		}
	}
	
	$hta_dir = SSHDB_DIR.'data/.htaccess';
	if(!file_exists($hta_dir)){
	$hta_open = fopen($hta_dir, 'w');
	$hta_content = 'RewriteEngine On
RedirectMatch /(.*)$ http://sshdb.seoseunghyun.com/report/hacking';
	fwrite($hta_open,$hta_content);
	fclose($hta_open);
	}
	
	for($j=0;$j<$data_files_count;$j++){
	$data_perm = fileperms(SSHDB_DIR.'data/'.$data_files[$j]);$data_permi = $data_perm - 16384;
	$data_permiss = decoct($data_permi);
	if(!in_array($data_permiss,$perm_array)){return $sshdb_msg = 84;}
	}
	
	$key_file_path = SSHDB_DIR.'data/sign/owner.key.sshdb.php';
	
	if(!file_exists($key_file_path)){return $sshdb_msg = 2;}
	$key_file_open = fopen($key_file_path, 'r');
	$key_file_content = fread($key_file_open,filesize($key_file_path));
	fclose($key_file_open);
	
	$key_split_b = explode(SSHDB_EXPLODE_SECURE,$key_file_content);
	$key_split = explode(SSHDB_EXPLODE1,$key_split_b[1]);
	$key_id = $key_split[0];
	$key_password = $key_split[1];
	
	if($id == $key_id && $password == $key_password){
		define('SSHDB_CONNECT',1);
		$sshdb_msg = 3;
		include(SSHDB_DIR.'core/function.php');
		sshdb_push_log(1,'DIRECT CONNECT',$id,$sshdb_msg);
	}else{
		return $sshdb_msg = 4;
	}
}
function sshdb_disconnect(){
	global $sshdb_msg, $sshdb_global_memory,$sshdb_get;
	sshdb_push_log(1,'DISCONNECT',SSHDB_CONNECT_ID,'__UNSET_ALL__');
	define('SSHDB_DISCONNECT',1);
	unset($sshdb_get,$sshdb_msg,$sshdb_global_memory);
}
function sshdb_create_key($id,$password){
	global $sshdb_msg;
	$key_file_path = SSHDB_DIR.'data/sign/owner.key.sshdb.php';
	$data_files = array('','storage','sign','log'); //Template 기능 제거됨 (거의 사용하지 않음으로.)
	$perm_array = array('707','757','777');
	$data_files_count = count($data_files);
	
	if(file_exists($key_file_path)){return $sshdb_msg = 86;}
	for($i=0;$i<$data_files_count;$i++){
		if(!is_dir(SSHDB_DIR.'data/'.$data_files[$i])){
			mkdir(SSHDB_DIR.'data/'.$data_files[$i], 0777);
			chmod(SSHDB_DIR.'data/'.$data_files[$i], 0777);
		}
	}
	for($j=0;$j<$data_files_count;$j++){
	$data_perm = fileperms(SSHDB_DIR.'data/'.$data_files[$j]);$data_permi = $data_perm - 16384;
	$data_permiss = decoct($data_permi);
	
	if(!in_array($data_permiss,$perm_array)){return $sshdb_msg = 84;}
	}
	if(!$id){return $sshdb_msg = 81;}
	if(!$password){return $sshdb_msg = 82;}
	if(sshdb_filter_preg($id) == 0){return $sshdb_msg = 83;}
	if(sshdb_filter_fatal($id.$password) == 0){return $sshdb_msg = 5;}

	$key_complete = $id.SSHDB_EXPLODE1.sshdb_hash($password);
	
	$fdir = $key_file_path;
	$fopen = fopen($fdir, 'w');
	$secure = '<?php exit;?>';
	fwrite($fopen,$secure.SSHDB_EXPLODE_SECURE.$key_complete);
	fclose($fopen);
	
	return $sshdb_msg = 85;
}
?>