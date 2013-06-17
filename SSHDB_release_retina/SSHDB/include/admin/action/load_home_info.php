<?
function get_time() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
 
$start = get_time();

include('../lib/set.php');
$size_array = sshdb_fsize(SSHDB_DIR);

$end = get_time();
$time = $end - $start;
?>
- <strong>SSHDB Connection Time</strong> : <font color="#c48cdb"><?=substr($time,0,7)?></font> sec.
<br />
- <strong>Total Size</strong> : <font color="#57c9d0"><?=sshdb_fsize_format($size_array['size'])?></font> (<?=$size_array['dircount']?> Directories, <?=$size_array['count']?> Files)
<br />