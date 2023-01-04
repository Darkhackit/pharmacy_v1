@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Supplier Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Supplier</a>
                   @endpermission
                   @permission(['Supplier Trash','All'])
                   @if(!$trash)
                   <a href="{{route('trash.supply')}}" class="btn btn-primary float-right">Trashed Suppliers</a>
                   @else
                   <a href="{{route('supply.index')}}" class="btn btn-primary float-right">Suppliers</a>
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
                                <form class="form" id="supplierAdd">
                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text"   class="form-control" name="company_name" placeholder="Company Name">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Conpany Name</label>
                                                    <div class="text-danger" id="error-company_name"></div>
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
                                                 <input type="text" name="country"  class="form-control" placeholder="Country">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-connectdevelop"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Country</label>
                                                    <div class="text-danger" id="error-country"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                 <input type="text" name="city"  class="form-control" placeholder="City">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-creative-commons"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">City</label>
                                                    <div class="text-danger" id="error-city"></div>
                                                </div>
                                            </div>
                                             <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                 <input type="text" name="address"  class="form-control" placeholder="Address">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-fort-awesome"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Address</label>
                                                    <div class="text-danger" id="error-address"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                 <input type="text" name="acct"  class="form-control" placeholder="Account Number">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-credit-card-alt"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Account Number</label>
                                                    <div class="text-danger" id="error-acct"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                <textarea name="description"  cols="5" rows="5" class="form-control"></textarea>
                                                    <div class="form-control-position">
                                                        <i class="fa fa-commenting-o"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Description</label>
                                                    <div class="text-danger" id="error-description"></div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary addSup">Accept</button>
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
                                        <th>Company</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Email</th>
                                        <th>Account Number</th>
                                        <th>Description</th>
                                        <th>Medicines</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supplies as $supply)
                                    <tr>
                                        <td>{{$supply->company_name}}</td>
                                        <td>{{$supply->phone}}</td>
                                        <td>{{$supply->address}}</td>
                                        <td>{{ $supply->city }}</td>
                                        <td>{{ $supply->country }}</td>
                                        <td>{{ $supply->email }}</td>
                                        <td>{{ $supply->account_number }}</td>
                                        <td>{{ $supply->description }}</td>
                                        <td>{{ $supply->medicines->count() }}</td>
                                        <td>
                                            @permission(['Supplier Edit','All'])
                                            @if(!$trash)
                                            <button class="btn btn-info btn-sm supplyEdit" id="{{$supply->id}}"><i class="fa fa-pencil"></i></button>
                                            @else
                                            <button class="btn btn-info btn-sm supplyRestore" id="{{$supply->id}}"><i class="fa fa-window-restore"></i></button>
                                            @endif
                                            @endpermission
                                            @permission(['Supplier Delete','All'])
                                            <form id="deleteSupplier" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteS" value="{{ $supply->id }}">
                                                  <button type="button" id="{{ $supply->id }}" class="btn btn-danger btn-sm deleteSup"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>
                                    <div class="modal fade text-left" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Edit Supplier</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="supplierEdit">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  id="company_name" class="form-control" name="company_name" placeholder="Company Name">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-user"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Conpany Name</label>
                                                                        <div class="text-danger" id="error-edcompany_name"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  id="phone" class="form-control" name="phone" placeholder="Phone Number" data-inputmask="'mask':'(999) 999-999999'" data-mask>
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
                                                                     <input type="text" name="country" id="country" class="form-control" placeholder="Country">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-connectdevelop"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Country</label>
                                                                        <div class="text-danger" id="error-edcountry"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                     <input type="text" name="city" id="city" class="form-control" placeholder="City">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-creative-commons"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">City</label>
                                                                        <div class="text-danger" id="error-edcity"></div>
                                                                    </div>
                                                                </div>
                                                                 <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                     <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-fort-awesome"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Address</label>
                                                                        <div class="text-danger" id="error-edaddress"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                     <input type="text" name="acct" id="acct" class="form-control" placeholder="Account Number">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-credit-card-alt"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Account Number</label>
                                                                        <div class="text-danger" id="error-edacct"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-commenting-o"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Description</label>
                                                                        <div class="text-danger" id="error-eddescription"></div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id" id="supId">



                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary EditSup">Accept</button>
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



