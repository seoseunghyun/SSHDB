<?php
//SSHDB
switch ($attr_no){
	case 0 : $attr='error';break;
	case 1 : $attr='connect';break;
	case 2 : $attr='modify';break;
	case 3 : $attr='view';break;
	case 4 : $attr='msg';break;
}
if(!$path){$path = '__ROOT__';}
if(!$time){$log_time = date('YmdHis',time());}else{$log_time = $time;}
if(!$ip){$log_ip = $_SERVER['REMOTE_ADDR'];}else{$log_ip = $ip;}
return $log_return = 
	'#'.
	$log_time.
	'_ $'.
	$log_ip.
	'['.$attr.']'.
	' : Action('.
	$action.
	'); Path('.
	$path.
	'); Value('.
	$val.
	');'
	;

?>