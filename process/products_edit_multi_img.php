 <?php session_start();
 include './connect.php';
 if (!isset($_SESSION['user_id'])) { //check session
 	echo "
 	<script>
 	window.location.href='../login.php';
 	</script>
 	";
 }else{
// File upload configuration 
 	$targetDir = "../image/uploads/products/"; 
 	$allowTypes = array('jpg','png','jpeg','gif'); 

 	$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
 	$fileNames = array_filter($_FILES['files']['name']); 
 	if(!empty($fileNames)){ 
 		$pd_id = htmlspecialchars(isset($_GET["pd_id"])?$_GET["pd_id"]:'');
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

 					$insertValuesSQL .= "('".$pd_id."','".$fileName."', NOW()),"; 

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
 				window.location.href ='../admin/products_edit.php?pd_id=".$pd_id."';
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

 ?>
