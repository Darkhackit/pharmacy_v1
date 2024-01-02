@extends('layouts.app')

@section('content')
    <section id="column-selectors">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="from_date" id="from_date" readonly>
                                    <div  class="input-group-append">to</div>
                                    <input type="text" class="form-control" name="to_date" id="to_date" readonly>
                                </div>
                                <div class="col-md-6 col-12 mt-2">
                                    <div class="form-label-group">
                                        <select name="manufacture_id" id="manufacture_id" class="form-control select2 pnam" >
                                            <option disabled selected>Select Medicine</option>
                                            @foreach ($medicines as $medicine)
                                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                            @endforeach

                                        </select>
                                        <label for="first-name-column">Select Medicine</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" name="refresh" id="refresh" class="btn btn-warning">Refresh</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors filterTable">
                                    <thead>
                                    <tr>
                                        <th>Sales ID</th>
                                        <th>Medicine Name</th>
                                        <th>Quantity</th>
                                        <th>Expiry Date</th>
                                        <th>Price</th>
                                        <th>Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>TOTAL SALES:</th>
                                        <td class="totalSales"></td>
                                        <th>TOTAL PROFIT:</th>
                                        <td class="totalProfit"></td>
                                    </tr>
                                    </tfoot>

                                </table>
                                @csrf
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')

    <script src="{{ URL::asset('picker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('print/print.min.js') }}"></script>

    <script>
        $(document).ready(function ()
        {
            let date = new Date();

            $('.input-daterange').datepicker({

                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            let medicine = $('#manufacture_id').val()

            let _token = $('input[name="_token"]').val();

            fetch_data()

            function fetch_data (from_date = "" , to_date = "",medicine = "")
            {

                $.ajax({

                    url:"{{ route('purchase.filterMedicine') }}",
                    method:'POST',
                    data:{from_date:from_date,to_date:to_date,_token:_token,medicine:medicine},
                    dataType:'json',
                    success: function (data)
                    {

                        console.log(data)
                        let totalSales = 0
                        let totalProfit = 0
                        let output = "";
                        $('#total_records').text(data.length);
                        data.forEach(function (i) {

                            output += '<tr>',
                                output += '<td>'+i.invoice_number+'</td>'
                            output += '<td>'+i.name+'</td>'
                            output += '<td>'+i.quantity+'</td>'
                            output += '<td>'+i.ext_date+'</td>'
                            output += '<td>'+i.purchase_price+'</td>'
                            output += '<td>'+i.date+'</td>'


                            totalSales += parseFloat(i.price) ;
                            totalProfit += parseFloat(i.profit)
                        })





                        $('tbody').html(output)
                        $('.totalSales').html(totalSales)
                        $('.totalProfit').html(totalProfit)
                        // console.log(total)


                    }


                })


            }




            function sumTotalPrice() {

                var priceItem = $('.total').html()
                var sumPriceArray = [0];

                priceItem.forEach(function (i) {

                    sumPriceArray.push(parseFloat($(i)))
                })

                function sumArrayPrices(total , number) {

                    return total + number;

                }

                var sumArrayPrices = sumPriceArray.reduce(sumArrayPrices)

                console.log(sumArrayPrices)


            }



            $('#filter').click(function ()
            {
                let from_date = $('#from_date').val()
                let to_date = $('#to_date').val()
                let medicine = $('#manufacture_id').val()

                if(from_date != "" && to_date != "")
                {
                    fetch_data(from_date,to_date,medicine)
                }
                else
                {
                    alert('Both Date are required')
                }
            })

            $('#refresh').click(function ()
            {
                let from_date =  $('#from_date').val('')
                let to_date = $('#to_date').val('')
                let medicine = $('#manufacture_id').val()

                fetch_data(from_date,to_date,medicine)
            })


        })

    </script>


@endsection
