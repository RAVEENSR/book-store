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
                        <li><a href="#" class="active">Add Sub Category</a></li>
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
                    <h2>Add Sub Category</h2>
                    <p>Enter the details of the sub category</p>
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <div class="login-form">
                <form>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Main Category</label>
                        <select class="form-control">
                            <option value="" disabled selected>Select a Main Category</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sub Category 1</label>
                        <input type="text" class="form-control" name="subCategory[]"
                               placeholder="Ex: Computer Science"/>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sub Category 2</label>
                        <input type="text" class="form-control" name="subCategory[]"
                               placeholder="Ex: Physical Science"/>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sub Category 3</label>
                        <input type="text" class="form-control" name="subCategory[]"
                               placeholder="Ex: Biological Science"/>
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