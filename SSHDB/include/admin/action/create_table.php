<?php
include('../lib/set.php');
sshdb_create_table($_POST['db'],$_POST['table'],'');
if($sshdb_msg==25){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>