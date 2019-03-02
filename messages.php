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
$fid=$_GET['id'];
?>

<!DOCTYPE html>
<html class=''>
<head>
<link rel="stylesheet" href="css/mstyles.css">


</head><body>
<div class="container">
  <div class="header">
  <font size="5">
  <?php 
  $query2 = "SELECT * FROM users WHERE id = $fid";//select reciever details
  $result2 = $conn->query($query2);
  $them = mysqli_fetch_assoc( $result2);
  
   $query3 = "UPDATE chat set unread=0 WHERE sender =$fid and reciever=$id";//set all unread messages as 0
   echo $them['firstname'];echo " ";echo $them['lastname'];
  $res = $conn->query($query3);
  ?>
  </font>
  </div>
  <div class="chat-box">
  <?php
    echo "<iframe id=\"iframe\" src=\"m.php?fid=";echo $fid;echo"\" width=\"100%\"height=\"100%\" frameborder=\"0\"></iframe>";
    ?>
    <div class="enter-message">
    <form method="post" action="">
      <input type="text" name="msg" placeholder="Enter your message.."/>
      <button name="send" class="send">Send</button>
      </form>
      <?php
      if(isset($_POST['send']))
      {
      $m=$_POST['msg'];
      $d=date('d',time());
       $mo=date('m',time());
        $y=date('y',time());
      $t=date('h:m:s',time());
      $sql = "INSERT into chat (sender,reciever,message,ctime,d,m,y) values ($id,$fid,'$m','$t',$d,$mo,$y) ";//insert message into table
        $send = $conn->query($sql);
        header("Location:$page?id=$fid");
    }
      ?>
    </div>
  </div>
</div>
</body></html>