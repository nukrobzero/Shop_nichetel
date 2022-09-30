<?php 
include "../process/connect.php";
//include "./process/check_user.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Nichetel Communications | NETWORK LAN Card, RAID Card | Server, VMWare, Diskless</title>
    <!--ICON TITLE -->
    <link rel="icon" href="./assets/img/NT-Logosmall.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.2-web/css/all.css">
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        .main-rrr {
          padding: 16px;
          margin-top: 150px;
      }        
  </style>
</head>
<body>

    <?php include "../components/menubar.php";?>

    <div class="container main-rrr">
        <div class="row">
            <div class="col-md-9">
                <div class="well well-lg offer-box text-center">


                   Today's Offer : &nbsp; <span class="glyphicon glyphicon-cog"></span>&nbsp;40 % off  on purchase of $ 2,000 and above till 24 dec !                


               </div>
               <div class="main box-border">
                <div id="mi-slider" class="mi-slider">
                    <ul>

                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img01"><h4>Boots</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img02"><h4>Oxfords</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img03"><h4>Loafers</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img04"><h4>Sneakers</h4>
                        </a></li>
                    </ul>
                    <ul>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img05"><h4>Belts</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img06"><h4>Hats &amp; Caps</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img07"><h4>Sunglasses</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img08"><h4>Scarves</h4>
                        </a></li>
                    </ul>
                    <ul>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img09"><h4>Casual</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img10"><h4>Luxury</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img11"><h4>Sport</h4>
                        </a></li>
                    </ul>
                    <ul>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img12"><h4>Carry-Ons</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img13"><h4>Duffel Bags</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img14"><h4>Laptop Bags</h4>
                        </a></li>
                        <li><a href="#">
                            <img src="assets/img/tel.jpg" alt="img15"><h4>Briefcases</h4>
                        </a></li>
                    </ul>
                    <nav>
                        <a href="#">Shoes</a>
                        <a href="#">Accessories</a>
                        <a href="#">Watches</a>
                        <a href="#">Bags</a>
                    </nav>
                </div>

            </div>
            <br />
        </div>
        <!-- /.col -->

        <div class="col-md-3 text-center">
            <div class=" col-md-12 col-sm-6 col-xs-6" >
                <div class="offer-text">
                    30% off here
                </div>
                <div class="thumbnail product-box">
                    <img src="assets/img/tel.jpg" alt="" />
                    <div class="caption">
                        <h3><a href="#">Samsung Galaxy </a></h3>
                        <p><a href="#">Ptional dismiss button </a></p>
                    </div>
                </div>
            </div>
            <div class=" col-md-12 col-sm-6 col-xs-6">
                <div class="offer-text2">
                    30% off here
                </div>
                <div class="thumbnail product-box">
                    <img src="assets/img/tel.jpg" alt="" />
                    <div class="caption">
                        <h3><a href="#">Samsung Galaxy </a></h3>
                        <p><a href="#">Ptional dismiss button </a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-3">
            <div>
                <a href="#" class="list-group-item active">หมวดหมู่สินค้า
                </a>
                <ul class="list-group">
                    <?php 
                    $cg_id = htmlspecialchars( isset($_GET['cg_id'])?$_GET['cg_id']:'');
                    $sql = "SELECT b.brand_name, COUNT(a.pd_id) as pd_ids FROM products as a INNER JOIN brand_products as b ON a.brand_id = b.brand_id GROUP BY a.brand_id ORDER BY pd_ids";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                          echo '
                          <li class="list-group-item">'.$row["brand_name"].'
                          <span class="label label-primary pull-right">'.$row["pd_ids"].'</span>
                          </li>
                          ';
                      }
                  } else {
                      echo "0 results";
                  }
                  ?>
                  </ul>
              </div>
              <!-- /.div -->
              <div>
                  <a href="#" class="list-group-item active list-group-item-success">Clothing & Wears
                  </a>
                  <ul class="list-group">

                      <li class="list-group-item">Men's Clothing
                          <span class="label label-danger pull-right">300</span>
                      </li>
                      <li class="list-group-item">Women's Clothing
                          <span class="label label-success pull-right">340</span>
                      </li>
                      <li class="list-group-item">Kid's Wear
                          <span class="label label-info pull-right">735</span>
                      </li>

                  </ul>
              </div>
              <!-- /.div -->
              <div>
                  <a href="#" class="list-group-item active">Accessaries & Extras
                  </a>
                  <ul class="list-group">
                      <li class="list-group-item">Mobile Accessaries
                          <span class="label label-warning pull-right">456</span>
                      </li>
                      <li class="list-group-item">Men's Accessaries
                          <span class="label label-success pull-right">156</span>
                      </li>
                      <li class="list-group-item">Women's Accessaries
                          <span class="label label-info pull-right">400</span>
                      </li>
                      <li class="list-group-item">Kid's Accessaries
                          <span class="label label-primary pull-right">89</span>
                      </li>
                      <li class="list-group-item">Home Products
                          <span class="label label-danger pull-right">90</span>
                      </li>
                      <li class="list-group-item">Kitchen Products
                          <span class="label label-warning pull-right">567</span>
                      </li>
                  </ul>
              </div>
              <!-- /.div -->
              <div>
                  <ul class="list-group">
                      <li class="list-group-item list-group-item-success"><a href="#">New Offer's Coming </a></li>
                      <li class="list-group-item list-group-item-info"><a href="#">New Products Added</a></li>
                      <li class="list-group-item list-group-item-warning"><a href="#">Ending Soon Offers</a></li>
                      <li class="list-group-item list-group-item-danger"><a href="#">Just Ended Offers</a></li>
                  </ul>
              </div>
              <!-- /.div -->
              <div class="well well-lg offer-box offer-colors">


                  <span class="glyphicon glyphicon-star-empty"></span>25 % off  , GRAB IT                 

                  <br />
                  <br />
                  <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                      style="width: 70%">
                      <span class="sr-only">70% Complete (success)</span>
                      2hr 35 mins left
                  </div>
              </div>
              <a href="#">click here to know more </a>
          </div>
          <!-- /.div -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
          <div>
              <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Electronics</li>
              </ol>
          </div>
          <!-- /.div -->
          <div class="row">
              <div class="btn-group alg-right-pad">
                  <button type="button" class="btn btn-default"><strong>1235  </strong>items</button>
                  <div class="btn-group">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                          Sort Products &nbsp;
                          <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                          <li><a href="#">By Price Low</a></li>
                          <li class="divider"></li>
                          <li><a href="#">By Price High</a></li>
                          <li class="divider"></li>
                          <li><a href="#">By Popularity</a></li>
                          <li class="divider"></li>
                          <li><a href="#">By Reviews</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <!-- /.row -->
          <div class="from-group row">
              <br>
              <?php
              $sql ="SELECT * FROM products INNER JOIN gallery_products ON products.pd_id = gallery_products.pd_id INNER JOIN brand_products ON products.brand_id = brand_products.brand_id INNER JOIN category ON brand_products.cg_id = category.cg_id INNER JOIN promotions ON products.p_id = promotions.p_id  GROUP BY products.pd_id ORDER BY products.pd_id DESC limit 9";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                $discount_price = $row["pd_price"] - $row["pd_price"]*($row["p_percent"]/100);
                echo '
                <div class="col-md-4 text-center col-sm-6 col-xs-6">
                <div class="thumbnail product-box">
                <img src="../image/uploads/products/'.$row["pd_img"].'" alt="" style="height: 165px; width:auto;"">
                <div class="caption">
                <h4>'.$row["brand_name"].'-'.$row["pd_name"].'</h4>
                <p>ราคาโปรโมชั่น  : <strong>'.$discount_price.' ฿</strong>  </p>
                <p>ราคาปกติ  : <strong>'.$row["pd_price"].' ฿</strong>  </p>
                <p><a href="#" class="btn btn-success" role="button">เพิ่มไปยังรถเข็น</a> <a href="#" class="btn btn-primary" role="button">ดูรายละเอียดสินค้า</a></p>
                </div>
                </div>
                </div>
                ';
            }
            ?>
            <br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <ul class="pagination alg-right-pad">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
    <!-- /.row -->
    <div>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Clothing</a></li>
            <li class="active">Men's Clothing</li>
        </ol>
    </div>
    <!-- /.div -->
    <div class="row">
        <div class="btn-group alg-right-pad">
            <button type="button" class="btn btn-default"><strong>3005  </strong>items</button>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Sort Products &nbsp;
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">By Price Low</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Price High</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Popularity</a></li>
                    <li class="divider"></li>
                    <li><a href="#">By Reviews</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4 text-center col-sm-6 col-xs-6">
            <div class="thumbnail product-box">
                <img src="assets/img/tel.jpg" alt="" />
                <div class="caption">
                    <h3><a href="#">Samsung Galaxy </a></h3>
                    <p>Price : <strong>$ 3,45,900</strong>  </p>
                    <p><a href="#">Ptional dismiss button </a></p>
                    <p>Ptional dismiss button in tional dismiss button in   </p>
                    <p>
                        <a href="#" class="btn btn-success" role="button">Add To Cart</a>
                        <a href="#" class="btn btn-primary" role="button">See Details</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-4 text-center col-sm-6 col-xs-6">
            <div class="thumbnail product-box">
                <img src="assets/img/tel.jpg" alt="" />
                <div class="caption">
                    <h3><a href="#">Samsung Galaxy </a></h3>
                    <p>Price : <strong>$ 3,45,900</strong>  </p>
                    <p><a href="#">Ptional dismiss button </a></p>
                    <p>Ptional dismiss button in tional dismiss button in   </p>
                    <p><a href="#" class="btn btn-success" role="button">Add To Cart</a> <a href="#" class="btn btn-primary" role="button">See Details</a></p>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-4 text-center col-sm-6 col-xs-6">
            <div class="thumbnail product-box">
                <img src="assets/img/tel.jpg" alt="" />
                <div class="caption">
                    <h3><a href="#">Samsung Galaxy </a></h3>
                    <p>Price : <strong>$ 3,45,900</strong>  </p>
                    <p><a href="#">Ptional dismiss button </a></p>
                    <p>Ptional dismiss button in tional dismiss button in   </p>
                    <p><a href="#" class="btn btn-success" role="button">Add To Cart</a> <a href="#" class="btn btn-primary" role="button">See Details</a></p>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <ul class="pagination alg-right-pad">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
    <!-- /.row -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
