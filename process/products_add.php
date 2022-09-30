 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
 	$target_dir = "../image/uploads/products/";
 	$target_file = $target_dir;
 	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

 	$uploadOk = 1;
 	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 	$str = substr(base64_encode(sha1(mt_rand())), 0, 16);
 	$file_name = $str.".".$imageFileType;
 	$target_file2 = $target_dir.$file_name;

// Check if image file is a actual image or fake image
 	if(isset($_POST["submit"])) {
 		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 		if($check !== false) {
 			echo "File is an image - " . $check["mime"] . ".";
 			$uploadOk = 1;
 		} else {
 			echo "File is not an image.";
 			$uploadOk = 0;
 		}
 	}
// Check if file already exists
 	if (file_exists($target_file)) {
 		echo "Sorry, file already exists.";
 		$uploadOk = 0;
 	}
// Check file size
 	if ($_FILES["fileToUpload"]["size"] > 500000) {
 		echo "Sorry, your file is too large.";
 		$uploadOk = 0;
 	}
// Allow certain file formats
 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
 		&& $imageFileType != "gif" ) {
 		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
 	$uploadOk = 0;
 }
// Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
 	echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
 } else {
 	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file2)) {

 		$uploadOk = 3;
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
 	} 
 }


 if ($uploadOk == 3) {
// File upload configuration 
 	$targetDir = "../image/uploads/products/"; 
 	$allowTypes = array('jpg','png','jpeg','gif'); 

 	$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
 	$fileNames = array_filter($_FILES['files']['name']); 
 	if(!empty($fileNames)){ 
 		$pd_id = htmlspecialchars(isset($_POST["pd_id"])?$_POST["pd_id"]:'');
 		if ($pd_id =='') {
 			$brand_name = isset($_POST["brand_name"])?$_POST["brand_name"]:'';
 			$p_name = isset($_POST["p_name"])?$_POST["p_name"]:'';
 			$pd_name = isset($_POST["pd_name"])?$_POST["pd_name"]:'';
 			$pd_price = isset($_POST["pd_price"])?$_POST["pd_price"]:'';
 			$pd_cost = isset($_POST["pd_cost"])?$_POST["pd_cost"]:'';
 			$pd_total_price = isset($_POST["pd_total_price"])?$_POST["pd_total_price"]:'';
 			$pd_profit = isset($_POST["pd_profit"])?$_POST["pd_profit"]:'';
 			$pd_no = isset($_POST["pd_no"])?$_POST["pd_no"]:'';
 			$pd_detail = isset($_POST["pd_detail"])?$_POST["pd_detail"]:'';
 			$pd_date_from_user = isset($_POST["pd_date_from_user"])?$_POST["pd_date_from_user"]:'';
 			$pd_balance = isset($_POST["pd_balance"])?$_POST["pd_balance"]:'';
 			$pd_book = isset($_POST["pd_book"])?$_POST["pd_book"]:'';
 			$pd_Ready = isset($_POST["pd_Ready"])?$_POST["pd_Ready"]:'';
 			$stock_name = isset($_POST["stock_name"])?$_POST["stock_name"]:'';
 			$pd_datasheet = isset($_POST["pd_datasheet"])?$_POST["pd_datasheet"]:'';

 			// CONFIC VALUES
 			$id_prefix ="PD-"; 
 			$id_length = 4;
 			$id_insert = "";

 			$sql_last_id = "SELECT MAX(pd_id) as pd_ids FROM products ";
 			$result_last_id = $conn->query($sql_last_id);
 			$row_last_id = $result_last_id->fetch_assoc();

			// echo -$id_length;
 			if ($row_last_id["pd_ids"]==""){
 				$id_num = 1;
 			}
 			else{
 				$new_id = intval (substr($row_last_id["pd_ids"], -$id_length) );
 				$id_num = $new_id+1;
 			}

 			$id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);
 			$id_insert = $id_prefix.$id_with_zero;

 			if ($pd_balance == '') {
 				$pd_balance = $pd_Ready;

 				//date for Time Set 
 				date_default_timezone_set('Asia/Bangkok');
 				$datenow = date("Y-m-d h:i:s",strtotime("now"));


 				$sql = "INSERT INTO products (pd_id,brand_id,p_id,pd_name,pd_price,pd_cost,pd_total_price,pd_profit,pd_no,pd_detail,pd_date_from_user,pd_balance,pd_book,pd_Ready,stock_id,pd_datasheet,pd_img)
 				VALUES ('$id_insert','$brand_name','$p_name','$pd_name','$pd_price','$pd_cost',0,0,0,'$pd_detail','$datenow','$pd_balance',0,'$pd_Ready','$stock_name','$pd_datasheet','$file_name') ";
 				$result = $conn->query($sql);
 			}else{
 				$sql = "INSERT INTO products (pd_id,brand_id,p_id,pd_name,pd_price,pd_cost,pd_total_price,pd_profit,pd_no,pd_detail,pd_date_from_user,pd_balance,pd_book,pd_Ready,pd_datasheet,pd_img)
 				VALUES ('$id_insert','$brand_name','$p_name','$pd_name','$pd_price','$pd_cost',0,0,0,'$pd_detail','$datenow','$pd_balance',0,'$pd_Ready','$pd_datasheet','$file_name') ";
 			}

 			// echo $conn->error;
 			// exit();
 		}
 		foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
 			$target_file = $targetDir;
 			$target_file = $targetDir . basename($_FILES['files']['name'][$key]); 

            // Check whether file type is valid 
 			$fileType = pathinfo($target_file, PATHINFO_EXTENSION);
 			//random name for image
 			$str = substr(base64_encode(sha1(mt_rand())), 0, 16); 
 			$fileName = $str.".".$fileType;
 			$targetFilePath = $targetDir.$fileName;
 			
 			if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
 				if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 

 					$insertValuesSQL .= "('".$id_insert."','".$fileName."', NOW()),"; 
 					
 				}else{ 
 					$errorUpload .= $_FILES['files']['name'][$key].' | '; 
 				} 
 			}else{ 
 				$errorUploadType .= $_FILES['files']['name'][$key].' | '; 
 			} 
 		} 

 		if(!empty($insertValuesSQL)){ 
 			$insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 

 			$insert = $conn->query("INSERT INTO gallery_products (pd_id, file_name, uploaded_on) VALUES $insertValuesSQL"); 

 			if($insert){ 
 				$errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
 				$errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
 				$errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                //$statusMsg = "Files are uploaded successfully.".$errorMsg; TT
 				echo "
 				<script> 
 				window.location.href ='../admin/products.php';
 				</script>
 				";
 			}else{ 
 				$statusMsg = "Sorry, there was an error uploading your file."; 
 			} 
 		} 

 	}else{ 
 		$statusMsg = 'Please select a file to upload.'; 
 	} 

    // Display status message 
 	echo $statusMsg; 
 } 
}
?>
