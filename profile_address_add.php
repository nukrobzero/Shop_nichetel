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
    <title>Nichetel Communications | Profile Address</title>
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
                <div class="row">
                 <!-- Begin Page Content -->
                 <!-- DataTales Example -->
                 <div class="card shadow mb-3">
                  <div class="card-body">
                    <div class="form-group">
                      <?php 
                      $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
                      $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                      ?>
                      <form action="./process/profile_address_add.php?user_id=<?php echo $user_id; ?>" method="post">
                        <div class="form-group">
                          <div class="form-group">
                            <label class="m-0 font-weight-bold text-warning">ชื่อ-นามสกุล</label>
                            <input type="username" class="form-control form-control-user" id="exampleInputusername" placeholder="" name="ad_name" value="">
                          </div>
                          <div class="form-group">
                            <label class="m-0 font-weight-bold text-warning">หมายเลขโทรศัพท์</label>
                            <input type="number" class="form-control form-control-user" id="exampleInputEmail" placeholder="" name="ad_tel" value="">
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label class="m-0 font-weight-bold text-warning">ตำบล</label>
                              <input type="text" class="form-control form-control-user" id="district" name="ad_district" value="">  
                            </div>
                            <div class="col-sm-6">
                              <label class="m-0 font-weight-bold text-warning">อำเภอ</label>
                              <input type="text" class="form-control form-control-user" id="amphoe" name="ad_amphur" value="">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label class="m-0 font-weight-bold text-warning">จังหวัด</label>
                              <input type="text" class="form-control form-control-user" id="province" name="ad_province" value="">
                            </div> 
                            <div class="col-sm-6">
                              <label class="m-0 font-weight-bold text-warning">รหัสไปรษณี</label>
                              <input type="number" class="form-control form-control-user" id="zipcode" name="ad_postcode" value="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="m-0 font-weight-bold text-warning">อื่นๆ</label>
                            <input type="text" placeholder="อาคาร , ถนน และอื่่นๆ" class="form-control form-control-user" name="ad_etc" value="">
                          </div> 
                        </div>   
                        <br>
                        <br>
                        <button class="btn btn-primary btn-user btn-block"type="submit">
                          ยืนยัน
                        </button>
                        <hr>                
                      </form>
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
<script type="text/javascript" src="js/thaipost_address/JQL.min.js"></script>
<script type="text/javascript" src="js/thaipost_address/typeahead.bundle.js"></script>
<link rel="stylesheet" href="css/thaipost_address/jquery.Thailand.min.css">
<script type="text/javascript" src="js/thaipost_address/jquery.Thailand.min.js"></script>


<script type="text/javascript">
  $.Thailand({
        $district: $('#district'), // input ของตำบล
        $amphoe: $('#amphoe'), // input ของอำเภอ
        $province: $('#province'), // input ของจังหวัด
        $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
      });
    </script>

  </body>
<?php }?>

</html>