<?php
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
$page = $_SERVER['PHP_SELF'];
$sec = "3";
?>


<!DOCTYPE html>
<html >

<head>
  <meta http-equiv="refresh" content="<?php echo $sec ?>; URL='<?php echo $page; ?>'">
  <link rel="shortcut icon" type="image/x-icon" href="https://production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
  <link rel="mask-icon" type="" href="https://production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
  <title>CodePen - Data Table</title>
  
  
  
  
      <style>
      @import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

    </style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>

</head>

<body translate="no" >

  <html lang="en">
<head>
	<meta charset="utf-8" />
</head>

<body>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Subject</th>
<th class="text-left">Date</th>
<th class="text-left">Message</th>
<th class="text-left"></th>
</tr>
<form  align = "left" action="" method="post">
		
			<?php
			$query = "SELECT id,eventname,YEAR(eventdate) AS year, MONTH(eventdate) AS month, DAY(eventdate) AS day,message FROM event where userid = $id order by eventdate asc";
			$result = $conn->query($query);
			$d = date('d',time());
      $m = date('m',time());
      $y = date('Y',time());
			while( $row = mysqli_fetch_assoc( $result) )
			{		
      if($y==$row['year']&&$m==$row['month']&&$d==$row['day'])
        {
        echo '<tr>
        <td class="text-left"><font face="verdana" color="red">';echo $row['eventname'];echo '</font>
        </td><td class="text-left"><font face="verdana" color="red">';echo $row['day'].'/'.$row['month'].'/'.$row['year'];echo '</font>
        </td><td class="text-left"><font face="verdana" color="red">';echo $row['message'];echo '</font>
        </td><td class="text-left"><button name="remove" type ="submit" value ="'.$row['id'].'">Remove</button>
        </td></tr>';
      }	
        else if($y<=$row['year']&&$m<=$row['month']&&$d<$row['day'])
        {
				echo '<tr>
				<td class="text-left">';echo $row['eventname'];echo '
				</td><td class="text-left">';echo $row['day'].'/'.$row['month'].'/'.$row['year'];echo '
				</td><td class="text-left">';echo $row['message'];echo '
        </td><td class="text-left"><button name="remove" type ="submit" value ="'.$row['id'].'">Remove</button>
				</td></tr>';
      }
}
			
			?>
			
		</form>
</tbody>
</table>
  

  <?php

if(isset($_POST['remove']))
{
  $tid=$_POST['remove'];

  $query = "DELETE FROM event where id = $tid";
      $result = $conn->query($query);
}


?>
  
  
  
  

</body>
</html>
 