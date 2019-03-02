

<html>
<head>
	<meta charset="UTF-8">
	<title>Events</title>
	<style>
div{
padding-top: 150px;
padding-right: 500px;
padding-bottam: 250px;
padding-left: 500px;
}
</style>
</head>
<body bgcolor="gray">
	<center><h1><b><font color="orange"> Event page </h1></font><b></center>
	<div>
	<form action="insert.php" method="post">
	Event Name : <input type="textarea" name="eventname" size="36"><br><br>
	Event Date : &nbsp;&nbsp;<input type="date" name="eventdate"><br>
	<input value="Submit" type="submit" onclick="alert('want to send')"></input>
	</form>
	</div>
	<div >
	<form  align = "left" action="" method="post">
	Events: </br>
	 <?php
			   
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
      <a href="accpage.php">Back</a>
      </form>
      </div>
      </br>
</body>
</html>