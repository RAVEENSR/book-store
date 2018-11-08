<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'AdminHeader.php' ?>
    <!-- js file for Add main category -->
    <script src="<?php echo base_url(); ?>js/addMainCategory.js"></script>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>/administrator/loadAdminPortal">Home</a></li>
                            <li><a href="#" class="active">Add Main Category</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- add-main-category-area-start -->
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
                        <form id="mainCategoryForm">
                            <div class="form-group dynamic-main-category">
                                <label for="mainCat1">Main Category 1<span>*</span></label>
                                <input type="text" class="form-control" id="mainCat1" name="mainCategory[]"
                                       onkeyup="validateMainCategoryName(false, 'mainCat1')"
                                       placeholder="Ex:Education" required/>
                            </div>
                            <div class="form-group dynamic-main-category">
                                <label for="mainCat2">Main Category 2</label>
                                <input type="text" class="form-control" id="mainCat2" name="mainCategory[]"
                                       onkeyup="validateMainCategoryName(false, 'mainCat2')"
                                       placeholder="Ex: Social"/>
                            </div>
                            <div class="form-group dynamic-main-category">
                                <label for="mainCat3">Main Category 3</label>
                                <input type="text" class="form-control" id="mainCat3" name="mainCategory[]"
                                       onkeyup="validateMainCategoryName(false, 'mainCat3')"
                                       placeholder="Ex: Technology"/>
                            </div>
                            <div class="single-login single-login-2">
                                <button type="button" id="addMainCategoryBtn" class="btn btn-default"
                                        onclick="validateMainCategoryForm()">Add
                                </button>
                            </div>
                            <!-- store the base url to access in the js file -->
                            <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                            <div id="mainCategoryAlertSection"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add-main-category-area-end -->
<?php include 'AdminFooter.php' ?>