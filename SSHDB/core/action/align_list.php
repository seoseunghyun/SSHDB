<?php
//SSHDB
if(!$attr){return $sshdb_msg_inc = 11;}
if(!in_array($align_sort,sshdb_array('align_sort'))){return $sshdb_msg_inc = 44;};
if(!in_array($align_type,sshdb_array('align_type'))){return $sshdb_msg_inc = 45;};
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);

$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');

for($j=0;$j<$var_count;$j++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $var_content_split[0];
	$var_ids_plus[$j+4] = $var_content_split[0];
}
$attr_no = array_search($attr, $var_ids_plus);
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);

for($k=0;$k<$ele_count;$k++){
	
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$k]);
	$ele_attrs[$k] = $ele_content_split[$attr_no];
	if($ele_attrs[$k]==SSHDB_EXPLODE_STACK){
		$ele_attrs[$k] = sshdb_fopen_r($db_dir.sshdb_hash($table).'/stack/'.sshdb_hash($attr).'.'.sshdb_hash($ele_content_split[0]).'.stack.sshdb.php');
		}
}
switch($align_sort){
	case 'asc' : $sort_way = SORT_ASC;break;
	case 'desc' : $sort_way = SORT_DESC;break;
	default : $sort_way = SORT_ASC;break;
}

switch($align_type){
	case 'regular' : $sort_type = SORT_REGULAR;break;
	case 'numberic' : $sort_type = SORT_NUMERIC;break;
	case 'string' : $sort_type = SORT_STRING;break;
	default : $sort_type = SORT_REGULAR;break;
}

array_multisort($ele_attrs,$sort_way,$sort_type,$ele_split);
$table_split[3] = implode($ele_split,SSHDB_EXPLODE2);
$table_complete = implode($table_split,SSHDB_EXPLODE3);
sshdb_fopen_w($table_dir,$table_complete);
$sshdb_global_memory[$table_dir] = $table_complete;
?>