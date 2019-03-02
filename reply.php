
<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // it will never let you open index(login) page if session is set
  if ( !isset($_SESSION['user']) ) {
    header("Location: classNET.html");
    exit;
  }
  else{
    $uid=$_SESSION['user'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Replies</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <body>
  <div align="center">
  <?php
 
        $id=$_GET['id'];
          $query = "SELECT * FROM discussions where did=$id";
          $result = $conn->query($query);
          $row = mysqli_fetch_assoc( $result);
          echo "<h2><font color=\"blue\">";
                echo $row['dis_content'];
        echo "</font></h2>";     
    ?>
  <form action="" method="POST">
  <textarea style = "width : 50% ; height: 200px " name="reply-content"  placeholder="Enter your reply"/></textarea><br>
    <input type="submit" name= "submit" value="Submit" /><br><br>
   <?php
  		include_once 'dbconnect.php';
	  if(isset($_POST['submit']) && !empty($_POST['reply-content']))
	  {
		$reply=$_POST['reply-content'];

    	$d = date('d',time());
    	$m = date('m',time());
    	$y=  date('y',time());
    
	      $query = "INSERT INTO reply(did,id,reply,day,month,year) VALUES($id,$uid,'$reply',$d,$m,$y)";

       $res =$conn->query($query);
     header("Location : reply.php");
	  }
    ?>
    <h4><a href='discus.php'>Back to All Discussions</a></h4>
<div class="container">    
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Replys</th>
      </tr>
    </thead>
    <tbody>
     <tr>
       <?php
		$query = "SELECT * FROM reply where did=$id ORDER by rid desc";
    $result = $conn->query($query);
    while( $row = mysqli_fetch_assoc( $result) )
    {
      $i=$row['id'];
       $q = "SELECT * FROM users WHERE id = $i";
          $r = $conn->query($q);
          $res = mysqli_fetch_assoc( $r);
      echo "<tr><td>";
      echo $row['day'];echo "/";echo $row['month'];echo "/"; echo $row['year'];
      echo "</br>Posted by</br>";
      echo '<img src="'.$res['profile'].'" width="50px" height="50px">';
      echo $res['firstname'];echo " ";
      echo $res['lastname'];
       echo "</td>";
      echo "<td colspan = \"30\">";
      echo $row['reply'];echo "</br>";
      echo "</td></tr>";
		}
	?>
		</tr>	
    </tbody>
  </table>
</div>

</body>
</html>
