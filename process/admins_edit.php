 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$admin_id = htmlspecialchars( isset($_GET['admin_id'])?$_GET['admin_id']:'');

 	$admin_username = isset($_POST["admin_username"])?$_POST["admin_username"]:'';
 	$admin_name = isset($_POST["admin_name"])?$_POST["admin_name"]:'';
 	$admin_password = isset($_POST["admin_password"])?$_POST["admin_password"]:'';
 	$admin_repassword = isset($_POST["admin_repassword"])?$_POST["admin_repassword"]:'';
 	$admin_repassword = md5($admin_repassword);

 	$sql_check_repassword ="SELECT admin_id, admin_password FROM administrator WHERE admin_id='$admin_id' ";
 	$result_check_repassword = $conn->query($sql_check_repassword);
 	$result_check_repassword = $result_check_repassword->fetch_assoc();
 	$admin_password = $result_check_repassword["admin_password"];
 	// echo $admin_password,$admin_repassword;
 	// exit();
 	if ($admin_password == $admin_repassword) {

 		$sql = "UPDATE administrator SET admin_username='$admin_username',admin_name='$admin_name', admin_password='$admin_password' WHERE admin_id = '$admin_id'";
 		$result = $conn->query($sql);

 		if ($result === TRUE) {
 			echo " 
 			<script>
 			window.location.href='../admin/admins.php';
 			</script>
 			";
 		} else {
 			echo "Error updated record: " . $conn->error;
 		}
 	}
 	else{
 		echo "
 		<script> 
 		alert('รหัสผ่านไม่ตรงกัน');
 		window.location.href ='../admin/admins_edit.php?admin_id=".$admin_id."';
 		</script>"; 
 	}
 }
 $conn->close();

 ?>