<?php
session_start();
include('../../../start.php');
unset($_SESSION[SSHDB_TOKEN]['sshdb_id'],$_SESSION[SSHDB_TOKEN]['sshdb_password']);
?>