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
      <title>Nichetel Communications | Checkout</title>
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
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
          <div class="ht__bradcaump__wrap">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Checkout</h2>
                    <nav class="bradcaump-inner">
                      <a class="breadcrumb-item" href="index.html">Home</a>
                      <span class="brd-separetor">/</span>
                      <span class="breadcrumb-item active">Checkout</span>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
        <section class="our-checkout-area ptb--120 bg__white">
          <div class="container">
           <form id="form_post_checkout1" action="./process/checkout.php?bp_id=<?php echo $bp_id; ?>&cart_id=<?php echo $cart_id; ?>&status=<?php echo $status; ?>&b_date=<?php echo $b_date; ?>&sum_tatol_discount_price2=<?php echo $sum_tatol_discount_price2; ?>&b_payment=<?php echo $b_payment; ?>&address_id=<?php echo $address_id; ?>&delivery=<?php echo $delivery; ?>" method="_GET">
            <div class="row">
              <div class="order_details_iner">
                <div class="ckeckout-left-sidebar">
                  <!-- Start Checkbox Area -->
                  <div class="checkout-form">
                    <h2 class="section-title-3"><i class="ti-location-pin">ที่อยู่ในการจัดส่ง</i></h2>
                    <br>
                    <?php
                    $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                    ?>
                    <div style="text-align:right;font-size: 18px;font-color: blue;"><a href="./profile_address.php?user_id=<?php echo $user_id; ?>"style="font-color: blue;">แก้ไข/เพิ่มที่อยู่ใหม่</a></div>
                    <div class="checkout-form-inner">
                     <?php 
                     $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;
                     $sql = "SELECT * FROM address INNER JOIN users ON address.ad_user_id = users.user_id where users.user_id = '$user_id'";
                     $result = $conn->query($sql);   
                     if ($result->num_rows > 0) {
                      $i=1;
                      $j = 1;
                      if ($j == 1) {
                        $j ="checked";
                      }
                      ?>
                      <?php while ( $row = $result->fetch_assoc())
                      { ?>
                        <div style="font-size: 16px;">
                        <input type="radio" required="" <?php echo $j;?> id="<?php echo $row["ad_id"];?>" name="address_id" value="<?php echo $row["ad_id"];?>">&nbsp;&nbsp;<?php echo $i; ?>.&nbsp;<strong style="font-size: 18px;"><label for="<?php echo $row["ad_id"];?>"><?php echo $row["ad_name"]; ?>&nbsp;&nbsp; <?php echo $row["ad_tel"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $row["ad_etc"]; ?>, ตำบล<?php echo $row["ad_district"]; ?> , อำเภอ<?php echo $row["ad_amphur"]; ?>, จังหวัด<?php echo $row["ad_province"]; ?>, <?php echo $row["ad_postcode"]; ?></label>
                        </div>
                        <br>
                        <?php $i++; $j++;}
                      } else {
                        echo '<strong style="font-size: 18px;">ไม่มีที่อยู่สำหรับจัดส่ง กรุณาเพิ่มที่อยู่...</strong>';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <!-- End Checkbox Area -->
                <br>
                <hr>
                <strong><h3 class="section-title-4"><i class="ti-shopping-cart-full">&nbsp;รายละเอียดการสั่งซื้อ</i></h3></strong>
                <div class="table-content table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th class="product-name">#</th>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                     $pd_id = isset($_GET['pd_id'])?$_GET['pd_id']:'';
                     $pd_Ready= ISSET($_GET["pd_Ready"])?$_GET["pd_Ready"]:'';
                     $cart_user_id= ISSET($_GET["cart_user_id"])?$_GET["cart_user_id"]:'';

                     $user_username = isset($_SESSION["user_username"])?$_SESSION["user_username"]:'' ;
                     $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:'' ;

                     $sql = "SELECT * FROM cart INNER JOIN cart_product_list ON cart.cart_id = cart_product_list.cart_id INNER JOIN products ON cart_product_list.pd_id = products.pd_id INNER JOIN promotions ON products.p_id = promotions.p_id WHERE cart_user_id = '".$user_id."' and cart_status = 0 ORDER BY cart_p_id DESC";
                     $result = $conn->query($sql);
                     $sum_tatol_discount_price = 0;
                     $total_sum_vat = 0;
                     $i = 1;
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
                        <strong><td class="product-price"><?php echo $i;?></td></strong>
                        <td class="product-thumbnail"><a href="#"><img src="./image/uploads/products/<?php echo $row["pd_img"];?>" alt="product img"></a></td>
                        <td class="product-name"><a href="#"><?php echo $row["pd_name"];?></a></td>
                        <td class="product-price"><span class="amount" style="text-decoration:line-through" id="product_price">฿<?php echo number_format($product_price,2)?></span><br>
                          <span class="amount" id="discount_price">฿<?php echo number_format($discount_price,2);?></span>
                        </td>
                        <td class="product-price">
                          <?php
                          echo'
                          <div class="product_count">
                          <storng><span class="product_count_item text-center" id="product_count_item'.$row["cart_p_id"].'" name="product_count_item[]" >X&nbsp;'.$row["count"].'</span></storng>
                          <input type="hidden" name="tmp_cart_product_id[]" value="'.$row["cart_p_id"].'">
                          </div>

                          ';

                          ?>  
                        </td>
                        <td class="product-subtotal"id="tatol_discount_price<?php echo $row["cart_p_id"];?>" style="color: #ee4d2d">฿<?php echo number_format($tatol_discount_price,2);?></td>
                        <?php $i++;} ?>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-md-8 col-sm-7 col-xs-12">
                    <h2 class="section-title-3"><i class="ti-truck">&nbsp;รูปแบบการจัดส่ง</i></h2>
                    <?php if ($sum_tatol_discount_price>=3000) { ?>
                      <div class="row">
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="delivery1" name="delivery" value="0" checked="">
                        <label for="delivery1"> ส่งฟรี</label>&nbsp;&nbsp;    
                        <span style="color: red">***จัดส่งฟรีเมื่อซื้อสินค้าถึง 3,000 บาท</span> 
                      </div>
                    <?php }else{ ?>
                      <div class="row">
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="delivery1" name="delivery" value="50" checked="">
                        <label for="delivery1"> ส่งธรรมดา(+฿50)</label>&nbsp;&nbsp;    
                        <input type="radio" id="delivery2" name="delivery" value="100">
                        <label for="delivery2"> ส่งด่วน(+฿100)</label>  
                        <span style="color: red">***จัดส่งฟรีเมื่อซื้อสินค้าถึง 3,000 บาท</span> 
                      </div>             
                    <?php } ?>
                    <hr>
                    <h5 style="font-size: 24px;"><strong><i class="ti-credit-card">&nbsp;วิธีการชำระเงิน</i></strong></h5>
                    <div class="col-md-8 col-sm-7 col-xs-12">
                     <div class="row">
                      <br>
                      <input type="radio" id="Payment" name="b_payment" value="1" checked="">
                      <label for="Payment"> โอน/ชำระผ่านบัญชีธนาคาร</label>&nbsp;&nbsp;    
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-12">
                  <div class="cart_totals">
                    <br>
                    <h2>Cart Totals</h2>
                    <table>
                      <br>
                      <tbody>
                        <br>
                        <tr class="cart-subtotal">
                        </tr>
                        <tr class="order-total">
                          <th>ยอดสั่งซื้อ</th>
                          <td>
                            <?php echo '<input type="hidden" name="" id="sum_tatol_discount_price_hidden" value="'.$sum_tatol_discount_price.'">'; ?>
                            <strong><span id="sum_tatol_discount_price">฿<?php echo number_format($sum_tatol_discount_price,2); ?></span></strong>
                            <br>
                          </tr>
                          <tr class="order-total">
                            <th>ค่าจัดส่ง</th>
                            <td>
                             <?php echo '<input type="hidden" name="" id="delivery" value="">'; ?>
                             <strong>฿<span id="delivery_budget" style="color:#000"><?php echo number_format(0,0); ?></span>.00</strong>
                             <br>
                           </tr>
                           <tr class="order-total">
                            <th>ยอดสั่งซื้อทั้งหมด</th>
                            <td>
                             <?php echo '<input type="hidden" name="sum_tatol_discount_price2" id="sum_tatol_discount_price_hidden2" value="'.$sum_tatol_discount_price.'">'; ?>
                             <strong><span class="amount" id="sum_tatol_discount_price2" name="sum_tatol_discount_price2" style="color: #ee4d2d">฿<?php echo number_format($sum_tatol_discount_price,2); ?></span></strong>
                           </td>
                         </tr>                                           
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
             </form>
             <!-- Start Payment Box -->
             <?php 
             if ($sum_tatol_discount_price!=0) {?>
               <div class="payment-form">
                <br>
                <div class="wc-proceed-to-checkout text-right">
                  <a href="#" onclick="document.forms['form_post_checkout1'].submit();">สั่งสินค้า</a>
                </div>
              </div>
            <?php }?>
            <!-- End Payment Box -->
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- End Checkout Area -->
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