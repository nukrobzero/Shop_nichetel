 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$stock_id = htmlspecialchars( isset($_GET['stock_id'])?$_GET['stock_id']:'');

 	$stock_name = isset($_POST["stock_name"])?$_POST["stock_name"]:'';
 	$stock_address = isset($_POST["stock_address"])?$_POST["stock_address"]:'';
 	$stock_tel = isset($_POST["stock_tel"])?$_POST["stock_tel"]:'';
 	$stock_detail = isset($_POST["stock_detail"])?$_POST["stock_detail"]:'';
 	$stock_status = isset($_POST["stock_status"])?$_POST["stock_status"]:'';
 		$sql = "UPDATE stock_products SET stock_name='$stock_name', stock_address='$stock_address', stock_tel='$stock_tel', stock_detail='$stock_detail', stock_status=1 WHERE stock_id = '$stock_id'";
 		$result = $conn->query($sql);

 		if ($result === TRUE) {
 			echo " 
 			<script>
 			alert('แก้ไขข้อมูลคลังสินค้าสำเร็จ!!!');
 			window.location.href='../admin/stock_products.php';
 			</script>
 			";
 		} else {
 			echo "Error updated record: " . $conn->error;
 		}
 	}
 $conn->close();

 ?>