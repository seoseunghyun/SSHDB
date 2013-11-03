<?php
function get_time() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
 
$start = get_time();
include('../lib/set.php');

$db =$_GET['db'];
$tb =$_GET['tb'];

sshdb_get_table($db,$tb,'');
$size_array = sshdb_info_table($db,$tb,'');
$end = get_time();
$time = $end - $start;
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

<div id="content_tb_header_root">
<br />
<div id="home_info_title" class="content_title"><img src="<?=SSHDBS_URL?>img/content_info_title.gif" class="resol" width="231" height="26" alt="Information Of Table" /></div>
- <strong style="color:#e89245">Table Real Directory</strong> : <?=SSHDB_DIR?>data/storage/<br />&nbsp;&nbsp;&nbsp;<?=sshdb_hash($db)?>/<br />&nbsp;&nbsp;&nbsp;<strong><?=sshdb_hash($tb)?></strong>/<br /><br />
- <strong>Table Connection Time</strong> : <font color="#c48cdb"><?=substr($time,0,7)?></font> sec.
<br />
- <strong>Total Size</strong> : <font color="#57c9d0"><?=$size_array['size']?></font> (<?=$size_array['dircount']?> Directories, <?=$size_array['count']?> Files)<br /><br />
<br />
</div>