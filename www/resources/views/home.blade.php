@extends('layouts.app')

@section('content')
<section id="dashboard-analytics">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="text-white card bg-analytics">
                <div class="card-content">
                    <div class="text-center card-body">
                        <img src="../../../app-assets/images/elements/decore-left.png" class="img-left" alt="
card-img-left">
                        <img src="../../../app-assets/images/elements/decore-right.png" class="img-right" alt="
card-img-right">
                        <div class="mt-0 shadow avatar avatar-xl bg-primary">
                            <div class="avatar-content">
                                <i class="feather icon-award white font-large-1"></i>
                            </div>
                        </div>
                        @if($checkSales > 0)
                        <div class="text-center">
                            <h1 class="mb-2 text-white">Congratulations {{ Auth::user()->name}},</h1>
                            <p class="m-auto w-75">You have done <strong>
                                @foreach ($result as $item)
                                ₵ {{ $item->t }}
                                @endforeach

                            </strong> more sales today.</p>
                        </div>
                        @else
                        <div class="text-center">
                            <h1 class="mb-2 text-white">Welcome Back {{ Auth::user()->name}},</h1>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="pb-0 card-header d-flex flex-column align-items-start">
                    <div class="m-0 avatar bg-rgba-primary p-50">
                        <div class="avatar-content">
                            <i class="fa fa-medkit text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="mt-1 text-bold-700 mb-25">{{ $medicine_count }}</h2>
                    <p class="mb-0">Medicines</p>
                </div>
                <div class="card-content">
                    <div id="subscribe-gain-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="pb-0 card-header d-flex flex-column align-items-start">
                    <div class="m-0 avatar bg-rgba-warning p-50">
                        <div class="avatar-content">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="mt-1 text-bold-700 mb-25">{{ $checkSales }}</h2>
                    <p class="mb-0">Todays Sales</p>
                </div>
                <div class="card-content">
                    <div id="orders-received-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Expiration</h4>
                                </div>
                                <div class="card-content">
                                    <div class="mt-1 table-responsive">
                                        <table class="table mb-0 table-hover-animation">
                                            <thead>
                                                <tr>
                                                    <th>MEDICINES</th>
                                                    <th>DAYS LEFT</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medicine_expires as $medicine)
                                                @php
                                                $date = date('Y-m-d');
                                                    $date1 = new DateTime($date);
                                                    $date2 = new DateTime($medicine->exDate);
                                                    $interval = $date1->diff($date2);
                                                    $days = $interval->format('%R%a');
                                                @endphp

                                                @if($days < 100)

                                                <tr>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>
                                                        @if($days <= 99 && $days >= 50 )
                                                        <div class="chip chip-warning">
                                                            <div class="chip-body">
                                                                <div class="chip-text">{{$days}}</div>
                                                            </div>
                                                        </div>
                                                        @elseif($days < 49 && $days > 0)
                                                        <div class="chip chip-danger">
                                                            <div class="chip-body">
                                                                <div class="chip-text">{{$days}}</div>
                                                            </div>
                                                        </div>
                                                        @elseif($days < 0)
                                                        <div class="chip chip-danger">
                                                            <div class="chip-body">
                                                                <div class="chip-text">{{'expired'}}</div>
                                                            </div>
                                                        </div>

                                                        @else
                                                        <div class="chip chip-success">
                                                            <div class="chip-body">
                                                                <div class="chip-text">{{$days}}</div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>



                                                </tr>
                                                @endif
                                                @endforeach

                                            </tbody>
                                        </table>

                        <hr/>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4 class="mb-0">Total Medicines In Stock</h4>
                    <p class="mb-0 font-medium-5"><i class="cursor-pointer feather icon-help-circle text-muted"></i></p>
                </div>
                <div class="card-content">
                    <div class="px-0 pb-0 card-body">
                        <div id="goal-overview-chart" class="mt-75"></div>
                        <div class="mx-0 text-center row">
                            <div class="py-1 col-6 border-top border-right d-flex align-items-between flex-column">
                                <p class="mb-50">Medicines</p>
                                <p class="font-large-1 text-bold-700 stock">
                                    @foreach ($count_all_medicine as $med)
                                    {{ number_format( $med->stock )}}
                                    @endforeach
                                </p>
                            </div>
                            <div class="py-1 col-6 border-top d-flex align-items-between flex-column">
                                <p class="mb-50">Total bought Today</p>
                                <p class="font-large-1 text-bold-700 quantity">
                                    @foreach ($countTotalToday as $item)
                                    {{ number_format($item->quantity)  }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($bestSellers as $bestSeller)


        <div class="col-xl-4 col-md-6 col-sm-12 profile-card-1">
            <div class="card">
                <div class="mx-auto card-header">
                    <div class="avatar avatar-xl">
                        <img class="img-fluid" src="{{ URL::asset('user_images') }}/{{ $bestSeller->image }}" alt="img placeholder">
                    </div>
                </div>
                <div class="card-content">
                    <div class="text-center card-body">
                        <h4>{{ $bestSeller->name }}</h4>

                        <hr class="my-2">
                        <div class="d-flex justify-content-between">
                            <div class="float-left">
                                <i class="feather icon-star text-warning mr-50"></i>₵ {{ $bestSeller->sale }}
                            </div>
                            <div class="float-right">
                                <i class="feather icon-briefcase text-primary mr-50"></i> Total Sales Made Today
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
    <div class="row match-height">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="pb-0 card-header d-flex justify-content-between">
                    <h4>Most Purchased Medicine</h4>

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table mb-0 table-hover-animation">
                            <thead>
                                <tr>
                                    <th>MEDICINES</th>
                                    <th>Purchased</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicine_high as $medicine)





                                <tr>
                                    <td>{{ $medicine->name }}</td>
                                    <td>
                                        <div class="chip chip-success">
                                            <div class="chip-body">
                                                <div class="chip-text">{{ $medicine->number_of_sales }}</div>
                                            </div>
                                        </div>

                                    </td>



                                </tr>



                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title">Less Purchased Medicine</h4>

                    </div>
                    <p class="mb-0"><i class="cursor-pointer feather icon-more-vertical font-medium-3 text-muted"></i></p>
                </div>
                <div class="card-content">
                    <div class="px-0 card-body">

                        <table class="table mb-0 table-hover-animation">
                            <thead>
                                <tr>
                                    <th>MEDICINES</th>
                                    <th>Purchased</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicine_low as $medicine)





                                <tr>
                                    <td>{{ $medicine->name }}</td>
                                    <td>
                                        <div class="chip chip-danger">
                                            <div class="chip-body">
                                                <div class="chip-text">{{ $medicine->number_of_sales }}</div>
                                            </div>
                                        </div>

                                    </td>



                                </tr>



                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">LOW STOCK</h4>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Expiration</h4>
                    </div>
                    <div class="card-content">
                        <div class="mt-1 table-responsive">
                            <table class="table mb-0 table-hover-animation zero-configuration">
                                <thead>
                                    <tr>
                                        <th>MEDICINES</th>
                                        <th>STOCK</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicine_stocks as $medicine)


                                    @if($medicine->stock <= 99)


                                    <tr>
                                        <td>{{ $medicine->name }}</td>
                                        <td>
                                            @if($medicine->stock <= 99 && $medicine->stock >= 50 )
                                            <div class="chip chip-warning">
                                                <div class="chip-body">
                                                    <div class="chip-text">{{$medicine->stock}}</div>
                                                </div>
                                            </div>
                                            @elseif($medicine->stock <= 49)
                                            <div class="chip chip-danger">
                                                <div class="chip-body">
                                                    <div class="chip-text">{{$medicine->stock}}</div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="chip chip-success">
                                                <div class="chip-body">
                                                    <div class="chip-text">{{$medicine->stock}}</div>
                                                </div>
                                            </div>
                                            @endif

                                        </td>



                                    </tr>

                                    @endif

                                    @endforeach

                                </tbody>
                            </table>

            <hr/>
                    </div>
                    </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Sales</h4>
                </div>
                <div class="card-content">
                    <div class="mt-1 table-responsive">
                        <table class="table mb-0 table-hover-animation">
                            <thead>
                                <tr>
                                    <th>ORDER</th>
                                    <th>CUSTOMER</th>
                                    <th>SELLER</th>
                                    <th>TOTAL</th>
                                    <th>PAYMENT</th>
                                    <th>Time</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)

                                @php
                                $date = $sale->created_at;
                              //  $date = Carbon::parse($date);
                                @endphp

                                <tr>

                                    <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>{{ $sale->code }}</td>
                                    <td class="p-1">
                                       {{ $sale->customer_name}}
                                    </td>
                                    <td>  {{$sale->name}}</td>
                                    <td>
                                          {{ $sale->total_price }}
                                    </td>
                                    <td>{{ $sale->payment_method }}</td>
                                    <td>{{
                                        \Carbon\Carbon::parse($date)->diffForHumans()
                                    }}</td>

                                </tr>

                                @endforeach

                                @php
                                    $realStock = $med->stock + $item->quantity;
                                @endphp

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="text-left modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center modal-title" id="myModalLabel17">Low Stock and Expired Medicine</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             <h2 class="text-center">Low Stock</h2>
               <table class="table table-striped">
                   <thead>
                       <tr>
                           <th>Name</th>
                           <th>Quantity Left</th>
                       </tr>
                   </thead>
                   <tbody id="lowStock">

                   </tbody>
               </table>

               <hr>
               <h2 class="text-center">Getting Expired</h2>
               <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Days Left</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach ($medicine_expires as $medicine)

                 @php
                 $date = date('Y-m-d');
                     $date1 = new DateTime($date);
                     $date2 = new DateTime($medicine->exDate);
                     $interval = $date1->diff($date2);
                     $days = $interval->format('%R%a');
                 @endphp

                 @if($days < 30)

                 <tr>
                     <td>{{ $medicine->name }}</td>
                     <td>
                         @if($days < 49 && $days > 0)
                         <div class="chip chip-danger">
                             <div class="chip-body">
                                 <div class="chip-text">{{$days}}</div>
                             </div>
                         </div>
                         @elseif($days < 0)
                         <div class="chip chip-danger">
                             <div class="chip-body">
                                 <div class="chip-text">{{'expired'}}</div>
                             </div>
                         </div>
                         @endif
                     </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>
