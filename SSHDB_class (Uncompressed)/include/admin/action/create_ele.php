<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'],$_POST['tb'],$_POST['ele']);
$action->create_ele($_POST['tag']);
if($sshdb_msg==38){
$ids = explode(',', $_POST['ele']);
$ids_count = count($ids);
$real_count = 0;
for($i=0;$i<$ids_count;$i++){
$action->selector_ele($ids[$i]);
$action->modify_ele($_POST['attr'],$_POST['change']);
if($sshdb_msg==40){$real_count += 1;}else{
echo sshdb_parser_msg($sshdb_msg);
}
}
if($real_count==$ids_count){
	echo 1;
}
}else{
echo sshdb_parser_msg($sshdb_msg);
}
?>