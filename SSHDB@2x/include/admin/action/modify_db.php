<?php
include('../lib/set.php');
sshdb_modify_db($_POST['db'],$_POST['act'],$_POST['val']);
if($sshdb_msg==17){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>