<div class="col-md-12 download-app-box text-center">

    <span class="glyphicon glyphicon-download-alt"></span>Download Our Android App and Get 10% additional Off on all Products . <a href="#" class="btn btn-danger btn-lg">DOWNLOAD  NOW</a>

</div>

<!--Footer -->
<div class="col-md-12 footer-box">


    <div class="row small-box ">
        <strong>Mobiles :</strong> <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> | 
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |
        <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  <a href="#">Sony</a> | 
        <a href="#">Microx</a> |<a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  
        <a href="#">Sony</a> | <a href="#">Microx</a> | view all items

    </div>
    <div class="row small-box ">
        <strong>Laptops :</strong> <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx Laptops</a> | 
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |
        <a href="#">Sony Laptops</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  <a href="#">Sony</a> | 
        <a href="#">Microx</a> |<a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  
        <a href="#">Sony</a> | <a href="#">Microx</a> | view all items
    </div>
    <div class="row small-box ">
        <strong>Tablets : </strong><a href="#">samsung</a> |  <a href="#">Sony Tablets</a> | <a href="#">Microx</a> | 
        <a href="#">samsung </a>|  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |
        <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung Tablets</a> |  <a href="#">Sony</a> | 
        <a href="#">Microx</a> |<a href="#">samsung Tablets</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  
        <a href="#">Sony</a> | <a href="#">Microx Tablets</a> | view all items

    </div>
    <div class="row small-box pad-botom ">
        <strong>Computers :</strong> <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> | 
        <a href="#">samsung Computers</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |
        <a href="#">Sony</a> | <a href="#">Microx</a> |<a href="#">samsung</a> |  <a href="#">Sony</a> | 
        <a href="#">Microx Computers</a> |<a href="#">samsung Computers</a> |  <a href="#">Sony</a> | <a href="#">Microx</a> |
        <a href="#">samsung</a> |  <a href="#">Sony</a> | <a href="#">Microx Computers</a> |<a href="#">samsung</a> |  
        <a href="#">Sony</a> | <a href="#">Microx</a> | view all items

    </div>
    <div class="row">
        <div class="col-md-4">
            <strong>Send a Quick Query </strong>
            <hr>
            <form>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Email address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <strong>Our Location</strong>
            <hr>
            <p>
             234, New york Street,<br />
             Just Location, USA<br />
             Call: +09-456-567-890<br>
             Email: info@yourdomain.com<br>
         </p>

         2014 www.yourdomain.com | All Right Reserved
     </div>
     <div class="col-md-4 social-box">
        <strong>We are Social </strong>
        <hr>
        <a href="#"><i class="fa fa-facebook-square fa-3x "></i></a>
        <a href="#"><i class="fa fa-twitter-square fa-3x "></i></a>
        <a href="#"><i class="fa fa-google-plus-square fa-3x c"></i></a>
        <a href="#"><i class="fa fa-linkedin-square fa-3x "></i></a>
        <a href="#"><i class="fa fa-pinterest-square fa-3x "></i></a>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec nisl odio. Mauris vehicula at nunc id posuere. Curabitur nec nisl odio. Mauris vehicula at nunc id posuere. 
        </p>
    </div>
</div>
<hr>
</div>
<!-- /.col -->
<div class="col-md-12 end-box ">
    <?php include "../components/footer.php";?>
</div>
<!-- /.col -->
<!--Footer end -->
<!--Core JavaScript file  -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!--bootstrap JavaScript file  -->
<script src="assets/js/bootstrap.js"></script>
<!--Slider JavaScript file  -->
<script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
<script src="assets/ItemSlider/js/jquery.catslider.js"></script>
<script>
    $(function () {

        $('#mi-slider').catslider();

    });
</script>
</body>
</html>
