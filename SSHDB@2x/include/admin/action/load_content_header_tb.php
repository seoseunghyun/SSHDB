<?
include('../lib/set.php');
$db =$_GET['db'];
$tb =$_GET['tb'];
sshdb_get_table($db,$tb,'');
?>
<div id="content_tb_header_tb">
	<span id="content_a_title" class="content_edit_toggle">
	<?=$tb?><img src="<?=SSHDBS_URL?>img/content_edit_tbtitle.gif" width="65" height="55" class="resol" alt="Edit Table ID" /></span>

	<span id="content_edit_title">
		<input id="content_edit_title_input">
		<font color="#888888" style="font-size:13px;text-decoration: underline;"><span id="content_edit_title_o">Modify</span></font><span><font style="font-size:13px;">&nbsp;</font></span><font color="#ababab" style="font-size:12px;text-decoration: underline;"><span id="content_edit_title_cancle"class="content_edit_toggle">Cancle</span></font>
	</span>
</div>

<div id="content_tb_header_tag">
	<img src="<?=SSHDBS_URL?>img/content_tag.gif" width="31" height="23" class="resol" alt="TAG :" />
	<span id="content_a_tag" class="content_edit_tag_toggle">
	<span id="content_a_tag_content"><?=$sshdb_get[$db][$tb]['tag']?></span>
	<img src="<?=SSHDBS_URL?>img/content_edit_tag.gif" width="35" height="13" class="resol" alt="Edit Tag" />
	</span>
	
	<span id="content_edit_tag">
		<input id="content_edit_tag_input">
		<font color="#888888" style="font-size:13px;text-decoration: underline;"><span id="content_edit_tag_o">Modify</span></font><span><font style="font-size:13px;">&nbsp;</font></span><font color="#ababab" style="font-size:12px;text-decoration: underline;"><span id="content_edit_tag_cancle" class="content_edit_tag_toggle">Cancle</span></font>
	</span>
	
	<img src="<?=SSHDBS_URL?>img/content_clock.gif" width="31" height="23" class="resol" alt="DATE :" />
	<font color="#9e9e9e" style="font-size:13px;">
	<?=substr($sshdb_get[$db][$tb]['date'],0,4).'.'.substr($sshdb_get[$db][$tb]['date'],4,2).'.'.substr($sshdb_get[$db][$tb]['date'],6,2).'&nbsp;('.substr($sshdb_get[$db][$tb]['date'],8,2).':'.substr($sshdb_get[$db][$tb]['date'],10,2).':'.substr($sshdb_get[$db][$tb]['date'],12,2).')'?>
	</font>

</div>