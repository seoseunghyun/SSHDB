<?php
include('../lib/set.php');
if(!sshdb_list_storage()){echo '';}else{
foreach(sshdb_list_storage() as $key => $value){
	?>
	<div id="navi_list_<?=$key?>" class="navi_db"><img src="<?=SSHDBS_URL?>img/icon_db.gif" width="20" height="20" class="resol" alt="" /><?php
	if(strlen($key)>9){$key_print = substr($key,0,9).'...';}else{ $key_print = $key;}
	?><?=$key_print?><div id="navi_list_<?=$key?>_del" class="navi_db_del" ><img src="<?=SSHDBS_URL?>img/navi_del.gif" width="17" height="25" class="resol" alt="" /></div></div>
	<?php
    foreach($value as $keys => $values){
	?>
	<div id="navi_list_<?=strlen($key)?>_<?=$key?><?=$keys?>" class="navi_tb"><div id="navi_list_a_<?=strlen($key)?>_<?=$key?><?=$keys?>" class="navi_tb_a"><img src="<?=SSHDBS_URL?>img/icon_tb.gif" width="20" height="20" class="resol" alt="" /><?php
	if(strlen($keys)>9){$keys_print = substr($keys,0,9).'...';}else{ $keys_print = $keys;}
	?><?=$keys_print?></div><div id="navi_list_<?=strlen($key)?>_<?=$key?><?=$keys?>_del" class="navi_tb_del" ><img src="<?=SSHDBS_URL?>img/navi_del_tb.gif" width="17" height="25" class="resol" alt="" /></div></div>
	<?php
	}
	?>
	<div id="navi_ctb_<?=$key?>" class="navi_ctb"><img src="<?=SSHDBS_URL?>img/icon_ctb.gif" width="20" height="20" class="resol" alt="" /><input id="navi_ctb_input_<?=$key?>" class="input_ctb"><div id="navi_ctb_btn_<?=$key?>" class="navi_ctb_btn" ><img src="<?=SSHDBS_URL?>img/navi_ctb_btn.gif" width="17" height="25" class="resol" alt="" /></div></div>
	<?php
}
}
?>