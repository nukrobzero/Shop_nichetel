<?php session_start();
include "./process/connect.php";
//include "./process/check_user.php";
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nichetel Communications | </title>
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
        <!-- End Offset Wrapper -->
        <!-- Start Feature Product -->
        <section class="categories-slider-area bg__white">
            <div class="container">
                <div class="row">
                    <!-- Start Left Feature -->
                    <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                        <!-- Start Slider Area -->
                        <div class="slider__container slider--one">
                            <div class="slider__activation__wrap owl-carousel owl-theme">
                                <!-- Start Single Slide -->
                                <?php 
                                //$p_id = htmlspecialchars( isset($_GET['p_id'])?$_GET['p_id']:'');
                                $sql = "SELECT * FROM promotions ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                 while($row = $result->fetch_assoc()) { ?>
                                    <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url(./image/uploads/promotions/<?php echo $row["p_img"]; ?>) no-repeat scroll center center / cover ;">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                                    <div class="slider__inner">
                                                        <h1><span class="text--theme"><?php echo $row["p_name"]; ?></span></h1>
                                                        <div class="slider__btn">
                                                            <a class="htc__btn" href="shop.php">shop now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php  }
                            } else {
                              echo "0 results";
                          }
                          ?>
                          <!-- End Single Slide -->
                      </div>
                  </div>
                  <!-- Start Slider Area -->
              </div>
              <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                <div class="categories-menu">
                    <div class="category-heading">
                     <h3> Browse Categories</h3>
                 </div>
                 <div class="category-menu-list">
                    <ul>
                       <?php 
                       $sql ="SELECT * FROM category";
                       $result = $conn->query($sql);
                       while($row = $result->fetch_assoc()) {
                        ?>
                        <li><a href="./shop_search.php?search1=<?php echo $row["cg_id"];?>"><img alt="" src="images/icons/thum2.png"> <?php echo $row["cg_name_type"]; ?> <i class="zmdi zmdi-chevron-right"></i></a>
                            <div class="category-menu-dropdown">
                                <?php 
                                $sql1 ="SELECT * FROM brand_products WHERE cg_id = '".$row["cg_id"]."'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    $i = 1;
                                    while($row1 = $result1->fetch_assoc()) {
                                        ?>
                                        <div class="category-part-<?php echo $i; ?> category-common mb--30">
                                            <h4 class="categories-subtitle"> <?php echo $row1["brand_name"]; ?></h4>
                                            <ul>
                                                <?php 
                                                $sql2 ="SELECT * FROM products WHERE brand_id = '".$row1["brand_id"]."'";
                                                $result2 = $conn->query($sql2);
                                                while($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <li><a href="product-details.php?pd_id=<?php echo $row2["pd_id"]; ?>"> <?php echo $row2["pd_name"]; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php 
                                        $i++;
                                    } 
                                }
                                ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Left Feature -->
</div>
</div>
<br>
<br>
<br>
</section>
<!-- End Feature Product -->
<!-- <div class="only-banner ptb--100 bg__white">
    <div class="container">
        <div class="only-banner-img">
            <a href="shop-sidebar.html"><img src="images/new-product/3.jpg" alt="new product"></a>
        </div>
    </div>
</div> -->
<!-- Start Our Product Area -->
<section class="htc__product__area bg__white">
    <div class="container">
        <div class="form group">
            <div class="product-style-tab">
                <div class="product-tab-list">
                    <!-- Nav tabs -->
                    <ul class="tab-style" role="tablist">
                        <li class="active">
                            <a href="#home1" data-toggle="tab">
                                <div class="tab-menu-text">
                                    <h4>latest </h4>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#home2" data-toggle="tab">
                                <div class="tab-menu-text">
                                    <h4>best sale </h4>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content another-product-style jump">
                    <div class="tab-pane active" id="home1" style="text-align: center;">
                        <div class="row">
                            <div class="product-slider-active owl-carousel">
                                <?php
                                $sql ="SELECT * FROM products INNER JOIN gallery_products ON products.pd_id = gallery_products.pd_id INNER JOIN brand_products ON products.brand_id = brand_products.brand_id INNER JOIN category ON brand_products.cg_id = category.cg_id INNER JOIN promotions ON products.p_id = promotions.p_id  GROUP BY products.pd_id ORDER BY products.pd_id DESC limit 12 ";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $discount_price = $row["pd_price"] - $row["pd_price"]*($row["p_percent"]/100); ?>
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product" >
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="product-details.php?pd_id=<?php echo $row["pd_id"];?>">
                                                        <img  style="height: 270px; width:auto;text-align: center;border-radius: 2%;" src="image/uploads/products/<?php echo $row["pd_img"];?>" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a  title="Quick View" href="product-details.php?pd_id=<?php echo $row["pd_id"];?>"><span class="ti-eye"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="product-details.php?pd_id=<?php echo $row["pd_id"];?>"><?php echo $row["brand_name"]."-".$row["pd_name"];?></a></h2>
                                                <ul class="product__price">
                                                    <li class="old__price">฿<?php echo number_format($row["pd_price"],2);?></li>
                                                    <li class="new__price">฿<?php echo number_format($discount_price,2);?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>  
                            </div>
                        </div>  
                    </div>     
                    <div class="tab-pane" id="home2">
                        <div class="row">
                            <div class="product-slider-active owl-carousel">
                                <?php
                                $sql2 ="SELECT cart_product_list.pd_id as pd_ids , SUM(count) as scount, pd_img, brand_name, pd_name, pd_price, p_percent FROM cart_product_list INNER JOIN products INNER JOIN gallery_products ON products.pd_id = gallery_products.pd_id INNER JOIN brand_products ON products.brand_id = brand_products.brand_id INNER JOIN category ON brand_products.cg_id = category.cg_id INNER JOIN promotions ON products.p_id = promotions.p_id WHERE products.pd_id = cart_product_list.pd_id GROUP BY cart_product_list.pd_id HAVING COUNT(pd_ids) > 1 ORDER BY scount DESC limit 12 ";
                                $result2 = $conn->query($sql2);
                                while ($row2 = $result2->fetch_assoc()) {
                                    $discount_price2 = $row2["pd_price"] - $row2["pd_price"]*($row2["p_percent"]/100); ?>
                                    <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                        <div class="product">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="product-details.php?pd_id=<?php echo $row2["pd_ids"];?>">
                                                        <img  style="height: 270px; width:270px;text-align: center;border-radius: 2%;" src="image/uploads/products/<?php echo $row2["pd_img"];?>" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a  title="Quick View" href="product-details.php?pd_id=<?php echo $row2["pd_ids"];?>"><span class="ti-eye"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="product-details.php?pd_id=<?php echo $row2["pd_ids"];?>"><?php echo $row2["brand_name"]."-".$row2["pd_name"];?></a></h2>
                                                <ul class="product__price">
                                                    <li class="old__price">฿<?php echo number_format($row2["pd_price"],2);?></li>
                                                    <li class="new__price">฿<?php echo number_format($discount_price2,2);?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>  
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </section>
                <!-- End Our Product Area -->
                <!-- Start Blog Area -->
                <section class="htc__blog__area bg__white pb--130" style="text-align: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="section__title ` text-center">
                                    <h2 class="title__line">All Products</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="product__list another-product-style">
                                <?php
                                $sql ="SELECT * FROM products INNER JOIN gallery_products ON products.pd_id = gallery_products.pd_id INNER JOIN brand_products ON products.brand_id = brand_products.brand_id INNER JOIN category ON brand_products.cg_id = category.cg_id INNER JOIN promotions ON products.p_id = promotions.p_id GROUP BY products.pd_id ORDER BY products.pd_id DESC limit 6 ";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {
                                    $discount_price = $row["pd_price"] - $row["pd_price"]*($row["p_percent"]/100);?>
                                    <!-- Start Single Blog -->
                                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12" >
                                        <div class="product foo">
                                            <div class="product__inner">
                                                <div class="pro__thumb">
                                                    <a href="product-details.php?pd_id=<?php echo $row["pd_id"];?>">
                                                        <img src="image/uploads/products/<?php echo $row["pd_img"];?>" alt="product images" style="height: 165px; width:auto;border-radius: 2%;">
                                                    </a>
                                                </div>
                                                <div class="product__hover__info">
                                                    <ul class="product__action">
                                                        <li><a title="Quick View" href="product-details.php?pd_id=<?php echo $row["pd_id"];?>"><span class="ti-eye"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__details">
                                                <h2><a href="product-details.php?pd_id=<?php echo $row["pd_id"];?>"><?php echo $row["brand_name"].'-'.$row["pd_name"];?></a></h2>
                                                <ul class="product__price">
                                                    <li class="old__price">฿<?php echo number_format($row["pd_price"],2);?></li>
                                                    <li class="new__price">฿<?php echo number_format($discount_price,2);?></li>
                                                </ul>
                                            </div>  
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End Single Blog -->
                            </div>
                            <br>
                            <br>
                        </div>
                            <!-- Start Load More BTn -->
                            <div class="row mt--60">
                                <div class="col-md-12">
                                    <div class="htc__loadmore__btn">
                                        <a href="./shop.php">load more</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Load More BTn -->
                        
                    </div>
                </section>
                <!-- End Blog Area -->
                <!-- Start Footer Area -->
                <?php include "./components/footeruser.php";?>
                <!-- End Footer Area -->
            </div>
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

        </body>

        </html>