
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
    $id=$_SESSION['user'];
  }
?>
<!DOCTYPE html>
<html>
<body bgcolor="#7FFFD4">
 <body>
  	<center><h1><b>DISCUSSIONS</b></h1></center>
  		<div align="center">
  	  <form action="" method="post">
  
        <textarea style = "width : 75%" name='Discussion_description' rows="8" cols="50" placeholder="Enter your thoughts"/></textarea><br><br>
        <input type='submit' name ='submit' value='Send' /></br></br>
     </form> 
 		<?php
   			include_once 'dbconnect.php';
   			if(isset($_POST['submit']) && !empty($_POST['Discussion_description']))
			{
				$content=$_POST['Discussion_description'];
				$d = date('d',time());
    			$m = date('m',time());
    			$y=  date('y',time());
    			$query = "INSERT INTO discussions(id,dis_content,day,month,year) VALUES($id,'$content',$d,$m,$y)";
       			 $res =$conn->query($query);
			 }
		?>

	  		<form  align = "left" action="" method="post">
			<center><table border ="2" style = "width : 70%"></center>
            <col width = "80">
            <col width = 100%>
      <?php
		 $query = "SELECT * FROM discussions";
		 $result = $conn->query($query);
		 while( $row = mysqli_fetch_assoc( $result) )
		 {		$i=$row['id'];
		 	 $q = "SELECT * FROM users WHERE id = $i";
          $r = $conn->query($q);
          $res = mysqli_fetch_assoc( $r);
		 	echo "<tr><td>";	
		 	echo $row['day'];echo "/";echo $row['month'];echo "/"; echo $row['year'];echo "</br>Posted by</br>";
		 	echo $res['firstname'];echo " ";
		 	echo $res['lastname'];
		 	 echo "</td>";
		 	echo "<td colspan = \"30\">";
		 	echo "<a href='reply.php?id= ";echo $row['did'];echo "'>";
		 	echo $row['dis_content'];
	     	echo "</a></td></tr>";
		 }
      ?>
			</table>
      		</form>
      </div>
  </body>
</html>