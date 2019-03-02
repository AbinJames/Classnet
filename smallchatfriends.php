<!DOCTYPE html>
<html>
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
$sec = "2";
?>
<meta http-equiv="refresh" content="<?php echo $sec ?>; URL='<?php echo $page; ?>'">



<body>
<style>
.message-box{
  padding:18px 0 10px;
  clear:both;
   overflow:   auto;
}
.message-box .picture{
  float:left;
  width:50px;
  display:block;
  padding-right:10px;
}
.picture img{
  width:50px;
  height:50px;
  border-radius:5px;
}
.picture span{
  font-weight:bold;
  font-size:12px;
  clear:both;
  display:block;
  text-align:center;
  margin-top:3px;
}
.message{
  background:#fff;
  display:inline-block;
  padding:13px;
  width:274px;
  border-radius:2px;
  box-shadow: 0 1px 1px rgba(0,0,0,.04);
  position:relative;
}
.message:before{
  content:"";
  position:absolute;
  display:block;
  left:0;
  border-right:6px solid #fff;
  border-top: 6px solid transparent;
  border-bottom:6px solid transparent;
  top:10px;
  margin-left:-6px;
}
.message span{
  color:#555;
  font-weight:bold;
}
.message p{
  padding-top:5px;
}
</style>

	<div class="btn-group">
		<form  align = "left" action="" method="post">
		
			<?php

      $id=$_SESSION['user'];
      $query = "SELECT * FROM friendlinks WHERE uid = $id";
      $result = $conn->query($query);
      echo "<div id = \"chatmessages\" class = \"chat-box\">";
      while($row = mysqli_fetch_assoc( $result))
      {
        $q = "SELECT * FROM users WHERE id = {$row['fid']}";
        $res = $conn->query($q);
        $r = mysqli_fetch_assoc( $res);
        $query3 = "SELECT * FROM chat WHERE sender ={$row['fid']} and reciever=$id and unread = 1 order by id";
      $res = $conn->query($query3);
      $ro = mysqli_fetch_assoc( $res);
      if($res->num_rows>0)
      {
        echo "<div class=\"message-box left-img\">
      		<div class=\"picture\">
        <img src=\"";echo $r['profile'];echo "\"> </div><a href=\"chat.php\" target=\"_parent_parent\">";echo $r['firstname'];echo" ";echo $r['lastname'];echo"</a></br>";
      echo $ro['message'];
     }
         }
         $query = "SELECT * FROM friendlinks WHERE fid = $id";
      $result = $conn->query($query);
      echo "<div id = \"chatmessages\" class = \"chat-box\">";
      while($row = mysqli_fetch_assoc( $result))
      {
        $q = "SELECT * FROM users WHERE id = {$row['uid']}";
        $res = $conn->query($q);
        $r = mysqli_fetch_assoc( $res);
$query3 = "SELECT * FROM chat WHERE sender ={$row['uid']} and reciever=$id and unread = 1 order by id";
      $res = $conn->query($query3);
      $ro = mysqli_fetch_assoc( $res);      
      
      if($res->num_rows>0)
      {
        echo "<div class=\"message-box left-img\">
          <div class=\"picture\">
        <img src=\"";echo $r['profile'];echo "\"> </div><a href=\"chat.php\" target=\"_parent_parent\">";echo $r['firstname'];echo" ";echo $r['lastname'];echo"</a></br>";
      echo $ro['message'];
     }
         }
         ?>
			
		</form>
	</div>
	
</body>
</html>