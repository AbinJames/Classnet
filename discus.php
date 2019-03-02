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
<html lang="en">
<head>
  <title>Discuss</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
<div class="container">
<p>Already discussed topics</p>       
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Topic</th>
      </tr>
    </thead>
    <tbody>
     <tr>
      <?php
		 require_once 'dbconnect.php';
		 $query = "SELECT * FROM discussions ORDER by did desc";
		 $result = $conn->query($query);
		 while( $row = mysqli_fetch_assoc( $result) )
		 {		
		 	$i=$row['id'];
       $q = "SELECT * FROM users WHERE id = $i";
          $r = $conn->query($q);
          $res = mysqli_fetch_assoc( $r);
      echo "<tr><td>";  
      echo $row['day'];echo "/";echo $row['month'];echo "/"; echo $row['year'];echo "</br>Posted by</br>";
      echo '<img src="'.$res['profile'].'" width="50px" height="50px">';
      echo $res['firstname'];echo " ";
      echo $res['lastname'];
       echo "</td>";
      echo "<td colspan = \"30\">";
      echo "<a href='reply.php?id= ";echo $row['did'];echo "'>";
      echo $row['dis_content'];
        echo "</a></td></tr>";
     }
      ?>
		</tr>	
    </tbody>
  </table>
</div>

</body>
</html>
