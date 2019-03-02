

<html>
<head>
	<meta charset="UTF-8">
	
</head>
<body bgcolor="#7FFFD4">
	<h1><b><font color="orange"> Your Events</h1></font><b>
	
	<div >
	<form  align = "left" action="" method="post">
	</br>
	 <?php
			    ob_start();
				session_start();
				require_once 'dbconnect.php';
					$id=$_SESSION['user'];
					 $query = "SELECT * FROM event WHERE userid = $id";
			      		$result = $conn->query($query);
			      		 $row_cnt = $result->num_rows;

			      		while( $row = mysqli_fetch_assoc( $result) ){
			      		
			            echo $row['eventdate'];
			            echo " : ";
			            echo $row['eventname'];
			            echo "</br>";
						}

      ?>
      </form>
      </div>
      </br>
</body>
</html>