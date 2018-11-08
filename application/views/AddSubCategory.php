<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'AdminHeader.php' ?>
<!-- js file for Add sub category -->
<script src="<?php echo base_url();?>js/addSubCategory.js"></script>
<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs-menu">
                    <ul>
                        <li><a href="<?php echo site_url();?>/administrator/loadAdminPortal">Home</a></li>
                        <li><a href="#" class="active">Add Sub Category</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<?php if(isset($mainCategories)) { ?>
<!-- add-sub-category-area-start -->
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
                <form id="subCategoryForm">
                    <div class="form-group">
                        <label for="mainCatSelect">Main Category<span>*</span></label>
                        <select class="form-control" id="mainCatSelect">
                            <option value="" disabled selected>Select a Main Category</option>
                            <?php foreach ($mainCategories as $key=>$value) {
                                echo "<option>".$value."</option>";
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subCat1">Sub Category 1<span>*</span></label>
                        <input type="text" class="form-control" id="subCat1" name="subCategory[]"
                               onkeyup="validateSubCategoryName(false, 'subCat1')"
                               placeholder="Ex: Computer Science"/>
                    </div>
                    <div class="form-group">
                        <label for="subCat2">Sub Category 2</label>
                        <input type="text" class="form-control" id="subCat2" name="subCategory[]"
                               onkeyup="validateSubCategoryName(false, 'subCat2')"
                               placeholder="Ex: Physical Science"/>
                    </div>
                    <div class="form-group">
                        <label for="subCat3">Sub Category 3</label>
                        <input type="text" class="form-control" id="subCat3" name="subCategory[]"
                               onkeyup="validateSubCategoryName(false, 'subCat3')"
                               placeholder="Ex: Biological Science"/>
                    </div>
                    <div class="form-group">
                        <label for="subCat4">Sub Category 4</label>
                        <input type="text" class="form-control" id="subCat4" name="subCategory[]"
                               onkeyup="validateSubCategoryName(false, 'subCat4')"
                               placeholder="Ex: Chemical Science"/>
                    </div>
                    <div class="single-login single-login-2">
                        <button type="button" id="addSubCategoryBtn" class="btn btn-default"
                                onclick="validateSubCategoryForm()">Add</button>
                    </div>
                    <!-- store the base url to access in the js file -->
                    <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                    <div id="subCategoryAlertSection"></div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
    <div class="user-login-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-title text-center mb-30">
                        <h2>Please add a Main Category before adding a Sub Category</h2>
                        <a href="<?php echo site_url();?>/administrator/loadAddMainCategory">Add Main Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- add-sub-category-area-end -->
<?php include 'AdminFooter.php' ?>