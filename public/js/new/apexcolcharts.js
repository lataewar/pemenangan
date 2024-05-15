"use strict";

// Shared Colors Definition
const primary = "#6993FF";
const success = "#1BC5BD";
const info = "#8950FC";
const warning = "#FFA800";
const danger = "#F64E60";
const muted = "#B5B5C3";

var KTApexColChartsDemo = (function () {
  // Private functions

  var _columnChart = function () {
    const apexChart = "#column_chart";
    var options = {
      series: series_1,
      chart: {
        type: "bar",
        height: 350,
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: categories_1,
      },
      yaxis: {
        title: {
          text: "Jumlah Suara",
        },
        labels: {
          formatter: function (val) {
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          },
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return (
              val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " suara"
            );
          },
        },
      },
      colors: [danger, warning, success],
    };

    var chart = new ApexCharts(document.querySelector(apexChart), options);
    chart.render();
  };

  return {
    // public functions
    init: function () {
      _columnChart();
    },
  };
})();

jQuery(document).ready(function () {
  KTApexColChartsDemo.init();
});
