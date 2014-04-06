<?php
	
	include "constants.php";

	session_start();
	
	function createLoginSession($userid){
		$_SESSION[ses_uid] = $userid;
		session_regenerate_id();
	}

	function getLoginSession(){
		return $_SESSION[ses_uid];
	}

?>