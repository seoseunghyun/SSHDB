<?	
//SSHDB

class SSHDB_SELECT{
	var $sshdb_select;
	function selector($select){
		//선택자 배열
		$select_tree = array('db','table','var','ele');
		$select_b = explode('->', $select);
		$select_b_count = count($select_b);
		for($i=0;$i<$select_b_count;$i++){
		$this -> sshdb_select[$select_tree[$i]] = $select_b[$i];
		}
	}
	function selector_var($select){
		$this -> sshdb_select['var'] = $select;
	}
	function selector_ele($select){
		$this -> sshdb_select['ele'] = $select;
	}
}


function sshdb_modify_key($id,$password){
	global $sshdb_msg;	
	include (SSHDB_DIR.'core/action/modify_key.php');
	if(isset($sshdb_msg_inc)){	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'mKEY',$id,'');
	return $sshdb_msg = 80;
}
	
//!Pre Function
function sshdb_array($form){
	switch($form){
	//기본 속성
	case 'attr' : return array('id','date','tag','option','link','backup');break;
	case 'attr_n' : return array('id','tag');break; 								
	//수정 가능한 속성 (date를 제외하기 위해)
	case 'attr_m' : return array('id','tag','option');break;
	//align_ele에서 정렬할 때 사용한다.
	case 'align_sort' : return array('','asc','desc');break;
	//align_ele정렬 때 정렬 유형을 정한다.
	case 'align_type' : return array('','regular','numberic','string');break;
	//Link의 권한 값 배열.
	case 'link_permission' : return array('707','757','777');break;
	//로그의 true or false 속성 배열
	case 'log' : return array(SSHDB_LOG,SSHDB_LOG_ERROR,SSHDB_LOG_CONNECT,SSHDB_LOG_MODIFY,SSHDB_LOG_VIEW,SSHDB_LOG_MSG,SSHDB_LOG_VALEN);break;
	//로그의 종류 배열
	case 'attr_log' : return array('error','connect','modify','view','msg');break;
	//테이블 안에 있는 폴더 명
	case 'attr_structure' : return array('','stack','backup');break;
	}
}        
function sshdb_list_storage(){
	global $sshdb_list;
	echo sshdb_fview(SSHDB_DIR.'data/storage/','');
	$sshdb_list_a = $sshdb_list;
	$sshdb_list ='';
	unset($sshdb_list);
	return $sshdb_list_a;
}
//아직 제작중인 함수
function sshdb_parser_option($attr,$type,$content){
	$content_group = str_ireplace($attr.'{', '', stristr(stristr(trim($content), $attr.'{'),'}',true));
	return $content_main = str_ireplace($type.':', '', stristr(stristr($content_group, $type.':'),';',true));	
}

function sshdb_modify_setting($set,$change){
	global $sshdb_set, $sshdb_msg;
	$content ='';
	if(!isset($sshdb_set[$set])){
		return $sshdb_msg = 97;
	}
	$sshdb_set[strtolower($set)] = $change;
	foreach($sshdb_set as $key => $val){
		$content .= $key.':'.$val.';
';
	}
	$fdir = SSHDB_DIR.'data/sign/owner.set.sshdb.php';
	$fopen = fopen($fdir, 'w');
	fwrite($fopen,$content);
	fclose($fopen);
	return $sshdb_msg = 98;
}


