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
                                        <th>Invoice No</th>
                                        <th>Purchase ID</th>
                                        <th>Whole Seller name</th>
                                        <th>Payment</th>
                                        <th>Purchase Date</th>
                                        <th>Total</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>TOTAL COST:</th>
                                        <td class="totalCOst"></td>
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
<div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Purchase Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="card invoice-page" id="Printing">
                    <div id="invoice-template" class="card-body">

                        <div id="invoice-company-details" class="row">

                            <div class="col-sm-12 col-12 text-center">
                                <h1>{{ $setting->shop_name }}</h1>
                                <div class="invoice-details mt-2">
                                    <h6>MANUFACTURER NAME: <strong id="manuName"></strong> </h6>
                                    <h6>INVOICE NO.: <strong id="invoice"></strong></h6>
                                    <h6>DATE : <strong id="dates"></strong></h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->

                        <!-- Invoice Recipient Details -->
                        <div id="invoice-customer-details" class="row pt-2">


                        </div>
                        <!--/ Invoice Recipient Details -->

                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-1 invoice-items-table" style="padding-top: 50px">
                            <div class="row">
                                <div class="table-responsive col-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>MEDICINE NAME</th>
                                                <th>QUANTITY</th>
                                                <th>EXPIRY DATE</th>
                                                <th>PURCHASE PRICE</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mainPurcahse">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="invoice-total-details" class="invoice-total-table">
                            <div class="row">
                                <div class="col-7 offset-5">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th>TOTAL</th>
                                                    <td id="mainTotal"> USD</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Footer -->

                        <!--/ Invoice Footer -->

                    </div>
                </section>
            </div>

        </div>
    </div>
</div>


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

        let _token = $('input[name="_token"]').val();

        fetch_data()

        function fetch_data (from_date = "" , to_date = "")
        {

            $.ajax({

                url:"{{ route('purchase.fetch_data') }}",
                method:'POST',
                data:{from_date:from_date,to_date:to_date,_token:_token},
                dataType:'json',
                success: function (data)
                {

                    console.log(data)
                    let total = 0
                    let output = "";
                    $('#total_records').text(data.length);
                    data.forEach(function (i) {

                            output += '<tr>',
                            output += '<td>'+i.invoice_number+'</td>'
                            output += '<td>'+i.purchase_id+'</td>'
                            output += '<td>'+i.manufacturer_name+'</td>'
                            output += '<td>'+i.payment_name+'</td>'
                            output += '<td>'+i.purchase_date+'</td>'
                            output += '<td class="total">'+i.total+'</td>'
                            output += '<td> <button class="btn btn-info btn-sm viewPurcahse" id="'+i.id+'"><i class="fa fa-eye"></i></button></td>'

                            total += parseFloat(i.total) ;
                    })





                    $('tbody').html(output)
                    $('.totalCOst').html(total)
                    console.log(total)


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

            if(from_date != "" && to_date != "")
            {
                fetch_data(from_date,to_date)
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

            fetch_data(from_date,to_date)
        })


    })

</script>


<script>

    $('.filterTable').on('click','button.viewPurcahse',function () {

        $('tbody#mainPurcahse').empty()
        let id = $(this).attr('id');

        console.log(id)

        $.ajax({
            url:'{{url('/purchase/details')}}' + '/' + id,
            method:'GET',
            data:{id,id},
            success:function (response) {

                console.log(response)
                $('#manuName').html(response[0].manufacturer_name)
                $('#invoice').html(response[0].invoice_number)
                $('#dates').html(response[0].purchase_date)
                $('#mainTotal').html('₵'+response[0].mainTotal)

                response.forEach(function (i) {

                    $('tbody#mainPurcahse').append(`
                    <tr>
                        <td>${i.name}</td>
                        <td>${i.quantity}</td>
                        <td>${i.exDate}</td>
                        <td>₵ ${i.purchase_price}</td>
                        <td>₵ ${i.netTotal}</td>
                    </tr>
                    `)
                })
            }
        })

        $('#addUser').modal('show')
    })
</script>

@endsection
