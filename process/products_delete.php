<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');
 	$sql ="SELECT * FROM gallery_products where pd_id='$pd_id' ";
 	$result_product = $conn->query($sql);
 	while ($row_product = $result_product->fetch_assoc()){
 		$image = $row_product["file_name"];
 		$file_path = "../image/uploads/products/".$image;
 		$results[ $image ]=@unlink( $file_path );
 	}

 	$sql_pd_img ="SELECT * FROM products where pd_id='$pd_id' ";
 	$result_pd_img = $conn->query($sql_pd_img);
 	$row_pd_img = $result_pd_img->fetch_assoc();
 	$image1 = $row_pd_img["pd_img"];


 	$sql = "DELETE  FROM products where pd_id='$pd_id'";
 	$result = $conn->query($sql);    

 	if ($image!= ''){
 		$file_path = "../image/uploads/products/".$image1;
 		unlink($file_path);
 	}

 	if ($result === TRUE) {
 		
 		echo "
 		<script>
 		window.location.href='../admin/products.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }

 $conn->close();

 ?>