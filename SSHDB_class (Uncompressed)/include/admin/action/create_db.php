<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db']);
if($action->create_db('')==10){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>