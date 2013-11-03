<?php
//SSHDB
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_content = sshdb_fopen_r($table_dir);
$table_split = explode(SSHDB_EXPLODE3,$table_content);

$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);$var_ids_plus = array('id','date','tag','option');
if(!$var_split[0]){$var_count=0;}
for($i=0;$i<$var_count;$i++){
	$var_content_split = explode(SSHDB_EXPLODE1,$var_split[$i]);
	$var_ids[$i] = $var_content_split[0];
	$var_ids_plus[$i+4] = $var_content_split[0];
}
$sshdb_print['var_id'] = $var_ids_plus;
$var_plus_count = count($var_ids_plus);
$ele_split = explode(SSHDB_EXPLODE2,$table_split[3]);
$ele_count = count($ele_split);
for($j=0;$j<$ele_count;$j++){
	$ele_content_split = explode(SSHDB_EXPLODE1,$ele_split[$j]);
	if($ele_content_split[0]){
		for($k=0;$k<$var_plus_count;$k++){
		if($ele_content_split[$k]==SSHDB_EXPLODE_STACK){
			$ele_content_split[$k]=sshdb_fopen_r($db_dir.sshdb_hash($table).'/stack/'.sshdb_hash($var_ids_plus[$k]).'.'.sshdb_hash($ele_content_split[0]).'.stack.sshdb.php');
		}
			$sshdb_print[$j][$var_ids_plus[$k]] = $ele_content_split[$k];

		}
	}
}
$db_split = explode(SSHDB_EXPLODE1,$table_split[0]);
$db_id = $db_split[0];
$xmlResponse = '<?php xml version="1.0" encoding="UTF-8" ?>
';
$xmlResponse .= '<table id="'.$db_id.'" date="'.$db_split[1].'" tag="'.$db_split[2].'">
';

array_splice($sshdb_print, 0,1);
foreach($sshdb_print as $key => $val){
	foreach($val as $keys => $vals){
	$vals = htmlspecialchars($vals);
	if($keys=='id'){
	$xmlResponse .= '<element id="'.$vals.'">
';
	$xmlends = '</element>
';
	}else{
	$xmlResponse .= '	<'.$keys.'>'.$vals.'</'.$keys.'>
';
	}
	}
	$xmlResponse .= $xmlends.'

';
}
$xmlResponse .= '</table>';
$sshdb_export = $xmlResponse;
?>