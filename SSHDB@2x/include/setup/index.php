<?
if(isset($_SESSION['sshdb_id'])){
	unset($_SESSION['sshdb_id'],$_SESSION['sshdb_password']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SSHDB Setup</title>
<script type="text/javascript" src="include/common/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
var sshdb_client_phpversion = <?=substr(PHP_VERSION,0,3)?>;
	<?
		$perm_array = array('707','757','777');
		$perm = fileperms('data/');$permi = $perm - 16384;
		$permiss = decoct($permi);
		if(in_array($permiss,$perm_array)){$sshdb_permi = '1';}else{$sshdb_permi = '0';}
	?>
var sshdb_client_rewrite = <?=in_array('mod_rewrite', apache_get_modules());?>;
var sshdb_client_permission = <?=$sshdb_permi?>;
</script>
<script type="text/javascript" src="<?=SSHDB_URL_SETUP?>js/default.js"></script>
<link rel="stylesheet" type="text/css" charset="UTF-8" href="<?=SSHDB_URL_SETUP?>css/style.css" />
</head>

<body>

<div id="header_wrap"></div>
<div id="container_wrap">
	<div id="content_wrap">
		<div id="logo_wrap">
			<img id="logo_img" src="<?=SSHDB_URL_SETUP?>img/logo.gif" width="157" height="44" alt="SSHDB"  class="presol"/>
		</div>
		<div id="intro_wrap">
		<br/><strong>SSHDB를 설치합니다.</strong>
		</div>
		<div id="cw_1" class="content_wrap">
		<div id="check_php" class="check_0 presol_bg"></div>
		<div class="descript">&nbsp;PHP버전 : <?=PHP_VERSION?></div><br/>
		<font style="font-size:10px; color:#9c9c9c">서버에 설치된 PHP 버전이 5.1 이상이어야 합니다.</font>
		<br/><br/>
		<div id="check_rewrite" class="check_0 presol_bg"></div>
		<div class="descript">&nbsp;mod_rewrite 모듈 유무 : <?=in_array('mod_rewrite', apache_get_modules());?></div><br/>
		<font style="font-size:10px; color:#9c9c9c">서버의 아파치 설정에서 mod_rewrite 모듈을 활성화 시켜야 합니다.</font>
		<br /><br/>
		<div id="check_permission" class="check_0 presol_bg"></div>
		<div class="descript">&nbsp;"SSHDB/data"폴더의 권한 가용 여부 : <?=$sshdb_permi?></div><br/>
		<font style="font-size:10px; color:#9c9c9c">SSHDB폴더에서 "data"폴더의 권한을  707,757,777 같이 설정해야 합니다.</font>
		<br /><br/>

		</div>
		
		
		<div id="cw_2" class="content_wrap">
		<a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.ko"><img alt="크리에이티브 커먼즈 라이선스" style="border-width:0" src="<?=SSHDB_URL_SETUP?>img/cc.gif" width="50" height="50" class="presol" /><img alt="크리에이티브 커먼즈 라이선스" style="border-width:0" src="<?=SSHDB_URL_SETUP?>img/by.gif" width="50" height="50" class="presol" /></a><br /><br /><a xmlns:cc="http://creativecommons.org/ns#" href="http://sshdb.com" property="cc:attributionName" rel="cc:attributionURL">SeungHyun Seo</a>에 의해 작성된 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">SSHDB</span> 은(는) <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.ko">크리에이티브 커먼즈 저작자표시 3.0 Unported 라이선스</a>에 따라 이용할 수 있습니다.<a xmlns:dct="http://purl.org/dc/terms/" href="http://sshdb.seoseunghyun.com" rel="dct:source">http://sshdb.seoseunghyun.com</a>의 저작물에 기반합니다.<br /><br />위 라이선스에 동의하면 아래 NEXT를 클릭하시면 됩니다.

		</div>
		
		
		<div id="cw_3" class="content_wrap"><br />
		<strong><font color="#636363">사용자 id와 password를 생성합니다.</font></strong><br/><br/>
		<strong>ID : </strong><input id="input_id" type="text" /><br />
		<strong>PASSWORD : </strong><input id="input_password" type="password" />
		</div>
		
		<div id="cw_4" class="content_wrap"><br />
		<strong><font color="#636363" style="font-size:18px;">설치를 완료합니다.</font></strong><br /><br />
		<strong>- SSHDB API : </strong>http://sshdb.com/api<br /><br />
		<strong>- SSHDB Support : </strong>http://sshdb.com/support<br /><br /><br />
		<strong>http://sshdb.com</strong><br />
		<strong>http://seoseunghyun.com</strong><br /><br /><br />
		<strong><font color="#636363" style="font-size:16px;">감사합니다.</font></strong>
		</div>
		
		<div id="btn_wrap">
			<img id="btn_next_0" src="<?=SSHDB_URL_SETUP?>img/btn_next_0.gif" width="165" height="40" alt="DOWNLOAD" class="presol btn_next" /><img id="btn_next_1" src="<?=SSHDB_URL_SETUP?>img/btn_next_1.gif" width="165" height="40" alt="DOWNLOAD" class="presol btn_next" />
		</div>
	</div>
	<div id="under_wrap"></div>
</div>

</body>
</html>