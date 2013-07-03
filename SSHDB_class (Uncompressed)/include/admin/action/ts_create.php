<?
include('../lib/set.php');
$action = new SSHDB;
$action->selector($_POST['db'].'->'.$_POST['tb']);
if($_POST['type']=='var'){
	if($_POST['check']=='off'){
		$ab[0] = $_POST['id'];
		$abc[0] = $_POST['tag'];
	$action->selector_var($ab);
	$action->create_var($abc);
	}else{
	$action->selector_var($_POST['id']);
	$action->create_var($_POST['tag']);
	}
}else{
	if($_POST['check']=='off'){
		$abb[0] = $_POST['id'];
		$abcc[0] = $_POST['tag'];
	$action->selector_ele($abb);
	$action->create_ele($abcc);
	}else{
	$action->selector_ele($_POST['id']);
	$action->create_ele($_POST['tag']);
	}
}
if($sshdb_msg == 30 || $sshdb_msg == 38){
	echo 1;
}else{
	echo sshdb_parser_msg($sshdb_msg);
}
?>