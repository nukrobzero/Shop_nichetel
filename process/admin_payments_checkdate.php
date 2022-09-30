 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$bp_id = htmlspecialchars( isset($_GET['bp_id'])?$_GET['bp_id']:'');
 	$b_img = htmlspecialchars( isset($_GET['b_img'])?$_GET['b_img']:'');
 	$status = htmlspecialchars( isset($_GET['status'])?$_GET['status']:'');

 	$pd_Ready= ISSET($_POST["pd_Ready"])?$_POST["pd_Ready"]:'';
 	$count =  isset($_POST['count'])?$_POST['count']:'';
 	$b_date = isset($_GET['b_date'])?$_GET['b_date']:'';

//DELETE ORDER 	 
 	date_default_timezone_set('Asia/Bangkok');	
 	$strDateDel = date('Y-m-d h:i:s',strtotime("-3 day"));
 	$sql_check_time_out = "SELECT * FROM bill_products WHERE bp_date_startorder < '".$strDateDel."' and b_img='' and status !=1 and status !=2 and status !=3 ";
 	$result_check_time_out = $conn->query($sql_check_time_out);

 	if ($result_check_time_out->num_rows > 0){
 		while ($row_check_time_out = $result_check_time_out->fetch_assoc()) {
 			$bil_id = $row_check_time_out["bp_id"];
 			$cart_ids = $row_check_time_out["cart_id"];
 			$strSQL = "DELETE FROM bill_products WHERE bp_id = '$bil_id'";
 			$resultSQL = $conn->query($strSQL);

 			if ($bp_id = '$bp_id'){
 				$sql_product = "SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart.cart_status =1 and bill_products.status!=2 and bill_products.status!=3";

 				$result_product = $conn->query($sql_product);
 				while ($row_product = $result_product->fetch_assoc()) {
 					$pd_id_tmp = $row_product["pd_id"];
 					$pd_no_tmp = $row_product["count"];
 					$pd_no_storge =  $row_product["pd_Ready"];
 					$pd_no_storge_book =  $row_product["pd_book"];
 					$pd_no_sum = $pd_no_storge + $pd_no_tmp;
 					$pd_no_book_delete = $pd_no_tmp - $pd_no_storge_book;
 					$cart_id = $row_product["cart_id"];
 					$image = $row_product["b_img"];

 					$sql2 = "UPDATE products SET pd_Ready='$pd_no_sum', pd_book='$pd_no_book_delete' WHERE pd_id='$pd_id_tmp'";
 					$result2 = $conn->query($sql2);

 					$str_del_cart = "DELETE FROM cart WHERE cart_id = '$cart_ids'";
 					$result_del_cart = $conn->query($str_del_cart);

 					if ($image!= ''){
 						$file_path = "../image/uploads/uploadslip/".$image;
 						unlink($file_path);
 					}
 					echo " 
 					<script>
 					window.location.href='../admin/payments.php';
 					</script>
 					";
 				}
 			}
 		}
 	}
 	else{
 		echo " 
 		<script>
 		window.location.href='../admin/payments.php';
 		</script>
 		";
 	}
 }
 $conn->close();

 ?>