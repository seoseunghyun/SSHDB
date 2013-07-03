<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['table']);
if($action->create_table('')==25){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>