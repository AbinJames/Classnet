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
          $row=mysqli_fetch_assoc($result);
  }
?>

<!DOCTYPE html>
<html >

<head>
  <meta charset="UTF-8">
  <title>Reminders</title>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/home.css">

</head>

<body translate="no" >

  <section id="sidebar"> 
  <div id="sidebar-nav">   
    <ul>
      <li class="active"><a rel="nofollow" rel="noreferrer"href="reminders.php"><i class="fa fa-calendar-o"></i> Reminders</a></li>
      <li><a rel="nofollow" rel="noreferrer" href="homepage.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a rel="nofollow" rel="noreferrer"href="texteditor.php?tid=-1"><i class="fa fa-pencil-square-o"></i> Create Note</a></li>
      <li><a rel="nofollow" rel="noreferrer" href="allnotes.php"><i class="fa fa-file"></i> All Notes</a></li>
      <li><a rel="nofollow" rel="noreferrer"href="discussions.php"><i class="fa fa-tasks"></i> Discussions</a></li>
      <li><a rel="nofollow" rel="noreferrer"href="uploadr.php"><i class="fa fa-upload"></i> Upload Resources</a></li>
      <li><a rel="nofollow" rel="noreferrer"href="chat.php"><i class="fa fa-comments-o"></i> Chat</a></li>    
      <li><a rel="nofollow" rel="noreferrer" href="mates.php"><i class="fa fa-users"></i> My Buddies</a></li>
      <li><a rel="nofollow" rel="noreferrer"href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
      <li><a rel="nofollow" rel="noreferrer" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>

    </ul>
  </div>
</section>
<section id="content">
  

  <div class="content">
    <div class="content-header">
      <h1>Your Events</h1>
    </div>
     <iframe id="iframe1" name ="iframe1" target="_parent" src="events.php" width="40%" height="90%" frameborder="0"></iframe> 
     <iframe id="iframe2" name ="iframe2" src="allevents.php?check=0" width="50%" height="90%" frameborder="0"></iframe>
  </div>

</section>
  
  

  
  
  

</body>
</html>
 