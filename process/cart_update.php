<?php session_start();
include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$product_count_item = ( isset($_POST['product_count_item'])?$_POST['product_count_item']:'');
 	$tmp_cart_product_id = ( isset($_POST['tmp_cart_product_id'])?$_POST['tmp_cart_product_id']:'');

 	$pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');
 	$pd_Ready= ISSET($_POST["product_count"])?$_POST["product_count"]:'';
 // $sp_no= ISSET($_POST["product_count"])?$_POST["product_count"]:'';

 	$user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

 // CHECK ERROR
 	$err = 0;
 	foreach ($product_count_item as $index => &$value ) 
 	{
 	//echo $value." ".$tmp_cart_product_id[$index]." ";
 		$cart_product_id = $tmp_cart_product_id[$index];
 		$sql2 =  "UPDATE cart_product_list SET count='$value' WHERE cart_p_id='$cart_product_id'";
 		$result2 = $conn->query($sql2);

 		if ($result2 === TRUE) {
 		// UPDATE PRODUCT REDUCE TO CART 
 			$sql_check_storge = "SELECT * FROM cart_product_list INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart_product_list.cart_p_id='$cart_product_id'";
 			$result_check_storge = $conn->query($sql_check_storge);
 			$row1 = $result_check_storge->fetch_assoc();
 			$pd_tmp_id = $row1["pd_id"];
 			$pd_no_storge =  $row1["pd_Ready"];
 			$pd_no_storge_book =  $row1["pd_book"];
 			$pd_no_sum = $pd_no_storge + $pd_no_storge_book;
 			$pd_no_sum_cart = $pd_no_sum - $value;
 			$sql3 = "UPDATE products SET pd_Ready='$pd_no_sum_cart', pd_book='$value' WHERE pd_id='$pd_tmp_id'";
 			$result3 = $conn->query($sql3);

 		} else {
 			$err++;
 			echo "Error updated record: " . $conn->error;
	 		// echo "
	 		// <script> 
	 		// alert('มีการกรอกข้อมูลซ้ำ');
	 		// window.location.href ='../single-product.php?sp_id=5';
	 		// </script>
 		}

 	}
 	if ($err==0){
 		echo " 
 		<script>
 		window.location.href='../cart.php';
 		</script>
 		";
 	}
 	else{
 		echo "Error updated record";
 	}

 }

 ?>