<?php session_start();

include "./process/connect.php";

//include "./process/check_user.php";

?>

<!doctype html>

<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Nichetel Communications | Products Details</title>

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



    <!-- img slide -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



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

        <!-- End Offset Wrapper -->

        <!-- Start Bradcaump area -->

        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">

            <div class="ht__bradcaump__wrap">

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="bradcaump__inner text-center">

                                <h2 class="bradcaump-title">Product Details</h2>

                                <nav class="bradcaump-inner">

                                  <a class="breadcrumb-item" href="index.php">Home</a>

                                  <span class="brd-separetor">/</span>

                                  <span class="breadcrumb-item active">Product Details</span>

                              </nav>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

      </div>

      <!-- End Bradcaump area -->

      <!-- Start Product Details -->

      <section class="htc__product__details pt--120 pb--100 bg__white">

        <div class="container">

            <div class="row">

                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                  <div id="myCarousel" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->

                    <ol class="carousel-indicators">

                        <?php 

                        $pd_id = isset($_GET['pd_id'])?$_GET['pd_id']:'';

                        $sql = "SELECT * FROM gallery_products WHERE pd_id ='$pd_id' ORDER BY pd_id DESC";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            $i=0;

                            $active_s='';

                            if ($i == 0) {

                                $active_s = "active";

                            }

                            ?>

                            <?php 

                            while($row = $result->fetch_assoc()) { ?>

                              <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $active_s;?>"></li>



                              <?php $i++; } } ?>

                          </ol> 

                          <!-- Wrapper for slides -->

                          <div class="carousel-inner">

                            <?php 

                            $pd_id = isset($_GET['pd_id'])?$_GET['pd_id']:'';

                            $sql1 = "SELECT * FROM gallery_products WHERE pd_id ='$pd_id' ORDER BY pd_id DESC";

                            $result1 = $conn->query($sql1); 

                            if ($result1->num_rows > 0) {

                                $i=0;

                                if ($i == 0) {

                                    $i = "active";

                                }else{

                                    $i = "";

                                }

                                while($row1 = $result1->fetch_assoc()) { ?>

                                  <div class="item <?php echo $i;?>">

                                    <img src="./image/uploads/products/<?php echo $row1["file_name"];?>?gallery_id=<?php echo $row1["gallery_id"]; ?>" style="width:100%;">

                                </div>

                                <?php  $i++; } } ?>

                            </div>

                            <!-- Left and right controls -->

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">

                                <span class="glyphicon glyphicon-chevron-left ti-angle-left"></span>

                                <span class="sr-only">Previous</span>

                            </a>

                            <a class="right carousel-control" href="#myCarousel" data-slide="next">

                                <span class="glyphicon glyphicon-chevron-right ti-angle-right"></span>

                                <span class="sr-only">Next</span>

                            </a>

                        </div>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">

                        <div class="htc__product__details__inner">

                            <?php 

                            $pd_id = htmlspecialchars( isset($_GET['pd_id'])?$_GET['pd_id']:'');

                            $cart_id = htmlspecialchars( isset($_GET['cart_id'])?$_GET['cart_id']:'');

                            $sql ="SELECT * FROM products

                            INNER JOIN brand_products ON products.brand_id = brand_products.brand_id 

                            INNER JOIN promotions ON products.p_id = promotions.p_id WHERE pd_id = '$pd_id'";

                            $result = $conn->query($sql);

                            $row1 = $result->fetch_assoc(); 

                            $discount_price = $row1["pd_price"] - $row1["pd_price"]*($row1["p_percent"]/100);

                            $product_price = $row1["pd_price"];

                            $pd_Ready = $row1["pd_Ready"];

                            ?>

                            <div class="pro__detl__title">

                                <h2><?php echo $row1["brand_name"]." ".$row1["pd_name"]; ?></h2>

                            </div>

                            <ul class="pro__dtl__prize">

                                <li class="old__prize" id ="product_price">฿<?php echo number_format($product_price,2); ?></li>

                                <li id="discount_price">฿<?php echo number_format($discount_price,2); ?></li>

                            </ul>

                            <div class="product-action-wrap">

                                <div class="prodict-statas"><span>Quantity :</span></div>

                                <div class="product-quantity">

                                    <form id='product_details_form' method='POST' action='./process/product_details.php?pd_id=<?php echo $pd_id;?>&cart_id=<?php echo $cart_id;?>'>

                                        <div class="product-quantity">

                                            <div class="g">

                                                <span class="product_count_item inumber-decrement"><i class="ti-minus fa-1x"></i></span>

                                                <input class="text-center product_count_item input-number cart-plus-minus-box" type="text" min="1" max="<?php $row1["pd_Ready"];?>" value="1" id="product_count1" name="product_count">

                                                <span class="product_count_item number-increment"><i class="ti-plus fa-1x"></i></span>

                                                <input type="hidden" id="product_count1_hid" value="1">

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                            <div>

                                จำนวนคงเหลือ:&nbsp;<?php echo $row1["pd_Ready"]; ?>

                            </div>

                            <br>

                            <ul class="pro__dtl__btn">

                                <li class="buy__now__btn"><a href="#" onclick="document.forms['product_details_form'].submit();">buy now</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- End Product Details -->

        <!-- Start Product tab -->

        <section class="htc__product__details__tab bg__white pb--120">

            <div class="container">

                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <ul class="product__deatils__tab mb--60" role="tablist">

                            <li role="presentation" class="active">

                                <a href="#description" role="tab" data-toggle="tab">Description</a>

                            </li>

                            <li role="presentation">

                                <a href="#sheet" role="tab" data-toggle="tab">Data sheet</a>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="product__details__tab__content">

                            <!-- Start Single Content -->

                            <div role="tabpanel" id="description" class="product__tab__content fade in active">

                                <div class="product__description__wrap">

                                    <div class="product__desc">

                                        <h2 class="title__6">Details</h2>

                                        <?php

                                        if ($row1["pd_detail"] == '') {

                                            echo '<p>ไม่มีรายละเอียดให้แสดง</p>';

                                        }else{ 

                                            echo '

                                            <p>'.$row1["pd_detail"].'</p>

                                            ';

                                        }

                                        ?>

                                    </div>

