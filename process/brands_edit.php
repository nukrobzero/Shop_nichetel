<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$cg_id = htmlspecialchars( isset($_GET['cg_id'])?$_GET['cg_id']:'');
 	$cg_name_type = htmlspecialchars( isset($_POST['cg_name_type'])?$_POST['cg_name_type']:'');

 	$sql = "UPDATE category SET cg_name_type='$cg_name_type' WHERE cg_id='$cg_id'";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo " 
 		<script>
 		window.location.href='../admin/category.php';
 		</script>
 		";
 	} else {
 	//echo "Error updated record: " . $conn->error;
 		echo "
 		<script> 
 		alert('มีการกรอกข้อมูลซ้ำ');
 		window.location.href ='../admin/category-edit.php?cg_id=".$cg_id."';
 		</script>
 		";
 	}
 }

 $conn->close();

 ?>