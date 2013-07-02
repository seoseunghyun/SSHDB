<?
//SSHDB
$log_dir = SSHDB_DIR.'data/log/';
$sshdb_get['#log']['list'] = array();
	$dirs = dir($log_dir);
	while(false !== ($entry = $dirs->read())){
		if( ($entry!='.') && ($entry!='..') &&($entry!='.DS_Store')){
			if(is_dir($log_dir.$entry)){
			$sshdb_get['$log']['list'][$entry] = array();
								$dirs_con = dir($log_dir.$entry);
								while(false !== ($entry_con = $dirs_con->read())){
									if( ($entry_con!='.') && ($entry_con!='..') &&($entry_con!='.DS_Store')){
										array_push($sshdb_get['$log']['list'][$entry],str_replace('.log.sshdb.php', '', $entry_con));
									}
								}
								$dirs_con->close();
				
			}
		}
	}
	$dirs->close();
?>