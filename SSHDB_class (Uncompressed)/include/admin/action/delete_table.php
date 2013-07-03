<?
include('../lib/set.php');
include('../lib/parse_ids.php');
$array = parse_tb(substr($_POST['val'],0,-4),4);
$action = new SSHDB;
$action->selector($array['db'].'->'.$array['tb']);
if($action->delete_table()!=27){
echo sshdb_parser_msg($sshdb_msg);
}
echo '#1'.$array['tb'];
?>