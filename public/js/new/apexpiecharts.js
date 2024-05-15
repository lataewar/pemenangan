"use strict";

var KTApexPieChartsDemo = (function () {
  // Private functions

  var _pieChart = function () {
    const apexChart = "#pie_chart";
    var options = {
      series: series_2,
      chart: {
        width: 520,
        type: "pie",
      },
      labels: labels_2,
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
      tooltip: {
        y: {
          formatter: function (val) {
            return (
              val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " suara"
            );
          },
        },
      },
      colors: colors_2,
    };

    var chart = new ApexCharts(document.querySelector(apexChart), options);
    chart.render();
  };

  return {
    // public functions
    init: function () {
      _pieChart();
    },
  };
})();

jQuery(document).ready(function () {
  KTApexPieChartsDemo.init();
});
