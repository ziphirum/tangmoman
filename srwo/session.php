<?php
	
	session_start();

	$ses_uid = "tm_ses_uid";
	
	function createLoginSession($userid){
		$_SESSION[$ses_uid] = $userid;
		session_regenerate_id();
	}

	function getLoginSession(){
		return $_SESSION[$ses_uid];
	}

?>