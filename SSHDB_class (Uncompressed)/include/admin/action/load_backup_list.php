<?
include('../lib/set.php');
$db = $_GET['db'];
$tb = $_GET['tb'];
$action = new SSHDB;
$action->selector($db.'->'.$tb);
$action->list_backup();
foreach($sshdb_get[$db][$tb]['backup'] as $key => $value){
foreach($value as $keys => $values){
?>
<div id="backup_list_wrap_<?=$values?>" class="backup_list_wrap">
<div class="backup_list_side"><img src="<?=SSHDBS_URL?>img/backup_left.gif" width="10" height="30" class="resol" alt="" /></div>

<div id="backup_list_item_<?=$values?>" class="backup_list_item presol_css"><div class="backup_list_id">
<?=substr($values,0,4).'.'.substr($values,4,2).'.'.substr($values,6,2).'&nbsp;('.substr($values,8,2).':'.substr($values,10,2).':'.substr($values,12,2).')'?></div><div id="backup_list_tool_<?=$values?>" class="backup_list_tool"><span id="backup_btn_push_<?=$values?>" class="backup_btn_push">Push</span>&nbsp;<span id="backup_btn_view_<?=$values?>" class="backup_btn_view">View</span><br /><span id="backup_btn_del_<?=$values?>" class="backup_btn_del">Delete</span></div></div>
<div class="backup_list_side"><img src="<?=SSHDBS_URL?>img/backup_right.gif" width="10" height="30" class="resol" alt="" /></div>
</div>
<?
}
}
?>
<span id="backup_list_count" style="display:none"><?=count($sshdb_get[$db][$tb]['backup']['list'])?></span>