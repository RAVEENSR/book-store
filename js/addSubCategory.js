function validateSubCategoryForm() {
    var mainCategory = $('#mainCatSelect')[0].value;
    var category1 = $('#subCat1')[0].value;
    var form = $('#subCategoryForm')[0];
    var alertSection = $('#subCategoryAlertSection');
    var siteURL = $('#siteURL')[0].value;
    var data = [];
    // get the category values
    var formData = form.elements['subCategory[]'];
    for (var i = 0, len = formData.length; i < len; i++) {
        if (formData[i].value !== '') {
            data.push(formData[i].value);
        }
    }
    // check for main category field whether it is empty
    if (mainCategory === '') {
        alertSection.html('<div class="alert alert-danger">Please select a "Main Category"</div>');
        return;
    }
    // check for first sub category field whether it is empty
    if (category1 === '') {
        alertSection.html('<div class="alert alert-danger">"Sub Category 1" field cannot be blank.</div>');
    } else {
        $.ajax({
            url: siteURL + "/administrator/create_subcategory",
            type: "POST",
            data: {mainCategory: mainCategory, subCategories: data},
            success: function (data) {
                alertSection.html('<div class="alert alert-success">Successfully added categories.</div>');
                $('#subCategoryForm').trigger("reset");
            },
            error: function (XHR, status, response) {
                console.log(XHR.response);
                console.log(status);
                console.log(response);
                alertSection.html('<div class="alert alert-danger">Error occurred when adding categories.</div>');
            }
        });
    }
}

/*
* validates the name of the main category.
* */
function validateSubCategoryName(subCategoryName, subCategoryFieldId) {
    var alertSection = $('#subCategoryAlertSection');
    var siteURL = $('#siteURL')[0].value;

    if (!subCategoryName && subCategoryFieldId) {
        subCategoryName = $('#' + subCategoryFieldId)[0].value;
    }

    $.ajax({
        url: siteURL + "/administrator/validate_subcategory",
        type: "POST",
        data: {subCategoryName: subCategoryName},
        success: function (data) {
            var flag = $.parseJSON(data);
            if (!flag) {
                alertSection.html('<div class="alert alert-danger">Sub Category "' + subCategoryName + '" already ' +
                    'exists in database.</div>');
                $('#addSubCategoryBtn').prop('disabled', true);
                return false;
            } else {
                alertSection.html('<div id="subCategoryAlertSection"></div>');
                $('#addSubCategoryBtn').prop('disabled', false);
                return true;
            }
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alertSection.html('<div class="alert alert-danger">Error occurred when validating the Publisher Name' +
                ' field.</div>');
            return false;
        }
    });
}