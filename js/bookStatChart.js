function loadSingleBookStats($isbn) {
    var siteURL = $('#siteURL')[0].value;
    $.ajax({
        url: siteURL + '/administrator/getViewsForBookForLastDays',
        type:"post",
        data: {isbn: $isbn, numberOfDays: 30},
        success: function(data){
            var flag = $.parseJSON(data).status;
            if (flag === '1') {
                var dates = $.parseJSON(data).dates;
                var views = $.parseJSON(data).views;
                var barChartData = {
                    labels: dates,
                    datasets: [{
                        fillColor: "rgba(255,128,0,1)",
                        strokeColor: "black",
                        data: [views]
                    }]
                };
                var ctx = $('#singleBookViews')[0].getContext("2d");
                var barChart = new Chart(ctx).Bar(barChartData, {
                    responsive: true,
                    barValueSpacing: 2
                });
            } else {
                alert('Error occurred when loading the statistics graph');
            }
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
           alert('Error occurred when validating the isbn number');
        }
    });
}

function loadStatGraphs() {
    var siteURL = $('#siteURL')[0].value;
    $.ajax({
        url: siteURL + '/administrator/getStatGraphInfo',
        type:"post",
        data: {numberOfDays: 30},
        success: function(data){
            var flag = $.parseJSON(data).status;
            if (flag === '1') {
                var topBooks = $.parseJSON(data).topBooks;
                var topBookViews = $.parseJSON(data).topBookViews;

                var topCategories = $.parseJSON(data).topCategories;
                var topCategoryViews = $.parseJSON(data).topCategoryViews;

                var topSubCategories = $.parseJSON(data).topSubCategories;
                var topSubCategoryViews = $.parseJSON(data).topSubCategoryViews;

                var totalViews = $.parseJSON(data).totalViews;
                var dates = $.parseJSON(data).dates;

                // bar chart for top books
                var bookBarChartData = {
                    labels: topBooks,
                    datasets: [{
                        fillColor: "rgba(255,128,0,1)",
                        strokeColor: "black",
                        data: topBookViews
                    }]
                };
                var ctx = $('#topBooks')[0].getContext("2d");
                var barChart1 = new Chart(ctx).Bar(bookBarChartData, {
                    responsive: true,
                    barValueSpacing: 2
                });
/*--------------------------------------------------------------------------------------------------------------------*/
                // bar chart for top categories
                var categoryBarChartData = {
                    labels: topCategories,
                    datasets: [{
                        fillColor: "rgba(255,128,0,1)",
                        strokeColor: "black",
                        data: topCategoryViews
                    }]
                };
                var ctx = $('#topCategories')[0].getContext("2d");
                var barChart2 = new Chart(ctx).Bar(categoryBarChartData, {
                    responsive: true,
                    barValueSpacing: 2
                });
/*--------------------------------------------------------------------------------------------------------------------*/
                // bar chart for top subCategories
                var subCategoryBarChartData = {
                    labels: topSubCategories,
                    datasets: [{
                        fillColor: "rgba(255,128,0,1)",
                        strokeColor: "black",
                        data: topSubCategoryViews
                    }]
                };
                var ctx = $('#topSubCategories')[0].getContext("2d");
                var barChart3 = new Chart(ctx).Bar(subCategoryBarChartData, {
                    responsive: true,
                    barValueSpacing: 2
                });
/*---------------------------------------------------------------------------------------------------------------------*/
                // line chart for total book views
                var totalViewBarChartData = {
                    labels: dates,
                    datasets: [{
                        fillColor: "rgba(255,128,0,1)",
                        strokeColor: "black",
                        data: totalViews
                    }]
                };
                var ctx = $('#topSingleBookViews')[0].getContext("2d");
                var barChart4 = new Chart(ctx).Bar(totalViewBarChartData, {
                    responsive: true,
                    barValueSpacing: 1
                });
            } else {
                alert('Error occurred when loading the statistics graphs');
            }
        },
        error: function (XHR, status, response) {
            console.log(XHR.response);
            console.log(status);
            console.log(response);
            alert('Error occurred when loading the statistics graphs');
        }
    });
}