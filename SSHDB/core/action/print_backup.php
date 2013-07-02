<?
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}
switch($stack){
	case '0' : $stack = 0;break;
	case 'no': $stack = 0;break;
	default : $stack = 1;break;
}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$backup_dir = $db_dir.sshdb_hash($table).'/backup/'.$backup.'/info.table.sshdb.php';
if(!file_exists($backup_dir)){return $sshdb_msg_inc = 61;}
$backup_content = sshdb_fopen_r($backup_dir);
$backup_split = explode(SSHDB_EXPLODE3,$backup_content);
echo str_replace(SSHDB_EXPLODE_STACK, '[[BIG_DATA]]',str_replace(SSHDB_EXPLODE2, '
',str_replace(SSHDB_EXPLODE3, '

', $backup_content))).'

';
$ele_split = explode(SSHDB_EXPLODE2,$backup_split[3]);
$ele_count = count($ele_split);
$var_split = explode(SSHDB_EXPLODE2,$backup_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');
echo 'VARIABLE : ';
for($j=0;$j<$var_count;$j++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $var_content_split[0];
	print_r($var_content_split);
}
$var_ids_real = array_merge($var_ids_plus,$var_ids);
echo 'ELEMENT : ';
for($k=0;$k<$ele_count;$k++){
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$k]);
	
		for($l=0;$l<$var_count+4;$l++){
		if($ele_content_split[$l] == SSHDB_EXPLODE_STACK && $stack == 1){
		$ele_content_split[$l] = sshdb_fopen_r($db_dir.sshdb_hash($table).'/backup/'.$backup.'/stack/'.sshdb_hash($var_ids_real[$l]).'.'.sshdb_hash($ele_content_split[0]).'.stack.sshdb.php');
		}else if($ele_content_split[$l] == SSHDB_EXPLODE_STACK && $stack == 0){
			$ele_content_split[$l] = '$SSHDB_STACK$';
		}
		$ele_content_real_split[$var_ids_real[$l]] = $ele_content_split[$l];
		}
	print_r($ele_content_real_split);
}

?>