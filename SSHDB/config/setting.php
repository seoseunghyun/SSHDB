<?
//SSHDB
define('SSHDB_VER','0.01');
define('SSHDB_DIR',str_replace('config\\','', str_replace('config/','',str_replace(basename(__FILE__),'',__FILE__))));

$sshdb_token_fdir = SSHDB_DIR.'data/sign/owner.token.sshdb.php';
if(file_exists($sshdb_token_fdir) && filesize($sshdb_token_fdir)>0){
	$sshdb_token_read_fopen = fopen($sshdb_token_fdir, 'r');
	$sshdb_token_read_fcontent = fread($sshdb_token_read_fopen, filesize($sshdb_token_fdir));
	fclose($sshdb_token_read_fopen);
	define('SSHDB_TOKEN', $sshdb_token_read_fcontent);
}else{
	$sshdb_token_write_fopen = fopen($sshdb_token_fdir, 'w');
	$sshdb_token_write_content = md5(uniqid(rand(),true));
	fwrite($sshdb_token_write_fopen,$sshdb_token_write_content);
	fclose($sshdb_token_write_fopen);
	define('SSHDB_TOKEN', $sshdb_token_write_content);
}
$sshdb_set_read_fdir = SSHDB_DIR.'data/sign/owner.set.sshdb.php';

//미설정 시 기본 설정 값
global $sshdb_set;
$sshdb_set = array(
	'null'=>'null',
	'lang'=>'kr',
	'cache_frequency'=>0,		//캐시의 빈도
	'size_stack'=>300,			//빅데이터 대응
	'log'=>1,					//로그 기록 유무
	'log_error'=>1,				//오류 로그 기록 유무
	'log_connect'=>1,			//접속 정보 로그 기록 유무
	'log_modify'=>1,			//데이터 변동 로그 기록 유무
	'log_view'=>1,				//데이터 조회 로그 기록 유무
	'log_msg'=>1,				//데이터 조회 로그 기록 유무
	'log_valen'=>25
);

if(file_exists($sshdb_set_read_fdir) && filesize($sshdb_set_read_fdir)>0){
$sshdb_set_read_fopen = fopen($sshdb_set_read_fdir, 'r');
$sshdb_set_read_fcontent = fread($sshdb_set_read_fopen, filesize($sshdb_set_read_fdir));
fclose($sshdb_set_read_fopen);
unset($sshdb_set_read_fdir,$sshdb_set_read_fopen,$sshdb_set_read_fcontent_split);

$sshdb_set_b['null'] = sshdb_stand_parser('null',$sshdb_set_read_fcontent);
$sshdb_set_b['lang'] = sshdb_stand_parser('lang',$sshdb_set_read_fcontent);
$sshdb_set_b['cache_frequency'] = intval(sshdb_stand_parser('cache_frequency',$sshdb_set_read_fcontent));
$sshdb_set_b['size_stack'] = intval(sshdb_stand_parser('size_stack',$sshdb_set_read_fcontent));
$sshdb_set_b['log'] = intval(sshdb_stand_parser('log',$sshdb_set_read_fcontent));
$sshdb_set_b['log_error'] = intval(sshdb_stand_parser('log_error',$sshdb_set_read_fcontent));
$sshdb_set_b['log_connect'] = intval(sshdb_stand_parser('log_connect',$sshdb_set_read_fcontent));
$sshdb_set_b['log_modify'] = intval(sshdb_stand_parser('log_modify',$sshdb_set_read_fcontent));
$sshdb_set_b['log_view'] = intval(sshdb_stand_parser('log_view',$sshdb_set_read_fcontent));
$sshdb_set_b['log_msg'] = intval(sshdb_stand_parser('log_msg',$sshdb_set_read_fcontent));
$sshdb_set_b['log_valen'] = intval(sshdb_stand_parser('log_valen',$sshdb_set_read_fcontent));
if($sshdb_set_b['null']){$sshdb_set['null'] = $sshdb_set_b['null'];}
if($sshdb_set_b['lang']){$sshdb_set['lang'] = $sshdb_set_b['lang'];}
if($sshdb_set_b['cache_frequency'] == 1 || $sshdb_set_b['cache_frequency'] == 0){$sshdb_set['cache_frequency'] = $sshdb_set_b['cache_frequency'];}
if($sshdb_set_b['size_stack'] && is_integer($sshdb_set_b['size_stack'])){$sshdb_set['size_stack'] = $sshdb_set_b['size_stack'];}
if($sshdb_set_b['log'] == 1 || $sshdb_set_b['log'] == 0){$sshdb_set['log'] = $sshdb_set_b['log'];}
if($sshdb_set_b['log_error'] == 1 || $sshdb_set_b['log_error'] == 0){$sshdb_set['log_error'] = $sshdb_set_b['log_error'];}
if($sshdb_set_b['log_connect'] == 1 || $sshdb_set_b['log_connect'] == 0){$sshdb_set['log_connect'] = $sshdb_set_b['log_connect'];}
if($sshdb_set_b['log_modify'] == 1 || $sshdb_set_b['log_modify'] == 0){$sshdb_set['log_modify'] = $sshdb_set_b['log_modify'];}
if($sshdb_set_b['log_view'] == 1 || $sshdb_set_b['log_view'] == 0){$sshdb_set['log_view'] = $sshdb_set_b['log_view'];}
if($sshdb_set_b['log_msg'] == 1 || $sshdb_set_b['log_msg'] == 0){$sshdb_set['log_msg'] = $sshdb_set_b['log_msg'];}
if($sshdb_set_b['log_valen'] == 1 || $sshdb_set_b['log_valen'] == 0){$sshdb_set['log_valen'] = $sshdb_set_b['log_valen'];}

}

