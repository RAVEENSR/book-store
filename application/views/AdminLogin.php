<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'AdminHeader.php' ?>
<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#" class="active">login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!-- user-login-area-start -->
<div class="user-login-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-title text-center mb-30">
                    <h2>Administrator Login</h2>
                    <p>Enter Your Login Credentials</p>
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <div class="login-form">
                    <div class="single-login">
                        <label>Username<span>*</span></label>
                        <input type="text" />
                    </div>
                    <div class="single-login">
                        <label>Password<span>*</span></label>
                        <input type="text" />
                    </div>
                    <div class="single-login single-login-2">
                        <a href="#">login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- user-login-area-end -->
<?php include 'AdminFooter.php' ?>