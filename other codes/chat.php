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

<!DOCTYPE html>
<html >

<head>
  <meta charset="UTF-8">
  <title>CodePen - Dashboard</title>

  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
  <style>
    html, body {
      font-family: 'Open Sans', sans-serif;
      height: 100%;
    }
    body {
      background: #FFFFFF;
      height: 100%;
    }
    img {
      max-width: 100%;
    }
    ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    a {
      text-decoration: none;
    }
    #header {
      float: left;
      width: 100%;
      background: #ffffff;
      position: relative;
    }
    .white-label {
      float: left;
      background: #33373B;
      max-width: 210px;
      padding: 10px;
      min-height: 44px;
      background: #279BE4;
      width: 100%;
      max-height: 44px;
    }
    .white-label img {
      max-height: 43px;
    }
    .header-nav {
      min-height: 64px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      background: #279BE4;
    }
    .menu-button {
      float: left;
      font-size: 29px;
      color: #fff;
      padding: 12px 19px;
    }
    .nav ul {
      height: 64px;
      float: right;
    }
    .n ul {
     background: #01A9F0;
     border-style: solid; border-width: thin; border-color: #0000FF; 
     float: left;
   }
   .nav ul li {
    float: left;
    position: relative;
    padding: 11px;
  }
  .nav > ul > li:first-child {
    border-left: none;
  }
  .nav ul li a {
    color: #fff;
    padding: 1px;
    float: left;
  }
  .nav ul li i {
    color: #fff;
  }
  .nav ul li:hover {
    background: #01A9F0;
    color: #fff;
  }
  .user-profile {
    float: right;
  }
  .user-profile > div {
    float: left;
    padding: 20px 8px;
    position: relative;
  }
  .user-profile i {
    font-size: 1.2em;
    color: #5F6F86;
  }
  .user-profile i:hover {
    color: #397AC5;
  }
  .font-icon i:after {
    position: absolute;
    content: '3';
    background: #E74C3C;
    color: #fff;
    font-size: 12px;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    padding: 3px 4px 4px 3px;
    text-align: center;
    top: 12px;
    right: 11px;
  }
  .font-icon {
    padding: 8px 10px;
  }
  .font-icon i {
    font-size: 24px;
  }
  .nav-mail .font-icon i:after {
    background: #2ECC71;
  }
  div.user-image {
    padding: 9px 5px;
    margin: 0 5px;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
  }
  .nav-profile {
    background: #0274BD;
  }
  .nav-profile-image img {
    width: 39px;
    height: 41px;
    border-radius: 50%;
    float: left;
  }
  .nav-profile-name {
    float: right;
    margin: 11px 7px 8px 14px;
    color: #fff;
  }
  .nav-profile-name i {
    padding: 0 0 0 11px;
  }
  .nav-chat i:after {
    display: none;
  }
  #sidebar {
    overflow: hidden;
    width: 210px;
    height: 100%;
    float: left;
    background: #2A2D33;
  }
  #sidebar-nav {
    width: 106%;
    height: calc(100% - 95px);
    padding: 0;
    background: #2A2D33;
    border-right: 1px solid #E0E0E0;
    overflow-y: scroll;
  }
  #sidebar-nav h2 {
    color: #60636B;
    float: left;
    width: 100%;
    font-size: .8em;
    font-family: 'Open Sans', sans-serif;
    font-weight: 600;
    text-transform: uppercase;
    padding: 3px 0 2px 20px;
    border-top: 1px solid #4D4C4C;
    box-sizing: border-box;
    margin: 10px 0;
  }
  #sidebar-nav ul {

  }
  #sidebar-nav ul li {

  }
  #sidebar-nav ul li a {
    color: #C2C2C2;
    font-size: .95em;
    padding: 15px 20px;
    float: left;
    width: 100%;
    font-weight: 600;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  #sidebar-nav ul li:hover a, #sidebar-nav ul li:hover a i, #sidebar-nav li.active a, #sidebar-nav li.active a i {
    color: #333;
  }
  #sidebar-nav ul li:hover a {
    background: #fff;
    color: #333;
  }
  #sidebar-nav ul li.active a {
    background: #fff;
    color: #333;
  }
  #sidebar-nav ul li.active a i {
    background: #fff;
  }
  #sidebar-nav i {
    padding-right: 8px;
    font-size: 1.3em;
    color: #60636B;
    width: 25px;
    text-align: center;
  }
  #content {
    float: left;
    width: calc(100% - 210px);
    height: 100%;
    word-wrap: break-word;
    background: #FFFFFF;
    font-family: Raleway, sans-serif;
  }
  ::-webkit-scrollbar {
    width: 12px;
  }
  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
  }
  ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
  }
  .content {
    float: left;
    background: #E9EEF4;
    width: 100%;
    height: calc(100% - 64px);
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .content-header {
    background: #fff;
    float: left;
    width: 100%;
    margin-bottom: 15px;
    padding: 15px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border-bottom: 1px solid #ccc;
  }
  .content-header h1 {
    margin: 0;
    font-weight: normal;
    padding-bottom: 5px;
  }
  .content-header p {
    margin: 0;
    padding-left: 2px;
  }
  .widget-box {
    background: #fff;
    border: 1px solid #E0E0E0;
    float: left;
    width: 100%;
    margin: 0 0 15px 15px;
  }
  .widget-header {
    background: #279BE4;
  }
  .widget-header h2 {
    font-size: 15px;
    font-weight: normal;
    margin: 0;
    padding: 11px 15px;
    color: #F9F9F9;
    display: inline-block;
  }
  .sample-widget {max-width: 47%;}
  .widget-box .fa-cog {
    float: right;
    color: #fff;
    margin: 11px 11px 0 0;
    font-size: 20px;
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

  <section id="sidebar"> 
    <div class="white-label">
    </div> 
    <div id="sidebar-nav">   
      <ul>
        <li class="active"><a rel="nofollow" rel="noreferrer"href="chat.php"><i class="fa fa-comments-o"></i>Chat</a></li>
        <li><a rel="nofollow" rel="noreferrer"href="homepage.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a rel="nofollow" rel="noreferrer"href="texteditor.php?tid=-1"><i class="fa fa-pencil-square-o"></i> Create Note</a></li>
        <li><a rel="nofollow" rel="noreferrer" href="allnotes.php"><i class="fa fa-file"></i> All Notes</a></li>
        <li><a rel="nofollow" rel="noreferrer"href=""><i class="fa fa-tasks"></i> Discussions</a></li>
        <li><a rel="nofollow" rel="noreferrer"href="#"><i class="fa fa-upload"></i> Upload Resources</a></li>   
      <li><a rel="nofollow" rel="noreferrer" href="mates.php"><i class="fa fa-users"></i> My Buddies</a></li>
        <li><a rel="nofollow" rel="noreferrer"href="#"><i class="fa fa-calendar-o"></i> Reminders</a></li>
        <li><a rel="nofollow" rel="noreferrer"href="#"><i class="fa fa-calendar"></i> Calendar</a></li>
         <li><a rel="nofollow" rel="noreferrer"href="#"><i class="fa fa-gear"></i> Settings</a></li>
      <li><a rel="nofollow" rel="noreferrer" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </div>
  </section>
  <section id="content">
    <div id="header">
      <div class="header-nav">
        <div class="menu-button">
          <!--<i class="fa fa-navicon"></i>-->
        </div>
        <div class="nav">
          <ul>
            <li class="nav-settings">
              <div class="font-icon"><i class="fa fa-tasks"></i></div>
            </li>
            <li class="nav-mail">
              <div class="font-icon"><i class="fa fa-envelope-o"></i></div>
            </li>
            <li class="nav-calendar">
              <div class="font-icon"><i class="fa fa-calendar"></i></div>
            </li>
            <li class="nav-chat">
              <div class="font-icon"><i class="fa fa-comments-o"></i></div>
            </li>
            <li class="nav-profile">
              <div class="nav-profile-image">
                <?php

                $id=$_SESSION['user'];
                $query = "SELECT * FROM users WHERE id = $id";
                $result = $conn->query($query);
                $row = mysqli_fetch_assoc( $result);$link = $row['profile'];
                echo "<img src=\"";echo $row['profile'];echo "\" alt=\"profile image\">
                <div class=\"nav-profile-name\">";
                 echo $row['firstname'];echo " ";
                 echo $row['lastname'];echo "<i class=\"fa fa-caret-down\"></i></div>";
                 ?>

               </div>
             </li>
           </ul>
         </div>
       </div>
     </div>

     <div class="content">
      <div class="content-header">
        <h1>Your Messages</h1>
      </div>




      <?php

      $id=$_SESSION['user'];
      $query = "SELECT * FROM friendlinks WHERE uid = $id";
      $result = $conn->query($query);
      while($row = mysqli_fetch_assoc( $result))
      {
        $q = "SELECT * FROM users WHERE id = {$row['fid']}";
        $res = $conn->query($q);
        $r = mysqli_fetch_assoc( $res);
        echo "<div class=\"n\"><ul><li class=\"nav-profile\">
        <div class=\"nav-profile-image\"><img src=\"";echo $r['profile'];echo "\" alt=\"profile image\">
          <div class=\"nav-profile-name\">";
          echo "<a href=\"messages.php?id=";echo $row['fid'];echo"\">";
           echo $r['firstname'];echo " ";
           echo $r['lastname'];echo "</a></div></div> </li></ul></div>";
         }
         ?>




       </div>

     </section>

     <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>





   </body>
   </html><div class
   <div class= "outer">

   </div>="red">
 </div>
 