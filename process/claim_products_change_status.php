<?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 $claim_id = isset($_GET['claim_id'])?$_GET['claim_id']:'';
 $claim_status = isset($_POST["claim_status"])?$_POST["claim_status"]:'';
 $claim_name_chang_status = isset($_POST["claim_name_chang_status"])?$_POST["claim_name_chang_status"]:'';
 $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

 $sql = "UPDATE claim_products SET claim_name_chang_status = '$user_id'	, claim_status = 1  WHERE claim_id='$claim_id'";
 $result = $conn->query($sql);

 if ($result === TRUE) {
 	// echo $conn->error;
 	// exit();
 	echo " 
 	<script>
 	alert('อนุมัติข้อมูลแล้ว');
 	window.location.href='../admin/claim_products.php';
 	</script>
 	";
 } else {
 	echo "Error updated record: " . $conn->error;
 	// echo "
  //       <script> 
  //       alert('มีการกรอกข้อมูลซ้ำ');
  //       window.location.href ='../category-edit.php';
  //       </script>
  //       ";
 }
}
 $conn->close();

 ?>