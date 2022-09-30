 <?php session_start();

 include './connect.php';

 if (!isset($_SESSION['user_id'])) { //check session

    echo "

    <script>

    window.location.href='../login.php';

    </script>

    ";

}else{

    $address_id = isset($_GET["address_id"])?$_GET["address_id"]:'';

    if ($address_id !='') {



        $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;

        $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;



        $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';

        $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';

        $status= ISSET($_GET["status"])?$_GET["status"]:'';

        $b_date= ISSET($_GET["b_date"])?$_GET["b_date"]:'';

        $delivery = isset($_GET["delivery"])?$_GET["delivery"]:'';

        $sum_tatol_discount_price2= ISSET($_GET["sum_tatol_discount_price2"])?$_GET["sum_tatol_discount_price2"]:'';

        $b_payment = isset($_GET["b_payment"])?$_GET["b_payment"]:'';



// echo $delivery.'-'.$status.'-'.$sum_tatol_discount_price2;

// exit;

        $sql_check_user = "SELECT * FROM cart where cart_user_id ='$user_id' and cart_status=0";

        $result_check_user = $conn->query($sql_check_user);



        if (mysqli_num_rows($result_check_user) > 0 ){

            $row_check_user = $result_check_user->fetch_assoc();

            $cart_id = $row_check_user["cart_id"];



    // CONFIC VALUES

            $id_prefix ="BILL-"; 

            $id_length = 4;

            $id_insert = "";



            $sql_last_id = "SELECT MAX(bp_id) as bp_ids FROM bill_products ";

            $result_last_id = $conn->query($sql_last_id);

            $row_last_id = $result_last_id->fetch_assoc();



        // echo -$id_length;

            if ($row_last_id["bp_ids"]==""){

                $id_num = 1;

            }

            else{

                $new_id = intval (substr($row_last_id["bp_ids"], -$id_length) );

                $id_num = $new_id+1;

            }



            $id_with_zero = str_pad($id_num, $id_length, "0", STR_PAD_LEFT);

            $id_insert = $id_prefix.$id_with_zero;





        //date for start order

            date_default_timezone_set('Asia/Bangkok');

            $datenow = date("Y-m-d h:i:s",strtotime("now"));





            $sql = "INSERT INTO bill_products (bp_id,status,delivery,cart_id, price_total, b_payment, address_id, bp_date_startorder, bp_date_uploadpayment, administrator_id, delivery_number, b_img)

            VALUES ('$id_insert',0,'$delivery','$cart_id','$sum_tatol_discount_price2','$b_payment','$address_id','$datenow',0,'','','')";

            $result = mysqli_query($conn,$sql);



            if ($result) {

                $sql2 =  "UPDATE cart SET cart_status='1' WHERE cart_id='".$cart_id."'";

                $result2 = $conn->query($sql2);

        //echo $cart_id,$cart_status,$delivery;

        // exit();

                echo "

                <script> 

                window.location.href ='../payments.php?cart_id=".$cart_id."&cart_status=1';

                </script>

                ";

        //echo $conn->error;

            }

            else{

                echo mysqli_error($conn);

        // echo "เกิดข้อผิดพลาด!";

        // echo "

     //        <script> 

     //        alert('มีการกรอกข้อมูลซ้ำ');

     //        window.location.href ='../checkout.php?user_id='".$user_id."'';

     //        </script>

     //        ";

            }

        }



    }else{

        echo "

        <script> 

        alert('กรุณาเพิ่มที่อยู่จัดส่ง');

        window.location.href ='../checkout.php';

        </script>

        ";

    }

}



?>

