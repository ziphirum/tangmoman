<?php
    $arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
    // echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}

    $item = "Zak;\"'s Laptop;";
	$escaped_item = mysql_escape_string($item);
	printf("Escaped string: %s\n", $escaped_item);

?>