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
include('./functions.php');
/*defined settings - start*/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_SMALL_DIR', './uploades/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', './uploades/medium/');
define('IMAGE_MEDIUM_SIZE', 250);
/*defined settings - end*/

if(isset($_FILES['image_upload_file'])){
	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['image_upload_file']["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		/*create directory with 777 permission if not exist - start*/
		createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['image_upload_file']['tmp_name'];
		$file = pathinfo($_FILES['image_upload_file']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
	
$query = "SELECT * FROM users where id = $id";
		 $result = $conn->query($query);
	
		 $row = mysqli_fetch_assoc( $result);
		 $n=$row['nop'];
		 $n++;
$m=move_uploaded_file($path[0],"images/$fileNameNew");
$query = "UPDATE users set nop = $n and profile = 'images/$fileNameNew' where id = $id";
		 $result = $conn->query($query);
		 $query = "UPDATE users set profile = 'images/$fileNameNew' where id = $id";
		 $result = $conn->query($query);
	$query = "INSERT into profileimg (id, name) values ($id,'images/$fileNameNew')";
		 $result = $conn->query($query);	 
		if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
			
			if (createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
				$output['status']=TRUE;
				$output['image_medium']= $path[1];
				$output['image_small']= $path[2];
				
			}
		}
	}
	echo json_encode($output);
}
?>	