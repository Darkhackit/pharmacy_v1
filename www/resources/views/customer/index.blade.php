@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Customer Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Customer</a>
                   @endpermission
                   @permission(['Customer Trash','All'])
                   @if(!$trash)
                   <a href="{{route('trash.customer')}}" class="btn btn-primary float-right">Trash Customers</a>
                   @else
                   <a href="{{route('customer.index')}}"  class="btn btn-primary float-right">Customers</a>
                   @endif
                   @endpermission
                </div>
                <div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Add Supplier</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" id="CustomerAdd">
                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text"   class="form-control" name="customer_name" placeholder="Customer Name">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Conpany Name</label>
                                                    <div class="text-danger" id="error-customer_name"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text"   class="form-control" name="phone" placeholder="Phone Number" data-inputmask="'mask':'(999) 999-999999'" data-mask>
                                                    <div class="form-control-position">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Phone Number</label>
                                                    <div class="text-danger" id="error-phone"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="email"  class="form-control"  name="email" placeholder="Email">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <label for="email-id-floating-icon">Email</label>
                                                    <div class="text-danger" id="error-email"></div>

                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text"  class="form-control"  name="address" placeholder="Address">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-fort-awesome"></i>
                                                    </div>
                                                    <label for="email-id-floating-icon">Address</label>
                                                    <div class="text-danger" id="error-address"></div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary addCus">Save</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Number of Perchase</th>
                                        <th>Last Purchase</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)


                                    <tr>
                                        <td>{{$customer->customer_name}}</td>
                                        <td> {{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                         <button type="button" id="{{ $customer->id }}" class="viewPurchase btn btn-success btn-sm">{{ $customer->number_of_purchase }}</button>
                                        </td>
                                        <td>{{ $customer->last_purchase }}</td>
                                        <td>
                                            @permission(['Customer Edit','All'])
                                            @if(!$trash)
                                            <button class="btn btn-info btn-sm customerInfo" id="{{$customer->id}}"><i class="fa fa-pencil"></i></button>
                                            @else
                                            <button class="btn btn-info btn-sm customerRestore" id="{{$customer->id}}"><i class="fa fa-window-restore"></i></button>
                                            @endif
                                            @endpermission
                                            @permission(['Customer Delete','All'])
                                            <form id="deleteCustomer" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteC" value="{{ $customer->id }}">
                                                  <button type="button" id="{{ $customer->id }}" class="btn btn-danger btn-sm deleteCust"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>
                                    <div class="modal fade text-left" id="EditCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Add Supplier</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="CustomerEdit">
                                                        @csrf
                                                         @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"   class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-user"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Conpany Name</label>
                                                                        <div class="text-danger" id="error-edcustomer_name"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"   class="form-control" id="phone" name="phone" placeholder="Phone Number" data-inputmask="'mask':'(999) 999-999999'" data-mask>
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-phone"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Phone Number</label>
                                                                        <div class="text-danger" id="error-edphone"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="email"  class="form-control" id="email" name="email" placeholder="Email">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Email</label>
                                                                        <div class="text-danger" id="error-edemail"></div>

                                                                    </div>

                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="address" name="address" placeholder="Address">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-fort-awesome"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Address</label>
                                                                        <div class="text-danger" id="error-edaddress"></div>

                                                                    </div>
                                                                    <input type="hidden" name="id" id="customerId">

                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary editCus">Save</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
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

<div class="modal fade text-left" id="viewPurchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Purchases Made</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="invoice-items-details" class="pt-1 invoice-items-table" style="padding-top: 50px">
                    <div class="row">
                        <div class="table-responsive col-12">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>MEDICINE NAME</th>
                                        <th>QUANTITY</th>
                                        <th>DATE</th>
                                    </tr>
                                </thead>
                                <tbody id="mainPurcahse">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary addCus">Save</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    $('.addCus').click(function () {

        let form = $('#CustomerAdd').serialize();
        $('#error-email').html("");
        $('#error-phone').html("");
        $('#error-address').html("");
        $('#error-customer_name').html("");

        $.ajax({
            url:"{{ route('customer.store') }}",
            method:'POST',
            data:form,
            success:function (response) {

                console.log(response)
                toastr.success('Customer created successfully.', 'Customer created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.customer_name) {

                       $('#error-customer_name').html(data.errors.customer_name[0])

                    }
                     if(data.errors.phone) {

                       $('#error-phone').html(data.errors.phone[0])

                   }
                   if(data.errors.email) {

                        $('#error-email').html(data.errors.email[0])

                   }


                   if(data.errors.address) {

                    $('#error-address').html(data.errors.address[0])

               }


                }

            }
        })

    })

    $('.customerInfo').click(function () {

        let id = $(this).attr('id');

        $.ajax({

            url:'{{url('/customer')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (feedback) {

                console.log(feedback);
                $('#customer_name').val(feedback.customer.customer_name)
                $('#phone').val(feedback.customer.phone)
                $('#email').val(feedback.customer.email)
                $('#address').val(feedback.customer.address)
                $('#customerId').val(feedback.customer.id)
            }
        })

        $('#EditCustomer').modal('show')
    })

    $('.editCus').click(function () {

        let id = $('#customerId').val();
        let form = $('#CustomerEdit').serialize();

        $.ajax({
            url:'{{url('/customer')}}' + '/' + id,
            method:'POST',
            data:form,
            success:function (feedback) {

                console.log(feedback)
                toastr.success('Customer updated successfully.', 'Customer updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#EditCustomer').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.customer_name) {

                       $('#error-edcustomer_name').html(data.errors.customer_name[0])

                    }
                     if(data.errors.phone) {

                       $('#error-edphone').html(data.errors.phone[0])

                   }
                   if(data.errors.email) {

                        $('#error-edemail').html(data.errors.email[0])

                   }


                   if(data.errors.address) {

                    $('#error-edaddress').html(data.errors.address[0])

               }


                }

            }
        })
    })

    $('.deleteCust').click(function () {

        let tbh = $(this)
        let id = $(this).attr('id');

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

                    url:'{{url('/customer')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCustomer').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Supplier has been deleted.',
                                confirmButtonClass: 'btn btn-success',
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

$('.customerRestore').click(function () {

    let tbh = $(this);
    let id = $(this).attr('id');

    console.log(id)

    $.ajax({

        type: 'GET',
        url: '{{url('/restore/customer')}}' + '/' + id,
        data: {id :id},
        success: function (feedback) {

            if(feedback.success == true) {

                  tbh.parents('tr').hide()
                  toastr.success('Customer Restored successfully.', 'Customer Restored successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            }
        }

    })
})


$('.viewPurchase').click(function () {

    $('tbody#mainPurcahse').empty()

    let id = $(this).attr('id')

    console.log(id)


    $.ajax({

        url:'{{url('/customer/viewPurchase')}}' + '/' + id,
        method:'GET',
        data:{id:id},
        success:function (feedback) {

            console.log(feedback)

            feedback.forEach(function (i) {

                $('tbody#mainPurcahse').append(`
                <tr>
                    <td>${i.name}</td>
                    <td>${i.quantity}</td>
                    <td>${i.date}</td>

                </tr>
                `)
            })

        }


    })

    $('#viewPurchase').modal('show')
})

</script>

@endsection
