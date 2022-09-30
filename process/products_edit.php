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

 	$brand_name = isset($_POST["brand_name"])?$_POST["brand_name"]:'';

 	$p_name = isset($_POST["p_name"])?$_POST["p_name"]:'';

 	$pd_name = isset($_POST["pd_name"])?$_POST["pd_name"]:'';

 	$pd_price = isset($_POST["pd_price"])?$_POST["pd_price"]:'';

 	$pd_cost = isset($_POST["pd_cost"])?$_POST["pd_cost"]:'';

 	$pd_total_price = isset($_POST["pd_total_price"])?$_POST["pd_total_price"]:'';

 	$pd_profit = isset($_POST["pd_profit"])?$_POST["pd_profit"]:'';

 	$pd_no = isset($_POST["pd_no"])?$_POST["pd_no"]:'';

 	$pd_detail = isset($_POST["pd_detail"])?$_POST["pd_detail"]:'';

 	$pd_balance = isset($_POST["pd_balance"])?$_POST["pd_balance"]:'';

 	$pd_book = isset($_POST["pd_book"])?$_POST["pd_book"]:'';

 	$pd_Ready = isset($_POST["pd_Ready"])?$_POST["pd_Ready"]:'';

 	$stock_name = isset($_POST["stock_name"])?$_POST["stock_name"]:'';

 	$pd_datasheet = isset($_POST["pd_datasheet"])?$_POST["pd_datasheet"]:'';



//date for Time

 	date_default_timezone_set('Asia/Bangkok');

 	$datenow = date("Y-m-d h:i:s",strtotime("now"));



 	$sql = "UPDATE products SET brand_id='$brand_name', p_id='$p_name', pd_name='$pd_name', pd_price='$pd_price', pd_cost='$pd_cost', pd_total_price='0', pd_profit='0', pd_no='0', pd_detail='$pd_detail', stock_id='$stock_name', pd_date='$datenow', pd_datasheet='$pd_datasheet' WHERE pd_id='$pd_id'";

 	$result = $conn->query($sql);



 	if ($result === TRUE) {

 		echo " 

 		<script>

 		alert('แก้ไขสินค้าสำเร็จ!!!');

 		window.location.href='../admin/products.php';

 		</script>

 		";

 	} else {

 	//echo "Error updated record: " . $conn->error;

 		echo "

 		<script> 

 		window.location.href ='../admin/products_edit.php?pd_id=".$pd_id."';

 		</script>

 		";

 	}

 }



 $conn->close();



 ?>