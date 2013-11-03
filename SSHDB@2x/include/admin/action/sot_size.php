<?php
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$get_size = sshdb_info_table($db,$tb,'');
$get_backup_size = sshdb_info_table($db,$tb,'backup');
$get_stack_size = sshdb_info_table($db,$tb,'stack');
echo intval(($get_backup_size['realsize']/$get_size['realsize'])*100);
echo ',';
echo intval(($get_stack_size['realsize']/$get_size['realsize'])*100);
echo ',';
//전체
echo $get_size['size'];
echo ',';
//백업
echo $get_backup_size['size'].' ('.$get_backup_size['count'].' Files)';
echo ',';
//스택
echo $get_stack_size['size'].' ('.$get_stack_size['count'].' Stacks)';
?>