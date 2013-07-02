<?
include('../lib/set.php');
sshdb_create_link($_POST['db'],'',$_POST['dir']);
if($sshdb_msg==48){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>