@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <a href="{{ route('purchase.create') }}" class="btn btn-primary">Add Purchase</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Purchase ID</th>
                                        <th>Supplier Name</th>
                                        <th>Payment</th>
                                        <th>Purchase Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)


                                    <tr>
                                        <td>{{ $purchase->invoice_number }}</td>
                                        <td>{{ $purchase->purchase_id }}</td>
                                        <td>{{ $purchase->company_name }}</td>
                                        <td>{{ $purchase->payment_name }}</td>
                                        <td>{{ $purchase->purchase_date }}</td>
                                        <td>₵ {{ $purchase->total }}</td>
                                        <td>
                                            @if($purchase->status == 1)

                                            {{ 'Paid'}}

                                            @else

                                            {{ 'Unpaid'}}
                                            @endif
                                        </td>
                                        <td>
                                            @permission(['Purchase View','All'])
                                            <button class="btn btn-info btn-sm viewPurcahse" id="{{ $purchase->id }}"><i class="fa fa-eye"></i></button>
                                            @endpermission
                                            @permission(['Purchase Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $purchase->id  }}">
                                                  <button type="button" class="btn btn-danger btn-sm btnDel" id="{{  $purchase->id  }}"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="text-left modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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

                            <div class="text-center col-sm-12 col-12">
                                <h1>{{ $setting->shop_name }}</h1>
                                <div class="mt-2 invoice-details">
                                    <h6>MANUFACTURER NAME: <strong id="manuName"></strong> </h6>
                                    <h6>INVOICE NO.: <strong id="invoice"></strong></h6>
                                    <h6>DATE : <strong id="dates"></strong></h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->

                        <!-- Invoice Recipient Details -->
                        <div id="invoice-customer-details" class="pt-2 row">


                        </div>
                        <!--/ Invoice Recipient Details -->

                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-1 invoice-items-table" style="padding-top: 50px">
                            <div class="row">
                                <div class="table-responsive col-12">
                                    <table class="table table-borderless tab">
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
                                                    <input type="number" name="total" id="grandTotal"  class="form-control" readonly>

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
            <div class="modal-footer">
                <button class="mb-1 btn btn-primary mb-md-0 addMed"> <i class="feather icon-file-text"></i> Add Medicine</button>
                <button class="mb-1 btn btn-primary mb-md-0 addMed"> <i class="feather icon-file-text"></i>Update Purchase</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script src="{{ URL::asset('app-assets/js/scripts/pages/invoice.js') }}"></script>
    <script src="{{ URL::asset('print/print.min.js') }}"></script>
<script>

    $('.viewPurcahse').click(function () {

        $('tbody#mainPurcahse').empty()
        let id = $(this).attr('id');

        $.ajax({
            url:'{{url('/purchase/details')}}' + '/' + id,
            method:'GET',
            data:{id,id},
            success:function (response) {

                console.log(response)
                $('#manuName').html(response[0].company_name)
                $('#invoice').html(response[0].invoice_number)
                $('#dates').html(response[0].purchase_date)
                $('#grandTotal').val(response[0].mainTotal)

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

    $('.btnDel').click(function () {

        let tdh = $(this);
        let id = $(this).attr('id');

        console.log(id)

        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
          }).then(function (result) {

            if(result.value) {

                $.ajax({

                    url:'{{url('purchase')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCategory').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tdh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Sales has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else {
                            Swal.fire({
                                title: 'Error Deleting Sale',
                                text:'This Sale is already associated with some medicines',
                                animation: false,
                                customClass: 'animated shake',
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                              })
                        }
                    }
                })
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                  title: 'Cancelled',
                  text: 'Your imaginary file is safe :)',
                  type: 'error',
                  confirmButtonClass: 'btn btn-success',
                })
              }
    })
    })


    $(document).on('click','.addMed',function () {
        $('tbody#mainPurcahse').append(`

<tr>
    <td>
     <select class="form-control select2 pnam" name="medicine[]">
         <option>SELECT MEDICINE</option>
         @foreach($medicines as $medicine)
         <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
         @endforeach
     </select>

    </td>

    <td>
        <input type="number" name="quantity[]" class="form-control quantity" required>
    </td>
    <td>
        <input type="date" name="expirydate[]"  class="form-control exdate" required>
    </td>
    <td>
        <input type="number" name="purchase_price[]" class="form-control pprice" required>
    </td>

    <td>
        <input type="number" name="netTotal[]" class="form-control netTotal" value="0.00" readonly required>
    </td>


</tr>
`)



$('.select2').select2();

    })

    $(".tab").delegate('.pnam','change',function () {


        var id = this.value;
        var tr = $(this).parent().parent();
        console.log(id)

        $.ajax({
            url:'{{url('/medicine')}}' + '/' + id,
            method:'GET',
            data:{id,id},
            success:function (response) {

                console.log(response.medicine)
                tr.find('.stock').val(response.medicine.stock)
                tr.find('.pprice').val(response.medicine.purchase_price)
                tr.find('.newPrice').val(response.medicine.selling_price)
            }
})

    })


    $('.tab').delegate('.quantity','keyup',function () {

        console.log('Hi')


        var qty = $(this);
        console.log(qty)
        var tr = $(this).parent().parent();

        let manuPrice = tr.find('.pprice').val()



        tr.find('.netTotal').val(parseFloat(qty.val() * manuPrice))

        sumAll()

})

                        function sumAll() {
                            let allTotal = $('#grandTotal').val();
                            var sumPriceArray = [];

                            let priceItem = $('.netTotal')

                            for(var i = 0 ; i < priceItem.length; i++) {

                                sumPriceArray.push(parseFloat($(priceItem[i]).val()))

                            }

                                function sumArrayPrices(total , number) {

                                    return total + number;

                                }
                                var sumArrayPrice = sumPriceArray.reduce(sumArrayPrices)

                                let tot = sumArrayPrice + parseFloat(allTotal)

                                $('#grandTotal').val(tot)

                        }


</script>

@endsection
