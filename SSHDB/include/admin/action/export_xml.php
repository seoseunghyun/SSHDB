<?php
include('../lib/set.php');
$db =$_GET['db'];
$tb =$_GET['tb'];
header('Content-type: text/xml');
echo sshdb_export_xml($db,$tb);
?>
