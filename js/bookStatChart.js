var dData = function() {
    return Math.round(Math.random() * 1000) + 10
};

var barChartData = {
    labels: ["Nov 2", "Nov 3", "Nov 4", "Nov 5", "Nov 6"],
    datasets: [{
        fillColor: "rgba(255,128,0,1)",
        strokeColor: "black",
        data: [dData(), dData(), dData(), dData(), dData()]
    }]
}

var index = 11;
var ctx = $('#canvas')[0].getContext("2d");
var barChartDemo = new Chart(ctx).Bar(barChartData, {
    responsive: true,
    barValueSpacing: 2
});