<div class="text-left modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center modal-title" id="myModalLabel17">Pending Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Supplier</th>
                            <th>Paid Amount</th>
                            <th>Totalid Amount</th>
                            <th>Pending Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sum = 0;
                        @endphp
                        @foreach ($owing as $items)

                      @php
                      $pend = $items->total - $items->paid_amount;

                      $sum += $pend;
                      @endphp
                        <tr>
                            <td>{{ $items->invoice_number }}</td>
                            <td>{{ $items->company_name }}</td>
                            <td>{{ $items->paid_amount }}</td>
                            <td>{{ $items->total }}</td>
                            <td>{{ $items->total - $items->paid_amount }}</td>
                            <td>
                                <button type="button" id="{{ $items->own_id }}" class="btn btn-success pay">Pay</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <td>{{ $sum }}</td>
                    </tfoot>
                </table>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ URL::asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>

<script>

    let stock = $.trim($('.stock').html())
    let quantity = $.trim($('.quantity').html())

    console.log(stock)
    var $success = '#28C76F';
    var $strok_color = '#b9c3cd';
    var goalChartoptions = {
        chart: {
          height: 250,
          type: 'radialBar',
          sparkline: {
            enabled: true,
          },
          dropShadow: {
            enabled: true,
            blur: 3,
            left: 1,
            top: 1,
            opacity: 0.1
          },
        },
        colors: [$success],
        plotOptions: {
          radialBar: {
            size: 110,
            startAngle: -150,
            endAngle: 150,
            hollow: {
              size: '77%',
            },
            track: {
              background: $strok_color,
              strokeWidth: '50%',
            },
            dataLabels: {
              name: {
                show: false
              },
              value: {
                offsetY: 18,
                color: '#99a2ac',
                fontSize: '4rem'
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: ['#00b5b5'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          },
        },
        series: [{{ ceil($item->quantity / ($realStock * 100)) }} ],
        stroke: {
          lineCap: 'round'
        },

      }

      var goalChart = new ApexCharts(
        document.querySelector("#goal-overview-chart"),
        goalChartoptions
      );

      goalChart.render();
</script>

<script>
    $(window).on('load',function () {

        $.ajax({

            url:"{{ route('lowStock') }}",
            method:'GET',
            success:function (response) {

                if(response.length > 0) {

                    response.forEach(function (i) {

                        $('tbody#lowStock').append(`

                         <tr>
                             <td>${i.name}</td>
                             <td>
                                <div class="chip chip-danger">
                                    <div class="chip-body">
                                        <div class="chip-text">${i.stock}</div>
                                    </div>
                                </div>
                             </td>
                         </tr>

                        `)
                    })

                    if (document.cookie.indexOf('visited=true') == -1){

                        $('#addUser').modal('show')
                        var year = 60*60*24;
                        var expires = new Date((new Date()).valueOf() + year);
                        document.cookie = "visited=true;expires=" + expires.toUTCString();
                      }


                }
            }

        })
    })
</script>

<script>

    $('#addUser').on('hide.bs.modal',function ()
    {

        $('#payment').modal('show')
    })


    $('.pay').click(function () {

        let id = $(this).attr('id')
        let tbh = $(this)

        $.ajax({
            url:'{{ url('pay') }}' + '/' + id,
            method:'GET',
            success:function(response)
            {
              tbh.parents('tr').hide()
            }
        })
    })
</script>

@endsection
