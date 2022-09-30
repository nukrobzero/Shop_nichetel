        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">
                       <!-- Start Single Footer Widget -->
                       <div class="col-md-3 col-lg-3 col-sm-6">
                        <div class="ft__widget">
                            <div class="ft__logo">
                               <a href="index.php"><strong>Nichetel</strong> Shop
                                    <!-- <img src="image/logo/NT-Logoaaasdvy.png" alt="logo"> -->
                                
                                </a>
                            </div>
                            <div class="footer-address">
                                <ul>
                                    <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-pin"></i>
                                        </div>
                                        <div class="address-text">
                                            <a href="https://www.google.com/maps/place/%E0%B8%AD%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%A3+42+%E0%B8%97%E0%B8%B2%E0%B8%A7%E0%B9%80%E0%B8%A7%E0%B8%AD%E0%B8%A3%E0%B9%8C/@13.715454,100.584537,18z/data=!4m5!3m4!1s0x0:0x359e3f04c5542c4a!8m2!3d13.715405!4d100.584539?hl=th-TH" target="_blank"><p>42 Tower, 11th Floor 65 Sukhumvit 42 Road, Prakhanong, Klongtoey,  <br> Bangkok 10110 Thailand</p></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-email"></i>
                                        </div>
                                        <div class="address-text">
                                            <a href="mailto:sale@nichetelcomm.com"> sale@nichetelcomm.com</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="address-icon">
                                            <i class="zmdi zmdi-phone-in-talk"></i>
                                        </div>
                                        <div class="address-text">
                                            <p>+66 2 712 3211-13 </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <ul class="social__icon">
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                        <div class="ft__widget">
                            <h2 class="ft__title">Categories</h2>
                            <ul class="footer-categories">
                                <?php 
                                $cg_id = htmlspecialchars( isset($_GET['cg_id'])?$_GET['cg_id']:'');
                                $sql = "SELECT b.brand_name, COUNT(a.pd_id) as pd_ids FROM products as a INNER JOIN brand_products as b ON a.brand_id = b.brand_id GROUP BY a.brand_id ORDER BY pd_ids";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                                      echo '
                                      <li><a href="./shop_search.php?search='.$row["brand_name"].'">'.$row["brand_name"].'</a></li>
                                      ';
                                  }
                              }
                              ?>
                          </ul>
                      </div>
                  </div>
                  <!-- Start Single Footer Widget -->
                  <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                    <div class="ft__widget">
                        <h2 class="ft__title">Infomation</h2>
                        <ul class="footer-categories">
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner">
                        <div class="copyright">
                            <p>&copy; <?php echo date("Y");?> <a href="https://nichetelcomm.com/" target="_blank">Nichetel Communications Co.,Ltd.</a>
                            All Right Reserved.</p>
                            <p>By Peeradon Chairattanakumrod</p>
                        </div>
                        <ul class="footer__menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="shop.php">Product</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>