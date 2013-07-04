<?
include('../lib/set.php');
$log=$_GET['log'];
$attr=$_GET['attr'];
if(!$log){echo '로그를 선택하세요.';return false;}
if(!$attr==','){echo '로그 속성을 선택하세요.';return false;}
$attr_array = explode(',', $attr);
$attr_array_count = count($attr_array);
for($i=1;$i<$attr_array_count;$i++){
$now_array = sshdb_print_log($log,$attr_array[$i]);
if(count($now_array)>50){
	array_splice($now_array, -50,50);
}
	foreach($now_array as $key => $val){
		$nc = explode('_',$val);
		$nc[0] = str_replace('#', '', $nc[0]);
		$content_t = implode('_',$nc);
		
?>
<?
$nd = explode(']',$nc[1]);
$nd[0] = explode('[', str_replace('$', '', $nd[0]));
switch($nd[0][1]){
	case 'error':$nd_color = '#d94285';break;
	case 'connect':$nd_color = '#4290d9';break;
	case 'modify':$nd_color = '#e2792b';break;
	case 'view':$nd_color = '#d76dde';break;
	case 'msg':$nd_color = '#000000';break;
}
?>
<strong>{<font color="<?=$nd_color?>"><?=$nd[0][1]?></font>}&nbsp;<?=substr($nc[0],0,4).'.'.substr($nc[0],4,2).'.'.substr($nc[0],6,2).'&nbsp;('.substr($nc[0],8,2).':'.substr($nc[0],10,2).':'.substr($nc[0],12,2).')'?></strong>
<i><?=$nd[0][0]?></i>
<br />
<font size="2">
<?=$val?>
</font>
<br /><br />

<?
	}
}
?>