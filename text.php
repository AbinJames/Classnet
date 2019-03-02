<?php
ob_start();
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
$tid=$_GET['id'];
?>
<!DOCTYPE html><html class=''>
<head><style class="cp-pen-styles">body{
  padding: 15px;
  background-color: #ddd;
}
.textmodmenu{
  font-size: 0;
}
.texteditor{
  height: 250px;
  width: 100%;
  border: 1px solid #666;
  overflow-y: auto;
  margin: 10px 0;
  border-radius: 3px;
  background-color: #f3f3f3;
  transition: background-color .5s;
  padding: 10px;
}
.texteditor:focus{
  background-color: #fff;
}

.textmodmenu button{
  background-color: #eee;
  border: 0;
  border: 1px solid #bbb;


}
.textmodsub{
  display: inline-block;
  padding-right: 10px;
}
.textmodmenu button:hover{
  box-shadow: 0 0 15px #666 inset;
}
.article{
  background-color: #fff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  margin: 10px 0;
  padding: 15px;
}
.article img{
  max-width: 100%;
}

/*override bootstrap blockquote style*/
blockquote{
  font-size: inherit;
}
.dropdown-menu.dropdown-selector{
  padding-left: 15px;
}</style></head><body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

<!--text menu-->


<div class="textmodmenu">
  <div class="textmodsub btn-group">
    <button class="textmod btn" id="bold"><i class="fa fa-bold"></i></button>
    <button class="textmod btn" id="italic"><i class="fa fa-italic"></i></button>
    <button class="textmod btn" id="underline"><i class="fa fa-underline"></i></button>
    <button class="textmod btn" id="strikeThrough"><i class="fa fa-strikethrough"></i></button>
  </div>
  <div class="textmodsub btn-group">
    <button class="textmod btn" id="superscript"><i class="fa fa-superscript"></i></button>
    <button class="textmod btn" id="subscript"><i class="fa fa-subscript"></i></button>
  </div>
  <div class="textmodsub btn-group">
    <button class="textmod btn" id="insertUnorderedList"><i class="fa fa-list"></i></button>
    <button class="textmod btn" id="insertOrderedList"><i class="fa fa-list-ol"></i></button>
  </div>
  <div class="textmodsub btn-group">
    <button class="textmod btn" id="justifyLeft"><i class="fa fa-align-left"></i></button>
    <button class="textmod btn" id="justifyCenter"><i class="fa fa-align-center"></i></button>
    <button class="textmod btn" id="justifyRight"><i class="fa fa-align-right"></i></button>
    <button class="textmod btn" id="justifyFull"><i class="fa fa-align-justify"></i></button>
  </div>
  <div class="textmodsub btn-group">
    <button class="textmod btn" id="indent"><i class="fa fa-indent"></i></button>
    <button class="textmod btn" id="outdent"><i class="fa fa-outdent"></i></button>
  </div>
  
  <div class="textmodsub btn-group">
    <button class="textmodarg btn" id="H1">H1</button>
    <button class="textmodarg btn" id="H2">H2</button>
    <button class="textmodarg btn" id="H3">H3</button>
    <button class="textmodarg btn" id="P">P</button>
  </div>
  
  
</div>
<!--uses div instead of textarea to allow editing of format-->

<div class="texteditor" id="cms" contenteditable>

  <?php
  
  if($tid>0)
  {
   $query = "SELECT * FROM notes where tid = $tid";
   $result = $conn->query($query);

   $row = mysqli_fetch_assoc( $result);

   echo $row['ncontent'];
 }
 ?>
 
</div>

<p><span id="charcount">0</span><span>/25000</span></p>
<div class="textmodsub btn-group">
  <?php
  $tid=$_GET['id'];
  echo "<input type = \"text\" id =\"title\" ";
  if($tid>0)
  {
    $query = "SELECT * FROM notes where tid = $tid";
    $result = $conn->query($query);

    $row = mysqli_fetch_assoc( $result);
    echo "value = \"";
    echo $row['ntitle'];
    echo "\">";


  }
  else
    echo "placeholder=\"Enter note name\">";
  ?>
  <?php
  if($tid<0)
    $c=1;
  else
    $c=0;
  echo '<button id="save" class="btn" value="'.$c.'">';
  ?><i class="fa fa-save"></i></button>
  <button><a href="allnotes.php" target="_parent">All notes</a></button>
</div>

<div class="textcontainer" id="display">

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

<script>

//text modifier
$(".textmod").click(function(){
  console.log("called textmod");
  var textType = $(this).attr("id");
  console.log(textType);
  document.execCommand(textType, false, null);
  var supported = document.queryCommandSupported("fontName");
  console.log(supported);
  
});
//src modifier
$(".textmodlink").click(function(){
  console.log("called textmodarg");
  var argText = prompt("insert link");
  var textType = $(this).attr("id");
  if(argText != null && argText != "" && argText != " "){
    document.execCommand(textType, false, argText);
  };
});

//alter text to heading
$(".textmodarg").click(function(){
  console.log("textmodarg");
  var argText = $(this).attr("id");
  document.execCommand("formatBlock", false, argText);
});

//save to var and display below


$("#save").click(function(){
  var tr = $("#cms").html();
  var title = $('input#title').val();
  var c= $('#save').val();
  if(title=="")
    alert("Input Note Name");
  else
    $.post('te.php',{str:tr,title:title,check:c},function(data){ 
      var savecontent = "Your saved text<div class='article'>" + data + "</div>";
      $("#display").html(savecontent);
      console.log(savecontent);
      
    });});

$('#cms').bind('blur keyup paste copy cut mouseup', function(e) {
  var count = $("#cms").html().length;
  $("#charcount").text(count);
  if(count > 25000){
    $("#save").attr("disabled", true);
    $("#charcount").css("color", "red");
  }
  else{
    $("#save").attr("disabled", false);
    $("#charcount").css("color", "initial");
  }
});

</script>
</body></html>
