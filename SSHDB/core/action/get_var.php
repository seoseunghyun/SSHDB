<?php
//SSHDB
if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$table_dir = $db_dir.sshdb_hash($table).'/info.table.sshdb.php';
$table_content = sshdb_fopen_r($table_dir);
if(!file_exists($table_dir)){return $sshdb_msg_inc = 24;}
$table_split = explode(SSHDB_EXPLODE3,$table_content);
$var_split = explode(SSHDB_EXPLODE2,$table_split[2]);
$var_count = count($var_split);

for($j=0;$j<$var_count;$j++){
	$content_split = explode(SSHDB_EXPLODE1,$var_split[$j]);
	$var_ids[$j] = $content_split[0];
}
$var_no = array_search($var, $var_ids);
$var_content = explode(SSHDB_EXPLODE1,$var_split[$var_no]);

if(in_array('id',$attrs)){$sshdb_get[$db][$table][$var]['id']=$var_content[0];}
if(in_array('date',$attrs)){$sshdb_get[$db][$table][$var]['date']=$var_content[1];}
if(in_array('tag',$attrs)){$sshdb_get[$db][$table][$var]['tag']=$var_content[2];}
if(in_array('option',$attrs)){$sshdb_get[$db][$table][$var]['option']=$var_content[3];}


?>