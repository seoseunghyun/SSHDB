<?php
include('../lib/set.php');
if(sshdb_modify_setting($_POST['set'],$_POST['change'])==98){
	echo 98;
}else{
	echo $sshdb_msg;
}
?>