<?
include('../lib/set.php');
$content = sshdb_search_list($_GET['db'],$_GET['tb'],$_GET['attr'],'id',$_GET['search']);
$width =  explode('$$',$_GET['width']);
$width_count = count($width)-1;
for($i=0;$i<$width_count;$i++){
	$width_b = explode('$', $width[$i]);
	$width_a[$width_b[0]] = str_replace('px','',$width_b[1]);
}
if(!$content){exit;}
if($content==96){echo '<span id="table_td_status">x</span>';}
if(!is_array($content)){exit;}
$td_bgcolor = 0;
$td_bgcolor_real = '#e8e8e8';
foreach($content as $key => $value){
if($td_bgcolor==0){$td_bgcolor=1;$td_bgcolor_real = '#f6f6f6';}else{$td_bgcolor=0;$td_bgcolor_real = '#e8e8e8';}
	?><tr style="height:1px; background:<?=$td_bgcolor_real?>" ><tr>
	
 <td id="table_selector_<?=$content[$key]['id']?>" width="25" class="table_select_0" style="width:25px;"><img id="table_selector_0_<?=$content[$key]['id']?>" width="20" height="20" src="<?=SSHDBS_URL?>img/table_select_0.gif" class="table_selector_0 table_selector resol" alt="not select" /><img id="table_selector_1_<?=$content[$key]['id']?>" width="20" height="20" src="<?=SSHDBS_URL?>img/table_select_1.gif" class="table_selector_1 table_selector resol" alt="not select" /></td><td class="table_td_id_<?=$content[$key]['id']?> table_td_<?=$td_bgcolor?> table_left_bin" style="width:10px;"></td>
<?
 sshdb_get_ele($_GET['db'],$_GET['tb'],$content[$key]['id'],'');
 $value_b = $sshdb_get[$_GET['db']][$_GET['tb']][$content[$key]['id']];
    foreach($value_b as $keys => $values){
    ?><div id="table_ele_<?=$content[$key]['id']?>:<?=$keys?>" class="table_tds table_td_key_<?=$keys?> table_td_id_<?=$content[$key]['id']?> table_td_<?=$td_bgcolor?> " width="<?=$width_a[$keys]?>"  ><?=$width_a[$keys]?><? if($keys=='id'&&strlen($values)>10){
    if($keys==$_GET['attr']){ ?>
	 <?=str_replace($_GET['search'],'<font color="#5bc90a">'.$_GET['search'].'</font>',htmlspecialchars(mb_substr($values,0, 10,'UTF-8'))).'...'?>   
   <? }else{
     ?>
    <?=htmlspecialchars(mb_substr($values,0, 10,'UTF-8')).'...'?>
    <?}
     }else if(strlen($values)>30){ 
	    if($keys==$_GET['attr']){
    ?>
    <?=str_replace($_GET['search'],'<font color="#5bc90a">'.$_GET['search'].'</font>',htmlspecialchars(mb_substr($values,0, 30,'UTF-8'))).'...'?>
 
    <? }else{ ?><?=htmlspecialchars(mb_substr($values,0, 30,'UTF-8')).'...'?><? }
      }else{
      if($keys==$_GET['attr']){
     ?>
     <?=str_replace($_GET['search'],'<font color="#5bc90a">'.$_GET['search'].'</font>',htmlspecialchars($values))?>
     <? }else{
	     ?><?=htmlspecialchars($values)?><?
     } }?></td><?
   
    }?><td class="table_td_id_<?=$content[$key]['id']?> table_td_<?=$td_bgcolor?> table_td">&nbsp;&nbsp;</tr></tr></div><?
    }
   ?>