define('SSHDB_NULL',$sshdb_set['null']);
define('SSHDB_LANG',$sshdb_set['lang']);
define('SSHDB_CACHE_FREQUENCY',$sshdb_set['cache_frequency']);
define('SSHDB_LOG',$sshdb_set['log']);
define('SSHDB_LOG_ERROR',$sshdb_set['log_error']);
define('SSHDB_LOG_CONNECT',$sshdb_set['log_connect']);
define('SSHDB_LOG_MODIFY',$sshdb_set['log_modify']);
define('SSHDB_LOG_VIEW',$sshdb_set['log_view']);
define('SSHDB_LOG_MSG',$sshdb_set['log_msg']);
define('SSHDB_LOG_VALEN',$sshdb_set['log_valen']);
define('SSHDB_EXPLODE1',"\x1a");
define('SSHDB_EXPLODE2',"\x1b");
define('SSHDB_EXPLODE3',"\x1c");
define('SSHDB_EXPLODE_SECURE',"\x1d");
define('SSHDB_EXPLODE_STACK',"\x1e");

define('SSHDB_SIZE_STACK',$sshdb_set['size_stack']);

function sshdb_date(){
	return date('YmdHis',time());
}
function sshdb_hash($val){
	return hash('sha256', $val);
}
function sshdb_stand_parser($search,$content){
	return str_replace($search.':', '', stristr(stristr(str_replace(' ', '', $content), $search.':'),';',true));
}

unset($sshdb_set_b,$sshdb_set_read_fcontent);

//!Filter Function
function sshdb_filter_fatal($val){
	if(is_array($val)){$val = implode($val,'');}
	if(
	strpos($val,SSHDB_EXPLODE1) ||
	strpos($val,SSHDB_EXPLODE2) ||
	strpos($val,SSHDB_EXPLODE3) ||
	strpos($val,SSHDB_EXPLODE_SECURE) ||
	strpos($val,SSHDB_EXPLODE_STACK)
	){return 0;}else{return 1;}
}
function sshdb_filter_preg($val){
	if(preg_match('/[^a-z0-9-_]/i', $val)){
		return 0;
	}else{
		return 1;
	}
}



?>