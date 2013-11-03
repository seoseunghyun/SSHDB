<?php
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
sshdb_create_backup($db,$tb);
if($sshdb_msg==57){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>