<?
include('../lib/set.php');

$db =$_POST['db'];
$tb =$_POST['tb'];
$type = $_POST['type'];
$id = $_POST['id'];
$attr = $_POST['attr'];
if($type == 'var'){
	sshdb_get_var($db,$tb,$id,$attr);
	echo $sshdb_get[$db][$tb][$id][$attr];
}else{
	sshdb_get_ele($db,$tb,$id,$attr);
	echo $sshdb_get[$db][$tb][$id][$attr];
}
?>