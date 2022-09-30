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
 	
 	$user_email = htmlspecialchars( isset($_POST['user_email'])?$_POST['user_email']:'');
 	$user_pre_name = htmlspecialchars( isset($_POST['user_pre_name'])?$_POST['user_pre_name']:'');
 	$user_last_name = htmlspecialchars( isset($_POST['user_last_name'])?$_POST['user_last_name']:'');
 	$user_name = htmlspecialchars( isset($_POST['user_name'])?$_POST['user_name']:'');
 	$user_birthday = htmlspecialchars( isset($_POST['user_birthday'])?$_POST['user_birthday']:'');
 	$user_age = htmlspecialchars( isset($_POST['user_age'])?$_POST['user_age']:'');
 	$user_sex = isset($_POST['user_sex'])?$_POST['user_sex']:'';
 	$user_tel = htmlspecialchars( isset($_POST['user_tel'])?$_POST['user_tel']:'');


 	$sql = "UPDATE users SET user_email='$user_email',user_pre_name='$user_pre_name',user_last_name='$user_last_name',user_name='$user_name',user_birthday='$user_birthday',user_age='$user_age',user_age='$user_age',user_sex='$user_sex',user_tel='$user_tel' WHERE user_id='$user_id'";
 	$result = $conn->query($sql);
 	if ($result === TRUE ) {
		// echo "Error updated record: " . $conn->error;
 		echo "
 		<script>
 		window.location.href='../profile.php'
 		</script>
 		";
 	} else {
 		echo "Error updated record: " . $conn->error;
 	// echo "
 	// <script> 
 	// alert('มีการกรอกข้อมูลซ้ำ');
 	// window.location.href ='../users-control-edit.php';
 	// </script>
 	// ";
 	}
 }

 $conn->close();

 ?>