@endsection

@section('script')

<script>
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()


    $('.addSup').click(function () {

        let form = $('#supplierAdd').serialize()
        $('#error-company_name').html("");
        $('#error-phone').html("");
        $('#error-email').html("");
        $('#error-country').html("");
        $('#error-city').html("");
        $('#error-address').html("");
        $('#error-acct').html("");
        $('#error-description').html("");

        $.ajax({
            url: "{{ route('supply.store') }}",
            method:'POST',
            data:form,
            success:function (response) {

                console.log(response)
                toastr.success('Supplier created successfully.', 'Supplier created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.company_name) {

                       $('#error-company_name').html(data.errors.company_name[0])

                    }
                     if(data.errors.phone) {

                       $('#error-phone').html(data.errors.phone[0])

                   }
                   if(data.errors.email) {

                        $('#error-email').html(data.errors.email[0])

                   }
                   if(data.errors.country) {

                        $('#error-country').html(data.errors.country[0])

                   }
                   if(data.errors.city) {

                        $('#error-city').html(data.errors.city[0])

                   }
                   if(data.errors.address) {

                    $('#error-address').html(data.errors.address[0])

               }
               if(data.errors.acct) {

                $('#error-acct').html(data.errors.acct[0])

           }
           if(data.errors.description) {

            $('#error-description').html(data.errors.description[0])

       }
                }

            }

            })
    })

    $('.supplyEdit').click(function () {

        let id = $(this).attr('id')

        $.ajax({
            url:'{{url('/supply')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (response) {

                console.log(response);
                $('#company_name').val(response.supply.company_name)
                $('#phone').val(response.supply.phone)
                $('#email').val(response.supply.email)
                $('#country').val(response.supply.country)
                $('#city').val(response.supply.city)
                $('#address').val(response.supply.address)
                $('#acct').val(response.supply.account_number)
                $('#description').val(response.supply.description)
                $('#supId').val(response.supply.id)
            }
        })

        $('#EditUser').modal('show')
    })

    $('.EditSup').click(function () {

        let id = $('#supId').val();
        let form = $('#supplierEdit').serialize();

        $.ajax({
            url:'{{url('/supply')}}' + '/' + id,
            method:'POST',
            data:form,
            success:function (response) {
                console.log(response)
                toastr.success('Supplier Updated successfully.', 'Supplier Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.company_name) {

                       $('#error-edcompany_name').html(data.errors.company_name[0])

                    }
                     if(data.errors.phone) {

                       $('#error-edphone').html(data.errors.phone[0])

                   }
                   if(data.errors.email) {

                        $('#error-edemail').html(data.errors.email[0])

                   }
                   if(data.errors.country) {

                        $('#error-edcountry').html(data.errors.country[0])

                   }
                   if(data.errors.city) {

                        $('#error-edcity').html(data.errors.city[0])

                   }
                   if(data.errors.address) {

                    $('#error-edaddress').html(data.errors.address[0])

               }
               if(data.errors.acct) {

                $('#error-edacct').html(data.errors.acct[0])

           }
           if(data.errors.description) {

            $('#error-eddescription').html(data.errors.description[0])

       }
                }

            }
        })
    })

    $('.deleteSup').click(function () {

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

                    url:'{{url('/supply')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteSupplier').serialize(),
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
                        }else {

                            Swal.fire({
                                title: 'Error Deleting Supplier',
                                text:'This Supplier is already associated with some medicines',
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

$('.supplyRestore').click(function () {

    let tbh = $(this);
    let id = $(this).attr('id');

    console.log(id)

    $.ajax({

        type: 'GET',
        url: '{{url('/restore/supply')}}' + '/' + id,
        data: {id :id},
        success: function (feedback) {

            if(feedback.success == true) {

                  tbh.parents('tr').hide()
                  toastr.success('Supplier Restored successfully.', 'Supplier Restored successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            }
        }

    })
})

</script>

@endsection
