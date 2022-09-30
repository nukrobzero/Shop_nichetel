<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$cg_name_type = isset($_POST["cg_name_type"])?$_POST["cg_name_type"]:'';

 	$sql = "INSERT INTO category (cg_name_type)
 	VALUES ('$cg_name_type') ";
 	$result = mysqli_query($conn,$sql);

 	if ($result) {
 		echo "
 		<script> 
 		window.location.href ='../admin/category.php';
 		</script>
 		";
 	}
 	else{
	// echo mysqli_error($conn);
	// echo "เกิดข้อผิดพลาด!";
 		echo "
 		<script> 
 		alert('มีการกรอกข้อมูลซ้ำ');
 		window.location.href ='../admin/category-add.php';
 		</script>
 		";
 	}
 }

 ?>
