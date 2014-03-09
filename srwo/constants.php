<?php
	
	define("CONSTANT", "Hello world.");
	echo CONSTANT; // outputs "Hello world."
	echo "<br>";
	echo Constant; // outputs "Constant" and issues a notice.

	define("GREETING", "Hello you.", true);
	echo "<br>";
	echo GREETING; // outputs "Hello you."
	echo "<br>";
	echo constant("GREETING"); // outputs "Hello you."
	echo "<br>";
	echo Greeting; // outputs "Hello you."



?>