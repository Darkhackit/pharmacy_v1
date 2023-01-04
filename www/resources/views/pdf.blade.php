<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    {{--  <link rel="stylesheet" type="text/css" href="{{ URL::asset('cssR/bootstrap.css') }}">  --}}

    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
          }
          .text-center {
            text-align: center !important;
          }
          .p-1 {
            padding: 0.25rem !important;
          }
          table {
            border-collapse: collapse;
          }
          .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
          }

          .table th,
          .table td {
            padding: 0.75rem;
            width:100%;
            height:2px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            font-size:10px;
          }

          .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
          }

          .table tbody + tbody {
            border-top: 2px solid #dee2e6;
          }

          .table-sm th,
          .table-sm td {
            padding: 0.3rem;
          }

          .table-bordered {
            border: 1px solid #dee2e6;
          }

          .table-bordered th,
          .table-bordered td {
            border: 1px solid #dee2e6;
          }

          .table-bordered thead th,
          .table-bordered thead td {
            border-bottom-width: 1px;
          }
          .table-borderless th,
            .table-borderless td,
            .table-borderless thead th,
            .table-borderless tbody + tbody {
            border: 0;
            }

    </style>

</head>
<body id="mainBody">

    <div class="container">
        <h2 class="text-center">
            {{$setting->printer_header}}
        </h2>
        @php
        $i = 1;
        $date = date('l jS \of F Y h:i:s A');
    @endphp
               <div>
                   Date: {{ $date }}
               </div>
               <div>
                customer: {{ $customerName }}
            </div>

            <div>
                Seller: {{ $seller }}
            </div>
            <div>
                Type: {{ $type }}
            </div>

            <div>
                Discount: {{ $discount }} %
            </div>



        <div class="p-1">
            <table class="table table-bordered">
              <thead >
                  <tr>
                      <th>No</th>
                      <th width="30px" height="1px">Product</th>
                      <th width="30px">Quantity</th>
                      <th width="30px">Unit Price</th>
                      <th width="30px">subtotal</th>
                      <th width="30px">Expiry</th>
                  </tr>
              </thead>
              <tbody>

                  @foreach ($sales as $sale)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sale->medName }}</td>
                      <td>{{ $sale->quantity }}</td>
                      <td>{{ $sale->selling_price }}</td>
                      <td>{{ $sale->price }}</td>
                      <td>{{ $sale->exDate }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
        </div>

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th>Total</th>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>{{ $tax }}</td>
                </tr>
                <tr>
                    <th>Paid</th>
                    <td>{{ $paid }}</td>
                </tr>
                <tr>
                    <th>Due</th>
                    <td>{{ $due }}</td>
                </tr>
                <tr>
                    <th>Payment</th>
                    <td>{{ $payment }}</td>
                </tr>
            </tbody>
        </table>

    </div></body></html>
