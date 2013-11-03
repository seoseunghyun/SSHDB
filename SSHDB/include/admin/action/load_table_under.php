<?php
include('../lib/set.php');

$db =$_GET['db'];
$tb =$_GET['tb'];
$content = sshdb_print_table($db,$tb);
$count_var = count($content['var_id']);
$content_width = $count_var*130;
if($content_width > 680){
	$content_width=680;
}
?>
<div class="content_tb_warp" style="width:<?=45+$content_width?>px;">
<div class="content_tb_selector_wrap"></div>
<div class="content_tb_side"><img src="<?=SSHDBS_URL?>img/table_tdbottom_left.gif" width="10" height="27" class="resol" /></div>
<?php
array_splice($content, 0,1);
foreach($content as $key => $valuea){
?>

<?php
}
?>
<div class="content_tb_under" style="width:<?=$content_width?>px;">Count Of Element : <?=count($content)?></div>
<div class="content_tb_side"><img src="<?=SSHDBS_URL?>img/table_tdbottom_right.gif" width="10" height="27" class="resol" /></div>
</div>