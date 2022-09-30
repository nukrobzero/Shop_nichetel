<?php 

session_start();

include "./process/connect.php";

?>

<!doctype html>

<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Nichetel Communications | Forgot</title>

    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- Place favicon.ico in the root directory -->

    <link rel="shortcut icon" type="image/x-icon" href="./admin/assets/img/NT-Logosmall.png">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    



    <!-- All css files are included here. -->

    <!-- Bootstrap fremwork main css -->

    <link rel="stylesheet" href="css/bootstrap.min.css">

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

        <!-- End Cart Panel -->

    </div>

    <!-- End Offset Wrapper -->

    <!-- Start Login Register Area -->

    <div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">

        <div class="container">

            <div class="row">

                <div class="col-md-6 col-md-offset-3">

                    <ul class="login__register__menu" role="tablist">

                        <li role="presentation" class="login active"><a href="#" role="tab" data-toggle="tab">Forgot Password</a></li>

                    </ul>

                </div>

            </div>

            <!-- Start Login Register Content -->

            <div class="row">

                <div class="col-md-6 col-md-offset-3">

                    <div class="htc__login__register__wrap">

                        <!-- Start Single Content -->

                        <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">

                            <form id="forgot_form" class="login" action="./process/forgot_password.php" method="post">

                                <input type="text" placeholder="User Name*" name="user_username" required="">

                                <input type="password" placeholder="New Password*" name="user_password" required="">

                                <input type="password" placeholder="Repassword*" name="user_repassword" required="">

                                <div class="htc__login__btn mt--30">

                                    <button class="btn btn btn-warning" type="submit" style="font-size: 25px;background-color: #ff4136;">Submit</button>

                                </div>

                            </form>

                        </div>

                        <!-- End Single Content -->

                    </div>

                </div>

            </div>

            <!-- End Login Register Content -->

        </div>

    </div>

    <!-- End Login Register Area -->

    <!-- Start Footer Area -->

    <?php include "./components/footeruser.php";?>

    <!-- End Footer Area -->

</div>

<!-- Body main wrapper end -->

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