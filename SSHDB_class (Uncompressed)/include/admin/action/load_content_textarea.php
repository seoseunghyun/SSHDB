<?
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$type = $_POST['type'];
$id = $_POST['id'];
$attr = $_POST['attr'];
$action = new SSHDB;
$action->selector($db.'->'.$tb);
if($type == 'var'){
	$action->selector_var($id);
	$action->get_var($attr);
	echo $sshdb_get[$db][$tb][$id][$attr];
}else{
	$action->selector_ele($id);
	$action->get_ele($attr);
	echo $sshdb_get[$db][$tb][$id][$attr];
}
?>