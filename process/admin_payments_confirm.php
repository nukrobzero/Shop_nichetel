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

 	if ($row_check_image["b_img"] !='') {

 	$pd_Ready= ISSET($_POST["product_count"])?$_POST["product_count"]:'';
 	$count =  isset($_POST['count'])?$_POST['count']:'';
 	$bp_id = htmlspecialchars( isset($_GET['bp_id'])?$_GET['bp_id']:'');
 	$cart_id = htmlspecialchars( isset($_GET['cart_id'])?$_GET['cart_id']:'');
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
 	$user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;

// echo $bp_id;
//  echo $sub_no[0]."a";
 	$sql_product = "SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE bill_products.bp_id = '$bp_id' and cart.cart_status =1";

 	$result_product = $conn->query($sql_product);

 	while ( $row_product = $result_product->fetch_assoc()) {
 		
 		$pd_id_tmp = $row_product["pd_id"];
 		$pd_no_tmp = $row_product["count"];
 		$pd_no_storge =  $row_product["pd_Ready"];
 		$pd_no_storge_book =  $row_product["pd_book"];
 		$pd_no_storge_balance =  $row_product["pd_balance"];
 		$pd_no_book_delete = $pd_no_tmp - $pd_no_storge_book;
 		$pd_no_balance_confirm = $pd_no_storge_balance - $pd_no_tmp; 
 		// echo $row_product["pd_id"]." ".$pd_no_balance_confirm." ".$pd_no_storge_balance." ".$pd_no_book_delete."<br>";
 		// echo $user_username;
 		// exit;
 		$sql2 = "UPDATE products SET pd_balance='$pd_no_balance_confirm', pd_book='$pd_no_book_delete' WHERE pd_id='$pd_id_tmp'";
 		$result2 = $conn->query($sql2);
 		if ($result2){
 			$sql_update_status = "UPDATE bill_products SET status='2',administrator_id ='$user_username' WHERE bp_id='$bp_id'";
 			$result_update_status = $conn->query($sql_update_status);

 			if ($result_update_status){
 				$sql_update_status_cart = "UPDATE cart SET cart_status='2' WHERE cart_id='$cart_id'";
 				$result_update_status_cart = $conn->query($sql_update_status_cart);
 				echo " 
 				<script>
 				window.location.href='../admin/payments.php';
 				</script>
 				";
 			}
 			else{
 				$sql_recheck = "UPDATE products SET pd_no='$pd_no_storge' WHERE pd_id='$pd_id_tmp'";
 				$result_recheck = $conn->query($sql_recheck);
 			// echo $conn->error;
 			}

 		}

 	}
 }else{
 	echo "
 	<script>
 	alert('ไม่มีการอัพโหลดรูปภาพ กรุณาตรวจสอบ!!!');
 	window.location.href='../admin/payments.php';
 	</script>
 	";
 }
 }
 








//OLD CODE 


// $sql_update_status = "UPDATE bill_products SET status='2',employee_id='$user_id' WHERE bp_id='$bp_id'";
//  $result_update_status = $conn->query($sql_update_status);

//  if ($result_update_status){
//  	echo " 
//  	<script>
//  	window.location.href='../admin_uploadslip.php';
//  	</script>
//  	";
//  }
//  else{
//  	echo "Error updated record: " . $conn->error;
//  }





 ?>