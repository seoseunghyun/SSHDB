<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['tb']);
if($action->modify_table($_POST['act'],$_POST['val'])==26){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>