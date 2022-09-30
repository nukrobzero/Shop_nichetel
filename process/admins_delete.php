<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	
 	$admin_id = htmlspecialchars( isset($_GET['admin_id'])?$_GET['admin_id']:'');
 	
 	$sql = "DELETE  FROM administrator where admin_id= '$admin_id'";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo "
 		<script>
 		window.location.href='../admin/admins.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }
 $conn->close();

 ?>