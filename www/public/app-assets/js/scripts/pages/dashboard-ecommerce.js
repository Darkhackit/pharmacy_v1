/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {

  var $primary = '#7367F0';
  var $success = '#28C76F';
  var $danger = '#EA5455';
  var $warning = '#FF9F43';

  var $primary_light = '#A9A2F6';
  var $danger_light = '#f29292';

  var $warning_light = '#ffc085';

  var $strok_color = '#b9c3cd';
  var $label_color = '#e7e7e7';



  // Line Area Chart - 1
  // ----------------------------------

  var gainedlineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$primary],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Subscribers',
      data: [28, 40, 36, 52, 38, 60, 55]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var gainedlineChart = new ApexCharts(
    document.querySelector("#line-area-chart-1"),
    gainedlineChartoptions
  );

  gainedlineChart.render();



  // Line Area Chart - 2
  // ----------------------------------

  var revenuelineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$success],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Revenue',
      data: [350, 275, 400, 300, 350, 300, 450]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var revenuelineChart = new ApexCharts(
    document.querySelector("#line-area-chart-2"),
    revenuelineChartoptions
  );

  revenuelineChart.render();


  // Line Area Chart - 3
  // ----------------------------------

  var saleslineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$danger],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Sales',
      data: [10, 15, 7, 12, 3, 16]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var saleslineChart = new ApexCharts(
    document.querySelector("#line-area-chart-3"),
    saleslineChartoptions
  );

  saleslineChart.render();

  // Line Area Chart - 4
  // ----------------------------------

  var orderlineChartoptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
    },
    colors: [$warning],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [{
      name: 'Orders',
      data: [10, 15, 8, 15, 7, 12, 8]
    }],

    xaxis: {
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      }
    },
    yaxis: [{
      y: 0,
      offsetX: 0,
      offsetY: 0,
      padding: { left: 0, right: 0 },
    }],
    tooltip: {
      x: { show: false }
    },
  }

  var orderlineChart = new ApexCharts(
    document.querySelector("#line-area-chart-4"),
    orderlineChartoptions
  );

  orderlineChart.render();

  // revenue-chart Chart
  // -----------------------------




  // Goal Overview  Chart
  // -----------------------------



  // Client Retention Chart
  // ----------------------------------

  var clientChartoptions = {
    chart: {
      stacked: true,
      type: 'bar',
      toolbar: { show: false },
      height: 300,
    },
    plotOptions: {
      bar: {
        columnWidth: '10%'
      }
    },
    colors: [$primary, $danger],
    series: [{
      name: 'New Clients',
      data: [175, 125, 225, 175, 160, 189, 206, 134, 159, 216, 148, 123]
    }, {
      name: 'Retained Clients',
      data: [-144, -155, -141, -167, -122, -143, -158, -107, -126, -131, -140, -137]
    }],
    grid: {
      borderColor: $label_color,
      padding: {
        left: 0,
        right: 0
      }
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'left',
      offsetX: 0,
      fontSize: '14px',
      markers: {
        radius: 50,
        width: 10,
        height: 10,
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      labels: {
        style: {
          colors: $strok_color,
        }
      },
      axisTicks: {
        show: false,
      },
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      tickAmount: 5,
      labels: {
        style: {
          color: $strok_color,
        }
      }
    },
    tooltip: {
      x: { show: false }
    },
  }

  var clientChart = new ApexCharts(
    document.querySelector("#client-retention-chart"),
    clientChartoptions
  );

  clientChart.render();

  // Session Chart
  // ----------------------------------

  var sessionChartoptions = {
    chart: {
      type: 'donut',
      height: 325,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    series: [58.6, 34.9, 6.5],
    legend: { show: false },
    comparedResult: [2, -3, 8],
    labels: ['Desktop', 'Mobile', 'Tablet'],
    stroke: { width: 0 },
    colors: [$primary, $warning, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light, $danger_light]
      }
    }
  }

  var sessionChart = new ApexCharts(
    document.querySelector("#session-chart"),
    sessionChartoptions
  );

  sessionChart.render();

  // Customer Chart
  // -----------------------------

  var customerChartoptions = {
    chart: {
      type: 'pie',
      height: 330,
      dropShadow: {
        enabled: false,
        blur: 5,
        left: 1,
        top: 1,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    labels: ['New', 'Returning', 'Referrals'],
    series: [690, 258, 149],
    dataLabels: {
      enabled: false
    },
    legend: { show: false },
    stroke: {
      width: 5
    },
    colors: [$primary, $warning, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light, $danger_light]
      }
    }
  }

  var customerChart = new ApexCharts(
    document.querySelector("#customer-chart"),
    customerChartoptions
  );

  customerChart.render();

});


// Chat Application
(function ($) {
  "use strict";
  // Chat area
  if ($('.chat-application .user-chats').length > 0) {
    var chat_user = new PerfectScrollbar(".user-chats", { wheelPropagation: false });
  }

})(jQuery);

