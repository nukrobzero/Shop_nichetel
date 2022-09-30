<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
 	$sql = "SELECT COUNT(ad_id) AS ad_id_check FROM address WHERE ad_user_id = '$user_id'";
 	$result = $conn->query($sql);
 	$row = $result->fetch_assoc();
 	if ($row["ad_id_check"] > 1) {

 		$ad_id = htmlspecialchars( isset($_GET['ad_id'])?$_GET['ad_id']:'');

 		$sql = "DELETE  FROM address where ad_id=$ad_id";
 		$result = $conn->query($sql);

 		if ($result === TRUE) {
 			echo "
 			<script>
 			window.location.href='../profile_address.php';
 			</script>
 			";
 		} else {
 			echo "Error deleting record: " . $conn->error;
 		}
 	}else{
 		echo "
 		<script>
 		alert('ต้องมีที่อยู่มากกว่า 1');
 		window.location.href='../profile_address.php';
 		</script>
 		";
 	}
 }

 $conn->close();

 ?>