@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Manufacture Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Manufacturer</a>
                   @endpermission
                   @permission(['Manufacture Trash','All'])
                   @if(!$trash)
                   <a href="{{route('trash.manu')}}" class="btn btn-primary float-right">Trashed Manufacturers</a>
                   @else
                   <a href="{{route('manufacture.index')}}" class="btn btn-primary float-right"> Manufacturers</a>
                    @endif
                   @endpermission
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Number of Medicines</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($manufactures as $manufacture)

                                    <tr>
                                        <td>{{$manufacture->manufacturer_name}}</td>
                                        <td>{{ $manufacture->phone }}</td>
                                        <td>{{ $manufacture->email }}</td>
                                        <td>{{ $manufacture->address }}</td>
                                        <td>{{ $manufacture->medicines->count() }}</td>
                                        <td>
                                            @permission(['Manufacture Edit','All'])
                                            @if(!$trash)
                                            <button class="btn btn-info btn-sm btn-github editManuF" id="{{$manufacture->id}}"><i class="fa fa-pencil"></i></button>
                                            @else
                                            <button class="btn btn-info btn-sm btn-github ManuTRestore" id="{{$manufacture->id}}"><i class="fa fa-window-restore"></i></button>
                                             @endif
                                            @endpermission

                                            @permission(['Manufacture Delete','All'])
                                            <form id="deleteManufacture" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteM" value="{{ $manufacture->id }}">
                                                  <button type="button" id="{{ $manufacture->id }}" class="btn btn-danger btn-sm deleteMan"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>
                                    <div class="modal fade text-left" id="EditMan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Edit Manufacturere</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="ManEdit">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text" id="name"  class="form-control" name="manufacturer_name" placeholder="Company Name">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-user"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Conpany Name</label>
                                                                        <div class="text-danger" id="error-edcompany_name"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text" id="phone"  class="form-control" name="phone" placeholder="Phone Number" data-inputmask="'mask':'(999) 999-999999'" data-mask>
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-phone"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Phone Number</label>
                                                                        <div class="text-danger" id="error-edphone"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="email" id="email" class="form-control"  name="email" placeholder="Email">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Email</label>
                                                                        <div class="text-danger" id="error-edemail"></div>

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

                                                                <input type="hidden" name="id" id="manuId">

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary addDIt">Save</button>
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

<div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Manufacturere</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="ManAdd">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text"   class="form-control" name="manufacturer_name" placeholder="Company Name">
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
                                 <input type="text" name="address"  class="form-control" placeholder="Address">
                                    <div class="form-control-position">
                                        <i class="fa fa-fort-awesome"></i>
                                    </div>
                                    <label for="contact-floating-icon">Address</label>
                                    <div class="text-danger" id="error-address"></div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary addMan">Save</button>
            </div>
        </form>
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


    $('.addMan').click(function () {

        let form = $('#ManAdd').serialize();
        $('#error-email').html("");
        $('#error-phone').html("");
        $('#error-address').html("");
        $('#error-company_name').html("");

        $.ajax({
            url: "{{ route('manufacture.store') }}",
            method:'POST',
            data:form,
            success:function (response) {

                console.log(response)
                toastr.success('Manufacturer created successfully.', 'Manufacturer created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.manufacturer_name) {

                       $('#error-company_name').html(data.errors.manufacturer_name[0])

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

    $('.editManuF').click(function () {

        let id = $(this).attr('id');

        $.ajax({
            url:'{{url('/manufacture')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (response) {

                console.log(response)

                $('#name').val(response.man.manufacturer_name);
                $('#phone').val(response.man.phone);
                $('#email').val(response.man.email);
                $('#address').val(response.man.address);
                $('#manuId').val(response.man.id);

            }
        })

        $('#EditMan').modal('show')
    })

    $('.addDIt').click(function () {

        let id = $('#manuId').val();
        let form = $('#ManEdit').serialize();

        $.ajax({
            url:'{{url('/manufacture')}}' + '/' + id,
            method: 'POST',
            data:form,
            success:function (response) {
                console.log(response)
                toastr.success('Manufacturer updated successfully.', 'Manufacturer updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#EditMan').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.manufacturer_name) {

                       $('#error-edcompany_name').html(data.errors.manufacturer_name[0])

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

    $('.deleteMan').click(function () {
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

                    url:'{{url('/manufacture')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteManufacture').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Manufacturer has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else {
                            Swal.fire({
                                title: 'Error Deleting Manufacturer',
                                text:'This Manufacturer is already associated with some medicines',
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
    $('.ManuTRestore').click(function () {

        let tbh = $(this);
        let id = $(this).attr('id');

        console.log(id)

        $.ajax({

            type: 'GET',
            url: '{{url('/restore/manufacture')}}' + '/' + id,
            data: {id :id},
            success: function (feedback) {

                if(feedback.success == true) {

                      tbh.parents('tr').hide()
                      toastr.success('Manufacurer Restored successfully.', 'Manufacurer Restored successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                }
            }

        })
    })
</script>

@endsection
