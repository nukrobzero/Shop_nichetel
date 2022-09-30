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
 	$pd_Ready = htmlspecialchars( isset($_POST['pd_Ready'])?$_POST['pd_Ready']:'');
 	$pd_balance = htmlspecialchars( isset($_POST['pd_balance'])?$_POST['pd_balance']:'');

 	//for Log
 	//$pd_id = isset($_POST['pd_id'])?$_POST['pd_id']:'';
 	$pd_m_no = htmlspecialchars( isset($_POST['pd_balance'])?$_POST['pd_balance']:'');
 	$pd_m_status = htmlspecialchars( isset($_POST['pd_m_status'])?$_POST['pd_m_status']:'');

 	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

 	$sql_check_no = "SELECT pd_Ready FROM products WHERE pd_id ='$pd_id' ";
 	$result_check_no = $conn->query($sql_check_no);
 	$row_check_no = $result_check_no->fetch_assoc();

 	if ($pd_Ready > $row_check_no["pd_Ready"]) {
 		$pd_balance = $pd_Ready;
 		$sql = "UPDATE products SET pd_Ready='$pd_Ready', pd_balance='$pd_balance' WHERE pd_id='$pd_id'";
 		$result = $conn->query($sql);

 		$sql_log = "INSERT INTO products_movement_log (pd_id,pd_m_no,pd_m_status,pd_m_user)
 		VALUES ('$pd_id','$pd_Ready',0,'$user_id') ";
 		$results_log = mysqli_query($conn,$sql_log);

 	}else{
 		$pd_balance = $pd_Ready;
 		$sql = "UPDATE products SET pd_Ready='$pd_Ready', pd_balance='$pd_balance' WHERE pd_id='$pd_id'";
 		$result = $conn->query($sql);

 		$sql_log = "INSERT INTO products_movement_log (pd_id,pd_m_no,pd_m_status,pd_m_user)
 		VALUES ('$pd_id','$pd_Ready',1,'$user_id') ";
 		$results_log = mysqli_query($conn,$sql_log);

 	}

 	if ($result) {
 		echo "
 		<script> 
 		alert('แก้ไขจำนวนสต๊อกเรียบร้อยแล้ว!!!');
 		window.location.href ='../admin/stock_detail_products.php';
 		</script>
 		";
 	}
 	else{
	// echo mysqli_error($conn);
	// echo "เกิดข้อผิดพลาด!";
 		echo "
 		<script> 
 		window.location.href ='../admin/stock_detail_products.php';
 		</script>
 		";
 	}
 }

 ?>
