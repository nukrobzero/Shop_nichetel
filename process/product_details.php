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

 	$pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');
 	$pd_Ready= ISSET($_POST["product_count"])?$_POST["product_count"]:'';
 	$pd_book= ISSET($_POST["pd_book"])?$_POST["pd_book"]:'';
 	$cart_id = htmlspecialchars( isset($_GET['cart_id'])?$_GET['cart_id']:'');
 	$user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

// echo $pd_Ready."/".$pd_id;
//  exit;
 	$sql1 = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart.cart_user_id = '$user_id' and cart_product_list.pd_id = '$pd_id' and cart.cart_status = 0";
 	$result1 = $conn->query($sql1);
// IF ALREADY HAVE PRODUCT IN CART
 	if (mysqli_num_rows($result1) > 0) {
 		$row1 = $result1->fetch_assoc(); 
 		$new_pd_no = $row1["count"]+$pd_Ready;
 		$cart_p_id = $row1["cart_p_id"];
 		$sql2 =  "UPDATE cart_product_list SET count='$new_pd_no' WHERE cart_p_id='$cart_p_id'";
 		$result2 = $conn->query($sql2);
// UPDATE PRODUCT REDUCE WITH ADD TO CART 
 		$pd_id_tmp = $row1["pd_id"];
 		$pd_no_tmp = $row1["count"];
 		$pd_no_storge =  $row1["pd_Ready"];
 		$pd_no_sum = $pd_no_storge - $pd_no_tmp;
 		$pd_book_db = $pd_no_tmp + $row1["pd_book"];
 		$sql3 = "UPDATE products SET pd_Ready='$pd_no_sum', pd_book='$pd_book_db' WHERE pd_id='$pd_id_tmp'";
 		$result3 = $conn->query($sql3);

 		//echo $pd_no_sum,$pd_no_tmp ;

 		if ($result3 === TRUE) {
 		// echo $conn->error;
 		//exit;
 			echo " 
 			<script>
 			window.location.href='../cart.php?cart_id=".$cart_id."';
 			</script>
 			";
 		} else {
 			echo "Error updated record: " . $conn->error;
 		}

 	}
 	else {
 		$sql_check_user = "SELECT * FROM cart where cart_user_id ='$user_id' and cart_status = 0";
 		$result_check_user = $conn->query($sql_check_user);
 		$row_check_user = $result_check_user->fetch_assoc();

 //NO HAVE ALREADY CART AND CAR PRODUCT LIST
 	// echo $row_check_user;
 		if (mysqli_num_rows($result_check_user)==0){
 			// CONFIC VALUES
 			$id_prefix ="CART-"; 
 			$id_length = 4;
 			$id_insert = "";

 			$sql_last_id = "SELECT MAX(cart_id) as cart_ids FROM cart ";
 			$result_last_id = $conn->query($sql_last_id);
 			$row_last_id = $result_last_id->fetch_assoc();

			// echo -$id_length;
 			if ($row_last_id["cart_ids"]==""){
 				$id_num = 1;
 			}
 			else{
 				$new_id = intval (substr($row_last_id["cart_ids"], -$id_length) );
 				$id_num = $new_id+1;
 			}

 			$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
 			$id_insert = $id_prefix.$id_with_zero;

 			$sql =  "INSERT INTO cart (cart_id,cart_user_id,cart_status)
 			VALUES ('$id_insert','$user_id',0) ";
 			$result = $conn->query($sql);

 			
 			//$last_id = $conn->insert_id;
 			
 			// CONFIC VALUES
 			$id_prefix_c ="CART_P_"; 
 			$id_length_c = 4;
 			$id_insert_c = "";

 			$sql_last_id_c = "SELECT MAX(cart_p_id) as cart_p_ids FROM cart_product_list ";
 			$result_last_id_c = $conn->query($sql_last_id_c);
 			$row_last_id_c = $result_last_id_c->fetch_assoc();

			// echo -$id_length_c;
 			if ($row_last_id_c["cart_p_ids"]==""){
 				$id_num = 1;
 			}
 			else{
 				$new_id = intval (substr($row_last_id_c["cart_p_ids"], -$id_length_c) );
 				$id_num = $new_id+1;
 			}

 			$id_with_zero = str_pad($id_num, $id_length_c, "0", STR_PAD_LEFT);
 			$id_insert_c = $id_prefix_c.$id_with_zero;
 			$sql1 =  "INSERT INTO cart_product_list (cart_p_id,pd_id,cart_id,count)
 			VALUES ('$id_insert_c','$pd_id','$id_insert','$pd_Ready') ";
 			$result1 = $conn->query($sql1);
 			
// echo $conn->error;
// echo $id_insert_c." ".$id_insert ;
//  			exit();
// UPDATE PRODUCT REDUCE WITH ADD TO CART 
 			$sql2 = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart.cart_user_id = '$user_id' and cart_product_list.pd_id = '$pd_id' and cart.cart_status = 0";
 			$result2 = $conn->query($sql2);
 			$row1 = $result2->fetch_assoc();
 			$pd_id_tmp = $row1["pd_id"];
 			$pd_no_tmp = $row1["count"];
 			
 			$pd_no_storge =  $row1["pd_Ready"];
 			$pd_no_sum = $pd_no_storge - $pd_no_tmp;
 			$pd_book_db = $pd_no_tmp + $row1["pd_book"];

 			$sql3 = "UPDATE products SET pd_Ready='$pd_no_sum', pd_book='$pd_book_db' WHERE pd_id='$pd_id_tmp'";
 			$result3 = $conn->query($sql3);
 		//echo $conn->error;
 			//echo $pd_no_sum,$pd_no_tmp ;
 			if ($result === TRUE) {
 			//exit;
 				echo " 
 				<script>
 				window.location.href='../cart.php?cart_id=".$cart_id."';
 				</script>
 				";

 			} else {
 				echo "Error updated record: " . $conn->error;
 			}
 		}
 		else {
 			$last_id = $row_check_user["cart_id"];
 			// CONFIC VALUES
 			$id_prefix_c ="CART_P_"; 
 			$id_length_c = 4;
 			$id_insert_c = "";

 			$sql_last_id_c = "SELECT MAX(cart_p_id) as cart_p_ids FROM cart_product_list ";
 			$result_last_id_c = $conn->query($sql_last_id_c);
 			$row_last_id_c = $result_last_id_c->fetch_assoc();

			// echo -$id_length_c;
 			if ($row_last_id_c["cart_p_ids"]==""){
 				$id_num = 1;
 			}
 			else{
 				$new_id = intval (substr($row_last_id_c["cart_p_ids"], -$id_length_c) );
 				$id_num = $new_id+1;
 			}

 			$id_with_zero = str_pad($id_num, $id_length_c, "0", STR_PAD_LEFT);
 			$id_insert_c = $id_prefix_c.$id_with_zero;

 			$sql1 =  "INSERT INTO cart_product_list (cart_p_id,pd_id,cart_id,count)
 			VALUES ('$id_insert_c','$pd_id','$last_id','$pd_Ready') ";
 			$result1 = $conn->query($sql1);
 			// echo $conn->error;
 			// exit();

// UPDATE PRODUCT REDUCE WITH ADD TO CART  		
 			$sql2 = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id WHERE cart.cart_user_id = '$user_id' and cart_product_list.pd_id = '$pd_id' and cart.cart_status = 0";
 			$result2 = $conn->query($sql2);
 			$row1 = $result2->fetch_assoc();
 			$pd_id_tmp = $row1["pd_id"];
 			$pd_no_tmp = $row1["count"];
 			$pd_no_storge =  $row1["pd_Ready"];
 			$pd_no_sum = $pd_no_storge - $pd_no_tmp;
 			$pd_book_db = $pd_no_tmp + $row1["pd_book"];
 			$sql3 = "UPDATE products SET pd_Ready='$pd_no_sum', pd_book='$pd_book_db' WHERE pd_id='$pd_id_tmp'";
 			$result3 = $conn->query($sql3);
 		//echo $conn->error;
 			//echo $pd_no_sum,$pd_no_tmp ;
 			if ($result1 === TRUE) {
 			//exit;
 				echo " 
 				<script>
 				window.location.href='../cart.php?cart_id=".$cart_id."';
 				</script>
 				";

 			} else {
 				echo "Error updated record: " . $conn->error;
 			}
 		}

 	}
 }


 $conn->close();

 ?>