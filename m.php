<html>
<link rel="stylesheet" href="css/mstyles.css">

<script>
  window.onload=toBottom;

function toBottom()
{
window.scrollTo(0, document.body.scrollHeight);
}
</script>
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
$fid=$_GET['fid'];
?>
<meta http-equiv="refresh" content="<?php echo $sec ?>; URL='<?php echo $page; echo "?fid=$fid";?>'">
<?php
 

  $query = "SELECT * FROM users WHERE id = $id";
  $result = $conn->query($query);
  $you = mysqli_fetch_assoc( $result);
  $query2 = "SELECT * FROM users WHERE id = $fid";
  $result2 = $conn->query($query2);
  $them = mysqli_fetch_assoc( $result2);
  $query3 = "SELECT * FROM chat WHERE sender = $id and reciever=$fid or sender =$fid and reciever=$id order by id";// select messages from table
  $res = $conn->query($query3);
  echo "<div id = \"chatmessages\" class = \"chat-box\">";
  while($r = mysqli_fetch_assoc( $res))
  {
    if($r['sender']==$id)
    {
      echo "<div class=\"message-box left-img\">
      <div class=\"picture\">
        <img src=\"";echo $you['profile'];echo "\">";
        echo " <span class=\"time\">";echo $r['d'];echo"/";echo $r['m'];echo"/";echo $r['y'];echo " ";echo $r['ctime'];echo "</span>
    </div>
    <div class=\"message\">"; 
        echo "<span>YOU</span> 
        <p>";echo $r['message'];echo "</p>
    </div>
    </div>";
}
else
{
    echo "<div class=\"message-box right-img\">
    <div class=\"picture\">
        <img src=\"";echo $them['profile'];echo "\">";
        echo " <span class=\"time\">";echo $r['d'];echo"/";echo $r['m'];echo"/";echo $r['y'];echo " ";echo $r['ctime'];echo "</span>
    </div>
    <div class=\"message\">"; 
        echo "<span>";echo $them['firstname']; echo " ";echo $them['lastname'];echo"</span>
        <p>";echo $r['message'];echo "</p>
    </div>
    </div>";
}
}
echo "</div>";
?>
</html>