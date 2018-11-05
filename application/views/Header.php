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

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
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
    <!-- chosen.min.css-->
    <link rel="stylesheet" href="<?php echo base_url();?>css/chosen.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/responsive.css">
    <!-- modernizr css -->
    <script src="<?php echo base_url();?>js/vendor/modernizr-2.8.3.min.js"></script>
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
                        <a href="index.html"><img src="<?php echo base_url();?>img/logo/logo.png" alt="logo" /></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="my-cart">
                        <ul>
                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i>My Cart</a>
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
                                <li class="active"><a href="index.html">Home</a>
                                </li>
                                <li><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                    <div class="mega-menu">
                                        <span>
                                            <a href="#" class="title">Education</a>
                                            <a href="shop.html">Biology</a>
                                            <a href="shop.html">Maths</a>
                                            <a href="shop.html">Physics</a>
                                            <a href="shop.html">Chemistry</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Technology</a>
                                            <a href="shop.html">Sub category 1</a>
                                            <a href="shop.html">Sub category 2</a>
                                            <a href="shop.html">Sub category 3</a>
                                            <a href="shop.html">Sub category 4</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Friction</a>
                                            <a href="shop.html">Sub category 1</a>
                                            <a href="shop.html">Sub category 2</a>
                                            <a href="shop.html">Sub category 3</a>
                                            <a href="shop.html">Sub category 4</a>
                                        </span>
                                        <span>
                                            <a href="#" class="title">Social</a>
                                            <a href="shop.html">Sub category 1</a>
                                            <a href="shop.html">Sub category 2</a>
                                            <a href="shop.html">Sub category 3</a>
                                            <a href="shop.html">Sub category 4</a>
                                        </span>
                                        <span>
                                            <a href="#" >View all categories<i class="fa fa-angle-right"></i></a>
                                        </span>
                                    </div>
                                </li>
                                <li><a href="product-details.html">Browse</a>
                                </li>
                                <li><a href="product-details.html">Editors' Corner</a>
                                </li>
                                <li><a href="product-details.html">Contact Us</a>
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
                                <li><a href="index.html">Home</a>
                                </li>
                                <li><a href="#">Categories</a>
                                    <ul>
                                        <li><a href="shop.html">Education</a></li>
                                        <li><a href="shop.html">Technology</a></li>
                                        <li><a href="shop.html">Friction</a></li>
                                        <li><a href="shop.html">Social</a></li>
                                        <li><a href="shop.html">View all categories <i class="fa
                                        fa-angle-right"></i></a></li>
                                    </ul>
                                </li>
                                <li><a href="product-details.html">Browse</a>
                                </li>
                                <li><a href="product-details.html">Editors' Corner</a>
                                </li>
                                <li><a href="#">Contact Us</a>
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