<!--                             <div class="pro__feature">

                                <h2 class="title__6">Features</h2>

                                <ul class="feature__list">

                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Duis aute irure dolor in reprehenderit in voluptate velit esse</a></li>

                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>

                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>

                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>

                                </ul>

                            </div> -->

                        </div>

                    </div>

                    <!-- End Single Content -->

                    <!-- Start Single Content -->

                    <div role="tabpanel" id="sheet" class="product__tab__content fade">

                        <div class="pro__feature">

                            <h2 class="title__6">Data sheet</h2>

                            <ul class="feature__list">

                                <?php 

                                if ($row1["pd_datasheet"] =='') { ?>

                                    <p>ไม่มีรายละเอียดให้แสดง</p>

                                <?php }else{ ?>

                                    <li><a href="<?php echo $row1["pd_datasheet"];?>" target="_blank"><i class="zmdi zmdi-play-circle"></i>Data Sheet For <?php echo $row1["brand_name"]."-".$row1["pd_name"];?></a></li>

                                <?php } ?>

                            </ul>

                        </div>

                    </div>

                    <!-- End Single Content -->

                </div>

            </div>

            <!-- End Single Content -->

        </div>

    </div>

</div>

</section>

<!-- End Product tab -->

<!-- Start Footer Area -->

<?php include "./components/footeruser.php";?>

<!-- End Footer Area -->

<!-- Body main wrapper end -->

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

<script type="text/javascript">



  // #product_count1

  // discount_price

  // product_price

  var pd_no_total = <?php echo $pd_Ready; ?>;

  var discount_price = <?php echo $discount_price; ?> ;

  var product_price = <?php echo $product_price; ?> ;

  var tmp_product_count = $("#product_count1").val();

  $(".inumber-decrement").click(function() {

    if (tmp_product_count>1)

        tmp_product_count--;

    $("#product_count1").val(tmp_product_count);

    cal_price();

});



  $(".number-increment").click(function() {

    if (tmp_product_count<pd_no_total)

        tmp_product_count++;

    $("#product_count1").val(tmp_product_count);

    cal_price();

});

  function cal_price(){

    var tmp_discount_price = discount_price*$("#product_count1").val();

    var tmp_product_price = product_price*$("#product_count1").val();

    $("#product_count1_hid").val($("#product_count1").val()) ;

    $("#discount_price").text("฿"+numberWithCommas(tmp_discount_price.toFixed(2)));
    $("#product_price").text("฿"+numberWithCommas(tmp_product_price.toFixed(2)));
}



function numberWithCommas(number) {

    var parts = number.toString().split(".");

    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    return parts.join(".");

}



</script>



</body>



</html>