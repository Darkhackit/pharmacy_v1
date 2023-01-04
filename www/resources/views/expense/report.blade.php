@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-6 col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-end">
            <h4 class="card-title">Expenses and Profit Report</h4>
            <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
        </div>
        <div class="card-content">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-start">
                    <div class="mr-2">
                        <p class="mb-50 text-bold-600">Total Profit</p>
                        <h2 class="text-bold-400">
                            <sup class="font-medium-1">₵</sup>
                            <span class="text-success">{{ array_sum($profit) }}</span>
                        </h2>
                    </div>
                    <div>
                        <p class="mb-50 text-bold-600">Total Expenses</p>
                        <h2 class="text-bold-400">
                            <sup class="font-medium-1">₵</sup>
                            <span>{{ array_sum($expense) }}</span>
                        </h2>
                    </div>

                </div>
                <div id="revenue-chart"></div>
            </div>
        </div>
    </div>
</div>
@php
function js_str($s)
{
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function js_array($array)
{
    $temp = array_map('js_str', $array);
    return '[' . implode(',', $temp) . ']';
}

@endphp

@endsection

@section('script')

<script src="{{ URL::asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>


<script>
    var $danger_light = '#f29292';
    var $label_color = '#e7e7e7';
    var $info = '#00cfe8';
    var $success_light = '#55DD92';
    var $info_light = '#1fcadb';
    var $white = '#fff';
    var $primary = '#7367F0';
  var $success = '#28C76F';
  var $danger = '#EA5455';
  var $warning = '#FF9F43';

  var $primary_light = '#A9A2F6';
  var $danger_light = '#f29292';

  var $warning_light = '#ffc085';

  var $strok_color = '#b9c3cd';
  var $label_color = '#e7e7e7';

    var revenueChartoptions = {
        chart: {
          height: 270,
          toolbar: { show: false },
          type: 'line',
        },
        stroke: {
          curve: 'smooth',
          dashArray: [0, 8],
          width: [4, 2],
        },
        grid: {
          borderColor: $label_color,
        },
        legend: {
          show: false,
        },
        colors: [$danger_light, $strok_color],

        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            inverseColors: false,
            gradientToColors: [$primary, $strok_color],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
          },
        },
        markers: {
          size: 0,
          hover: {
            size: 5
          }
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
          categories: @php
              echo js_array($dates)
          @endphp,
          axisBorder: {
            show: false,
          },
          tickPlacement: 'on',
        },
        yaxis: {
          tickAmount: 5,
          labels: {
            style: {
              color: $strok_color,
            },
           // formatter: function (val) {
           //   return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
           // }
          }
        },
        tooltip: {
          x: { show: false }
        },
        series: [{
          name: "Profit",
          data: @php echo js_array($profit)  @endphp
        },
        {
          name: "Expense",
          data:  @php echo js_array($expense)  @endphp
        }
        ],

      }

      var revenueChart = new ApexCharts(
        document.querySelector("#revenue-chart"),
        revenueChartoptions
      );

      revenueChart.render();
</script>

@endsection
