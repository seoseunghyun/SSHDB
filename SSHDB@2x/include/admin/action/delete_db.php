<?php
include('../lib/set.php');
$db = substr_replace(substr_replace($_POST['val'],'',-4,4),'',0,10);
sshdb_delete_db($db);
if($sshdb_msg==18){echo 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>