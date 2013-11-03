<?php
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(sshdb_filter_fatal($db.$tag) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($db)){$dbs = explode(',',$db);}else{$dbs=$db;}$dbs_count = count($dbs);
if(!is_array($tag)){$tags = explode(',',$tag);}else{$tags=$tag;}$tags_count = count($tags);

$dbs_uniq_count = count(array_unique($dbs));
if($dbs_count != $dbs_uniq_count) {return $sshdb_msg_inc = 19;}

for($i=0;$i<$dbs_count;$i++){
	if(!isset($dbs[$i]) || $dbs[$i]==''){return $sshdb_msg_inc = 9;}
	if(in_array($dbs[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 7;}
	if(sshdb_filter_preg($dbs[$i]) == 0){return $sshdb_msg_inc = 83;}
	if(!isset($tags[$i]) || $tags[$i] == ''){$tags[$i] = SSHDB_NULL;}
}
for($j=0;$j<$dbs_count;$j++){
	$db_dir = SSHDB_DIR.'data/storage/'.sshdb_hash($dbs[$j]).'/info.db.sshdb.php';
	if(file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($dbs[$j]))){return $sshdb_msg_inc = 8;}
	mkdir(SSHDB_DIR.'data/storage/'.sshdb_hash($dbs[$j]), 0777);
	sshdb_fopen_w($db_dir,$dbs[$j].SSHDB_EXPLODE1.sshdb_date().SSHDB_EXPLODE1.$tags[$j].SSHDB_EXPLODE3.SSHDB_EXPLODE3);
}

?>