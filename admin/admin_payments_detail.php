<?php session_start();
include "../process/connect.php";
?>
<?php
  if (!isset($_SESSION['user_id'])) { //check session
    echo "
    <script>
    window.location.href='../login.php';
    </script>
    ";
  }else{?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Nichetel Communications - Payments</title>

      <!-- Custom fonts for this template -->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="css/sb-admin-2.min.css" rel="stylesheet">

      <!-- Custom styles for this page -->
      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

      <!-- Page Wrapper -->
      <div id="wrapper">

        <?php include "../components/allMenu.php";?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary">รายละเอียดสินค้า</h4>
            </div>
            <br>
            <div class="container">

              <div class="billing_details">
                <div class="row">
                  <div class="col-lg-12">
                    <?php
                    $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                    ?>
                    <form class="row contact_form" action="./process/uploadslip.php?cart_id=<?php echo $cart_id; ?>" method="post" novalidate="novalidate" enctype="multipart/form-data">
                      <div class="col-lg-10 container">
                        <h3>แจ้งการโอนเงิน</h3>
                        <div class="col-lg-12">

                          <div class="order_details_iner">
                            <div class="bg-light d-flex justify-content-between">
                              <?php 
                              $status= ISSET($_GET["status"])?$_GET["status"]:'';
                              $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                              $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                              $sql = "SELECT * FROM  bill_products WHERE cart_id = '$cart_id'";
                              $result = $conn->query($sql);
                              $cart_code = "B-".str_pad($cart_id, 6, "0", STR_PAD_LEFT);
                              $status_bill;
                              if ($status== 1) {
                                $status_bill = "โอนเงินแล้ว";
                              }else if ($status== 2) {
                                $status_bill = "กำลังเตรียมจัดส่ง";
                              }else if ($status== 3) {
                                $status_bill = "จัดส่งเรียบร้อยแล้ว";
                              }else{
                                $status_bill = "รอชำระเงิน";
                              }
                              ?>
                              <div><h3>คำสั่งซื้อ: <?php echo $cart_code;?></h3><h3>วันที่ทำรายการ: <?php echo $bp_date_startorder;?></h3></div>
                              <h3>สถานะ :<div style="color:#000000;background-color:#6DFCED;"> <?php echo $status_bill; ?></div>

                              </div>
                            </h3>
                            <br>
                            <table class="table table-borderless">
                              <thead>
                                <tr>
                                  <th scope="col"></th>
                                  <th scope="col" colspan="2">รายการสินค้า</th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col">ราคาต่อหน่วย</th>
                                  <th scope="col">จำนวน</th>
                                  <th scope="col">ราคารวม</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');
                                $bp_id = isset($_GET["bp_id"])?$_GET["bp_id"]:'';
                                $address_id= ISSET($_GET["address_id"])?$_GET["address_id"]:'';
                                $cart_user_id= ISSET($_GET["cart_user_id"])?$_GET["cart_user_id"]:'';
                                $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                                $delivery_number= ISSET($_GET["delivery_number"])?$_GET["delivery_number"]:'';

                                $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
                                $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

                                $sql = "SELECT * FROM  bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id INNER JOIN promotions ON products.p_id = promotions.p_id WHERE bill_products.cart_id = '".$cart_id."' ORDER BY cart_p_id DESC";
                                $result = $conn->query($sql);
                                $sum_tatol_discount_price = 0;
                                if ($result->num_rows > 0) {
                                  $i = 1;
                                  while ($row = $result->fetch_assoc()) {
                                    $discount_price = $row["pd_price"] - $row["pd_price"]*($row["p_percent"]/100);
                      //echo $row["p_percent"];
                                    $product_price = $row["pd_price"];
                                    $tatol_discount_price = $discount_price*$row["count"];
                                    $sum_tatol_discount_price+=$tatol_discount_price;
                                    echo '
                                    <tr>
                                    <th><span>'.$i.'.</span></th>
                                    <th colspan="2">
                                    <div class="media">
                                    <div class="d-flex">
                                    <img src="../image/uploads/products/'.$row["pd_img"].'" alt="" class="img-responsive img-thumbnail" width="100" height="100" />
                                    </div>
                                    <div class="media-body">
                                    <th colspan="3"><span>'.$row["pd_name"].'</span></th>
                                    </div>
                                    </div>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> <span>฿'.number_format($discount_price,2).'</span></th>    
                                    <th>x '.$row["count"].'</th>
                                    <th> <span id="tatol_discount_price'.$row["cart_p_id"].'"class="last">฿'.number_format($tatol_discount_price,2).'</span></th>
                                    </tr>

                                    ';
                                    $i++;
                                  }
                                }
                                echo $conn->error;
                                ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col" colspan="2">ยอดรวม</th>
                                  <?php echo '<input type="hidden" name="" id="sum_tatol_discount_price_hidden" value="'.$sum_tatol_discount_price.'">'; ?>
                                  <th scope="col" id="sum_tatol_discount_price">฿<?php echo number_format($sum_tatol_discount_price,2); ?></th>
                                  <th scope="col"></th>
                                </tr>
                                <tr>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col" colspan="2">ค่าจัดส่ง</th>
                                  <?php echo '<input type="hidden" name="" id="delivery" value="">'; ?>
                                  <th scope="col" >
                                    ฿<span id="delivery_budget"><?php echo number_format(0,0); ?></span>.00 
                                  </th>
                                  <th scope="col"></th>
                                </tr>
                                <tr>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col" colspan="2">ยอดรวมทั้งสิ้น</th>
                                  <?php echo '<input type="hidden" name="" id="sum_tatol_discount_price_hidden2" value="'.$sum_tatol_discount_price.'">'; ?>
                                  <th scope="col" id="sum_tatol_discount_price2"style="color:#000000;background-color:#6DFCED;">฿<?php echo number_format($sum_tatol_discount_price,2); ?> .00 </th>
                                  <th scope="col"></th>
                                </tr>

                                <tr>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col" ></th>
                                  <!-- <th scope="col"></th> -->
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" style="margin-left: 120px;">
                      <h3>ที่อยู่จัดส่ง</h3>
                      <?php 

                      $sql = "SELECT * FROM bill_products INNER JOIN address ON bill_products.address_id = address.ad_id INNER JOIN users ON address.ad_user_id = users.user_id where  bill_products.bp_id = '$bp_id'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row1 = $result->fetch_assoc()) { ?>
                        <hr>
                        <div style="font-size: 18px">
                          <div class="form-group">
                            <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">ชื่อ - นามสกุล :&nbsp;&nbsp;</label>
                            <?php echo $row1["ad_name"]; ?>
                          </div>
                          <div class="form-group" style="font-size: 14px">
                            <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">โทรศัพท์ :&nbsp;&nbsp;</label>
                            <?php echo $row1["ad_tel"]; ?>
                          </div>
                          <div class="form-group" style="font-size: 14px">
                            <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">ที่อยู่ :&nbsp;&nbsp;</label>
                            <?php echo $row1["ad_etc"]; ?>&nbsp;&nbsp;ตำบล<?php echo $row1["ad_district"]; ?>&nbsp;&nbsp;อำเภอ<?php echo $row1["ad_amphur"]; ?>&nbsp;&nbsp;จังหวัด<?php echo $row1["ad_province"]; ?>&nbsp;&nbsp;<?php echo $row1["ad_postcode"]; ?><br>
                          </div>
                        </div>
                        <br>
                        <hr>
                      <?php  }
                    } else {
                      echo "0 results";
                    }
                    ?>
                  </div>
                  <?php 
                  $hide_uploadslip = "";
                  if ($status == 1) {
                    $hide_uploadslip = "hidden";
                    echo '
                    <div class="col-md-12 form-group p_star">
                    <label class="m-0 font-weight-bold text-warning" '.$hide_uploadslip.'>แนบหลักฐานการโอนเงิน</label>
                    <input type="file" class="form-control form-control-user" id="fileToUpload" placeholder="" name="fileToUpload" value="" required="" '.$hide_uploadslip.'>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="col-md-4 form-group p_star " '.$hide_uploadslip.'>
                    <button class="btn btn-primary" '.$hide_uploadslip.'>
                    ยืนยัน
                    </button>
                    </div>';
                  }else if ($status == 0) {
                   echo '
                   <div class="col-md-12 form-group p_star">
                   <label class="m-0 font-weight-bold text-warning" '.$hide_uploadslip.'>แนบหลักฐานการโอนเงิน</label>
                   <input type="file" class="form-control form-control-user" id="fileToUpload" placeholder="" name="fileToUpload" value="" required="" '.$hide_uploadslip.'>
                   </div>
                   <br>
                   <br>
                   <br>
                   <br>
                   <div class="col-md-4 form-group p_star " '.$hide_uploadslip.'>
                   <button class="btn btn-primary" '.$hide_uploadslip.'>
                   ยืนยัน
                   </button>
                   </div>';
                 }else if ($status == 2 or $status == 3) {
                  echo '
                  <div><h3>หมายเลขพัสดุ : <label style="color:#000000;background-color:#6DFCED;">'.$delivery_number.'</label></h3></div>
                  ';
                }

                ?>
                <br>
                <br>
                <br>
                <br>
                <br>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <a href="./payments.php"><button class="btn btn-success btn-user btn-block" type="button">
        ย้อนกลับ
      </button></a>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include "../components/footer.php";?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">คุณต้องการจะออกจากระบบ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">โปรดเลือก "ตกลง" เพื่อทำการออกจากระบบ.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-primary" href="./process/logout.php">ตกลง</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script type="text/javascript">
  // var check_on_page = 0;
  var sum_tatol_discount_price_1 = <?php echo $sum_tatol_discount_price; ?>;
  if (sum_tatol_discount_price_1>=3000) { 
    $("#delivery_budget").text(0);
    var sum =0 ;
    sum = parseFloat($("#delivery_budget").text()) + (Number.parseFloat($("#sum_tatol_discount_price_hidden2").val()));

    $("#sum_tatol_discount_price2").text("฿"+numberWithCommas(sum.toFixed(2)));

    $("input[name='delivery']").change(function() {
      sum =0 ;
      $("#delivery_budget").text($(this).val());
      sum = parseFloat($("#delivery_budget").text()) + (Number.parseFloat($("#sum_tatol_discount_price_hidden2").val()));

      $("#sum_tatol_discount_price2").text("฿"+0+ ".00");
    // $("#sum_tatol_discount_price_hidden2").val(sum);
    
  });
  }else{
    $("#delivery_budget").text(50);
    var sum =0 ;
    sum = parseFloat($("#delivery_budget").text()) + (Number.parseFloat($("#sum_tatol_discount_price_hidden2").val()));

    $("#sum_tatol_discount_price2").text("฿"+numberWithCommas(sum.toFixed(2)));

    $("input[name='delivery']").change(function() {
      sum =0 ;
      $("#delivery_budget").text($(this).val());
      sum = parseFloat($("#delivery_budget").text()) + (Number.parseFloat($("#sum_tatol_discount_price_hidden2").val()));

      $("#sum_tatol_discount_price2").text("฿"+numberWithCommas(sum.toFixed(2)));
    // $("#sum_tatol_discount_price_hidden2").val(sum);
    
  });
  }

  function numberWithCommas2(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
  }
</script>

</body>
<?php } ?>
</html>
