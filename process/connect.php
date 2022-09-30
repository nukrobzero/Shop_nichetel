<?php



// Create connection

$conn = mysqli_connect('localhost','root','','nichetel_shop');

//phpinfo();

//Check connection

if($conn->connect_error){

	echo 'Faild to connect';

}

$conn->set_charset("utf8");







?>