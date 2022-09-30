<?php session_start();
include './connect.php';

$username = isset($_POST['username'])?$_POST['username']:'';
$password = isset($_POST['password'])?$_POST['password']:'';
$password = md5($password);

$sql_u = "SELECT * FROM users WHERE user_email = '$username' or user_username = '$username' and user_password = '$password' ";
$result_u = $conn->query($sql_u);


if ($result_u->num_rows > 0) {
	$row = $result_u->fetch_assoc();
	$_SESSION["user_username"] = $username;
	$_SESSION["user_id"] = $row["user_id"];
	$_SESSION["user_status"] = $row["user_status"];
	//echo 1;
	echo "
	<script>
	window.location.href='../index.php';
	</script>
	";
}
else {
	$sql_s = "SELECT * FROM administrator WHERE admin_id = '$username' or admin_username = '$username' and admin_password = '$password' ";
	$result_s= $conn->query($sql_s);

	if ($result_s->num_rows > 0) {
		$row = $result_s->fetch_assoc();
		$_SESSION["user_username"] = $username;
		$_SESSION["user_id"] = $row["admin_id"];
		$_SESSION["user_status"] = $row["admin_status"];
		//echo 2;
		echo "
		<script>
		window.location.href='../admin/index.php';
		</script>
		";
	}
	else {
		//echo 3;
		echo "
		<script>
		alert('ผู้ใช้ หรือ รหัสผ่าน ผิดพลาด');
		window.location.href='../login.php';
		</script>
		";
	}
}
$conn->close();
?>