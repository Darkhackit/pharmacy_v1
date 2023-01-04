@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['Role Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add Role</a>
                   @endpermission
                </div>
                <div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Add Role</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" id="submitRole">
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
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    {{ Form::select('permission[]',$permission,null,['class'=>'form-control select2 perm','multiple','style'=>'width:100%']) }}
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Permission</label>
                                                    <div class="text-danger" id="error-permission"></div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id" id="RoleId">


                                        </div>
                                    </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary addRole">save</button>
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
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>Permission(s)</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)

                                    <div class="modal fade text-left" id="editRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Add Role</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="submitRoleUpdate">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="edname" name="name" placeholder=" Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon"> Name</label>
                                                                        <div class="text-danger" id="error-edname"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="display_name" name="display_name" placeholder="Display Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Display Name</label>
                                                                        <div class="text-danger" id="error-eddisplay_name"></div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                       <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Description</label>
                                                                        <div class="text-danger" id="error-eddescription"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        {{ Form::select('permission[]',$permission,null,['class'=>'form-control select2 perm','multiple','style'=>'width:100%']) }}
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Permission</label>
                                                                        <div class="text-danger" id="error-edpermission"></div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id" id="RoleId">


                                                            </div>
                                                        </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary updateRole">save</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->display_name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td>
                                            @if($role->perms())
                                                <ul style="list-style:none">
                                                    @foreach ($role->perms()->get() as $permission)
                                                            <li>{{ $permission->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                        <td>
                                            @permission(['Role Edit','All'])
                                            <button class="btn btn-info btn-sm editRoler" id="{{$role->id}}" type="button" data-toggle="modal" data-target="#editRole"><i class="fa fa-pencil"></i></button>
                                            @endpermission
                                            @permission(['Role Delete','All'])
                                            <form id="deleteRole" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteR" value="{{ $role->id }}">
                                                  <button type="button" id="{{ $role->id }}" class="btn btn-danger btn-sm deleteRol"><i class="fa fa-trash-o"></i></button>

                                            </form>
                                            @endpermission
                                        </td>

                                    </tr>

                                    <div class="modal fade text-left" id="editRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Add Role</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="submitRoleUpdate">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="edname" name="name" placeholder=" Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon"> Name</label>
                                                                        <div class="text-danger" id="error-name"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text"  class="form-control" id="display_name" name="display_name" placeholder="Display Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Display Name</label>
                                                                        <div class="text-danger" id="error-display_name"></div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                       <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Description</label>
                                                                        <div class="text-danger" id="error-description"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        {{ Form::select('permission[]',$permission,null,['class'=>'form-control select2 perm','multiple','style'=>'width:100%']) }}
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Permission</label>
                                                                        <div class="text-danger" id="error-permission"></div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id" id="RoleId">


                                                            </div>
                                                        </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary updateRole">save</button>
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
    $('.addRole').click(function () {

        let form = $('#submitRole').serialize();
        $('#error-name').html("");
        $('#error-display_name').html("");
        $('#error-description').html("");
        $('#error-permission').html("");

        $.ajax({
            url: "{{ route('role.store') }}",
            method: 'POST',
            data:form,
            success: function (response) {

                console.log(response)
                toastr.success('Role created successfully.', 'Role created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

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
                    if(data.errors.permission) {

                        $('#error-permission').html(data.errors.permission[0])

                    }
                }

            }
        })
    })

    $('.editRoler').click(function () {

        let id = $(this).attr('id')

        $.ajax({
            url: '{{url('/role')}}' + '/' + id,
            method:'GET',
            data:{id:id},
            success: function(response) {

               console.log(response.role.name)

               $('#edname').val(response.role.name)
               $('#display_name').val(response.role.display_name)
               $('#description').val(response.role.description)
               $('#RoleId').val(response.role.id)



            }
        })
    })

    $('.updateRole').click(function () {

        let id = $('#RoleId').val();

        let form = $('#submitRoleUpdate').serialize();
        $.ajax({
            url: '{{url('/role')}}' + '/' + id,
            method:'POST',
            data:form,
            success: function (response) {

                toastr.success('Role Updated successfully.', 'Role Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {

                    $('#editRole').modal('hide');
                    location.reload()

                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)

                if(data.errors) {
                    if(data.errors.name) {

                        $('#error-edname').html(data.errors.name[0])

                    }
                     if(data.errors.display_name) {

                        $('#error-eddisplay_name').html(data.errors.display_name[0])

                    }
                    if(data.errors.description) {

                        $('#error-eddescription').html(data.errors.description[0])

                    }
                    if(data.errors.permission) {

                        $('#error-edpermission').html(data.errors.permission[0])

                    }
                }

            }
        })
    })

    $('.deleteRol').click(function () {

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

                     url:'{{url('/role')}}' + '/' + id,
                     method:'POST',
                     data:$('#deleteRole').serialize(),
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

