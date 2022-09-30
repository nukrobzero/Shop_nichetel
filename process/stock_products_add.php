 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$stock_name = isset($_POST["stock_name"])?$_POST["stock_name"]:'';
 	$stock_address = isset($_POST["stock_address"])?$_POST["stock_address"]:'';
 	$stock_tel = isset($_POST["stock_tel"])?$_POST["stock_tel"]:'';
 	$stock_detail = isset($_POST["stock_detail"])?$_POST["stock_detail"]:'';
 	$stock_status = isset($_POST["stock_status"])?$_POST["stock_status"]:'';

 	// CONFIC VALUES
	$id_prefix ="STOCK-"; 
	$id_length = 4;
	$id_insert = "";

	$sql_last_id = "SELECT MAX(stock_id) as stock_ids FROM stock_products";
	$result_last_id = $conn->query($sql_last_id);
	$row_last_id = $result_last_id->fetch_assoc();

		// echo -$id_length;
	if ($row_last_id["stock_ids"]==""){
		$id_num = 1;
	}
	else{
		$new_id = intval (substr($row_last_id["stock_ids"], -$id_length) );
		$id_num = $new_id+1;
	}

	$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
	$id_insert = $id_prefix.$id_with_zero;

 	$sql = "INSERT INTO stock_products (stock_id,stock_name,stock_address,stock_tel,stock_detail,stock_status)
 	VALUES ('$id_insert','$stock_name','$stock_address','$stock_tel','$stock_detail',1) ";
 	$result = mysqli_query($conn,$sql);


 	if ($result) {
 		echo "
 		<script> 
 		alert('เพิ่มคลังสินค้าสำเร็จ!!!');
 		window.location.href ='../admin/stock_products.php';
 		</script>
 		";
 	}
 	else{
 		echo mysqli_error($conn);
 		echo "เกิดข้อผิดพลาด!";
 	}
 }
 ?>
