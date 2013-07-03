<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db']);
if($action->create_link('',$_POST['dir'])==48){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>