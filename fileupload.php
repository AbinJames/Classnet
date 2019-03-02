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
	?>
	<!DOCTYPE html>
<html >

<head>
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
.form-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
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


.srch {
    width: 130px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

/* When the input field gets focus, change its width to 100% */
.srch:focus {
    width: 100%;
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
<div class="form-fill">
<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name ="file">
<input type ="submit" value ="submit" name="submit">
</form>
</div>
<?php
if(isset($_POST['submit'])){
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$type = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
$tmp_name = $_FILES['file']['tmp_name'];


if(isset($name)){
	if(!empty($name)){
		$query = "SELECT * from users where id = $id";
		 $result = $conn->query($query);
		 $member = mysqli_fetch_assoc($result);
		 $n=$member['nof'];
		 $n++;
		 $query = "UPDATE users set nof =$n where id = $id";
		 $result = $conn->query($query);
		 $target_dir = 'files/';
	$upload=$target_dir.'file_'.$id.'_'.$n.'.'.$type;
	move_uploaded_file($tmp_name,$upload);
	$today=date('Y/m/d',time());
	$query = "INSERT into files (userid,uname,name,type,size,udate) values ($id,'$upload','$name','$type',$size,'$today')";
		 $result = $conn->query($query);
		 unset($name);
		 unset($size);
		 unset($type);
		 unset($tmp_name);
		 header("Location:fileupload.php");
	}
	}
}

?>
<!--<div class="form-fill"><form  align = "left" action="" method="post"><input class = "srch" type="text" name="search" placeholder="Search.."></form></div>-->

<table class="table-fill">
<thead>
<tr>
<th class="text-left">S No</th>
<th class="text-left">Name</th>
<th class="text-left">Type</th>
<th class="text-left">Size</th>
<th class="text-left">Upload Date</th>
<th class="text-left">Shared By</th>
<th class="text-left"></th>
</tr>
		<form  align = "left" action="" method="post">
			<?php
      if(isset($_POST['search']))
      {
        $s=$_POST['search'];
        $query = "SELECT * FROM files where userid = $id and name like '%$s%' order by name asc";
      }
        else
			$query = "SELECT * FROM files where userid = $id order by udate asc";
			$result = $conn->query($query);
			if($result){
			$n=1;
			while( $row = mysqli_fetch_assoc( $result) )
			{		
        echo '<tr>
        <td class="text-left">';echo $n;echo '
        </td><td class="text-left">';echo $row['name'];echo '
        </td><td class="text-left">';echo $row['type'];echo '
        </td><td class="text-left">';echo $row['size'];echo '
        </td><td class="text-left">';echo $row['udate'];echo '
        </td><td class="text-left">';echo $row['shared'];echo '
        </td><td class="text-left"><button name="remove" type ="submit" value ="'.$row['id'].'" onclick="myFunction()">Remove</button></br>
        <button name="" type ="submit"><a href="filedown.php?id='.$row['id'].'" target="_blank">Download</button></br>
        <button name="" type ="submit"><a href="sharefile.php?id='.$row['id'].'" target="iframe2">Share</button>
				</td></tr>';
$n++;
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

  $query = "DELETE FROM files where id = $tid";
      $result = $conn->query($query);
      echo '<script>
function myFunction() {
    window.location.href = "fileupload.php";
}
</script>';
}


?>
  

  
  
  
  
  

</body>
</html>
