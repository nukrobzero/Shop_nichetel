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
$pd_id = htmlspecialchars(isset($_GET["pd_id"])?$_GET["pd_id"]:'');
$sql = "SELECT pd_img FROM products WHERE pd_id = '$pd_id'"; 
$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    $target_file2 = $target_dir.$row["pd_img"];                

    $myFile = $target_file2;
    unlink($myFile);
    // unlink($myFile) or die("Couldn't delete file");
}
$target_dir = "../image/uploads/products/";
$target_file = $target_dir;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//random name for image
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
if ($_FILES["fileToUpload"]["size"] > 1024000) {
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

    $sql = "UPDATE products SET pd_img = '$file_name' WHERE pd_id = '$pd_id'"; 
    $result = mysqli_query($conn,$sql);


    if ($result) {
        echo "
        <script> 
        window.location.href ='../admin/products_edit.php?pd_id=$pd_id';
        </script>
        ";
    }
    else{
        echo "Error updated record: " . $conn->error;
    }
}


}
?>
