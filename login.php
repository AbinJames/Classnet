<?php
ob_start();
  session_start();
  require_once 'dbconnect.php';

  // it will never let you open index(login) page if session is set
 /*if ( isset($_SESSION['user'])!="" ) {
  echo"hello";
    //header("Location: accpage.php");
    exit;
  }*/


  $error = false;

  if ( isset($_POST['signin']) ) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    
      // check email exist or not
     $query = "SELECT * FROM users WHERE email='$email'and password='$pass' ";
      $result = $conn->query($query);
      $row_cnt = $result->num_rows;
            if($row_cnt > 0) {
            //Login Successful
            session_regenerate_id();
            $member = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $member['id'];
            session_write_close();
          
            header("location: homepage.php");
            exit();
        }else {
            //Login failed
            $errmsg_arr[] = 'user name and password not found';
            $errflag = true;
            if($errflag) {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                session_write_close();
                 header("location: classNET.html");
                exit();
            }

    }
        
    
     
}
    
    
  
?>