//!File Control Function
function sshdb_fopen_r($dir){
	global $sshdb_global_memory;
	if(isset($sshdb_global_memory[$dir]) && SSHDB_CACHE_FREQUENCY == 0){return $sshdb_global_memory[$dir];}
	$fdir = $dir;
	$fopen = fopen($fdir, 'r');
	$fcontent = fread($fopen, filesize($fdir));
	$fcontent_split = explode(SSHDB_EXPLODE_SECURE,$fcontent);
	fclose($fopen);
	if(SSHDB_CACHE_FREQUENCY == 1){clearstatcache();}
	sshdb_push_log(3,'File IO [R]',$dir,'__READ__');
	return $fcontent_split[1];
}
function sshdb_fopen_w($dir,$content){
	$fdir = $dir;
	$fopen = fopen($fdir, 'w');
	$secure = '<?php exit;?>';
	fwrite($fopen,$secure.SSHDB_EXPLODE_SECURE.$content);
	fclose($fopen);
	sshdb_push_log(2,'File IO [W]',$dir,'__WRITE__');
}
function sshdb_fdelete($dir){
	$dirs = dir($dir);
	
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') ){
			if(is_dir($dir.'/'.$entry)){
				sshdb_fdelete($dir.'/'.$entry);
			}else{
				@unlink($dir.'/'.$entry);
			}
		}
	}
	$dirs->close();
	@rmdir($dir);
	sshdb_push_log(2,'File IO [Delete]',$dir,''); 
	
}
function sshdb_fdelete_nobackup($dir){
	$dirs = dir($dir);
	
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') && ($entry!='backup') ){
			if(is_dir($dir.'/'.$entry)){
				sshdb_fdelete($dir.'/'.$entry);
			}else{
				@unlink($dir.'/'.$entry);
			}
		}
	}
	$dirs->close();
	@rmdir($dir); 
	sshdb_push_log(2,'File IO [Delete]',$dir,'');
}
function sshdb_fview($dir,$db){
global $sshdb_list;
	$dirs = dir($dir);
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') &&($entry!='.DS_Store')){
			if(is_dir($dir.$entry)){

				if(file_exists($dir.$entry.'/info.db.sshdb.php') && !file_exists($dir.$entry.'/link.db.sshdb.php')){
				$db_split = explode(SSHDB_EXPLODE1,sshdb_fopen_r($dir.'/'.$entry.'/info.db.sshdb.php'));
				$sshdb_list[$db_split[0]]=array();
				sshdb_fview($dir.$entry,$db_split[0]);
				}else 
				if(file_exists($dir.$entry.'/info.db.sshdb.php') && file_exists($dir.$entry.'/link.db.sshdb.php')){
				$db_split = explode(SSHDB_EXPLODE1,sshdb_fopen_r($dir.'/'.$entry.'/info.db.sshdb.php'));
				$link_content = sshdb_fopen_r($dir.'/'.$entry.'/link.db.sshdb.php');
				$sshdb_list[$db_split[0]]=array();
				sshdb_fview($link_content,$db_split[0]);
				}else if(file_exists($dir.$entry.'/info.table.sshdb.php')){
					$table_split = explode(SSHDB_EXPLODE1,sshdb_fopen_r($dir.'/'.$entry.'/info.table.sshdb.php'));
					$sshdb_list[$db][$table_split[0]]=$table_split[1];
				}
			}else if($entry!='info.db.sshdb.php'){

				$table_split = explode(SSHDB_EXPLODE1,sshdb_fopen_r($dir.'/'.$entry.'/info.table.sshdb.php'));
				$sshdb_list[$db][$table_split[0]]=$table_split[1];
				
			}else{

			}
		}
	}
	sshdb_push_log(3,'File IO [Structure]',$dir,'');
	$dirs->close();
}
function sshdb_fdir($db){
	$dir = SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/';
	
	if(file_exists($dir.'link.db.sshdb.php')){
		$link_content = sshdb_fopen_r($dir.'link.db.sshdb.php');
		$link_perm = fileperms($link_content); 
		$link_permi = $link_perm - 16384;
		$link_permiss = decoct($link_permi);
			if(!in_array($link_permiss,sshdb_array('link_permission'))){
				$return_msg = array('0','49');
				return $return_msg;
			}
		return sshdb_fopen_r($dir.'link.db.sshdb.php');
	}	
	if(!file_exists($dir.'info.db.sshdb.php')){
		$return_msg = array('0','15');
		return $return_msg;
	}
	sshdb_push_log(3,'File IO [Structure]',$dir,'');
	return $dir;
}
function sshdb_fsize($path){ 
  $totalsize = 0; 
  $totalcount = 0; 
  $dircount = 0; 
  if ($handle = opendir ($path)) 
  { 
    while (false !== ($file = readdir($handle))) 
    { 
      $nextpath = $path . '/' . $file; 
      if ($file != '.' && $file != '..' && !is_link ($nextpath)) 
      { 
        if (is_dir ($nextpath)) 
        { 
          $dircount++; 
          $result = sshdb_fsize($nextpath); 
          $totalsize += $result['size']; 
          $totalcount += $result['count']; 
          $dircount += $result['dircount']; 
        } 
        elseif (is_file ($nextpath)) 
        { 
          $totalsize += filesize ($nextpath); 
          $totalcount++; 
        } 
      } 
    } 
  } 
  closedir ($handle); 
  $total['size'] = $totalsize; 
  $total['count'] = $totalcount; 
  $total['dircount'] = $dircount; 
  return $total; 
}
//bit수로 된 용량을 GB, MB, KB, Byte 유형으로 표현한다.
function sshdb_fsize_format($size){ 
    if($size<1024) 
    { 
        return $size.'bytes'; 
    } 
    else if($size<(1024*1024)) 
    { 
        $size=round($size/1024,1); 
        return $size.'KB'; 
    } 
    else if($size<(1024*1024*1024)) 
    { 
        $size=round($size/(1024*1024),1); 
        return $size.'MB'; 
    } 
    else 
    { 
        $size=round($size/(1024*1024*1024),1); 
        return $size.'GB'; 
    } 

}



