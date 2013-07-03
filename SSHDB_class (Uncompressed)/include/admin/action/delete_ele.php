<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['tb'].'->->'.$_POST['ele']);
if($action->delete_ele()==42){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>