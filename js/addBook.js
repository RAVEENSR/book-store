function loadSubCategories() {
    var siteURL = $('#siteURL')[0].value;
    var alertSection = $('#addBookAlertSection');
    var selectedMainCategory = $('#mainCategorySelect option:selected').text();
    var subCategorySelectSection = $('#subCategorySelect');
    if (selectedMainCategory !== "") {
        $.ajax({
            url: siteURL + "/administrator/getAllSubCategoriesOfMainCategory",
            type: "POST",
            data: {mainCategory: selectedMainCategory},
            success: function (data) {
                // if no data received that means the entered Main Category is a new one
                if (data) {
                    var subCategories = $.parseJSON(data).result;

                    var htmlString = "<select class=\"form-control sub-category-select\" id=\"subCategorySelect\" required>\n" +
                        "                            <option value=\"\" disabled selected>Select a category or add new category</option>";
                    for (var i = 0; i < subCategories.length; i++) {
                        htmlString += "<option>" + subCategories[i] + "</option>";
                    }
                    htmlString += "</select>";
                    subCategorySelectSection.html(htmlString);
                } else {
                    var htmlString = "<select class=\"form-control sub-category-select\" id=\"subCategorySelect\" required>\n" +
                        "                            <option value=\"\" disabled selected>Select a category or add new category</option></select>";
                    subCategorySelectSection.html(htmlString);
                }
            },
            error: function (XHR, status, response) {
                console.log(XHR.response);
                console.log(status);
                console.log(response);
                alertSection.html('<div class="alert alert-danger">Cannot load sub categories</div>');
            }
        });
    }
}

function validateAddBookForm() {
    var title = $('#title')[0].value;
    var author = $('#author')[0].value;
    var isbn = $('#isbn')[0].value;
    var mainCategory = $('#mainCategorySelect')[0].value;
    var subCategory = $('#subCategorySelect')[0].value;
    var publisher = $('#publisher')[0].value;
    var edition = $('#edition')[0].value;
    var price = $('#price')[0].value;
    var qty = $('#quantity')[0].value;
    var description = $('#description')[0].value;
    var img = $('#imgURL')[0].value;

    var alertSection = $('#addBookAlertSection');
    var siteURL = $('#siteURL')[0].value;
    var data = {};

    // check for main category field whether it is empty
    if (title === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Title"</div>');
        return;
    }
    if (author === '') {
        alertSection.html('<div class="alert alert-danger">Please enter an "Author"</div>');
        return;
    }
    if (isbn === '') {
        alertSection.html('<div class="alert alert-danger">Please enter an "ISBN"</div>');
        return;
    }
    if (mainCategory === '') {
        alertSection.html('<div class="alert alert-danger">Please select or enter a "Main Category"</div>');
        return;
    }
    if (subCategory === '') {
        alertSection.html('<div class="alert alert-danger">Please select or enter a "Sub Category"</div>');
        return;
    }
    if (publisher === '') {
        alertSection.html('<div class="alert alert-danger">Please select or enter a "Publisher"</div>');
        return;
    }
    if (price === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Price"</div>');
        return;
    }
    if (!isDecimal(price)) {
        alertSection.html('<div class="alert alert-danger">Please enter a valid decimal number with two' +
            ' digits for "Price"</div>');
        return;
    }
    if (qty === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Available Quantity"</div>');
        return;
    }
    if (!isInteger(qty)) {
        alertSection.html('<div class="alert alert-danger">Please enter an integer for "Available Quantity"</div>');
        return;
    }
    if (description === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Description"</div>');
        return;
    }
    if (img === '') {
        alertSection.html('<div class="alert alert-danger">Please enter a "Image URL"</div>');
        return;
    }

    data['title'] = title;
    data['author'] = author;
    data['isbn'] = isbn;
    data['mainCategory'] = mainCategory;
    data['subCategory'] = subCategory;
    data['publisher'] = publisher;
    data['edition'] = edition;
    data['price'] =  price;
    data['qty'] = Number(qty);
    data['description'] = description;
    data['img'] = img;
    console.log(data);

    $.ajax({
        url: siteURL + "/administrator/addBook",
        type: "POST",
        data: {bookData: data},
        success: function (data) {
            alertSection.html('<div class="alert alert-success">Successfully added the book.</div>');
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alertSection.html('<div class="alert alert-danger">Error occurred when adding the book.</div>');
        }
    });
}

function isInteger(value) {
    var regex = /^-?[0-9]+$/;
    return regex.test(value);
}

function isDecimal(value) {
    var regex = /^\d+\.\d{0,2}$/;
    return regex.test(value);
}

function convertToDecimal(number) {
    //With 3 exposing the hundredths place
    number = number.slice(0, (number.indexOf(".")) + 3);
    return number;}