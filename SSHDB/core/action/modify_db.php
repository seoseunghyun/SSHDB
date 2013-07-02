<?
//SSHDB
if(!$attr){return $sshdb_msg_inc = 11;}
if(!$change){return $sshdb_msg_inc = 12;}
if(sshdb_filter_fatal($change) == 0){return $sshdb_msg_inc = 5;}

if(!is_array($attr)){$attrs = explode(',',$attr);}else{$attrs=$attr;}$attrs_count = count($attrs);
if(!is_array($change)){$changes = explode(',',$change);}else{$changes=$change;}$changes_count = count($changes);

$attrs_uniq_count = count(array_unique($attrs));
if($attrs_count != $attrs_uniq_count) {return $sshdb_msg_inc = 16;}

for($i=0;$i<$attrs_count;$i++){
	if(!in_array($attrs[$i],sshdb_array('attr_n'))){return $sshdb_msg_inc = 13;}
	if(!isset($changes[$i]) || $changes[$i]==''){return $sshdb_msg_inc = 9;}
	if($attrs[$i] == 'id' && sshdb_filter_preg($changes[$i]) == 0){return $sshdb_msg_inc = 83;}
	if($attrs[$i] == 'id' && in_array($changes[$i],sshdb_array('attr'))){return $sshdb_msg_inc = 14;}
}
$db_dir = SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/';
$db_info_dir = $db_dir.'info.db.sshdb.php';
if(!file_exists($db_info_dir)){return $sshdb_msg_inc = 15;}
$db_content = sshdb_fopen_r($db_info_dir);
$db_split_b = explode(SSHDB_EXPLODE3,$db_content);
$db_split = explode(SSHDB_EXPLODE1,$db_split_b[0]);

for($j=0;$j<$attrs_count;$j++){
	if($attrs[$j]=='id' && file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($changes[$j]).'/info.db.sshdb.php')){return $sshdb_msg_inc = 8;}
	switch($attrs[$j]){
	case 'id' : $db_split[0] = $changes[$j];$attrs_modify_id = $changes[$j];break;
	case 'tag' : $db_split[2] = $changes[$j];break;
	}
}
	$db_split_b[0] = implode($db_split,SSHDB_EXPLODE1);
	$db_complete = implode($db_split_b,SSHDB_EXPLODE3);
	sshdb_fopen_w($db_info_dir,$db_complete);
	if(isset($attrs_modify_id)){
		rename(SSHDB_DIR.'data/storage/'.sshdb_hash($db) ,SSHDB_DIR.'data/storage/'.sshdb_hash($attrs_modify_id) );
	}
$sshdb_global_memory[$db_info_dir] = $db_complete;
?>