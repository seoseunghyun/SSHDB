<?
function parse_tb($val,$del_len){
$array = explode('_', $val);
$db_len = $array[$del_len-2];
array_splice($array, 0,$del_len-1);
$entire = implode($array, '_');
$split['db'] = substr($entire, 0,$db_len);
$split['tb'] = substr($entire, $db_len);
return $split;
}
?>