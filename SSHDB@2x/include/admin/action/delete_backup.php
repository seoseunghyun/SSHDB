<?php
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$bu =$_POST['bu'];
sshdb_delete_backup($db,$tb,$bu);
if($sshdb_msg==64){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>