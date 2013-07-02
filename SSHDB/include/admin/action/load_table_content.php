<?
include('../lib/set.php');

$db =$_GET['db'];
$tb =$_GET['tb'];
if(iconv("UTF-8","UTF-8",$_GET['search'])==$_GET['search']){$_GET['search'] = $_GET['search'];}
else{$_GET['search'] = iconv('EUC-KR','UTF-8',$_GET['search']);}
if($_GET['search']){
$content = sshdb_search_list($_GET['db'],$_GET['tb'],$_GET['attr'],'',$_GET['search']);
if(!is_array($content)){exit;}
foreach($content as $keyb => $valueb){
$count_var = count($valueb);
break;
}
}else{
$content = sshdb_print_table($db,$tb);
$count_var = count($content['var_id']);
array_splice($content, 0,1);
}
$align_array = explode(',', $_GET['align']);
$align_array_count = count($align_array);
if($_GET['align'] !='' && $content){
	for($i=0; $i<$align_array_count;$i++){
	foreach($content as $alk => $alv){
		$content_align[$alk] = $alv[$align_array[$i]];
	}
	array_multisort($content_align,SORT_ASC,SORT_REGULAR,$content);
	}
}
?>
<div class="content_tb_warp" style="width:<?=45+($count_var*130)?>px;">
<?
$tb_bgcolor = 0;
foreach($content as $key => $value){
if($tb_bgcolor==0){$tb_bgcolor=1;}else{$tb_bgcolor=0;}
?>
<div id="content_tb_selector_wrap_<?=$content[$key]['id']?>" class="content_tb_selector_wrap content_tb_select_0"><img id="content_tb_selector_0_<?=$content[$key]['id']?>" width="20" height="20" src="<?=SSHDBS_URL?>img/table_select_0.gif" class="content_tb_selector_0 content_tb_selector resol" alt="not select" /><img id="content_tb_selector_1_<?=$content[$key]['id']?>" width="20" height="20" src="<?=SSHDBS_URL?>img/table_select_1.gif" class="content_tb_selector_1 content_tb_selector resol" alt="not select" /></div>
<div class="content_tb_table_side_<?=$content[$key]['id']?> content_tb_table_side  content_tb_table_<?=$value['id']?> content_tb_bgcolor_<?=$tb_bgcolor?>" ></div>
<?
foreach($value as $keys => $values){
if($_GET['search'] && $_GET['attr'] == $keys){
	$values_b = str_replace($_GET['search'], '<font color="#278aef">'.$_GET['search'].'</font>',  $values);
}else{
	$values_b = $values;
}
?>
<div id="content_tb_table_<?=$value['id']?>" class="content_tb_table content_tb_table_<?=$value['id']?> content content_tb_bgcolor_<?=$tb_bgcolor?>" alt="<?=$keys?>"><?
if(mb_strlen($values_b) > 15){
	echo mb_substr($values_b,0,15);
}else{
	echo $values_b;
}
?></div>
<?
}
?>
<div class="content_tb_table_side content_tb_table_<?=$value['id']?> content_tb_bgcolor_<?=$tb_bgcolor?>" ></div>
<?
}
?>
</div>