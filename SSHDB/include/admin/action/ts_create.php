<?php
include('../lib/set.php');
if($_POST['type']=='var'){
	if($_POST['check']=='off'){
		$ab[0] = $_POST['id'];
		$abc[0] = $_POST['tag'];
	sshdb_create_var($_POST['db'],$_POST['tb'],$ab,$abc);
	}else{
	sshdb_create_var($_POST['db'],$_POST['tb'],$_POST['id'],$_POST['tag']);
	}
}else{
	if($_POST['check']=='off'){
		$abb[0] = $_POST['id'];
		$abcc[0] = $_POST['tag'];
	sshdb_create_ele($_POST['db'],$_POST['tb'],$abb,$abcc);
	}else{
	sshdb_create_ele($_POST['db'],$_POST['tb'],$_POST['id'],$_POST['tag']);
	}
}
if($sshdb_msg == 30 || $sshdb_msg == 38){
	echo 1;
}else{
	echo sshdb_parser_msg($sshdb_msg);
}
?>