<?php
	
	include "constants.php";

	session_start();
	
	function createLoginSession($userid){
		$_SESSION[SES_UID] = $userid;
		session_regenerate_id();
	}

	function getLoginSession(){
		return $_SESSION[SES_UID];
	}

?>