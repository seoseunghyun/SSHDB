<?php
include('../lib/set.php');
$select=$_GET['select'];
sshdb_list_log();
foreach($sshdb_get['$log']['list'] as $key => $val){
?>
<div id="log_list_wrap_<?=$key?>" class="log_list_wrap" alt="<?=$key?>">
<div class="log_list_side"><img src="<?=SSHDBS_URL?>img/backup_left.gif" width="10" height="30" class="resol" alt="" /></div>

<div id="log_list_item_<?=$key?>" class="log_list_item presol_css"><div class="log_list_id"><?php
	if($select==$key){
		echo '<font color="#429ed9"><strong>V</strong>&nbsp;</font>';
	}
?>
<?=substr($key,0,4).'.'.substr($key,4,2).'.'.substr($key,6,2)?></div></div>
<div class="log_list_side"><img src="<?=SSHDBS_URL?>img/backup_right.gif" width="10" height="30" class="resol" alt="" /></div>
</div>
<?php
}
?>