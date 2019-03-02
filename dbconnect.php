<?php

	
	
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'classnet');
	
	$conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
	
	if ( !$conn ) {
		echo "Connection Failed";
	}
	?>