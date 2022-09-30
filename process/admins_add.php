 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{

 	$admin_username = isset($_POST["admin_username"])?$_POST["admin_username"]:'';
 	$admin_name = isset($_POST["admin_name"])?$_POST["admin_name"]:'';
 	$admin_password = isset($_POST["admin_password"])?$_POST["admin_password"]:'';
 	$admin_repassword = isset($_POST["admin_repassword"])?$_POST["admin_repassword"]:'';

 	$admin_password = md5($admin_password);
 	$admin_repassword = md5($admin_repassword);

if ($admin_password == $admin_repassword) {
 	// CONFIC VALUES
	$id_prefix ="ADMIN-"; 
	$id_length = 4;
	$id_insert = "";

	$sql_last_id = "SELECT MAX(admin_id) as admin_ids FROM administrator";
	$result_last_id = $conn->query($sql_last_id);
	$row_last_id = $result_last_id->fetch_assoc();

		// echo -$id_length;
	if ($row_last_id["admin_ids"]==""){
		$id_num = 1;
	}
	else{
		$new_id = intval (substr($row_last_id["admin_ids"], -$id_length) );
		$id_num = $new_id+1;
	}

	$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
	$id_insert = $id_prefix.$id_with_zero;

 	$sql = "INSERT INTO administrator (admin_id,admin_username,admin_name,admin_password)
 	VALUES ('$id_insert','$admin_username','$admin_name','$admin_password') ";
 	$result = mysqli_query($conn,$sql);


 	if ($result) {
 		echo "
 		<script> 
 		window.location.href ='../admin/admins.php';
 		</script>
 		";
 	}
 	else{
 		echo mysqli_error($conn);
 		echo "เกิดข้อผิดพลาด!";
 	}
 }
 else{
	echo "
	<script> 
	alert('รหัสผ่านไม่ตรงกัน');
	window.location.href ='../admin/admins_add.php';
	</script>"; 
}
 }
 ?>
