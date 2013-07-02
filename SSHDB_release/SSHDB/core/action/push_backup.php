<?
//SSHDB
if(!$db){return $sshdb_msg_inc = 6;}
if(!$table){return $sshdb_msg_inc = 21;}
$db_fdir = sshdb_fdir($db);
if(is_array($db_fdir)){return $sshdb_msg_inc = $db_fdir[1];}else{$db_dir = $db_fdir;}
$backup_dir = $db_dir.sshdb_hash($table).'/backup/'.$backup;
if(!file_exists($backup_dir)){return $sshdb_msg_inc = 61;}

	$table_dir = $db_dir.sshdb_hash($table);
	if(!file_exists($table_dir.'/info.table.sshdb.php')){return $sshdb_msg_inc = 24;}
	$dir = $table_dir;
	$ndir = $table_dir.'/backup/'.sshdb_date();
	if(file_exists($table_dir.'/backup/'.sshdb_date())){return $sshdb_msg_inc = 60;}
	@mkdir($ndir);
	$tdir = opendir($dir); 
	while(($file = readdir($tdir)) != false) 
	{
	if($file == 'info.table.sshdb.php'){
		copy($dir.'/' .$file, $ndir.'/'.$file);
		}
	}
	$tsdir = opendir($dir.'/stack'); 
	$ntsdir = $dir.'/stack';
	$nsdir = $ndir.'/stack';
	@mkdir($nsdir);
	while(($sfile = readdir($tsdir)) != false) 
	{
	if($sfile != '.' && $sfile != '..'){
	copy($ntsdir.'/' .$sfile, $nsdir.'/'.$sfile); 
	}
	} 
	
	sshdb_fdelete_nobackup($table_dir);
	
	$dir_b = $backup_dir;
	$ndir_b = $table_dir;
	@mkdir($ndir_b);
	$tdir_b = opendir($dir_b); 
	while(($file_b = readdir($tdir_b)) != false) 
	{
	if($file_b == 'info.table.sshdb.php'){
		copy($dir_b.'/' .$file_b, $ndir_b.'/'.$file_b);
		}
	}
	$tsdir_b = opendir($dir_b.'/stack'); 
	$ntsdir_b = $dir_b.'/stack';
	$nsdir_b = $ndir_b.'/stack';
	@mkdir($nsdir_b);
	while(($sfile_b = readdir($tsdir_b)) != false) 
	{
	if($sfile_b != '.' && $sfile_b != '..'){
	copy($ntsdir_b.'/' .$sfile_b, $nsdir_b.'/'.$sfile_b); 
	}
	} 
	
	sshdb_fdelete_nobackup($backup_dir);

?>