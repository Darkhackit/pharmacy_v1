<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('cssR/bootstrap.css') }}">

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
                Customer: {{ $customerName }}
            </div>

          



        <div class="p-1">
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th> Price</th>
                      <th>Date</th>
                  </tr>
              </thead>
              <tbody>

                  @foreach ($data as $sale)


                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sale->name }}</td>
                      <td>{{ $sale->quantity }}</td>
                      <td>{{ $sale->price }}</td>
                      <td>{{ $sale->date }}</td>
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
               
            </tbody>
        </table>

    </div></body></html>
