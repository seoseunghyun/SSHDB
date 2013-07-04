<?
$db =$_GET['db'];
function get_time() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
 
$start = get_time();

include('../lib/set.php');
$size_array = sshdb_info_db($db,'');
$end = get_time();
$time = $end - $start;

//전체
?>- <strong style="color:#45b0e8">Database Real Directory</strong> : <?=SSHDB_DIR?>data/storage/<br /><strong>&nbsp;&nbsp;&nbsp;<?=sshdb_hash($db)?></strong>/<br /><br />
- <strong>Database Connection Time</strong> : <font color="#c48cdb"><?=substr($time,0,7)?></font> sec.
<br />
- <strong>Total Size</strong> : <font color="#57c9d0"><?=$size_array['size']?></font> (<?=$size_array['dircount']?> Directories, <?=$size_array['count']?> Files)<br /><br />
<?
if(file_exists(SSHDB_DIR.'data/storage/'.sshdb_hash($db).'/link.db.sshdb.php')){
sshdb_get_link($db);
?>
- <strong><font color="#b7a841">LINK</font> Real Directory</strong> : <?=$sshdb_get[$db]['link']?>
<?
}
?>
<br />