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
    <title>Nichetel Communications | Profile Edit</title>
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
                    <h2 class="bradcaump-title">Profile</h2>
                    <nav class="bradcaump-inner">
                      <a class="breadcrumb-item" href="index.php">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb-item active">Profile</span>
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
                      $user_id = htmlspecialchars(isset($_GET['user_id'])?$_GET['user_id']:'');
                      $sql ="SELECT * FROM users where user_id = '$user_id'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                      } else {
                        echo "0 results";
                      }
                      ?>
                      <form action="./process/profile_edit.php?user_id=<?php echo $user_id; ?>" method="post">
                        <div class="form-group">
                          <label class="m-0 font-weight-bold text-warning">ชื่อผู้ใช้</label>
                          <input type="username" disabled="" class="form-control form-control-user" id="exampleInputusername" placeholder="" name="user_username" value="<?php echo $row["user_username"]; ?>">
                        </div>
                        <div class="form-group">
                          <label class="m-0 font-weight-bold text-warning">อีเมล์</label>
                          <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="" name="user_email" value="<?php echo $row["user_email"]; ?>">
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="m-0 font-weight-bold text-warning">ชื่อจริง</label>
                            <input type="text" class="form-control form-control-user" id="examplePreName" placeholder="" name="user_pre_name" value="<?php echo $row["user_pre_name"]; ?>">
                          </div>
                          <div class="col-sm-6">
                            <label class="m-0 font-weight-bold text-warning">นามสกุล</label>
                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="" name="user_last_name" value="<?php echo $row["user_last_name"]; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="m-0 font-weight-bold text-warning">ชื่อเล่น</label>
                          <input type="text" class="form-control form-control-user" id="exampleInputName" placeholder="" name="user_name" value="<?php echo $row["user_name"]; ?>">
                        </div>
                        <div class="form-group">
                          <label class="m-0 font-weight-bold text-warning">ว/ด/ป เกิด</label>
                          <input type="date" class="form-control form-control-user" id="exampleInputBirthdat" placeholder="" name="user_birthday" value="<?php echo $row["user_birthday"]; ?>">
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="m-0 font-weight-bold text-warning">อายุ</label>
                            <input type="number" class="form-control form-control-user" id="exampleAge" placeholder="" name="user_age" value="<?php echo $row["user_age"]; ?>">
                          </div>
                          <div class="col-sm-6">
                            <label class="m-0 font-weight-bold text-warning">เพศ</label>
                            <?php
                            $male = '';
                            $female = '';
                            if ($row["user_sex"] == 'ชาย') {
                              $male = "selected";
                            }else {
                              $female = "selected";
                            }
                            ?>
                            <select  class="form-control form-control-user" id="exampleSex" name="user_sex" >
                              <option value="ชาย" <?php echo $male; ?> >ชาย</option>
                              <option value="หญิง" <?php echo $female; ?> >หญิง</option>
                            </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="m-0 font-weight-bold text-warning">เบอร์โทรศัพท์</label>
                          <input type="number" class="form-control form-control-user" id="exampleInputTel" placeholder="" name="user_tel" value="<?php echo $row["user_tel"]; ?>">
                        </div> 
                        <br>
                        <br>
                        <button class="btn btn-primary btn-user btn-block" type="submit">
                          บันทึก
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

</body>
<?php }?>

</html>