<?php
session_start();
include('../../../start.php');
if(isset($_SESSION[SSHDB_TOKEN]['sshdb_id']) && isset($_SESSION[SSHDB_TOKEN]['sshdb_password']) ){
sshdb_dconnect($_SESSION[SSHDB_TOKEN]['sshdb_id'],$_SESSION[SSHDB_TOKEN]['sshdb_password']);
if($sshdb_msg !=3){echo 'DB연결에 실패했습니다.';exit;}
define('SSHDBS_DIR',SSHDB_DIR.'include/admin/');
define('SSHDBS_URL','include/admin/');
}else{echo 'DB연결에 실패했습니다.';exit;}
?>