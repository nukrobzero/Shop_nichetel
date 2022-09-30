 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$user_id = htmlspecialchars( isset($_GET['user_id'])?$_GET['user_id']:'');
 	$user_oldpassword = isset($_POST["user_oldpassword"])?$_POST["user_oldpassword"]:'';
 	$user_newpassword = isset($_POST["user_newpassword"])?$_POST["user_newpassword"]:'';
 	$user_repassword = isset($_POST["user_repassword"])?$_POST["user_repassword"]:'';
 	$user_repassword = md5($user_repassword);
 	$user_oldpassword = md5($user_oldpassword);
 	$user_newpassword = md5($user_newpassword);

 	$sql_check_repassword ="SELECT * FROM users WHERE user_id='$user_id' ";
 	$result_check_repassword = $conn->query($sql_check_repassword);
 	$result_check_repassword = $result_check_repassword->fetch_assoc();
 	// echo $user_oldpassword."     ".$result_check_repassword["user_password"];
 	// exit();
 	if ($user_oldpassword == $result_check_repassword["user_password"]) {
 		if ($user_newpassword == $user_repassword) {

 			$sql = "UPDATE users SET user_password='$user_newpassword' WHERE user_id = '$user_id'";
 			$result = $conn->query($sql);

 			if ($result === TRUE) {
 				echo " 
 				<script>
 				alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
 				window.location.href='../profile.php';
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
 			window.location.href ='../profile_change_password.php';
 			</script>"; 
 		}
 	}else{
 		//echo "Error updated record: " . $conn->error;
 		echo "
 		<script> 
 		alert('รหัสผ่านเดิมผิด');
 		window.location.href ='../profile_change_password.php';
 		</script>"; 
 	}
 }
 $conn->close();

 ?>