@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Payment Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Payment</a>
                   @endpermission
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>


                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)


                                    <tr>
                                        <td>{{$payment->payment_name}}</td>
                                        <td>{{ $payment->description }}</td>
                                        <td>
                                            @permission(['Payment Edit','All'])
                                            <button class="btn btn-info btn-sm loadCat" id="{{$payment->id}}"><i class="fa fa-pencil"></i></button>
                                            @endpermission
                                            @permission(['Payment Delete','All'])
                                            <form id="deleteCategory" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $payment->id }}">
                                                  <button type="button" id="{{ $payment->id }}" class="btn btn-danger btn-sm deleteCat"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>
                                    <div class="modal fade text-left" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Edit Medicine Type</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="CatEdit">
                                                        @csrf
                                                         @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text" id="name"  class="form-control" name="name" placeholder="Type Name">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-list"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon">Type Name</label>
                                                                        <div class="text-danger" id="error-edcategory_name"></div>
                                                                    </div>
                                                                </div>



                                                                 <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                  <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-fort-awesome"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Description</label>
                                                                        <div class="text-danger" id="error-eddescription"></div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="id" id="catId">

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary editCate">save</button>
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
                <h4 class="modal-title" id="myModalLabel17">Add Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="CatAdd">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text"   class="form-control" name="name" placeholder="Payment Name">
                                    <div class="form-control-position">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <label for="first-name-floating-icon">Payment Name</label>
                                    <div class="text-danger" id="error-category_name"></div>
                                </div>
                            </div>



                             <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                              <textarea name="description" id="" cols="5" rows="5" class="form-control"></textarea>
                                    <div class="form-control-position">
                                        <i class="fa fa-fort-awesome"></i>
                                    </div>
                                    <label for="contact-floating-icon">Description</label>
                                    <div class="text-danger" id="error-description"></div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary addCate">save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('.addCate').click(function () {

        let form = $('#CatAdd').serialize();
        $('#error-category_name').html("");
        $('#error-description').html("");
        $.ajax({
            url: "{{ route('payment.store') }}",
            method:'POST',
            data:form,
            success:function (response) {
                toastr.success('Payment created successfully.', 'Payment created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#addUser').modal('hide');
                    location.reload()

                },2000)

            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.name) {

                       $('#error-category_name').html(data.errors.name[0])

                    }
                     if(data.errors.description) {

                       $('#error-description').html(data.errors.description[0])

                   }


                }

            }
        })
    })

    $('.loadCat').click(function () {

        let id = $(this).attr('id');
        $.ajax({
            url:'{{url('/payment')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success:function (response) {

                $('#name').val(response.payment_name)
                $('#description').val(response.description)
                $('#catId').val(response.id)

            }
        })
        $('#editCategory').modal('show')
    })

    $('.editCate').click(function () {

        let id = $('#catId').val();
        let form = $('#CatEdit').serialize();
        console.log(form)
        $.ajax({
            url:'{{url('/payment')}}' + '/' + id,
            method:'POST',
            data:form,
            success:function (response) {

                toastr.success('Payment updated successfully.', 'Payment updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#editCategory').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                  if(data.errors.name) {

                       $('#error-edcategory_name').html(data.errors.name[0])

                    }
                     if(data.errors.description) {

                       $('#error-eddescription').html(data.errors.description[0])

                   }


                }

            }
        })
    })

    $('.deleteCat').click(function () {
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

                    url:'{{url('/payment')}}' + '/' + id,
                    method:'POST',
                    data:$('#deleteCategory').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Unit has been deleted.',
                                confirmButtonClass: 'btn btn-success',
                              })
                        }else {
                            Swal.fire({
                                title: 'Error Deleting Unit',
                                text:'This Unit is already associated with some medicines',
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
