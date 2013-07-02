<?
//SSHDB
global $sshdb_msg;
require('config/setting.php');
	if(defined('SSHDB_CONNECT') && !defined('SSHDB_DISCONNECT')){
		$sshdb_msg = 1;
	}else{
		$sshdb_msg = 0;
		include ('config/connect.php');
	}
?>