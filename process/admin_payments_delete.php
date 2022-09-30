 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	alert('กรุณาล็อคอินก่อนซื้อสินค้า!!!');
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$bp_id = htmlspecialchars( isset($_GET['bp_id'])?$_GET['bp_id']:'');
 	$b_img = htmlspecialchars( isset($_GET['b_img'])?$_GET['b_img']:'');
 	$sql_check_image = "SELECT * FROM bill_products WHERE bp_id ='$bp_id'";
 	$result_check_image = $conn->query($sql_check_image);
 	$row_check_image = $result_check_image->fetch_assoc();

 	// if ($row_check_image["b_img"] =='') {
 		//exit();

 	$pd_Ready= ISSET($_POST["product_count"])?$_POST["product_count"]:'';
 	$count =  isset($_POST['count'])?$_POST['count']:'';
 	$bp_id = htmlspecialchars( isset($_GET['bp_id'])?$_GET['bp_id']:'');
 	$cart_id = htmlspecialchars( isset($_GET['cart_id'])?$_GET['cart_id']:'');


 	$sql_product = "SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE bill_products.bp_id = '$bp_id' and cart.cart_status =1";

 	$result_product = $conn->query($sql_product);

 	while ( $row_product = $result_product->fetch_assoc()) {
 		
 		$pd_id_tmp = $row_product["pd_id"];
 		$pd_no_tmp = $row_product["count"];
 		$pd_no_storge =  $row_product["pd_Ready"];
 		$pd_no_storge_book =  $row_product["pd_book"];
 		$pd_no_sum = $pd_no_storge + $pd_no_tmp;
 		$pd_no_book_delete = $pd_no_tmp - $pd_no_storge_book;
 		// echo $row_product["pd_id"]." ".$row_product["count"]." ".$pd_no_sum." ".$pd_no_book_delete."<br>";
 		// exit;
 		$sql2 = "UPDATE products SET pd_Ready='$pd_no_sum', pd_book='$pd_no_book_delete' WHERE pd_id='$pd_id_tmp'";
 		$result2 = $conn->query($sql2);
 	//exit;
 		if ($result2){
 			$sql_delete_cart = "DELETE  FROM cart where cart_id='$cart_id'";
 			$result_delete_cart = $conn->query($sql_delete_cart);

 			if ($result_delete_cart){
 				$sql_delete_bill = "DELETE  FROM bill_products where bp_id='$bp_id'";
 				$result_delete_bill = $conn->query($sql_delete_bill);

 				echo " 
 				<script>
 				window.location.href='../admin/payments.php';
 				</script>
 				";
 			}
 			else{
 				$sql_recheck = "UPDATE products SET pd_no='$pd_no_storge' WHERE pd_id='$pd_id_tmp'";
 				$result_recheck = $conn->query($sql_recheck);
 				echo $conn->error;
 			}

 		}

 	}
 // }else{
 // 	echo "
 // 	<script>
 // 	alert('มีการอัพโหลดรูปภาพ กรุณาตรวจสอบ!!!');
 // 	window.location.href='../admin/payments.php';
 // 	</script>
 // 	";
 // }
 }

 $conn->close();

 ?>