<?
include('../lib/set.php');
if(sshdb_modify_key($_POST['id'],$_POST['password'])==80){
	echo 80;
	unset($_SESSION[SSHDB_TOKEN]['sshdb_id'],$_SESSION[SSHDB_TOKEN]['sshdb_password']);
}else{
	echo $sshdb_msg;
}
?>