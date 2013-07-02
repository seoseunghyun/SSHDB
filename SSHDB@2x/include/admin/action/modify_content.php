<?
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$type = $_POST['type'];
$id = $_POST['id'];
$attr = $_POST['attr'];
$changes[0] = $_POST['change'];
if($type == 'var' || $type == 'VAR' ){
	$result = sshdb_modify_var($db,$tb,$id,$attr,$changes);
	if($result == 32){echo 1;}else{echo sshdb_parser_msg($sshdb_msg);}
}else{
	$result = sshdb_modify_ele($db,$tb,$id,$attr,$changes);
	if($result == 40){echo 1;}else{echo sshdb_parser_msg($sshdb_msg);}
}
?>