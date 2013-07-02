<?
include('../../../start.php');
sshdb_create_key($_POST['id'],$_POST['password']);
echo sshdb_parser_msg($sshdb_msg);
?>