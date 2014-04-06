<?php
	
	session_start();

	$uid = "tm_ses_uid";
	
	function createLoginSession($userid){
		$_SESSION[$uid] = $userid;
		session_regenerate_id();
	}

	function getLoginSession(){
		return $_SESSION[$uid];
	}

?>