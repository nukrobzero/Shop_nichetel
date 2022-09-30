<?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
$target_dir = "../image/uploads/promotions/";
$target_file = $target_dir;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//random name for image
$str = substr(base64_encode(sha1(mt_rand())), 0, 16);

$file_name = $str.".".$imageFileType;
$target_file2 = $target_dir.$file_name;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}
// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}
// Check file size limit 1Mb.
if ($_FILES["fileToUpload"]["size"] > 1024000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {

		$uploadOk = 3;
		// echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	} 
}
if ($uploadOk == 3) {
	$p_percent = isset($_POST["p_percent"])?$_POST["p_percent"]:'';
	$p_pre_date = isset($_POST["p_pre_date"])?$_POST["p_pre_date"]:'';
	$p_pos_date = isset($_POST["p_pos_date"])?$_POST["p_pos_date"]:'';
	$p_name = isset($_POST["p_name"])?$_POST["p_name"]:'';
	// $p_img = isset($_POST["p_img"])?$_POST["p_img"]:'';

	// CONFIC VALUES
	$id_prefix ="PROMO-"; 
	$id_length = 4;
	$id_insert = "";

	$sql_last_id = "SELECT MAX(p_id) as p_ids FROM promotions ";
	$result_last_id = $conn->query($sql_last_id);
	$row_last_id = $result_last_id->fetch_assoc();

// echo -$id_length;
	if ($row_last_id["p_ids"]==""){
		$id_num = 1;
	}
	else{
		$new_id = intval (substr($row_last_id["p_ids"], -$id_length) );
		$id_num = $new_id+1;
	}

	$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
	$id_insert = $id_prefix.$id_with_zero;

	$sql = "INSERT INTO promotions (p_id,p_percent,p_pre_date,p_pos_date,p_name,p_img)
	VALUES ('$id_insert','$p_percent','$p_pre_date','$p_pos_date','$p_name','$file_name') ";
	$result = mysqli_query($conn,$sql);


	if ($result) {
		echo "
		<script> 
		window.location.href ='../admin/promotions.php';
		</script>
		";
	}
	else{
		$myFile = $target_file2;
		unlink($myFile) or die("Couldn't delete file");
		// echo mysqli_error($conn);
		// echo "เกิดข้อผิดพลาด!";
		echo "
		<script> 
		alert('มีการกรอกข้อมูลซ้ำ');
		window.location.href ='../admin/promotions_add.php';
		</script>
		";
	}
}
}
?>
