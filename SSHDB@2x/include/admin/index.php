<?
if(isset($_SESSION[SSHDB_TOKEN]['sshdb_id'])&&isset($_SESSION[SSHDB_TOKEN]['sshdb_password'])){
sshdb_dconnect($_SESSION[SSHDB_TOKEN]['sshdb_id'],$_SESSION[SSHDB_TOKEN]['sshdb_password']);
if($sshdb_msg!=3){include('signin.php');exit;}}else{include('signin.php');exit;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SSHDB Admin</title>
<link rel="stylesheet" type="text/css" charset="UTF-8" href="<?=SSHDBS_URL?>css/style.css" />
<script type="text/javascript" src="include/common/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?=SSHDBS_URL?>js/default.js"></script>
<?
//file_get_contents('http://static.seoseunghyun.com/hub/sshdb/ssh/ijoijj8');
?>
</head>

<body>
<div id="header_bin"></div>


<div id="header_wrap">
	<div id="logo">
		<img src="<?=SSHDBS_URL?>img/logo.gif" width="189" height="87" class="presol" alt="SSHDB" />
	</div>
	<div id="console"></div>
	<div id="info">
	<div id="info_first"></div>
	<div id="info_signout"><img id="btn_signout" src="<?=SSHDBS_URL?>img/header_signout.gif" width="40" height="40" class="presol" alt="Sign Out" /></div>

	</div>
</div>

<div class="boundary_1"></div>
<div id="menu_wrap">
<div id="menu_bin_left"></div>
<div id="menu_content">
<div id="menu_first"><div id="menu_btn_home_wrap" class="menu_btn_wrap">
<img id="menu_btn_home" src="<?=SSHDBS_URL?>img/menu_btn_home.gif" width="49" height="48" alt="HOME" class="menu_btn" /></div><div id="menu_btn_user_wrap" class="menu_btn_wrap"><img id="menu_btn_user" src="<?=SSHDBS_URL?>img/menu_btn_user.gif" width="49" height="48" alt="USER" class="menu_btn" /></div><div id="menu_btn_view_wrap" class="menu_btn_wrap"><img id="menu_btn_view" src="<?=SSHDBS_URL?>img/menu_btn_view.gif" width="49" height="48" alt="VIEW" class="menu_btn" /></div><div id="menu_btn_guroomz_wrap" class="menu_btn_wrap"><img id="menu_btn_guroomz" src="<?=SSHDBS_URL?>img/menu_btn_guroomz.gif" width="49" height="48" alt="GUROOMZ" class="menu_btn" /></div>
</div>
<div id="menu_middle"></div>
<div id="menu_last">
	<div id="menu_ss"></div>
	<div id="menu_foc" class="presol_css">
	<div id="menu_foc_slider" class="presol_css">
	<img id="menu_foc_1" src="<?=SSHDBS_URL?>img/menu_foc_slider_1.gif" width="110" height="26" class="presol menu_display_status_<?=SSHDB_CACHE_FREQUENCY?>" alt="SSHDB" />
	</div>
	</div>
	<div id="menu_log" class="presol_css"><img src="<?=SSHDBS_URL?>img/menu_log_txt.gif" width="66" height="48" class="presol" alt="SSHDB" /><img id="menu_log_btn" src="<?=SSHDBS_URL?>img/menu_flip_on.gif" width="38" height="48" class="presol menu_display_status_<?=SSHDB_LOG?>" alt="Log ON" /></div>
	<div id="menu_log_view" class="presol_css"><img id="hide_log_btn" src="<?=SSHDBS_URL?>img/hide_log.gif" width="15" height="24" class="presol" alt="Log Hide" /></div>
</div>
</div>
<div id="menu_bin_right"></div>
</div>


<div id="view_log_wrap">
<div id="view_log_list"></div>
<div id="view_log_options">
	<div id="view_log_opt">
	<div id="log_check_error" class="ssh_check presol_css log_check" alt="error"></div><div class="log_check_b">error</div><br />
	<div id="log_check_connect" class="ssh_check presol_css log_check" alt="connect"></div><div class="log_check_b">connect</div><br />
	<div id="log_check_modify" class="ssh_check presol_css log_check" alt="modify"></div><div class="log_check_b">modify</div><br />
	<div id="log_check_view" class="ssh_check presol_css log_check" alt="view"></div><div class="log_check_b">view</div><br />
	<div id="log_check_msg" class="ssh_check presol_css log_check" alt="msg"></div><div class="log_check_b">msg</div><br />
	</div>
</div>
<div id="view_log_content"><div id="view_log_cont"></div>
</div>
</div>
<div class="boundary_1"></div>
<div id="container_wrap">
<div id="container">
	<div id="left_wrap">
<!--	< div id="search_wrap"><input id="search_input" ></div> -->
	<div id="navi_wrap"><div id="navi_top"><span><img id="navi_btn_reload" src="<?=SSHDBS_URL?>img/reload_btn.gif" width="20" height="20" class="resol" alt="Reload" /></span></div>
		<div id="navi"></div>
		<div id="navi_cdb_wrap">
			<div id="navi_cdb_top"></div>
			<div id="navi_cdb_content">
				<input id="navi_cdb_input" class="input_cdb">
				<img src="<?=SSHDBS_URL?>img/navi_cdb_help.gif" width="144" height="40" class="resol" alt="Submit" />
				<img id="navi_cdb_submit" class="navi_cdb_btn resol" src="<?=SSHDBS_URL?>img/navi_cdb_btn_submit.gif" width="72" height="18" alt="Submit" /><img id="navi_cdb_cancle" class="navi_cdb_btn resol" src="<?=SSHDBS_URL?>img/navi_cdb_btn_cancle.gif" width="72" height="18"  alt="Cancle" />

			</div>
			<div id="navi_cdb_bottom">
				<img id="navi_cdb_open" class="navi_cdb_btn presol" src="<?=SSHDBS_URL?>img/navi_cdb_btn.gif" width="144" height="18" alt="" />
			</div>
		</div>
		
		<div id="navi_clink_wrap">
			<div id="navi_clink_top"></div>
			<div id="navi_clink_content">
				<input id="navi_clink_input" class="input_clink" value="Database ID"><br /><input id="navi_clink_dir_input" class="input_clink_dir" value="<?=str_replace('SSHDB\\include\\admin\\','', str_replace('SSHDB/include/admin/','',str_replace(basename(__FILE__),'',__FILE__)))?>">
				<img src="<?=SSHDBS_URL?>img/navi_clink_help.gif" width="144" height="40" class="resol" alt="" />
				<img id="navi_clink_submit" class="navi_clink_btn resol" src="<?=SSHDBS_URL?>img/navi_clink_btn_submit.gif" width="72" height="18" alt="Submit" /><img id="navi_clink_cancle" class="navi_clink_btn resol" src="<?=SSHDBS_URL?>img/navi_clink_btn_cancle.gif" width="72" height="18"  alt="Cancle" />

			</div>
			<div id="navi_clink_bottom">
				<img id="navi_clink_open" class="navi_clink_btn presol" src="<?=SSHDBS_URL?>img/navi_clink_btn.gif" width="144" height="18" alt="" />
			</div>
		</div>
		<div id="navi_bottom"></div>
	</div>
	</div>
	<div id="content_bin_side"></div>
	<div id="content">
		<div id="content_loading" class="content_wrap">초기 화면을 불러오고 있습니다.
		</div>
		<div id="content_home" class="content_wrap content_home">
		
		
		<div id="content_home_info">
			<div id="home_info_title" class="content_title"><img src="<?=SSHDBS_URL?>img/home_info_title.gif" class="presol" width="238" height="26" alt="Information Of Table" /></div>
			<div id="home_info_content"><br />
				- <strong style="color:#45b0e8">SSHDB Root Directory</strong> : <?=SSHDB_DIR?><br />
				- <strong>SSHDB Version</strong> : <?=SSHDB_VER?><br />
				<span id="home_info_load" class="span_no"></span>
				<br /><br />
			</div>
		</div>
		<div id="content_home_ana">
			<div id="home_ana_title" class="content_title"><img src="<?=SSHDBS_URL?>img/home_ana_title.gif" class="presol" width="119" height="26" alt="Analytics" /></div>
			<div id="home_ana_gr">
			Loading...
			</div>
		</div>
		
		
		</div>
		
		
		<div id="content_db" class="content_wrap content_db">
		<div id="content_db_header"></div>
		<div id="content_db_info">
			<div id="db_info_title" class="content_title"><img src="<?=SSHDBS_URL?>img/content_di_title.gif" class="presol" width="280" height="26" alt="Information Of Database" /></div>
			<div id="db_info_content"><br />
				<span id="db_info_load" class="span_no"></span>
				<br /><br />
			</div>
		</div>
		</div>
		
		
		
		<div id="content_tb" class="content_wrap content_tb">
		<div id="content_tb_hide"></div>
		<div id="content_tb_header"></div>
		<div id="content_tb_sot">
			<div id="sot_title" class="content_title">
			<img src="<?=SSHDBS_URL?>img/content_sot_title.gif" class="presol" width="169" height="26" alt="Size Of Table" />
			</div>
			<div id="sot_wrap">
				<div id="sot_backup">Backup</div><div id="sot_stack">Stack</div>Table
			</div>
			<div id="sot_subscript">
				<strong><font color="#a2d6df">￭</font> <font color="#2f899c">Entire : </font></strong><span id="sot_sc_entire">...</span> <strong><font color="#f1c669">￭</font> <font color="#826422">Backup : </font></strong><span id="sot_sc_backup">...</span> <strong><font color="#f1698c">￭</font> <font color="#861d38">Stack : </font></strong></font><span id="sot_sc_stack">...</span>
			</div>
		</div>
		<div id="content_tb_backup">
			<div id="backup_title" class="content_title"><img src="<?=SSHDBS_URL?>img/content_backup_title.gif" class="presol" width="145" height="26" alt="Backup List" /></div><div id="backup_create"><img id="backup_create_btn" src="<?=SSHDBS_URL?>img/backup_create_btn.gif" class="presol" width="31" height="30" alt="Backup Create" /></div><div id="backup_list"></div>
		</div>
		<!-- table structure의 약자로 ts로 사용한다. -->
		<div id="content_tb_ts">
		<div id="ts_title" class="content_title"><img src="<?=SSHDBS_URL?>img/content_ts_title.gif" class="presol" width="198" height="26" alt="Table Structure" /></div>

		<div id="ts_cvar" class="ts_sub">
		<img src="<?=SSHDBS_URL?>img/ts_cvar_title.gif" class="presol" width="132" height="21" alt="Create Variable" /><input type="text" id="input_cvar_id" class="ts_sub_input" value="Variable ID" /><input type="text" id="input_cvar_tag" class="ts_sub_input_b" value="Descript - TAG" /><div id="ts_check_cvar" class="ssh_check presol_css ts_check"></div><div class="ts_check_b">콤마, 구분&nbsp;&nbsp;&nbsp;<span id="ts_cvar_btn">SUBMIT</span></div>
		</div>	
			
		<div id="ts_cele" class="ts_sub">
		<img src="<?=SSHDBS_URL?>img/ts_cele_title.gif" class="presol" width="132" height="21" alt="Create Element" /><input type="text" id="input_cele_id" class="ts_sub_input" value="Element ID" /><input type="text" id="input_cele_tag" class="ts_sub_input_b" value="Descript - TAG" /><div id="ts_check_cele" class="ssh_check presol_css ts_check"></div><div class="ts_check_b">콤마, 구분&nbsp;&nbsp;&nbsp;<span id="ts_cele_btn">SUBMIT</span></div>
		</div>


		
		<div id="ts_textarea_wrap">
			<div id="ts_textarea_wrap_top" class="presol_css"><img src="<?=SSHDBS_URL?>img/ts_textarea_corner_rt.gif" class="presol" width="15" height="15" alt="" /></div>
			<div id="ts_textarea_title"><img src="<?=SSHDBS_URL?>img/ts_textarea_title.gif" class="presol" width="132" height="21" alt="Modify Value" /><div id="ts_textarea_status">[<span id="tstw_type"></span>] <span id="tstw_id"></span> -> <span id="tstw_attr"></span><span id="tstw_tag"></span></div></div>
				<div id="ts_textarea_content">
				<textarea id="ts_textarea"></textarea>
				
				</div>
				<div id="ts_textarea_submit_wrap"><span id="ts_textarea_modify_submit">Modify</span>
				</div>
			<div id="ts_textarea_wrap_bottom" class="presol_css"><img src="<?=SSHDBS_URL?>img/ts_textarea_corner_rb.gif" class="presol" width="15" height="15" alt="" /></div>
		</div>
		
		
		<div id="ts_tb_tool"><span id="dele_btn">Delete</span>&nbsp;&nbsp;<span id="xml_btn">View XML</span></div>
		<div id="content_tb_wrap" class="content_tb">
		<div id="content_tb_title_wrap" class="content_tb"></div>
		<div id="content_tb_table_wrap" class="content_tb"></div>
		</div>
		<div id="content_tb_under_wrap" class="content_tb"></div>
		</div>
		</div>
	</div>
</div>
</div>
<div id="under_wrap">
	<div id="boundary_2"></div>
	<div id="footer">
		<img src="<?=SSHDBS_URL?>img/seoseunghyun_logo.jpg" width="334" height="205" alt="" />
	</div>
</div>
</body>
</html>