<?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 $p_id = htmlspecialchars( isset($_GET['p_id'])?$_GET['p_id']:'');
    $sql ="SELECT * FROM promotions where p_id='$p_id' ";
 	$result_product = $conn->query($sql);
 	$row_product = $result_product->fetch_assoc();
 	$image = $row_product["p_img"];

 	$sql = "DELETE  FROM promotions where p_id='$p_id'";
 	$result = $conn->query($sql);

 	if ($image!= ''){
 		$file_path = "../image/uploads/promotions/".$image;
 		unlink($file_path);
 	}
 


 if ($result === TRUE) {
 	echo "
 	<script>
 	window.location.href='../admin/promotions.php';
 	</script>
 	";
 } else {
 	echo "Error deleting record: " . $conn->error;
 }
}

 $conn->close();

 ?>