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

 	$user_username = isset($_POST["user_username"])?$_POST["user_username"]:'';
 	$user_password = isset($_POST["user_password"])?$_POST["user_password"]:'';
 	$user_name = isset($_POST["user_name"])?$_POST["user_name"]:'';
 	$user_email = isset($_POST["user_email"])?$_POST["user_email"]:'';

 	$user_password = md5($user_password);

 	$sql = "UPDATE users SET user_username='$user_username',user_password='$user_password',user_name='$user_name',user_email='$user_email' WHERE user_id='$user_id'";

 	$result = $conn->query($sql);

 	if ($result === TRUE) {
 		echo " 
 		<script>
 		window.location.href='../admin/users.php';
 		</script>
 		";
 	} else {
 		echo "Error updated record: " . $conn->error;
 	}
 }
 $conn->close();

 ?>