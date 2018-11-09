<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Book Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>img/favicon.png">

    <!-- all css start -->
    <!-- latest-bootstrap-version-3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/animate.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/meanmenu.min.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/owl.carousel.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css">
    <!-- flexslider.css-->
    <link rel="stylesheet" href="<?php echo base_url();?>css/flexslider.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/responsive.css">
    <!-- select2 library css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- modernizr css -->
    <script src="<?php echo base_url();?>js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- all-css-end-->
    <!-- all-js-start -->
    <!-- latest-jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap 3.3.7 compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- owl.carousel js -->
    <script src="<?php echo base_url();?>js/owl.carousel.min.js"></script>
    <!-- meanmenu js -->
    <script src="<?php echo base_url();?>js/jquery.meanmenu.js"></script>
    <!-- wow js -->
    <script src="<?php echo base_url();?>js/wow.min.js"></script>
    <!-- jquery.parallax-1.1.3.js -->
    <script src="<?php echo base_url();?>js/jquery.parallax-1.1.3.js"></script>
    <!-- jquery.flexslider.js -->
    <script src="<?php echo base_url();?>js/jquery.flexslider.js"></script>
    <!-- plugins js -->
    <script src="<?php echo base_url();?>js/plugins.js"></script>
    <!-- select2 library script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- all-js-end -->
</head>
<body class="home-2">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve
    your experience.</p>
<![endif]-->

<!-- header-start -->
<header>
    <!-- header-top-start -->
    <div class="header-mid-area ptb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                    <div class="logo-area text-left logo-xs-mrg">
                        <a href="<?php echo site_url();?>"><img src="<?php echo base_url(); ?>img/logo/logo.png"
                        alt="logo" /></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="my-cart">
                        <ul>
                            <li><a href="<?php echo site_url();?>/visitor/viewCart">
                                    <i class="fa fa-shopping-cart"></i>My Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-end -->
    <!-- main-menu-area-start -->
    <div class="main-menu-area hidden-sm hidden-xs" id="header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-area">
                        <nav>
                            <ul>
                                <li class="active"><a href="<?php echo site_url();?>">Home</a>
                                </li>
                                <li><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                    <div class="mega-menu">
                                        <span>
                                            <a href="#" class="title">Education</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=1&subCatId=1">Finance</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=1&subCatId=2">Higher</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=1&subCatId=3">History</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=1&subCatId=4">Health</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Technology</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=2&subCatId=5">Electricity</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=2&subCatId=6">Engineering</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=2&subCatId=7">Food</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=2&subCatId=8">Robotics</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Science</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=3&subCatId=9">Biology</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=3&subCatId=10">Chemistry</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=3&subCatId=11">Energy</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=3&subCatId=12">Physics</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Mathematics</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=4&subCatId=13">General</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=4&subCatId=14">Applied</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=4&subCatId=15">Geometry</a>
                                            <a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=4&subCatId=16">Logic</a>
                                        </span>
                                        <span>
                                            <a href="<?php echo site_url();?>/visitor/viewAllBooks" >View all
                                                categories<i class="fa fa-angle-right"></i></a>
                                        </span>
                                    </div>
                                </li>
                                <li><a href="<?php echo site_url();?>/visitor/viewAllBooks">Browse</a>
                                </li>
                                <li><a href="<?php echo site_url();?>/#editorsCorner">Editors' Corner</a>
                                </li>
                                <li><a href="#contactUs">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-menu-area-end -->
    <!-- mobile-menu-area-start -->
    <div class="mobile-menu-area hidden-md hidden-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul id="nav">
                                <li><a href="<?php echo site_url();?>">Home</a>
                                </li>
                                <li><a href="#">Categories</a>
                                    <ul>
                                        <li><a href="<?php echo site_url();
                                        ?>/visitor/viewBooksByCategory?mainCatId=1">Education</a></li>
                                        <li><a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=2">Technology</a></li>
                                        <li><a href="<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=3">Science</a></li>
                                        <li><a href=<?php echo site_url();
                                            ?>/visitor/viewBooksByCategory?mainCatId=4">Mathematics</a></li>
                                        <li><a href="<?php echo site_url();?>/visitor/viewAllBooks">View all
                                                categories <i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo site_url();?>/visitor/viewAllBooks">Browse</a>
                                </li>
                                <li><a href="<?php echo site_url();?>/#editorsCorner">Editors' Corner</a>
                                </li>
                                <li><a href="#contactUs">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area-end -->
</header>
<!-- header-area-end -->
<!-- search-area-start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="header-search">
                <form action="#">
                    <input type="text" placeholder="Search a book by title or author..."/>
                    <a href="#"><i class="fa fa-search"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- search-area-end -->