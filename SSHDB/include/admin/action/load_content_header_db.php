<?php
include('../lib/set.php');
$db =$_GET['db'];
sshdb_get_db($db,'');
?>
<div id="dbcontent_db_header_db">
	<span id="dbcontent_a_title" class="content_edit_toggle">
	<?=$db?><img src="<?=SSHDBS_URL?>img/content_edit_tbtitle.gif" width="65" height="55" class="resol" alt="Edit Table ID" /></span>

	<span id="dbcontent_edit_title">
		<input id="dbcontent_edit_title_input">
		<font color="#888888" style="font-size:13px;text-decoration: underline;"><span id="dbcontent_edit_title_o">Modify</span></font><span><font style="font-size:13px;">&nbsp;</font></span><font color="#ababab" style="font-size:12px;text-decoration: underline;"><span id="dbcontent_edit_title_cancle"class="content_edit_toggle">Cancle</span></font>
	</span>
</div>

<div id="dbcontent_db_header_tag">
	<img src="<?=SSHDBS_URL?>img/content_tag.gif" width="31" height="23" class="resol" alt="TAG :" />
	<span id="dbcontent_a_tag" class="content_edit_tag_toggle">
	<span id="dbcontent_a_tag_content"><?=$sshdb_get[$db]['tag']?></span>
	<img src="<?=SSHDBS_URL?>img/content_edit_tag.gif" width="35" height="13" class="resol" alt="Edit Tag" />
	</span>
	
	<span id="dbcontent_edit_tag">
		<input id="dbcontent_edit_tag_input">
		<font color="#888888" style="font-size:13px;text-decoration: underline;"><span id="dbcontent_edit_tag_o">Modify</span></font><span><font style="font-size:13px;">&nbsp;</font></span><font color="#ababab" style="font-size:12px;text-decoration: underline;"><span id="dbcontent_edit_tag_cancle" class="content_edit_tag_toggle">Cancle</span></font>
	</span>
	
	<img src="<?=SSHDBS_URL?>img/content_clock.gif" width="31" height="23" class="resol" alt="DATE :" />
	<font color="#9e9e9e" style="font-size:13px;">
	<?=substr($sshdb_get[$db]['date'],0,4).'.'.substr($sshdb_get[$db]['date'],4,2).'.'.substr($sshdb_get[$db]['date'],6,2).'&nbsp;('.substr($sshdb_get[$db]['date'],8,2).':'.substr($sshdb_get[$db]['date'],10,2).':'.substr($sshdb_get[$db]['date'],12,2).')'?>
	</font>

</div>