<?
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$type = $_POST['type'];
$id = $_POST['id'];
$attr = $_POST['attr'];
$changes[0] = $_POST['change'];
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['tb']);
if($type == 'var' || $type == 'VAR' ){
	$action->selector_var($id);
	if($action->modify_var($attr,$changes) == 32){echo 1;}else{echo sshdb_parser_msg($sshdb_msg);}
}else{
	$action->selector_ele($id);
	if($action->modify_ele($attr,$changes) == 40){echo 1;}else{echo sshdb_parser_msg($sshdb_msg);}
}
?>