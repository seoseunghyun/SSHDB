<?
include('../lib/set.php');
sshdb_create_db($_POST['db'],'');
if($sshdb_msg==10){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>