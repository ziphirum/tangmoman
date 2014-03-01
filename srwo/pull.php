<?php
	$cmd = "cd D:/Github/tangmoman";
	echo exec($cmd);
	$cmd = "D:";
	echo exec($cmd);
	$cmd = "git pull";
	echo exec($cmd);


	echo shell_exec( 'cd D:/Github/tangmoman && D: && git pull' );
	echo exec( 'cd D:/Github/tangmoman && D: && git pull' );
?>