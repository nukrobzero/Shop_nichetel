 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$user_username = isset($_POST["user_username"])?$_POST["user_username"]:'';
 	$user_password = isset($_POST["user_password"])?$_POST["user_password"]:'';
 	$user_name = isset($_POST["user_name"])?$_POST["user_name"]:'';
 	$user_email = isset($_POST["user_email"])?$_POST["user_email"]:'';

 	$user_password = md5($user_password);

 	$sql = "INSERT INTO users (user_username,user_password,user_name,user_email)
 	VALUES ('$user_username','$user_password','$user_name','$user_email') ";
 	$result = mysqli_query($conn,$sql);


 	if ($result) {
 		echo "
 		<script> 
 		window.location.href ='../admin/users.php';
 		</script>
 		";
 	}
 	else{
 		echo mysqli_error($conn);
 		echo "เกิดข้อผิดพลาด!";
 	}
 }
 ?>
