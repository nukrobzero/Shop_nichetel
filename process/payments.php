 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
    echo "
    <script>
    window.location.href='../login.php';
    </script>
    ";
}else{
$target_dir = "../image/uploads/uploadslip/";
    $target_file = $target_dir;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $str = substr(base64_encode(sha1(mt_rand())), 0, 16);
    $file_name = $str.".".$imageFileType;
    $target_file2 = $target_dir.$file_name;
    $cart_status = isset($_GET["cart_status"])?$_GET["cart_status"]:'';
    $cart_id = isset($_GET["cart_id"])?$_GET["cart_id"]:'';

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "
        <script> 
        alert('ขออภัย, ไม่ใช่ไฟล์รูปภาพ');
        window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=".$cart_status."';
        </script>
        ";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "
        <script> 
        alert('กรุณาอัพโหลดสลิปโอนเงิน!!!');
        window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=".$cart_status."';
        </script>
        ";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "
        <script> 
        alert('ขออภัย, ไฟล์รูปมีขนาดเกิน 1Mb');
        window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=".$cart_status."';
        </script>
        ";
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
    echo "
        <script> 
        alert('ขออภัย, ไม่ได้อัปโหลดไฟล์ของคุณ');
        window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=".$cart_status."';
        </script>
        ";
// if everything is ok, try to upload file
 } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {

        $uploadOk = 3;
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } 
 }


 if ($uploadOk == 3) {
	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
	$bp_id = isset($_GET["bp_id"])?$_GET["bp_id"]:'';
	$cart_id = isset($_GET["cart_id"])?$_GET["cart_id"]:'';
    $cart_status = isset($_GET["cart_status"])?$_GET["cart_status"]:'';
	$status = isset($_POST["status"])?$_POST["status"]:'';
    $bp_date_startorder = isset($_POST["bp_date_startorder"])?$_POST["bp_date_startorder"]:'';
	//$delivery = isset($_GET["delivery"])?$_GET["delivery"]:'';
    $sql_check_user = "SELECT * FROM bill_products where cart_id ='".$cart_id."'";
    $result_check_user = $conn->query($sql_check_user);

    //date for confrim order
        date_default_timezone_set('Asia/Bangkok');
        $datenow = date("Y-m-d h:i:s",strtotime("now"));

	if (mysqli_num_rows($result_check_user) > 0 ) {
        $sql ="UPDATE bill_products SET b_img='$file_name',status=1, bp_date_uploadpayment='$datenow' WHERE cart_id='".$cart_id."'";
        $result = $conn->query($sql);
		// echo $conn->error;
  //       echo "successs";
		echo "
		<script> 
		alert('บันทึกเลขที่คำสั่งซื้อนี้แล้ว');
		window.location.href ='../profile_myorder.php';
		</script>
		";
	}
	else{
        //echo "Error updated record: " . $conn->error;
        echo "
 		<script> 
 		alert('ไม่มีเลขที่คำสั่งซื้อนี้');
 		window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=".$cart_status."';
 		</script>
 		";
    }
}
}
?>
