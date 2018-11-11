<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include 'header.php' ?>
    <!-- js file for Add Book -->
    <script src="<?php echo base_url(); ?>js/addBook.js"></script>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="<?php echo site_url(); ?>/administrator/load_admin_portal">Home</a></li>
                            <li><a href="#" class="active">Add Book</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumbs-area-end -->
<?php if (isset($publishers)) { ?>
    <!-- add-book-area-start -->
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
                        <form method="post" id="addBookForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title<span>*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Title of the Book" required>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <label for="author">Author<span>*</span></label>
                                    <select class="form-control author-select" id="author" name="author" required>
                                        <option value="" disabled selected>Select an author or add new author</option>
                                        <?php foreach ($authors as $key => $value) {
                                            echo "<option>" . $value . "</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN<span>*</span></label>
                                <input type="text" onkeyup="validateISBN()" class="form-control" id="isbn" name="isbn"
                                       placeholder="Ex: 978-0062390493" required>
                            </div>
                            <div class="form-group">
                                <label for="mainCategorySelect">Main Category<span>*</span></label>
                                <select class="form-control main-category-select" id="mainCategorySelect"
                                        name="mainCategorySelect" onchange="loadSubCategories()" required>
                                    <option value="" disabled selected>Select a category or add new category</option>
                                    <?php foreach ($mainCategories as $key => $value) {
                                        echo "<option>$value</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group" id="sub-category-div">
                                <label for="subCategorySelect">Sub Category<span>*</span></label>
                                <select class="form-control sub-category-select" id="subCategorySelect"
                                        name="subCategorySelect" required>
                                    <option value="" disabled selected>Select a category or add new category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="publisher">Publisher<span>*</span></label>
                                <select class="form-control publisher-select" id="publisher" name="publisher" required>
                                    <option value="" disabled selected>Select a publisher or add new publisher</option>
                                    <?php foreach ($publishers as $key => $value) {
                                        echo "<option>$value</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edition">Edition</label>
                                <input type="text" class="form-control" id="edition" name="edition"
                                       placeholder="Ex: 2nd Edition" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price (USD)<span>*</span></label>
                                <input type="number" step="0.01" min="0" class="form-control" id="price" name="price"
                                       placeholder="Ex: 10.00" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Available Quantity<span>*</span></label>
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity"
                                       placeholder="Ex: 25" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description<span>*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                          required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="imgURL">Image URL<span>*</span></label>
                                <input type="file" class="form-control" id="imgURL" name="imgURL" required>
                            </div>
                            <div class="single-login single-login-2">
                                <button type="submit" id="addBookBtn" class="btn btn-default"
                                        onclick="return validateAddBookForm()">Add
                                </button>
                            </div>
                            <!-- store the base url to access in the js file -->
                            <input type="text" class="hide" id="siteURL" value="<?php echo site_url(); ?>"/>
                            <div id="addBookAlertSection"></div>
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
                        <h2>Please add at least one Publisher before adding a book</h2>
                        <a href="<?php echo site_url(); ?>/administrator/load_add_publisher">Add Publisher</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- add-book-area-end -->
<?php include 'footer.php' ?>