//!incomplete
function sshdb_search_all(){
	sshdb_fsearch(SSHDB_DIR.'data/storage');
}
function sshdb_fsearch($dir){
global $sshdb_search_list;
$dir_name = str_replace(SSHDB_DIR.'data/storage', '', $dir);
	$dirs = dir($dir);
	
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') && ($entry != '.DS_Store') ){
			if(is_dir($dir.'/'.$entry)){
				echo $dir_name.'>'.$entry.'>[ID]<br />';
				sshdb_fsearch($dir.'/'.$entry);
							}else{
				echo '--'.$dir_name.'>'.$entry.'<br />';

			}
		}
	}
	sshdb_push_log(3,'File IO (Search)',$dir,'');
	$dirs->close();
}

class SSHDB extends SSHDB_SELECT{
	//!DB Function
	function create_db($tag){
		global $sshdb_msg;	
		$db = $this -> sshdb_select['db'];
		include (SSHDB_DIR.'core/action/create_db.php');
		if(isset($sshdb_msg_inc)){
		sshdb_push_log(0,'cDB','',$sshdb_msg_inc);
		return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'cDB','',$db);
		return $sshdb_msg = 10;
	}
	function modify_db($attr,$change){
		global $sshdb_msg, $sshdb_global_memory;
		$db = $this -> sshdb_select['db'];	
		include (SSHDB_DIR.'core/action/modify_db.php');
		if(isset($sshdb_msg_inc)){
		sshdb_push_log(0,'mDB',$db,$sshdb_msg_inc);
		return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'mDB',$db,$attr.'~>'.$change);
		return $sshdb_msg = 17;

	}
	function delete_db(){
		global $sshdb_msg;
		$db = $this -> sshdb_select['db'];
		include (SSHDB_DIR.'core/action/delete_db.php');
		if(isset($sshdb_msg_inc)){
			sshdb_push_log(0,'dDB',$db,$sshdb_msg_inc);
			return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'dDB',$db,'');
		return $sshdb_msg = 18;
	}
	function get_db($attr){
		global $sshdb_msg,$sshdb_get;
		$db = $this -> sshdb_select['db'];
		include (SSHDB_DIR.'core/action/get_db.php');
		if(isset($sshdb_msg_inc)){
			sshdb_push_log(0,'gDB',$db,$sshdb_msg_inc);
			return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'gDB',$db,$attr.' : '.$sshdb_get);
		return $sshdb_msg = 20;
	}
	function size_db(){
		global $sshdb_msg;
		$db = $this -> sshdb_select['db'];
		include (SSHDB_DIR.'core/action/size_db.php');
			if(isset($sshdb_msg_inc)){
				sshdb_push_log(0,'siDB',$db,$sshdb_msg_inc);
				return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'siDB',$db,$sshdb_return_val);
		return $sshdb_return_val;
}

	//!LINK Function
	function create_link($tag,$dir){
		global $sshdb_msg;
		$db = $this -> sshdb_select['db'];	
		include (SSHDB_DIR.'core/action/create_link.php');
		if(isset($sshdb_msg_inc)){
			sshdb_push_log(0,'cLINK','',$sshdb_msg_inc);
			return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'cLINK','',$db.'('.$dir.')');
		return $sshdb_msg = 48;
	}
	function modify_link($dir){
		global $sshdb_msg;	
		$db = $this -> sshdb_select['db'];
		include (SSHDB_DIR.'core/action/modify_link.php');
			if(isset($sshdb_msg_inc)){
			sshdb_push_log(0,'mLINK',$db,$sshdb_msg_inc);
			return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'mLINK',$db,$dir);
		return $sshdb_msg = 55;
	}
	function get_link(){
		global $sshdb_msg,$sshdb_get;
		$db = $this -> sshdb_select['db'];	
		include (SSHDB_DIR.'core/action/get_link.php');
			if(isset($sshdb_msg_inc)){
			sshdb_push_log(0,'gLINK',$db.'('.$dir.')',$sshdb_msg_inc);
			return $sshdb_msg = $sshdb_msg_inc;}
		sshdb_push_log(4,'gLINK',$db.'('.$dir.')','dir :'.$sshdb_get);
		return $sshdb_msg = 56;
	}

