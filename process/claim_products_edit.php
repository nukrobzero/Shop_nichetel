 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$claim_id = htmlspecialchars( isset($_GET['claim_id'])?$_GET['claim_id']:'');

 	$claim_name = isset($_POST["claim_name"])?$_POST["claim_name"]:'';
	$claim_product_name = isset($_POST["claim_product_name"])?$_POST["claim_product_name"]:'';
	$claim_no = isset($_POST["claim_no"])?$_POST["claim_no"]:'';
	$claim_detail = isset($_POST["claim_detail"])?$_POST["claim_detail"]:'';
	$claim_tel = isset($_POST["claim_tel"])?$_POST["claim_tel"]:'';
	$claim_email = isset($_POST["claim_email"])?$_POST["claim_email"]:'';


	$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

 	$sql = "UPDATE claim_products SET claim_name='$claim_name',claim_product_name='$claim_product_name',claim_no='$claim_no',claim_detail='$claim_detail',claim_tel='$claim_tel',claim_email='$claim_email' WHERE claim_id='$claim_id'";

 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo " 
 		<script>
 		alert('แก้ไขข้อมูลสำเร็จ');
 		window.location.href='../admin/claim_products.php';
 		</script>
 		";
 	} else {
 		echo "Error updated record: " . $conn->error;
 	}
 }
 $conn->close();

 ?>