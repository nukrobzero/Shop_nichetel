<?php session_start();
include "./process/connect.php";
?>
<?php
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
      <title>Nichetel Communications | Cart</title>
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

      <script src="./js/vendor/jquery-1.12.0.min.js"></script>

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
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Cart</h2>
                    <nav class="bradcaump-inner">
                      <a class="breadcrumb-item" href="index.php">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb-item active">Cart</span>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--120 bg__white">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <form id="process_checkout_form" method="post" action="./process/cart.php"> 
                  <div class="table-content table-responsive">
                    <table id="table_cart" class="nav-ask">
                      <thead>
                        <tr>
                          <th class="product-name">#</th>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-subtotal">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       $pd_id = isset($_GET['pd_id'])?$_GET['pd_id']:'';
                       $pd_Ready= ISSET($_GET["pd_Ready"])?$_GET["pd_Ready"]:'';

                       $sql = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id INNER JOIN promotions ON products.p_id = promotions.p_id WHERE cart_user_id = '".$user_id."' and cart_status = 0 ORDER BY cart_p_id DESC";
                       $result = $conn->query($sql);
                       $sum_tatol_discount_price = 0;
                       $total_sum_vat = 0;
                       $i = 1;
                       if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                          $discount_price = floatval($row["pd_price"]) - floatval($row["pd_price"])*floatval(($row["p_percent"]/100));
                      //echo $row["p_percent"];
                          $product_price = floatval($row["pd_price"]);
                          $tatol_discount_price = floatval($discount_price)*floatval($row["count"]);
                          $sum_tatol_discount_price += floatval($tatol_discount_price);
                          $total_sum_vat = floatval($sum_tatol_discount_price*0.07);
                          $total = floatval($total_sum_vat) + floatval($sum_tatol_discount_price);

                          ?>
                          <tr>
                            <strong><td><?php echo $i;?></td></strong>
                            <td class="product-thumbnail"><a href="#"><img src="./image/uploads/products/<?php echo $row["pd_img"];?>" alt="product img"></a></td>
                            <td class="product-name"><a href="#"><?php echo $row["pd_name"];?></a></td>
                            <td class="product-price"><span class="amount" style="color:#ff003c;text-decoration:line-through" id="product_price">฿<?php echo number_format($product_price,2)?></span><br>
                              <span class="amount" id="discount_price">฿<?php echo number_format($discount_price,2);?></span>
                            </td>
                            <td>
                              <?php
                              echo'
                              <div class="product_count">
                              <span id="product_count_decrement'.$row["cart_p_id"].'" class="product_count_item input-number-decrement text-center"> <i class="ti-minus"></i>
                              </span>
                              <input class="product_count_item text-center" type="text" value="'.$row["count"].'" min="1" max="'.$row["pd_Ready"].'" id="product_count_item'.$row["cart_p_id"].'" name="product_count_item[]">
                              <input type="hidden" name="tmp_cart_product_id[]" value="'.$row["cart_p_id"].'">
                              <span id="product_count_increment'.$row["cart_p_id"].'" class="product_count_item input-number-increment text-center"> <i class="ti-plus"></i>
                              </span>
                              </div>

                              <script>
                              var product_count_item'.$row["cart_p_id"].' =parseInt($("#product_count_item'.$row["cart_p_id"].'").val()) ;
                              $("#product_count_decrement'.$row["cart_p_id"].'").click(function() {
                                if (product_count_item'.$row["cart_p_id"].' >1){
                                  product_count_item'.$row["cart_p_id"].'-=1;
                                  $("#product_count_item'.$row["cart_p_id"].'").val(product_count_item'.$row["cart_p_id"].');
                                  cal_price'.$row["cart_p_id"].'(product_count_item'.$row["cart_p_id"].');
                                  cal_sum_tatol'.$row["cart_p_id"].'(0);
                                }
                                });

                                $("#product_count_increment'.$row["cart_p_id"].'").click(function() {
                                  if (product_count_item'.$row["cart_p_id"].' < '.$row["pd_Ready"].'){
                                    product_count_item'.$row["cart_p_id"].'+=1;
                                    $("#product_count_item'.$row["cart_p_id"].'").val(product_count_item'.$row["cart_p_id"].');
                                    cal_price'.$row["cart_p_id"].'(product_count_item'.$row["cart_p_id"].');
                                    cal_sum_tatol'.$row["cart_p_id"].'(1);
                                  }
                                  });

                                  var d_price'.$row["cart_p_id"].' = '.$discount_price.';
                                  function cal_price'.$row["cart_p_id"].'( num_product){
                                    var tmp_discount_price = num_product*d_price'.$row["cart_p_id"].';

                                    $("#tatol_discount_price'.$row["cart_p_id"].'").text("฿"+numberWithCommas(tmp_discount_price.toFixed(2)));
                                  }

                                  function cal_sum_tatol'.$row["cart_p_id"].'(num){
                                    var sum_tatol_discount_price = 0;
                                    var total_sum_vat = 0;
                                    var total = total_sum_vat + sum_tatol_discount_price;

                                    if(num==0){
                                      total_sum_vat = Number.parseInt($("#total_sum_vat_hidden").val())-d_price'.$row["cart_p_id"].' * 0.07;
                                      sum_tatol_discount_price = Number.parseFloat($("#sum_tatol_discount_price_hidden").val())-d_price'.$row["cart_p_id"].';
                                      total = (Number.parseInt($("#sum_tatol_discount_price_hidden").val())-d_price'.$row["cart_p_id"].')+(Number.parseInt($("#total_sum_vat_hidden").val())-d_price'.$row["cart_p_id"].' * 0.07);
                                    }
                                    else if(num<=0){
                                      total_sum_vat = Number.parseInt($("#total_sum_vat_hidden").val())-d_price'.$row["cart_p_id"].' * 0.07;
                                      sum_tatol_discount_price = Number.parseFloat($("#sum_tatol_discount_price_hidden").val())-d_price'.$row["cart_p_id"].';
                                      total = (Number.parseInt($("#sum_tatol_discount_price_hidden").val())-d_price'.$row["cart_p_id"].') + (Number.parseInt($("#total_sum_vat_hidden").val())-d_price'.$row["cart_p_id"].' * 0.07);
                                    }
                                    else{
                                      sum_tatol_discount_price = Number.parseFloat($("#sum_tatol_discount_price_hidden").val())+d_price'.$row["cart_p_id"].';
                                      total_sum_vat = Number.parseInt($("#total_sum_vat_hidden").val())+d_price'.$row["cart_p_id"].' * 0.07;
                                      total = (Number.parseInt($("#sum_tatol_discount_price_hidden").val())+d_price'.$row["cart_p_id"].')+(Number.parseInt($("#total_sum_vat_hidden").val())+d_price'.$row["cart_p_id"].' * 0.07);
                                    }
                                    $("#sum_tatol_discount_price").text("฿"+numberWithCommas(sum_tatol_discount_price.toFixed(2)));
                                    $("#sum_tatol_discount_price_hidden").val(sum_tatol_discount_price);
                                    $("#total_sum_vat").text("฿"+numberWithCommas(total_sum_vat.toFixed(2)));
                                    $("#total_sum_vat_hidden").val(total_sum_vat);
                                    $("#total").text(numberWithCommas("฿"+total.toFixed(2)));
                                    $("#total_hidden").val(total);
                                  }
                                  </script>';
                                  ?>  
                                </td>
                                <td class="product-subtotal"id="tatol_discount_price<?php echo $row["cart_p_id"];?>">฿<?php echo number_format($tatol_discount_price,2);?> </td>
                                <td class="product-remove"><a href="./process/cart_delete.php?cart_p_id=<?php echo $row["cart_p_id"];?>">X</a></td>
                                <?php $i++;}
                              } else {
                                echo "<stong>ไม่มีรายการสินค้า</stong>";
                                echo'
                                <style type="text/css">
                                .nav-ask{ display:none; }
                                </style>
                                ';
                                echo'<br>
                                <br>
                                <br>';
                              }?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                          <div class="buttons-cart">
                            <a href="./shop.php">Continue Shopping</a>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                          <div class="cart_totals nav-ask">
                            <h2>Cart Totals</h2>
                            <table>
                              <tbody>
                                <tr class="cart-subtotal">
                                </tr>
                                <br>
                                <tr class="order-total">
                                  <th>Total</th>
                                  <td>
                                   <?php echo '<input type="hidden" name="" id="sum_tatol_discount_price_hidden" value="'.$sum_tatol_discount_price.'">'; ?>
                                   <strong><span class="amount" id="sum_tatol_discount_price">฿<?php echo number_format($sum_tatol_discount_price,2); ?></span></strong>
                                 </td>
                               </tr>                                           
                             </tbody>
                           </table>
                           <?php 
                           if ($sum_tatol_discount_price!=0) {?>
                             <div class="wc-proceed-to-checkout">
                              <a href="#" onclick="document.forms['process_checkout_form'].submit();">Proceed to Checkout</a>
                            </div>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
          <!-- cart-main-area end -->
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
        <script>

         function numberWithCommas(number) {
          var parts = number.toString().split(".");
          parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          return parts.join(".");
        }
      </script>


    </body>

  <?php  } ?>

  </html>