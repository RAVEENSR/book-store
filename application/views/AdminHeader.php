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
    <!-- select2 library css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- modernizr css -->
    <script src="<?php echo base_url();?>js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- all-css-end-->
    <!-- all-js-start -->
    <!-- jquery latest version -->
    <script src="<?php echo base_url();?>js/vendor/jquery-1.12.0.min.js"></script>
    <!-- bootstrap js -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="<?php echo base_url();?>js/owl.carousel.min.js"></script>
    <!-- meanmenu js -->
    <script src="<?php echo base_url();?>js/jquery.meanmenu.js"></script>
    <!-- wow js -->
    <script src="<?php echo base_url();?>js/wow.min.js"></script>
    <!-- jquery.parallax-1.1.3.js -->
    <script src="<?php echo base_url();?>js/jquery.parallax-1.1.3.js"></script>
    <!-- jquery.countdown.min.js -->
    <script src="<?php echo base_url();?>js/jquery.countdown.min.js"></script>
    <!-- jquery.flexslider.js -->
    <script src="<?php echo base_url();?>js/jquery.flexslider.js"></script>
    <!-- chosen.jquery.min.js -->
    <script src="<?php echo base_url();?>js/chosen.jquery.min.js"></script>
    <!-- jquery.counterup.min.js -->
    <script src="<?php echo base_url();?>js/jquery.counterup.min.js"></script>
    <!-- waypoints.min.js -->
    <script src="<?php echo base_url();?>js/waypoints.min.js"></script>
    <!-- plugins js -->
    <script src="<?php echo base_url();?>js/plugins.js"></script>
    <!-- select2 library script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- ajax js -->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                    <div class="logo-area text-center logo-xs-mrg">
                        <a href="<?php echo site_url();?>/administrator/loadAdminPortal">
                            <img src="<?php echo base_url();?>img/logo/logo.png" alt="logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
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
                                <li class="active"><a href="<?php echo site_url();?>/administrator/loadAdminPortal">Home</a>
                                </li>
                                <li><a href="#">Books<i class="fa fa-angle-down"></i></a>
                                    <div class="sub-menu sub-menu-2">
                                        <ul>
                                            <li>
                                                <a href="<?php echo site_url();?>/administrator/loadAddBook">
                                                    Add Book</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Publishers<i class="fa fa-angle-down"></i></a>
                                    <div class="sub-menu sub-menu-2">
                                        <ul>
                                            <li>
                                                <a href="<?php echo site_url();?>/administrator/loadAddPublisher">
                                                    Add Publisher</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                    <div class="sub-menu sub-menu-2">
                                        <ul>
                                            <li><a href="<?php echo site_url();?>/administrator/loadAddMainCategory">
                                                    Create Main Category</a></li>
                                            <li><a href="<?php echo site_url();?>/administrator/loadAddSubCategory">
                                                    Create Sub Category</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="<?php echo site_url();?>/administrator/loadSearchBook">Search</a>
                                </li>
                                <li><a href="#">Hi <?php echo $this->session->userdata('username'); ?><i class="fa
                                fa-angle-down"></i></a>
                                    <div class="sub-menu sub-menu-2 ">
                                        <ul>
                                            <li><a href="<?php echo site_url();?>/login/logout">LogOut</a>
                                        </ul>
                                    </div>
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
                                <li><a href="<?php echo site_url();?>/administrator/loadAdminPortal">Home</a>
                                </li>
                                <li><a href="#">Books</a>
                                    <ul>
                                        <li><a href="<?php echo site_url();?>/administrator/loadAddBook">
                                                Add Book</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Publishers</a>
                                    <ul>
                                        <li><a href="<?php echo site_url();?>/administrator/loadAddPublisher">
                                                Add Publisher</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Categories</a>
                                    <ul>
                                        <li><a href="<?php echo site_url();?>/administrator/loadAddMainCategory">
                                                Create Main Category</a></li>
                                        <li><a href="<?php echo site_url();?>/administrator/loadAddSubCategory">
                                                Create Sub Category</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo site_url();?>/administrator/loadSearchBook">Search</a>
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