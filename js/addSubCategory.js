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
    if(mainCategory === '') {
        alertSection.html('<div class="alert alert-danger">Please select a "Main Category"</div>');
        return;
    }
    // check for first category field whether it is empty
    if (category1 === '') {
        alertSection.html('<div class="alert alert-danger">"Sub Category 1" field cannot be blank.</div>');
    } else {
        $.ajax({
            url: siteURL + "/administrator/createSubCategory",
            type: "POST",
            data: {mainCategory : mainCategory, subCategories : data},
            success: function (data) {
                console.log(data);
                alertSection.html('<div class="alert alert-success">Successfully added categories.</div>');
            },
            error: function (XHR, status, response) {
                console.log(XHR.response);
                console.log(status);
                console.log(response);
                alertSection.html('<div class="alert alert-danger">Error occurred' +
                    ' when adding categories.</div>');
            }
        });
    }
}