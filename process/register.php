<?php
include './connect.php';


$user_username = isset($_POST["user_username"])?$_POST["user_username"]:'';
$user_password = isset($_POST["user_password"])?$_POST["user_password"]:'';
$user_repassword = isset($_POST["user_repassword"])?$_POST["user_repassword"]:'';
$user_status = isset($_POST["user_status"])?$_POST["user_status"]:'';
$user_email = isset($_POST["user_email"])?$_POST["user_email"]:'';

$user_password = md5($user_password);
$user_repassword = md5($user_repassword);
if($user_password == $user_repassword) {
	

	$sql_u = "SELECT * FROM users WHERE user_username = '$user_username'";
	$sql_e = "SELECT * FROM users WHERE user_email = '$user_email'";
	$result_u = $conn->query($sql_u);
	$result_e = $conn->query($sql_e);


	if ($result_u->num_rows > 0) {
		$row = $result_u->fetch_assoc();
		echo "
		<script> 
		alert('ชื่อผู้ใช้นี้ถูกใช้งานแล้ว');
		window.location.href ='../login.php';
		</script>
		";
	}
	else if ($result_e->num_rows > 0) {
		$row = $result_e->fetch_assoc();
		echo "
		<script> 
		alert('อีเมล์นี้ถูกใช้งานแล้ว');
		window.location.href ='../login.php';
		</script>
		";
	}
	else{
		// CONFIC VALUES
		$id_prefix ="USER-"; 
		$id_length = 4;
		$id_insert = "";

		$sql_last_id = "SELECT MAX(user_id) as user_ids FROM users ";
		$result_last_id = $conn->query($sql_last_id);
		$row_last_id = $result_last_id->fetch_assoc();

		// echo -$id_length;
		if ($row_last_id["user_ids"]==""){
			$id_num = 1;
		}
		else{
			$new_id = intval (substr($row_last_id["user_ids"], -$id_length) );
			$id_num = $new_id+1;
		}

		$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
		$id_insert = $id_prefix.$id_with_zero;

		$sql = "INSERT INTO users (user_id,user_username,user_password,user_email)
		VALUES ('$id_insert','$user_username','$user_password','$user_email') ";
		$result = $conn->query($sql);

		if ($result) {
			echo "
			<script> 
			alert('สมัครสมาชิกสำเร็จ!!!');
			window.location.href ='../login.php';
			</script>
			";
		}
		else{
			echo mysqli_error($conn);
			echo "เกิดข้อผิดพลาด!";
		}
	}
}
else{
	echo "
	<script> 
	alert('รหัสผ่านไม่ตรงกัน');
	window.location.href ='../login.php';
	</script>"; 
}
?>
