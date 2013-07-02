<?
include('../lib/set.php');
sshdb_modify_table($_POST['db'],$_POST['tb'],$_POST['act'],$_POST['val']);
if($sshdb_msg==26){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>