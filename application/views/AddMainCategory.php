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
                        <li><a href="#" class="active">Add Main Category</a></li>
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
                    <h2>Add Main Category</h2>
                    <p>Enter the details of the Category/s</p>
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <div class="login-form">
                <form>
                    <div class="form-group dynamic-main-category">
                        <label for="formGroupExampleInput">Main Category 1</label>
                        <input type="text" class="form-control" name="mainCategory[]" placeholder="Ex: Education" required/>
                    </div>
                    <div class="form-group dynamic-main-category">
                        <label for="formGroupExampleInput">Main Category 2</label>
                        <input type="text" class="form-control" name="mainCategory[]" placeholder="Ex: Social"/>
                    </div>
                    <div class="form-group dynamic-main-category">
                        <label for="formGroupExampleInput">Main Category 3</label>
                        <input type="text" class="form-control" name="mainCategory[]" placeholder="Ex: Technology"/>
                    </div>
                    <div class="single-login single-login-2">
                        <a href="#" onclick="document.forms[0].submit();" >Add</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- user-login-area-end -->
<?php include 'AdminFooter.php' ?>