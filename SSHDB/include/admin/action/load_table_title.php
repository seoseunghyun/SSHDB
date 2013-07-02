<?
include('../lib/set.php');

$db =$_GET['db'];
$tb =$_GET['tb'];
$content = sshdb_print_table($db,$tb);
$count_var = count($content['var_id']);
?>
<div class="content_tb_warp" style="width:<?=45+($count_var*130)?>px;">
<div class="content_tb_selector_wrap"><img id="content_tb_toggler" width="20" height="20" src="<?=SSHDBS_URL?>img/table_select_toggle.gif" class="resol" alt="not select" /></div>
<div class="content_tb_side"><img src="<?=SSHDBS_URL?>img/table_tdtop_left.gif" width="10" height="27" class="resol" /></div>
<?
foreach($content['var_id'] as $keya => $valuea){
$align_array = explode(',', $_GET['align']);
$align_array_count = count($align_array);
if(!($valuea == 'id' || $valuea == 'date' || $valuea == 'tag' || $valuea == 'option')){
	sshdb_get_var($db,$tb,$valuea,'tag');
	$valuec = $sshdb_get[$db][$tb][$valuea]['tag'];
}else{
	$valuec = $valuea;
}
if(in_array($valuea, $align_array)){
	$align_0_display = 'hidden';
	$align_1_display = 'show';
}else{
	$align_0_display = 'show';
	$align_1_display = 'hidden';
}
?>
<div id="content_tb_title_<?=$valuea?>" class="content_tb_title" alt="<?=$valuec?>"><?=$valuea?><img id="content_tb_align_0_<?=$valuea?>" width="16" height="16" src="<?=SSHDBS_URL?>img/table_align_0.gif" class="resol content_tb_align_display_<?=$align_0_display?> content_tb_align_0 content_tb_align_<?=$valuea?> content_tb_align_toggle" alt="Align to <?=$valuea?>" /><img id="content_tb_align_1_<?=$valuea?>" width="16" height="16" src="<?=SSHDBS_URL?>img/table_align_1.gif" class="resol content_tb_align_display_<?=$align_1_display?> content_tb_align_1 content_tb_align_<?=$valuea?> content_tb_align_toggle" alt="Align to <?=$valuea?>" /></div>

<?
}
?>
<div class="content_tb_side"><img src="<?=SSHDBS_URL?>img/table_tdtop_right.gif" width="10" height="27" class="resol" /></div>
<div class="content_tb_selector_wrap"></div>
<div class="content_tb_search_side"></div>
<?
foreach($content['var_id'] as $keyb => $valueb){
?>
<div class="content_tb_search"><input id="content_tb_search_input_<?=$valueb?>" class="content_tb_search_input" /></div>

<?
}
?>
<div class="content_tb_search_side"></div>
</div>