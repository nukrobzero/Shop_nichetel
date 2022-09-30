<?php session_start();
include "./process/connect.php";
if (!isset($_SESSION['user_id'])) { //check session
  echo "
  <script>
  alert('กรุณาล็อคอิน!!!');
  window.location.href='./login.php';
  </script>
  ";
}else{?>
  <!doctype html>
  <html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nichetel Communications | My Order</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="image/logo/NT-Logosmall.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">




    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  </head>

  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->  

      <!-- Body main wrapper start -->
      <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <?php include "./components/header.php";?>
        <!-- End Header Style -->
        
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
          <!-- Start Search Popap -->
          <div class="search__area">
            <div class="container" >
              <div class="row" >
                <div class="col-md-12" >
                  <div class="search__inner">
                    <form action="./shop_search.php?search=<?php echo $search; ?>" method="get">
                      <input placeholder="Search here... " type="text" name="search">
                      <button type="submit"></button>
                    </form>
                    <div class="search__close__btn">
                      <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Search Popap -->
        </div>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">My Order</h2>
                    <nav class="bradcaump-inner">
                      <a class="breadcrumb-item" href="index.php">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb-item active">My Order</span>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- End Offset Wrapper -->
        <!-- Start Our Product Area -->
        <section class="htc__product__area bg__white">
          <div class="container">
            <?php 
            $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
            $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
            ?>
            <div class="row">
              <br>
              <br>
              <!--Begin Left Menu -->
              <?php include "./components/left_menu_profile.php";?>
              <!-- End Left Menu -->
              <div class="col-md-9">
                <div class="row">
                 <!-- Begin Page Content -->
                 <!-- DataTales Example -->
                 <div class="card shadow mb-3">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="properties__button">
                       <!--Nav Button  -->
                       <div class="form-group">
                        <h3>การซื้อของฉัน</h3>
                        <ul class="nav nav-tabs">
                          <li><a class="active"id="nav-all" href="#nav-all">ทั้งหมด</a></li>
                          <li><a id="nav-payment" href="#nav-payment">ที่ต้องชำระ</a></li>
                          <li><a id="nav-payment-com" href="#nav-payment-com">ชำระแล้ว</a></li>
                          <li><a id="nav-delivery" href="#nav-delivery">ที่ต้องจัดส่ง</a></li>
                          <li><a id="nav-complete" href="#nav-complete">สำเร็จแล้ว</a></li>
                        </ul>
                      </div>
                      <!-- Nav Card -->
                      <div class="nav-all" style="margin-left: 1.5%;">
                        <!-- card one -->
                        <div>
                          <div class="row">
                            <div class="card-body">
                             <?php
                             $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';
                             $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                             $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                             $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                             $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id  WHERE cart_user_id = '".$user_id."' ORDER BY bill_products.bp_id DESC";

                             $result = $conn->query($sql);

                             ?>   
                             <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>ลำดับ</th>
                                    <th>คำสั่งซื้อ</th>
                                    <th>สถานะ</th>
                                    <th>วันที่ทำรายการ</th>
                                    <th>จัดการคำสั่งซื้อ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if ($result->num_rows > 0) {
                                    $i = 1;
                        // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                      $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                                      $status_bill;
                                      if ($row["status"]== 1) {
                                        $status_bill = "รอตรวจสอบ";
                                        echo '
                                        <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$cart_code.'</td>
                                        <td>'.$status_bill.'</td>
                                        <td>'.$row["bp_date_startorder"].'</td>
                                        <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                                        </tr>
                                        ';
                                      }else if ($row["status"]== 2) {
                                        $status_bill = "โอนเงินแล้ว";
                                        echo '
                                        <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$cart_code.'</td>
                                        <td>'.$status_bill.'</td>
                                        <td>'.$row["bp_date_startorder"].'</td>
                                        <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'&delivery_number='.$row["delivery_number"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                                        </tr>
                                        ';
                                      }else if ($row["status"]== 3) {
                                        $status_bill = "จัดส่งเรียบร้อยแล้ว";
                                        echo '
                                        <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$cart_code.'</td>
                                        <td>'.$status_bill.'</td>
                                        <td>'.$row["bp_date_startorder"].'</td>
                                        <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'&delivery_number='.$row["delivery_number"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                                        </tr>
                                        ';    
                                      }else{
                                        $status_bill = "รอชำระเงิน";
                                        echo '
                                        <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$cart_code.'</td>
                                        <td>'.$status_bill.'</td>
                                        <td>'.$row["bp_date_startorder"].'</td>
                                        <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'"style="color:#000000;background-color:#6DFCED;">ชำระเงิน</a></td>
                                        </tr>
                                        ';
                                      }

                                      $i++;                     
                                    } 
                                  } else {
                                    echo "0 results";
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Card two -->
                    <div class="nav-payment hide" style="margin-left: 1.5%;">
                      <div class="row">
                       <div class="card-body">
                         <?php
                         $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';
                         $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                         $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                         $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                         $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id  WHERE cart_user_id = '".$user_id."'and status = 0 or status = 1 ORDER BY bill_products.bp_id DESC";

                         $result = $conn->query($sql);

                         ?>   
                         <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>ลำดับ</th>
                                <th>คำสั่งซื้อ</th>
                                <th>สถานะ</th>
                                <th>วันที่ทำรายการ</th>
                                <th>ชำระเงิน</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ($result->num_rows > 0) {
                                $i = 1;
                        // output data of each row
                                while($row = $result->fetch_assoc()) {
                                  $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                                  $status_bill;
                                  if ($row["status"]== 1) {
                                    $status_bill = "รอตรวจสอบ";
                                  }else if ($row["status"]== 2) {
                                    $status_bill = "โอนเงินแล้ว";
                                  }else{
                                    $status_bill = "รอชำระเงิน";
                                  }
                                  echo '
                                  <tr>
                                  <td>'.$i.'</td>
                                  <td>'.$cart_code.'</td>
                                  <td>'.$status_bill.'</td>
                                  <td>'.$row["bp_date_startorder"].'</td>
                                  <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'"style="color:#000000;background-color:#6DFCED;">ชำระเงิน</a></td>
                                  </tr>
                                  ';
                                  $i++;                     
                                } 
                              } else {
                                echo "0 results";
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>   
                    </div>
                  </div>
                   <!-- Card three -->
                  <div class="nav-payment-com hide" style="margin-left: 1.5%;">
                    <div class="row">
                      <div class="card-body">
                       <?php
                       $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';
                       $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                       $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                       $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                       $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id  WHERE cart_user_id = '".$user_id."'and status = 2 ORDER BY bill_products.bp_id DESC";

                       $result = $conn->query($sql);

                       ?>   
                       <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>ลำดับ</th>
                              <th>คำสั่งซื้อ</th>
                              <th>สถานะ</th>
                              <th>วันที่ทำรายการ</th>
                              <th>รายละเอียดสินค้า</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                              $i = 1;
                        // output data of each row
                              while($row = $result->fetch_assoc()) {
                                $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                                $status_bill;
                                if ($row["status"]== 1) {
                                  $status_bill = "รอตรวจสอบ";
                                }else if ($row["status"]== 2) {
                                  $status_bill = "โอนเงินแล้ว";
                                }else{
                                  $status_bill = "รอชำระเงิน";
                                }
                                echo '
                                <tr>
                                <td>'.$i.'</td>
                                <td>'.$cart_code.'</td>
                                <td>'.$status_bill.'</td>
                                <td>'.$row["bp_date_startorder"].'</td>
                                <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                                </tr>
                                ';
                                $i++;                     
                              } 
                            } else {
                              echo "0 results";
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>   
                  </div>
                </div>
                  <!-- Card foure -->
                  <div class="nav-delivery hide" style="margin-left: 1.5%;">
                    <div class="row">
                      <div class="card-body">
                       <?php
                       $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';
                       $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                       $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                       $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                       $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id  WHERE cart_user_id = '".$user_id."'and status = 2 ORDER BY bill_products.bp_id DESC";

                       $result = $conn->query($sql);

                       ?>   
                       <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>ลำดับ</th>
                              <th>คำสั่งซื้อ</th>
                              <th>สถานะ</th>
                              <th>วันที่ทำรายการ</th>
                              <th>รายละเอียดสินค้า</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                              $i = 1;
                        // output data of each row
                              while($row = $result->fetch_assoc()) {
                                $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                                $status_bill;
                                if ($row["status"]== 1) {
                                  $status_bill = "รอตรวจสอบ";
                                }else if ($row["status"]== 2) {
                                  $status_bill = "โอนเงินแล้ว";
                                }else{
                                  $status_bill = "รอชำระเงิน";
                                }
                                echo '
                                <tr>
                                <td>'.$i.'</td>
                                <td>'.$cart_code.'</td>
                                <td>'.$status_bill.'</td>
                                <td>'.$row["bp_date_startorder"].'</td>
                                <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                                </tr>
                                ';
                                $i++;                     
                              } 
                            } else {
                              echo "0 results";
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>   
                  </div>
                </div>
                <!-- card five -->
                <div class="nav-complete hide" style="margin-left: 1.5%;">
                  <div class="row">
                    <div class="card-body">
                     <?php
                     $bp_id= ISSET($_GET["bp_id"])?$_GET["bp_id"]:'';
                     $bp_date_startorder= ISSET($_GET["bp_date_startorder"])?$_GET["bp_date_startorder"]:'';
                     $cart_id= ISSET($_GET["cart_id"])?$_GET["cart_id"]:'';
                     $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                     $sql ="SELECT * FROM bill_products INNER JOIN cart ON bill_products.cart_id = cart.cart_id  WHERE cart_user_id = '".$user_id."'and status = 3 ORDER BY bill_products.bp_id DESC";

                     $result = $conn->query($sql);

                     ?>   
                     <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>คำสั่งซื้อ</th>
                            <th>สถานะ</th>
                            <th>วันที่ทำรายการ</th>
                            <th>รายละเอียดสินค้า</th>
                            <th>หมายเลขพัสดุ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($result->num_rows > 0) {
                            $i = 1;
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                              $cart_code = "C-".str_pad($row["cart_id"], 6, "0", STR_PAD_LEFT);
                              $status_bill;
                              if ($row["status"]== 2) {
                                $status_bill = "โอนเงินแล้ว";
                              }else if ($row["status"]== 3) {
                                $status_bill = "จัดส่งเรียบร้อยแล้ว";
                              }else{
                                $status_bill = "รอชำระเงิน";
                              }
                              echo '
                              <tr>
                              <td>'.$i.'</td>
                              <td>'.$cart_code.'</td>
                              <td>'.$status_bill.'</td>
                              <td>'.$row["bp_date_startorder"].'</td>
                              <td><a href="./payments.php?cart_id='.$row["cart_id"].'&status='.$row["status"].'&bp_date_startorder='.$row["bp_date_startorder"].'&delivery_number='.$row["delivery_number"].'"style="color:#000000;background-color:#6DFCED;">รายละเอียดสินค้า</a></td>
                              <td>'.$row["delivery_number"].'</td>
                              </tr>
                              ';
                              $i++;                     
                            } 
                          } else {
                            echo "0 results";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>   
                </div>
              </div>
              <!--End Nav Button  -->
            </div>

            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Our Product Area -->
<!-- End Feature Product -->
<div class="only-banner ptb--100 bg__white">
  <div class="container">
  </div>
</div>

<!-- Start Footer Area -->
<?php include "./components/footeruser.php";?>
<!-- End Footer Area -->
</div>
<!-- Body main wrapper end -->
</div><!-- .modal-product -->
</div><!-- .modal-body -->
</div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div>
<!-- END Modal -->
</div>
<!-- END QUICKVIEW PRODUCT -->
<?php include "./components/logout_popup.php";?>
<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
<script src="js/vendor/jquery-1.12.0.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script>
<script>
  $(function(){

    $('#nav-all').click(function(){
      $('.nav-payment').addClass('hide');
      $('.nav-payment-com').addClass('hide');
      $('.nav-delivery').addClass('hide');
      $('.nav-complete').addClass('hide');
      $('.nav-all').removeClass('hide');
    });

    $('#nav-payment').click(function(){
      $('.nav-payment-com').addClass('hide');
      $('.nav-all').addClass('hide');
      $('.nav-delivery').addClass('hide');
      $('.nav-complete').addClass('hide');
      $('.nav-payment').removeClass('hide');
    });

    $('#nav-payment-com').click(function(){
      $('.nav-payment').addClass('hide');
      $('.nav-all').addClass('hide');
      $('.nav-delivery').addClass('hide');
      $('.nav-complete').addClass('hide');
      $('.nav-payment-com').removeClass('hide');
    });

    $('#nav-delivery').click(function(){
      $('.nav-all').addClass('hide');
      $('.nav-payment').addClass('hide');
      $('.nav-payment-com').addClass('hide');
      $('.nav-complete').addClass('hide');
      $('.nav-delivery').removeClass('hide');
    });

    $('#nav-complete').click(function(){
      $('.nav-all').addClass('hide');
      $('.nav-payment').addClass('hide');
      $('.nav-payment-com').addClass('hide');
      $('.nav-delivery').addClass('hide');
      $('.nav-complete').removeClass('hide');
    });

  })
</script>

</body>
<?php }?>

</html>