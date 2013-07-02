<?
//SSHDB
if(!$id){return $sshdb_msg_inc = 81;}
if(!$password){return $sshdb_msg_inc = 82;}
if(sshdb_filter_preg($id) == 0){return $sshdb_msg_inc = 83;}
if(sshdb_filter_fatal($id.$password) == 0){return $sshdb_msg_inc = 5;}

	$key_file_path = SSHDB_DIR.'data/sign/owner.key.sshdb.php';
	
	if(!file_exists($key_file_path)){return $sshdb_msg_inc = 2;}
	$key_complete = $id.SSHDB_EXPLODE1.sshdb_hash($password);
	
	sshdb_fopen_w($key_file_path,$key_complete);
?>