<?php
//SSHDB
session_start();
include 'start.php';
if(file_exists(SSHDB_DIR.'data/sign/owner.key.sshdb.php')){
	define('SSHDBS_DIR',SSHDB_DIR.'include/admin/');
	define('SSHDBS_URL','include/admin/');
	include(SSHDB_DIR.'include/admin/index.php');
}else{
	define('SSHDB_DIR_SETUP',SSHDB_DIR.'include/setup/');
	define('SSHDB_URL_SETUP','include/setup/');
	include(SSHDB_DIR_SETUP.'index.php');
}
?>