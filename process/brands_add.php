<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$brand_name = isset($_POST["brand_name"])?$_POST["brand_name"]:'';
 	$cg_name_type = isset($_POST["cg_name_type"])?$_POST["cg_name_type"]:'';

 	$sql = "INSERT INTO brand_products (brand_name, cg_id)
 	VALUES ('$brand_name', '$cg_name_type') ";
 	$result = mysqli_query($conn,$sql);

 	if ($result) {
 		echo "
 		<script> 
 		window.location.href ='../admin/brands.php';
 		</script>
 		";
 	}
 	else{
	// echo mysqli_error($conn);
	// echo "เกิดข้อผิดพลาด!";
 		echo "
 		<script> 
 		alert('มีการกรอกข้อมูลซ้ำ');
 		window.location.href ='../admin/brands-add.php';
 		</script>
 		";
 	}
 }

 ?>
