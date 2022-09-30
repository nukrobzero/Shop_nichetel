       <?php 
       include './process/connect.php';
       ?>
       <!-- //icon-fonts-style -->
       <link href="./fonts/fontawesome-free-5.15.2-web/css/all.css" rel="stylesheet"> <!--load all styles -->

       <header id="header" class="htc-header header--3 bg__white">
        <!-- Start Mainmenu Area -->
        <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3 hidden-xs ">
                        <h3><div class="logo">
                            <a href="index.php"><strong>Nichetel</strong> Shop
                                <!-- <img src="image/logo/NT-Logoaaasdvy.png" alt="logo"> -->

                            </a>
                        </div></h3>
                    </div>
                    <!-- Start MAinmenu Ares -->
                    <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                        <nav class="mainmenu__nav hidden-xs hidden-sm">
                            <ul class="main__menu">
                                <li class="drop"><a href="index.php">Home</a></li>
                                <li class="drop"><a href="shop.php">Products</a></li>
                                <li><a href="contact.php">contact</a></li>
                            </ul>
                        </nav>
                        <div class="mobile-menu clearfix visible-xs visible-sm">
                            <nav id="mobile_dropdown">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">Products</a></li>
                                    <li><a href="contact.php">contact</a></li>
                                </ul>
                            </nav>
                        </div>                         
                    </div>
                    <!-- End MAinmenu Ares -->
                    <div class="col-md-2 col-sm-4 col-xs-3">  
                        <ul class="menu-extra">
                            <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                            <?php 
                            $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
                            $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

                            if ($user_username =='' and $user_id =='') {?>
                                <li><a href="login.php"><span class="ti-user"></span></a></li>
                            <?php }else{ ?>
                                <li class="nav-item dropdown no-arrow">
                                  <a class="nav-link dropdown-toggle" href="login.php" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                    <span class="ti-user">&nbsp;<?php echo $user_username; ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuLink" style="margin: 5px;padding: 10px;text-align: left;">
                                    <ul class="col-sm">
                                        <li style="margin: 4px;"><a class="dropdown-item" href="./profile.php">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-address-card" aria-hidden="true"></i> บัญชีของฉัน</a></li>
                                        <li style="margin: 4px;"><a class="dropdown-item" href="./profile_myorder.php"><i class="fa fa-list" aria-hidden="true"></i> การซื้อของฉัน</a></li>
                                        <li style="margin: 4px;"><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> ออกจากระบบ</a></li>  
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                        <?php 
                        if ($user_username =='' and $user_id =='') { ?>
                            <li><a href="cart.php"><span class="ti-shopping-cart"></span></a></li>
                        <?php }else{ ?>
                            <?php
                            $sql1 = "SELECT cart_product_list.cart_id, COUNT(cart_p_id) as count_cart FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id WHERE cart.cart_status = 0 and cart_user_id ='".$user_id."'";
                            $result1 = $conn->query($sql1);
                            $row1 = $result1->fetch_assoc(); 
                            if ($row1["count_cart"] != 0) {
                             $cart_icon = "ti-shopping-cart-full";
                         }else{
                             $cart_icon = "ti-shopping-cart"; 
                         }
                         ?>
                         <li><a href="cart.php"><span class="<?php echo $cart_icon;?>"><sup><span style="background-color: #F90404;color: #FFFFFF;font-size: 16px;border-radius: 50%;text-align: center;margin: 5px;padding: 3px;">&nbsp;<?php echo $row1["count_cart"];?>&nbsp;</span></sup>
                          <span class="sr-only">unread messages</span></span></a></li>
                      <?php } ?>
                  </ul>
              </div>
          </div>
          <div class="mobile-menu-area"></div>
      </div>
  </div>
  <!-- End Mainmenu Area -->
</header>
<!-- End Header Style -->
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
