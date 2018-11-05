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
                        <li><a href="#" class="active">Add Book</a></li>
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
                    <h2>Add a Book to the Store</h2>
                    <p>Enter the details of the book</p>
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                <div class="login-form">
                <form>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Title</label>
                        <input type="text" class="form-control" id="" placeholder="Title of the Book" required>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <label for="author">Author</label>
                            <select class="form-control author-select" required>
                                <option value="" disabled selected>Select an author or add new author</option>
                                <option>orange</option>
                                <option>white</option>
                                <option>purple</option>
                                <option>orange</option>
                                <option>white</option>
                                <option>purple</option>
                                <option>orange</option>
                                <option>white</option>
                                <option>purple</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">ISBN </label>
                        <input type="text" class="form-control" id="" placeholder="Ex: 978-0062390493" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Main Category</label>
                        <select class="form-control main-category-select" id="main-category-select" required>
                            <option value="" disabled selected>Select a category or add new category</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group" id="sub-category-div" >
                        <label for="formGroupExampleInput">Sub Category</label>
                        <select class="form-control sub-category-select" id="" required>
                            <option value="" disabled selected>Select a category or add new category</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Publisher</label>
                        <select class="form-control sub-category-select" id="" required>
                            <option value="" disabled selected>Select a publisher or add new publisher</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Edition</label>
                        <input type="text" class="form-control" id="" placeholder="Ex: 2nd Edition" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Price (USD)</label>
                        <input type="text" class="form-control" id="" placeholder="Ex: 10.00" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Available Quantity</label>
                        <input type="text" class="form-control" id="" placeholder="Ex: 25" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Description</label>
                        <textarea class="form-control" id="" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Image URL</label>
                        <input type="text" class="form-control" id="" placeholder="Ex: img/education/1.jpg" required>
                    </div>
<!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
                    <div class="single-login single-login-2">
                        <a href="#" onclick="document.forms[0].submit();" >submit</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- user-login-area-end -->
<?php include 'AdminFooter.php' ?>