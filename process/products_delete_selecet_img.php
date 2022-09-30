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
 	$gallery_id = htmlspecialchars( isset($_GET['gallery_id'])?$_GET['gallery_id']:'');
 	$sql ="SELECT * FROM gallery_products where gallery_id='$gallery_id' ";
 	$result_product = $conn->query($sql);
 	while ($row_product = $result_product->fetch_assoc()){
 		$image = $row_product["file_name"];
 		$file_path = "../image/uploads/products/".$image;
 		$results[ $image ]=@unlink( $file_path );
 	}


 	$sql = "DELETE  FROM gallery_products where gallery_id='$gallery_id'";
 	$result = $conn->query($sql);    

 	echo "
 	<script>
 	window.location.href='../admin/products_edit.php?pd_id=".$pd_id." ';
 	</script>
 	";

 }

 $conn->close();

 ?>