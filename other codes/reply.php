
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
<html>
<body bgcolor="#7FFFD4">
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
		
        	<form  align = "left" action="" method="POST">
			<center><table border ="1" style = "width : 70%"></center>
            <col width = "80">
            <col width = 100%>
	 <?php
		$query = "SELECT * FROM reply where did=$id";
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
		 	echo $res['firstname'];echo " ";
		 	echo $res['lastname'];
		 	 echo "</td>";
			echo "<td colspan = \"30\">";
			echo $row['reply'];echo "</br>";
			echo "</td></tr>";
		}
	?>
    	 	 </table>
      		</form>
      </div>
  </body>
</html>