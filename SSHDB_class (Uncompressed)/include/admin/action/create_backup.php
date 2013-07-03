<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['tb']);
if($action->create_backup()==57){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>