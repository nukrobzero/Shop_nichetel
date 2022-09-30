 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

 	$ad_name = isset($_POST["ad_name"])?$_POST["ad_name"]:'' ;
 	$ad_tel = isset($_POST["ad_tel"])?$_POST["ad_tel"]:'';
 	$ad_district = isset($_POST["ad_district"])?$_POST["ad_district"]:'';
 	$ad_amphur = isset($_POST["ad_amphur"])?$_POST["ad_amphur"]:'';
 	$ad_province = isset($_POST["ad_province"])?$_POST["ad_province"]:'';
 	$ad_postcode = isset($_POST["ad_postcode"])?$_POST["ad_postcode"]:'';
 	$ad_etc = isset($_POST["ad_etc"])?$_POST["ad_etc"]:'';

 	
 	$sql = "INSERT INTO address (ad_user_id,ad_name,ad_tel,ad_district,ad_amphur,ad_province,ad_postcode,ad_etc)
 	VALUES ('$user_id','$ad_name','$ad_tel','$ad_district','$ad_amphur','$ad_province','$ad_postcode','$ad_etc') ";
 	$result = mysqli_query($conn,$sql);


 	if ($result) {
 		echo "
 		<script> 
 		alert('เพิ่มอยู่เรียบร้อยแล้ว');
 		window.location.href ='../profile_address.php';
 		</script>
 		";
 	}
 	else{
 		echo mysqli_error($conn);
 		echo "เกิดข้อผิดพลาด!";
 	}
 }
 ?>
