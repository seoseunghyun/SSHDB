<?
session_start();
include('../../../start.php');
sshdb_connect($_POST['id'],$_POST['password']);
if($sshdb_msg==3){
$_SESSION[SSHDB_TOKEN]['sshdb_id']=$_POST['id'];
$_SESSION[SSHDB_TOKEN]['sshdb_password']=sshdb_hash($_POST['password']);
echo 1;
}else{echo '아이디와 비밀번호를 확인하세요.';}
?>