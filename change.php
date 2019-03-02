<?php
session_start();
 $id=$_SESSION['user'];
 require_once 'dbconnect.php';
if(isset($_POST['profile']))
{
  $fn=$_POST['firstname'];
$query = "UPDATE users set firstname='$fn' where id = $id";
$res=$conn->query($query);
$fn=$_POST['lastname'];
$query = "UPDATE users set lastname='$fn' where id = $id";
$res=$conn->query($query);
$fn=$_POST['dob'];
$query = "UPDATE users set dob='$fn' where id = $id";
$res=$conn->query($query);
$fn=$_POST['phno'];
$query = "UPDATE users set phone=$fn where id = $id";
$res=$conn->query($query);

  header("Location:user_settings.php");
  }
  if(isset($_POST['pass']))
{
  $fn=$_POST['opass'];
$query = "SELECT * users where id = $id and password = '$fn'";
$res=$conn->query($query);
           if(!$res){
      echo '<script type="text/javascript">'; 
echo 'alert("Wrong Password");'; 
echo 'window.location.href = "user_settings.php";';
echo '</script>';
    }
    else
    {
            		$fn=$_POST['npass'];
$query = "UPDATE users set password='$fn' where id = $id";
$res=$conn->query($query);
header("Location:user_settings.php");
            	}

  
  }
?>