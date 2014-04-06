<?php
	
	date_default_timezone_set('UTC');

	define("SES_UID","tm_ses_uid");

	define("WIN", 1);
	define("LOSE", -1);
	define("DRAW", 0);

	define("DATE_FORMAT", "Y-m-d H:i:s");


	echo date(DATE_FORMAT);
?>