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
    <title>Nichetel Communications | Profile Edit Address</title>
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
                    <h2 class="bradcaump-title">Profile Address</h2>
                    <nav class="bradcaump-inner">
                      <a class="breadcrumb-item" href="index.php">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb-item active">Profile Address</span>
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
                <div style="text-align: right;">
                 <a href="./profile_address_add.php"><button type="button" class="btn btn-info" style="font-size: 18px;"><span class="ti-plus">&nbsp;เพิ่มที่อยู่</span></button></a> 
               </div>
               <div class="row">
                 <!-- Begin Page Content -->
                 <!-- DataTales Example -->
                 <div class="card shadow mb-3">
                  <div class="card-body">
                    <form action="../process/claim_products_change_status.php?ad_id=<?php echo $ad_id ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="form-group" style="margin-left: 8px;">
                          <?php 

                          $ad_id = htmlspecialchars( isset($_GET['ad_id'])?$_GET['ad_id']:'');
                          $sql = "SELECT * FROM address WHERE ad_user_id = '$user_id'";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) { ?>
                            <hr>
                            <div class="form-group" style="text-align: right;">
                              <a href="./profile_address_edit.php?ad_id=<?php echo $row["ad_id"];?>" >แก้ไข</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./process/profile_address_delete.php?ad_id=<?php echo $row["ad_id"];?>">ลบ</a>
                            </div>
                            <div style="font-size: 18px">
                              <div class="form-group">
                                <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">ชื่อ - นามสกุล :&nbsp;&nbsp;</label>
                                <?php echo $row["ad_name"]; ?>
                              </div>
                              <div class="form-group" style="font-size: 14px">
                                <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">โทรศัพท์ :&nbsp;&nbsp;</label>
                                <?php echo $row["ad_tel"]; ?>
                              </div>
                              <div class="form-group" style="font-size: 14px">
                                <label class="m-0 font-weight-bold text-muted" style="font-size: 14px">ที่อยู่ :&nbsp;&nbsp;</label>
                                <?php echo $row["ad_etc"]; ?>&nbsp;&nbsp;ตำบล<?php echo $row["ad_district"]; ?>&nbsp;&nbsp;อำเภอ<?php echo $row["ad_amphur"]; ?>&nbsp;&nbsp;จังหวัด<?php echo $row["ad_province"]; ?>&nbsp;&nbsp;<?php echo $row["ad_postcode"]; ?><br>
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

</body>
<?php }?>

</html>