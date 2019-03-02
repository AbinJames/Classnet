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
		 $query = "SELECT * FROM users WHERE id = $id";
      		$result = $conn->query($query);
	}
?>
<?php
/*function change_profile_image($user_id,$file_temp,$file_extn){
	$file_path='image/profile/'.substr(md5(time()),0,10).'.'.$file_extn;
	mysql_query("UPDATE users set profile = $file_path where id =$user_id");
}*/
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>classNET Home</title>
		<link rel="stylesheet" type="text/css" href="css/menudemo.css" />
		<link rel="stylesheet" type="text/css" href="css/menustyle.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
	<style>
	iframe
	{
		border :no-border;
		float:right;
	}
</style>
<iframe id="iframe" src="user.php" width="1600px" height="300px" frameborder="0"></iframe>
<iframe id="iframe" src="event.php" width="1600px" height="" frameborder="0"></iframe>

	<!--<div class="">
                <?php

                $member = mysqli_fetch_assoc($result);
                
               //if(isset($_FILES['profile'])=== true) {
               	//echo "ok";
                	/*if(empty($_FILES['profile']['name'])===true){
                		echo "please choose file";
                	}
                	else {
                		$allowed=array('jpg','jpeg','gif','png');
                		$file_name = $_FILES['profile']['name'];
                		$file_extn = strtolower(end(explode('.',$file_name)));
                		$file_temp = $_FILES['profile']['tmp_name'];
                		if(in_array($file_extn,$allowed)===true){
                			change_profile_image($session_user_id,$file_temp,$file_extn);
                		header('Location:'. $current_file);
                		exit();

                		}
                	}*/
              //  }
                if(empty($member['profile'])===false){
                	echo '<img src="images/profiles/',$member['profile'],'">';
                }
                ?>
                <form action="" method = "post" enctype"multipart/form-data">Profile Pic</br>
                <input type = "file" name="profile"></br>
               <input type="submit"  name="submit">Submit</button>
                </form>-->
            </div>
	<nav id="bt-menu" class="bt-menu">
				<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
				<ul>.
					<li><a href="#" class="bt-icon icon-user-outline">About</a></li>
					<li><a href="#" class="bt-icon icon-sun">My Mates</a></li>
					<li><a href="text.php?id=-1" class="bt-icon icon-windows">Create.Notes</a></li>
					<li><a href="note.php"  class="bt-icon icon-windows">All.Notes</font></li>
					<li><a href="events.php" >Events</a></li>
					<li><a href="discus.php" >Discussions</a></li>
					<li><a href="upload.php" ><font size = "1">Set.Profile.Image</font></li>
					<li><a href="#" >Contact</a></li>
					<li><a href="logout.php" action="post">Logout</a></li>
				</ul>
			</nav>
		
	</body>
	<script src="js/menuclassie.js"></script>
	<script src="js/borderMenu.js"></script>
</html>
<?php ob_end_flush(); ?>