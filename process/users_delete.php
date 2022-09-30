<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	
 	$user_id = htmlspecialchars( isset($_GET['user_id'])?$_GET['user_id']:'');
 	
 	$sql = "DELETE  FROM users where user_id=$user_id";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo "
 		<script>
 		window.location.href='../admin/users.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }
 $conn->close();

 ?>