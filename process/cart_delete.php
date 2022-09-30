<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$cart_p_id = htmlspecialchars( isset($_GET['cart_p_id'])?$_GET['cart_p_id']:'');
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
 	$pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');
 	$pd_Ready= ISSET($_POST["product_count"])?$_POST["product_count"]:'';
 	$pd_book= ISSET($_POST["pd_book"])?$_POST["pd_book"]:'';

// UPDATE PRODUCT ADD WITH ADD TO CART
 	$sql1 = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart_product_list.cart_p_id='$cart_p_id'";
 	$result1 = $conn->query($sql1);
 	while ( $row1 = $result1->fetch_assoc()) {
 		$pd_id_tmp = $row1["pd_id"];
 		$pd_book_tmp = $row1["pd_book"];
 		$pd_tmp = $row1["count"];
 		$pd_storge =  $row1["pd_Ready"];
 		$pd_sum = $pd_storge + $pd_tmp;
 		$pd_book_delete = $pd_book_tmp - $pd_tmp;
 		// echo $pd_book_delete." ".$pd_sum;
 		// exit();
 		$sql3 = "UPDATE products SET pd_Ready='$pd_sum', pd_book='$pd_book_delete' WHERE pd_id='$pd_id_tmp'";
 		$result3 = $conn->query($sql3);
 	//echo $pd_id_tmp,$pd_balance_sum,$pd_balance_tmp ;
 	}
// echo $conn->error;
//  		exit;
 	$sql = "DELETE  FROM cart_product_list where cart_p_id='$cart_p_id'";
 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		$sql2= "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id=cart_product_list.cart_id WHERE cart_user_id='$user_id' and cart_status = 0";
 		$result2 = $conn->query($sql2);

 		if (mysqli_num_rows($result2) == 0) {
 			$sql3 = "DELETE  FROM cart where cart_user_id='$user_id' and cart_status=0";
 			$result3 = $conn->query($sql3);

 		}
 		else{

 		}
 		echo "
 		<script>
 		window.location.href='../cart.php';
 		</script>
 		";
 	} else {
 		echo "Error deleting record: " . $conn->error;
 	}
 }

 $conn->close();

 ?>