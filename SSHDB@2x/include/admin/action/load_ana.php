<?php
include('../lib/set.php');
sshdb_list_log();
$log_array = array();
$log_array['date'] = array();
$log_array['count'] = array();
ksort($sshdb_get['$log']['list']);
foreach($sshdb_get['$log']['list'] as $key => $val){array_push($log_array['date'],$key);}
$log_date = array_splice($log_array['date'],-7,7);
$log_date_count = count($log_date);
?>
<div id="home_ana_rg_wrap">
<?php
for($i=0; $i<$log_date_count;$i++){
$i_count = count(sshdb_print_log($log_date[$i],1));
array_push($log_array['count'], $i_count);
?><div id="home_ana_rg_wrap_<?=$log_date[$i]?>" class="home_ana_rg_wrap">
	<div id="home_ana_rg_ele_<?=$log_date[$i]?>" class="home_ana_rg_ele">
	</div>
</div>
<?php
//echo substr($log_date[$i], 4,2).'월 ';
//echo substr($log_date[$i], 6,2).'일 접속 량 : ';
//array_push($log_array['count'], count(sshdb_print_log($log_date[$i],1)));
}
?>
</div>
<div id="home_ana_rg_subtitle">
<?php
for($j=0; $j<$log_date_count;$j++){
?>
<div class="home_ana_rg_subtitle_ele">
<?=substr($log_date[$j], 4,2).'월 '.substr($log_date[$j], 6,2).'일'?><br/>
<span id="home_ana_rg_subtitle_ele_<?=$log_date[$j]?>" style="color:#d986a4;"><?=$log_array['count'][$j]?></span>
</div>
<?php
}
?></div>
<span id="home_ana_rg_max" style="display:none"><?=max($log_array['count'])?></span>
