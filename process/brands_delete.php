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

 	$sql = "DELETE  FROM category where cg_id=$cg_id";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo "
 		<script>
 		window.location.href='../admin/category.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }

 $conn->close();

 ?>