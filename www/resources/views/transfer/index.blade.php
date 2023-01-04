@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <a href="{{ route('transfer.create') }}" class="btn btn-primary">Transfer Medicines</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Transfer ID</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Mode</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transfers as $transfer)


                                    <tr>
                                        <td>{{ $transfer->transfer_id }}</td>
                                        <td>{{ $transfer->shops_1->name }}</td>
                                        <td>{{ $transfer->shops_2->name }}</td>
                                        <td>{{ $transfer->mode }}</td>
                                        <td>₵ {{ $transfer->total }}</td>
                                        <td> {{ $transfer->transfer_date }}</td>
                                        <td>
                                            @permission(['Purchase View','All'])
                                            <button class="btn btn-info btn-sm viewPurcahse" id="{{ $transfer->id }}"><i class="fa fa-eye"></i></button>
                                            @endpermission
                                            @permission(['Purchase Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $transfer->id  }}">
                                                  <button type="button" class="btn btn-danger btn-sm btnDel" id="{{  $transfer->id  }}"><i class="fa fa-trash-o"></i></button>

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
                <h4 class="modal-title" id="myModalLabel17">Transfer Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="card invoice-page" id="Printing">
                    <div id="invoice-template" class="card-body">

                        <div id="invoice-company-details" class="row">

                            {{-- <div class="text-center col-sm-12 col-12">
                                <h1>{{ $setting->shop_name }}</h1>
                                <div class="mt-2 invoice-details">
                                    <h6>MANUFACTURER NAME: <strong id="manuName"></strong> </h6>
                                    <h6>INVOICE NO.: <strong id="invoice"></strong></h6>
                                    <h6>DATE : <strong id="dates"></strong></h6>
                                </div>
                            </div> --}}
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
            url:'{{url('/transfers/store')}}' + '/' + id,
            method:'GET',
            data:{id,id},
            success:function (response) {

                console.log(response)

                response.forEach(function (i) {

                    $('tbody#mainPurcahse').append(`
                    <tr>
                        <td>${i.name}</td>
                        <td>${i.quantity}</td>
                        <td>₵ ${parseFloat(i.quantity * i.selling_price)}</td>
                    </tr>
                    `)
                })

                $('#grandTotal').val(response[0].total)
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







</script>

@endsection
