<?php

	if (is_session_started() === FALSE) session_start();
	
	function createLoginSession($userid){
		$_SESSION[SES_UID] = $userid;
		session_regenerate_id();
	}

	function getLoginSession(){
		return $_SESSION[SES_UID];
	}
	
	function is_session_started(){
	    if ( php_sapi_name() !== 'cli' ) {
	        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	        	// No function session_status()
	            // return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	        } else {
	            return session_id() === '' ? FALSE : TRUE;
	        }
	    }
	    return FALSE;
	}
?>