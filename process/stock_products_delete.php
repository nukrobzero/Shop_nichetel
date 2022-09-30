<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	
 	$stock_id = htmlspecialchars( isset($_GET['stock_id'])?$_GET['stock_id']:'');
 	
 	$sql = "DELETE  FROM stock_products where stock_id= '$stock_id'";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo "
 		<script>
 		window.location.href='../admin/stock_products.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }
 $conn->close();

 ?>