@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Permission Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Permission</a>
                   @endpermission
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Discription</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)


                                    <tr>

                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->display_name}}</td>
                                        <td>{{$permission->description}}</td>
                                        <td>
                                            @permission(['Permission Edit','All'])
                                            <button id="{{$permission->id}}" data-toggle="modal" data-target="#editPermission"  class="btn btn-info btn-sm editPermission"><i class="fa fa-pencil"></i></button>
                                            @endpermission
                                            @permission(['Permission Delete','All'])
                                            <form id="deletePermission" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteP" value="{{ $permission->id }}">
                                                  <button type="button" id="{{ $permission->id }}" class="btn btn-danger btn-sm deletePerm"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission

                                        </td>

                                    </tr>
                                    <div class="modal fade text-left" id="editPermission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Edit Permission</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form class="form" id="PermissionEdit">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  id="name" class="form-control" name="name" placeholder=" Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon"> Name</label>
                                                                        <div class="text-danger" id="edname"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="eddisplay_name" name="display_name" placeholder="Display Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Display Name</label>
                                                                        <div class="text-danger" id="display_name"></div>

                                                                    </div>
                                                                    <input type="hidden" name="id" id="permId">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                       <textarea name="description"  cols="5" rows="5" id="eddescription" class="form-control"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Description</label>
                                                                        <div class="text-danger" id="description"></div>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="{{ $permission->id }}" class="btn btn-primary mr-1 mb-1 updatePermission">Update</button>
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
                <h4 class="modal-title" id="myModalLabel17">Add Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form" id="submitPermission">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" id="first-name-floating-icon" class="form-control" name="name" placeholder=" Name">
                                    <div class="form-control-position">
                                        <i class="feather icon-lock"></i>
                                    </div>
                                    <label for="first-name-floating-icon"> Name</label>
                                    <div class="text-danger" id="error-name"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" id="email-id-floating-icon" class="form-control" name="display_name" placeholder="Display Name">
                                    <div class="form-control-position">
                                        <i class="feather icon-lock"></i>
                                    </div>
                                    <label for="email-id-floating-icon">Display Name</label>
                                    <div class="text-danger" id="error-display_name"></div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                   <textarea name="description" id="" cols="5" rows="5" class="form-control"></textarea>
                                    <div class="form-control-position">
                                        <i class="feather icon-lock"></i>
                                    </div>
                                    <label for="contact-floating-icon">Description</label>
                                    <div class="text-danger" id="error-description"></div>
                                </div>
                            </div>



                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mr-1 mb-1 addPermission">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>



@endsection

@section('script')

<script>
    $('.addPermission').click(function () {

        let form = $('#submitPermission').serialize();
        $('#error-name').html("");
        $('#error-display_name').html("");
        $('#error-description').html("");

        $.ajax({
            url: "{{ route('permission.store') }}",
            method: 'POST',
            data:form,
            success:function (response) {
                toastr.success('Permission created successfully.', 'Permission created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

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

                        $('#error-name').html(data.errors.name[0])

                    }
                     if(data.errors.display_name) {

                        $('#error-display_name').html(data.errors.display_name[0])

                    }
                    if(data.errors.description) {

                        $('#error-description').html(data.errors.description[0])

                    }
                }

            }
        })
    })


    $('.editPermission').click(function () {

        let id = $(this).attr('id');

        $.ajax({
            url: '{{url('/permission')}}' + '/' + id,
            method:"GET",
            data: {id:id},
            success: function (response) {

                console.log(response)
                $('#name').val(response.permission.name)
                $('#eddisplay_name').val(response.permission.name)
                $('#eddescription').val(response.permission.name)
                $('#permId').val(response.permission.id)

            }
        })

        $('#editPermission').modal('show')
    })

    $('.updatePermission').click(function () {


        let id = $('#permId').val()

        console.log(id)

        let form = $('#PermissionEdit').serialize();

        console.log(form)

       $.ajax({
           url: '{{url('/permission')}}' + '/' + id,
            method:'POST',
            data:form,
           success:function (response) {

            toastr.success('Permission Updated successfully.', 'Permission Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            setTimeout(function () {

                $('#editPermission').modal('hide');
                location.reload()

            },2000)
          }
       })
    })

    $('.deletePerm').click(function () {

       let tbh = $(this);
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

                    url:'{{url('/permission')}}' + '/' + id,
                    method:'POST',
                    data:$('#deletePermission').serialize(),
                    success: function (response) {

                        console.log(response)

                        if(response.success == true) {

                            tbh.parents('tr').hide()
                            Swal.fire({
                                type: "success",
                                title: 'Deleted!',
                                text: 'Permission has been deleted.',
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
</script>


@endsection