	//!Table Function
	function create_table($tag){
	global $sshdb_msg;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/create_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'cTABLE',$db,$sshdb_msg_inc);	
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'cTABLE',$db,$table);
	return $sshdb_msg = 25;
}
	function modify_table($attr,$change){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/modify_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'mTABLE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'mTABLE',$db.'->'.$table,$attr.'~>'.$change);
	return $sshdb_msg = 26;	
}
	function delete_table(){
	global $sshdb_msg;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/delete_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'dTABLE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'dTABLE',$db.'->'.$table,'');
	return $sshdb_msg = 27;
}
	function get_table($attr){
	global $sshdb_msg,$sshdb_get;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/get_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'gTABLE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'gTABLE',$db.'->'.$table,$attr.' : '.$sshdb_get);
	return $sshdb_msg = 20;
}
	function form_table(){
	global $sshdb_msg;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/print_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'pTABLE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'pTABLE',$db.'->'.$table,'print : '.$sshdb_print);
	$sshdb_msg = 94;
	return $sshdb_print;
}
	function size_table($attr){
	global $sshdb_msg;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/size_table.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'siTABLE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'siTABLE',$db.'->'.$table,$sshdb_return_val['size'].'|'.$sshdb_return_val['realsize'].'|'.$sshdb_return_val['count'].'|'.$sshdb_return_val['dircount']);
	return $sshdb_return_val;
}

	//!Variable Function
	function create_var($tag){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$var = $this -> sshdb_select['var'];
	include (SSHDB_DIR.'core/action/create_var.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'cVAL',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'cVAL',$db.'->'.$table,$var);
	return $sshdb_msg = 30;
	}
	function modify_var($attr,$change){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$var = $this -> sshdb_select['var'];	
	include (SSHDB_DIR.'core/action/modify_var.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'mVAL',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'mVAL',$db.'->'.$table,$attr.'~>'.$change);
	return $sshdb_msg = 32;	

}
	function delete_var(){
	global $sshdb_msg,$sshdb_global_memory;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$var = $this -> sshdb_select['var'];
	include (SSHDB_DIR.'core/action/delete_var.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'dVAL',$db.'->'.$table.'->'.$var,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'dVAL',$db.'->'.$table.'->'.$var,'');
	return $sshdb_msg = 35;	
}
	function get_var($attr){
	global $sshdb_msg,$sshdb_get;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$var = $this -> sshdb_select['var'];
	include (SSHDB_DIR.'core/action/get_var.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'gVAL',$db.'->'.$table.'->'.$var,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(0,'gVAL',$db.'->'.$table.'->'.$var,$attr.' : '.$sshdb_get);
	return $sshdb_msg = 20;
}

	//!Element Function
	function create_ele($tag){
	global $sshdb_msg,$sshdb_global_memory;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$ele = $this -> sshdb_select['ele'];
	include (SSHDB_DIR.'core/action/create_ele.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'cELE',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'cELE',$db.'->'.$table,$ele);
	return $sshdb_msg = 38;
}
	function modify_ele($attr,$change){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$ele = $this -> sshdb_select['ele'];
	include (SSHDB_DIR.'core/action/modify_ele.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'mELE',$db.'->'.$table.'->'.$ele,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'mELE',$db.'->'.$table.'->'.$ele,$attr.'~>'.$change);
	return $sshdb_msg = 40;	

}
	function delete_ele(){
	global $sshdb_msg,$sshdb_global_memory;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$ele = $this -> sshdb_select['ele'];
	include (SSHDB_DIR.'core/action/delete_ele.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'dELE',$db.'->'.$table.'->'.$ele,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'dELE',$db.'->'.$table.'->'.$ele,'');
	return $sshdb_msg = 42;	

}
	function get_ele($attr){
	global $sshdb_msg,$sshdb_get;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	$ele = $this -> sshdb_select['ele'];
	include (SSHDB_DIR.'core/action/get_ele.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'gELE',$db.'->'.$table.'->'.$ele,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'gELE',$db.'->'.$table.'->'.$ele,$attr.' : '.$sshdb_get);
	return $sshdb_msg = 20;
}

	//!Backup Function
	function create_backup(){
	global $sshdb_msg;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/create_backup.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'cBACKUP',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'cBACKUP',$db.'->'.$table,'');
	return $sshdb_msg = 57;
}
	function list_backup(){
	global $sshdb_msg,$sshdb_get;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/list_backup.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'liBACKUP',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'liBACKUP',$db.'->'.$table,'list : '.$sshdb_get);
	return $sshdb_msg = 59;
}
	function print_backup($backup,$stack){
	global $sshdb_msg;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/print_backup.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'prBACKUP',$db.'->'.$table.'=>'.$backup,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'prBACKUP',$db.'->'.$table.'=>'.$backup,'');
	
	return $sshdb_msg = 62;
	
}
	function delete_backup($backup){
	global $sshdb_msg;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/delete_backup.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'dBACKUP',$db.'->'.$table.'=>'.$backup,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'dBACKUP',$db.'->'.$table.'=>'.$backup,'');
	return $sshdb_msg = 64;
	
}
	function change_backup($backup){
	global $sshdb_msg;	
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/change_backup.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'chBACKUP',$db.'->'.$table.'=>'.$backup,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'chBACKUP',$db.'->'.$table.'=>'.$backup,'');
	return $sshdb_msg = 65;
	
}

	//!List Function
	function get_list($ele,$attr){
	global $sshdb_msg,$sshdb_get;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/get_list.php');
	if(isset($sshdb_msg_inc)){return $sshdb_msg = $sshdb_msg_inc;}
	return $sshdb_msg = 20;
}	
	function align_list($attr,$align_sort,$align_type){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/align_list.php');
	if(isset($sshdb_msg_inc)){return $sshdb_msg = $sshdb_msg_inc;}
	return $sshdb_msg = 46;	
}
	function search_list($attr_search,$attr_get,$search){
	global $sshdb_msg,$sshdb_global_memory;
	$db = $this -> sshdb_select['db'];
	$table = $this -> sshdb_select['table'];
	include (SSHDB_DIR.'core/action/search_list.php');
	if(isset($sshdb_msg_inc)){return $sshdb_msg = $sshdb_msg_inc;}
	$sshdb_msg = 46;	
	return $sshdb_print;
}
}


//!Log Function
function sshdb_push_log($attr_no,$action,$path,$val){
	include (SSHDB_DIR.'core/action/push_log.php');
}	
function sshdb_print_log($log,$attr){
	global $sshdb_msg,$sshdb_get;
	include (SSHDB_DIR.'core/action/print_log.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'prLOG',$log,'');
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'prLOG',$log,'');
	$sshdb_msg = 87;
	return $sshdb_return;
}	
function sshdb_delete_log($log,$attr){
	global $sshdb_msg;
	include (SSHDB_DIR.'core/action/delete_log.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'dLOG',$log,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'dLOG',$log,'');
	return $sshdb_msg = 91; 
}
function sshdb_list_log(){
	global $sshdb_msg,$sshdb_get;
	include (SSHDB_DIR.'core/action/list_log.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(0,'listLOG','__ROOT_LOG__','');
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'listLOG','__ROOT_LOG__','');
	return $sshdb_msg = 88;
}
function sshdb_parser_log($attr_no,$action,$path,$val,$time,$ip){
	include (SSHDB_DIR.'core/parse/sshdb_log.php');
	return $log_return;
}

//!Export Function
function sshdb_export_xml($db,$table){
	global $sshdb_msg;
	include (SSHDB_DIR.'core/action/export_xml.php');
	if(isset($sshdb_msg_inc)){
	sshdb_push_log(3,'exXML',$db.'->'.$table,$sshdb_msg_inc);
	return $sshdb_msg = $sshdb_msg_inc;}
	sshdb_push_log(4,'exXML',$db.'->'.$table,'export XML');
	return $sshdb_msg = 99;

}


//!Query Function - incomplete
function sshdb_query_sql($query){
}