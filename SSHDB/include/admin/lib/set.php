<?
session_start();
if(isset($_SESSION['sshdb_id']) && isset($_SESSION['sshdb_password']) ){include('../../../start.php');
sshdb_dconnect($_SESSION['sshdb_id'],$_SESSION['sshdb_password']);
if($sshdb_msg !=3){echo 'DB연결에 실패했습니다.';exit;}
define('SSHDBS_DIR',SSHDB_DIR.'include/admin/');
define('SSHDBS_URL','include/admin/');
}else{echo 'DB연결에 실패했습니다.';exit;}
?>