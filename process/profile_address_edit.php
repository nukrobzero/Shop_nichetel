<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$ad_id = htmlspecialchars( isset($_GET['ad_id'])?$_GET['ad_id']:'');

 	$ad_name = isset($_POST["ad_name"])?$_POST["ad_name"]:'' ;
 	$ad_tel = isset($_POST["ad_tel"])?$_POST["ad_tel"]:'';
 	$ad_district = isset($_POST["ad_district"])?$_POST["ad_district"]:'';
 	$ad_amphur = isset($_POST["ad_amphur"])?$_POST["ad_amphur"]:'';
 	$ad_province = isset($_POST["ad_province"])?$_POST["ad_province"]:'';
 	$ad_postcode = isset($_POST["ad_postcode"])?$_POST["ad_postcode"]:'';
 	$ad_etc = isset($_POST["ad_etc"])?$_POST["ad_etc"]:'';

 	$sql = "UPDATE address SET ad_name='$ad_name', ad_tel='$ad_tel', ad_district='$ad_district', ad_amphur='$ad_amphur', ad_province='$ad_province', ad_postcode='$ad_postcode', ad_etc='$ad_etc' WHERE ad_id='$ad_id'";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo " 
 		<script>
 		alert('แก้ไขที่อยู่เรียบร้อยแล้ว');
 		window.location.href='../profile_address.php';
 		</script>
 		";
 	} else {
 	//echo "Error updated record: " . $conn->error;
 		echo "
 		<script> 
 		alert('มีการกรอกข้อมูลซ้ำ');
 		window.location.href ='../profile_address_edit.php?ad_id=".$ad_id."';
 		</script>
 		";
 	}
 }

 $conn->close();

 ?>