<?php


include_once 'dbconnect.php';
include_once 'defaultprofilepicture.php';

$error = false;

if ( isset($_POST['submit']) ) {
  
    // clean user inputs to prevent sql injections
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $query = "SELECT email FROM users WHERE email='$email'";
 $result = $conn->query($query);
 $row_cnt = $result->num_rows;
 if($row_cnt>0){
  echo '<script type="text/javascript">'; 
  echo 'alert("Email id already exists");'; 
  echo 'window.location.href = "classNET.html#toregister";';
  echo '</script>';
}
else
{
  
  $fname = trim($_POST['firstname']);
  $fname = strip_tags($fname);
  $fname = htmlspecialchars($fname);

  $lname = trim($_POST['lastname']);
  $lname = strip_tags($lname);
  $lname = htmlspecialchars($lname);
  
  

  $dob= $_POST['dob'];

  $phno = $_POST['phno'];


  $gender = $_POST['gender'];

  $st = $_POST['st'];

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $today = date('y/m/d',time());
  
    // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
    // if there's no error, continue to signup90,now
  if( !$error ) {
    
    $query = "INSERT INTO users(firstname,lastname,email,phone,gender,dob,S_T,password,profile,created_at,updated_at) VALUES('$fname','$lname','$email',$phno,'$gender','$dob','$st','$pass','$profile','$today','$today')";
    $query2=$query;
    $res =$conn->query($query);
    if ($res) {
      
      $query = "SELECT * FROM users WHERE email='$email'and password='$pass' ";
      $result = $conn->query($query);
      $row_cnt = $result->num_rows;
      if($row_cnt > 0) {
            //Login Successful
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $member['id'];
        header("location:homepage.php");
        exit();
      }
    } else {
      echo $query;
      echo "Something went wrong, try again later..."; 
    } 
    
  }
  
  
}
}
?>