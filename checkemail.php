<?php

	require_once 'dbconnect.php';
	
$email=$_POST['email'];
$query = "SELECT email FROM users WHERE email='$email'";
    $result = $conn->query($query);
    $row_cnt = $result->num_rows;
    if($row_cnt>0){
      echo "false";
    }
    else
    	echo "true";
    ?>