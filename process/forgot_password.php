 <?php

 include './connect.php';



 $user_username = isset($_POST["user_username"])?$_POST["user_username"]:'';

 $user_password = isset($_POST["user_password"])?$_POST["user_password"]:'';

 $user_repassword = isset($_POST["user_repassword"])?$_POST["user_repassword"]:'';



 $user_password = md5($user_password);

 $user_repassword = md5($user_repassword);



 $sql_u = "SELECT user_username FROM users WHERE user_username='$user_username'";

 $result_u = $conn->query($sql_u);

 $row = $result_u->fetch_assoc();



 if ($user_username == $row["user_username"]) {

 	

 	if($user_password == $user_repassword) {



 		$sql = "UPDATE users SET user_password='$user_password' WHERE user_username='$user_username'  ";

 		$result = $conn->query($sql);

 		if ($result === TRUE ) {

 			echo "

 			<script>

 			alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');

 			window.location.href='../forgotpassword.php';

 			</script>

 			";

 		} else {

 			echo "Error updated record: " . $conn->error;

 		}

 	}else{

 		echo "

 		<script> 

 		alert('รหัสผ่านไม่ตรงกัน');

 		window.location.href ='../forgotpassword.php';

 		</script>"; 

 	}

 }else{

	echo "
 	<script> 
 	alert('ไม่มีชื่อผู้ใช้นี้ในระบบ!!');
 	window.location.href ='../forgotpassword.php';
 	</script>";  }



 $conn->close();



 ?>