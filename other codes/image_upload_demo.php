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
  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="./css/imgstyle.css" rel="stylesheet">
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery.form.js"></script>
<script>
$(document).on('change', '#image_upload_file', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

$('#image_upload_form').ajaxForm({
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			$("#imgArea>img").prop('src',obj.image_medium);			
		}else{
			alert(obj.error);
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});
</script>
</head>

<body>

<br>

<?php
$query = "SELECT * FROM users WHERE id = $id";//select reciever details
  $result = $conn->query($query);
  $them = mysqli_fetch_assoc( $result);
echo '
<div id="imgContainer">
  <form enctype="multipart/form-data" action="image_upload_demo_submit.php" method="post" name="image_upload_form" id="image_upload_form">
    <div id="imgArea"><img src="';echo $them['profile'];echo '">
      <div class="progressBar">
        <div class="bar"></div>
        <div class="percent">0%</div>
      </div>
      <div id="imgChange"><span>Change Photo</span>
        <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
      </div>
    </div>
  </form>
</div>';
?>
</body>
</html>
