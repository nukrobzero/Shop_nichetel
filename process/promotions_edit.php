<?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 $p_id = htmlspecialchars( isset($_GET['p_id'])?$_GET['p_id']:'');

 $p_percent = htmlspecialchars( isset($_POST['p_percent'])?$_POST['p_percent']:'');
 $p_pre_date= htmlspecialchars( isset($_POST['p_pre_date'])?$_POST['p_pre_date']:'');
 $p_pos_date= htmlspecialchars( isset($_POST['p_pos_date'])?$_POST['p_pos_date']:'');
 $p_name= htmlspecialchars( isset($_POST['p_name'])?$_POST['p_name']:'');

 $sql = "UPDATE promotions SET p_percent='$p_percent',p_pre_date='$p_pre_date',p_pos_date='$p_pos_date',p_name='$p_name' WHERE p_id='$p_id'";

 $result = $conn->query($sql);

 if ($result === TRUE) {
 	echo " 
 	<script>
 	window.location.href='../admin/promotions.php';
 	</script>
 	";
 } else {
 	// echo "Error updated record: " . $conn->error;
 	echo "
 	<script> 
 	alert('มีการกรอกข้อมูลซ้ำ');
 	window.location.href ='../admin/promotions-edit.php';
 	</script>
 	";
 }
}
 ?>