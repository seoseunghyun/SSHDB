<?php
include('../lib/set.php');
sshdb_delete_ele($_POST['db'],$_POST['tb'],$_POST['ele']);
if($sshdb_msg==42){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>