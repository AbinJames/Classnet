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
  $row = mysqli_fetch_assoc( $result);
}
?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/dashstyle1.css">
<style>
  html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">



  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card-2 w3-round w3-white">
          <div class="w3-container">
           <h4 class="w3-center">My Profile</h4>
           <p class="w3-center"><img src="<?php echo $row['profile'];?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
           <hr>
           <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['email'];?></p>
           <p><i class="fa fa-phone fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['phone'];?></p>
           <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $row['dob'];?></p>
         </div>
       </div>
       <br>
       
       <!-- Accordion -->
       <div class="w3-card-2 w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
           <div class="w3-row-padding">
             <br><?php
             $query2 = "SELECT * FROM profileimg WHERE id = $id";
             $result2 = $conn->query($query2);
             while($row2 = mysqli_fetch_assoc( $result2))
             {
              echo '<div class="w3-half">
              <img src="'.$row2['name'].'" style="width:100%" class="w3-margin-bottom">
            </div>';
          }
          ?>
        </div>
      </div>
    </div>      
  </div>
  <br>
</div>

<!-- Middle Column -->
<div class="w3-col m7">
  
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h6 >Some of Your Notes</h6>
          
        </div>
      </div>
    </div>
  </div>
  
  <?php
  $query3 = "SELECT * FROM notes where id = $id order by tid desc";
  $result3 = $conn->query($query3);

  $n=0;
  while($row3 = mysqli_fetch_assoc( $result3) )
  {
    if($n<3){
      echo '
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
        <span class="w3-right w3-opacity"> '.$row3['updated'].'</span>
        <h4>'.$row3['ntitle'].'</h4><br>
        <p>'.$row3['ncontent'].'</p>
      </div>
      ';
    }$n++;
  }?>
  
  <!-- End Middle Column -->
</div>

<!-- Right Column -->
<div class="w3-col m2">
  <div class="w3-card-2 w3-round w3-white w3-center">
    <div class="w3-container">
      <p>EVENTS IN THIS MONTH</p>
      <?php
      $qe = "SELECT id,eventname,YEAR(eventdate) AS year, MONTH(eventdate) AS month, DAY(eventdate) AS day,message FROM event where userid = $id order by eventdate asc";
      $resul = $conn->query($qe);
      $d = date('d',time());
      $m = date('m',time());
      $y = date('Y',time());
      
      while( $row = mysqli_fetch_assoc( $resul) )
      {   
        
        if($y==$row['year']&&$m==$row['month']&&$d==$row['day'] )
        {
          echo '<p><strong><font face="verdana" color="red">';echo $row['eventname'];echo '</font></strong></p>
          <p><font face="verdana" color="red">';echo $row['message'];echo '</font></p>
          <p><font face="verdana" color="red">';echo $row['day'].'/'.$row['month'].'/'.$row['year'];echo '</font></p>';
        } 
        else if($y==$row['year']&&$m==$row['month']&&$d<$row['day'])
        {
          echo '<p><strong>';echo $row['eventname'];echo '</strong></p>
          <p>';echo $row['message'];echo '</p>
          <p>';echo $row['day'].'/'.$row['month'].'/'.$row['year'];echo '</p>';
        }
        

      }
      
      ?>
      
    </div>
  </div>
  <br>
  
  <div class="w3-card-2 w3-round w3-white w3-center">
    <div class="w3-container">
      <?php
      $query = "SELECT * FROM request where receiver=$id";
      $result = $conn->query($query);
      $cnt=$result->num_rows;
      if ($cnt!=0)
      {
        echo '<p>You have ';echo $cnt;echo ' friend requests</p>';
      }
      while( $r = mysqli_fetch_assoc( $result) )
      {     
        $fid=$r['sender'];
        $q = "SELECT * FROM users where id=$fid";
        $res = $conn->query($q);
        $row4 = mysqli_fetch_assoc( $res);
        echo'
        <img src="'.$row4['profile'].'" alt="Avatar" style="width:50%"><br>
        <span>'.$row4['firstname'].' '.$row4['lastname'].'</span>
        
      </div>
    </div>';
  }
  ?>
  
  
  <p>CHATS</p>
  <iframe id="iframe1" name ="iframe1" target = "iframe2" src="smallchatfriends.php" width="100%" height="500px" frameborder="0"></iframe>
  
  
  <br>


  <!-- End Right Column -->
</div>

<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>
<br>

<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
