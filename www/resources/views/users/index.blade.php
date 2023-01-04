@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @permission(['User Add','All'])
                   <a href="#addUser" data-toggle="modal" class="btn btn-primary">Add User</a>
                   @endpermission
                </div>

<div class="modal fade text-left" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="submitUser" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="text" id="first-name-floating-icon" class="form-control" name="name" placeholder=" Name">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    <label for="first-name-floating-icon"> Name</label>
                                    <div class="text-danger" id="error-name"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    <input type="email" id="email-id-floating-icon" class="form-control" name="email" placeholder="Email">
                                    <div class="form-control-position">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <label for="email-id-floating-icon">Email </label>
                                    <div class="text-danger" id="error-email"></div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInputFile">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                  <input type="password" name="password" id="password" class="form-control" required>
                                    <div class="form-control-position">
                                        <i class="feather icon-lock"></i>
                                    </div>
                                    <label for="contact-floating-icon">Password</label>
                                    <div class="text-danger" id="error-password"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group position-relative has-icon-left">
                                    {{ Form::select('role[]',$role,null,['class'=>'form-control select2 perm','multiple','style'=>'width:100%']) }}
                                    <div class="form-control-position">
                                        <i class="fa fa-empire"></i>
                                    </div>
                                    <label for="contact-floating-icon">Roles</label>
                                    <div class="text-danger" id="error-role"></div>
                                </div>
                            </div>




                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary AddUser">Save</button>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <div class="modal fade text-left" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Edit User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" id="submitEditUser">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="text" id="name" class="form-control" name="edname" placeholder=" Name">
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-user"></i>
                                                                        </div>
                                                                        <label for="first-name-floating-icon"> Name</label>
                                                                        <div class="text-danger" id="error-edname"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        <input type="email" id="email" class="form-control" name="edemail" placeholder="Email">
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-envelope"></i>
                                                                        </div>
                                                                        <label for="email-id-floating-icon">Email </label>
                                                                        <div class="text-danger" id="error-edemail"></div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="basicInputFile">Image</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" name="image" id="image">
                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                      <input type="password" name="edpassword" id="password" class="form-control" required>
                                                                        <div class="form-control-position">
                                                                            <i class="feather icon-lock"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Password</label>
                                                                        <div class="text-danger" id="error-edpassword"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-label-group position-relative has-icon-left">
                                                                        {{ Form::select('edrole[]',$role,null,['class'=>'form-control select2 perm','multiple','style'=>'width:100%']) }}
                                                                        <div class="form-control-position">
                                                                            <i class="fa fa-empire"></i>
                                                                        </div>
                                                                        <label for="contact-floating-icon">Roles</label>
                                                                        <div class="text-danger" id="error-edrole"></div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="id" id="userId">




                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary AUser">Save</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>
                                            <img class="round" src="{{ URL::asset('user_images') }}/{{ $user->image }}" alt="avatar" height="40" width="40">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->roles()->get())

                                            <ul style="list-style:none">
                                                @foreach ( $user->roles()->get() as $role )
                                                     <li>{{ $role->name }}</li>
                                                @endforeach
                                            </ul>

                                            @endif
                                        </td>
                                        <td>
                                            @permission(['User Edit','All'])
                                            <button id="{{$user->id}}" data-toggle="modal" data-target="#EditUser" class="btn btn-info btn-sm editingUser"><i class="fa fa-pencil"></i></button>
                                            @endpermission
                                            @permission(['User Delete','All'])
                                            <form id="deleteUser" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="id" id="deleteU" value="{{ $user->id }}">
                                                  <button type="button" id="{{ $user->id }}" class="btn btn-danger btn-sm deleteUse"><i class="fa fa-trash-o"></i></button>

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


@endsection


@section('script')

<script>
    $('.AddUser').click(function (e) {

        e.preventDefault()
      let form = new FormData($('#submitUser')[0])

      $('#error-name').html("");
      $('#error-email').html("");
      $('#error-password').html("");
      $('#error-role').html("");


      $.ajax({
          url: "{{route('user.store')}}",
          method:'POST',
          data:form,
          dataType:'JSON',
          cache:false,
          processData:false,
          contentType:false,
          success:function (response) {
            console.log(response)
            toastr.success('User created successfully.', 'User created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

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
                 if(data.errors.email) {

                    $('#error-email').html(data.errors.email[0])

                }
                if(data.errors.password) {

                    $('#error-password').html(data.errors.password[0])

                }
                if(data.errors.role) {

                    $('#error-role').html(data.errors.role[0])

                }
            }

        }
      })
    })

    $('.editingUser').click(function () {

        let id = $(this).attr('id');
      //  let form = $('#submitEditUser').serialize()
        $.ajax({
            url:'{{url('/user')}}' + '/' + id,
            method:'GET',
            data: {id:id},
            success: function (response) {

                console.log(response)
                $('#name').val(response.user.name)
                $('#email').val(response.user.email)
                $('#password').val(response.user.password)
                $('#userId').val(response.user.id)

            }
        })
    })

    $('.AUser').click(function () {

        let id = $('#userId').val();
        let form = new FormData($('#submitEditUser')[0])
        console.log(form)

       $.ajax({
           url:'{{url('/user')}}' + '/' + id,
           method:'POST',
           data: form,
           dataType:'JSON',
           cache:false,
           processData:false,
           contentType:false,
           success: function (response) {

            toastr.success('User Updated successfully.', 'User Updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            setTimeout(function () {

                $('#EditUser').modal('hide');
                location.reload()

            },2000)
           },
           error: (jqXHR,textStatus , errorThrown) => {


            data = jqXHR.responseJSON;
            console.log(data)

            if(data.errors) {
                if(data.errors.edname) {

                    $('#error-edname').html(data.errors.edname[0])

                }
                 if(data.errors.edemail) {

                    $('#error-edemail').html(data.errors.edemail[0])

                }

                if(data.errors.edrole) {

                    $('#error-edrole').html(data.errors.edrole[0])

                }
            }

        }
       })

    })

    $('.deleteUse').click(function () {
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

                     url:'{{url('/user')}}' + '/' + id,
                     method:'POST',
                     data:$('#deleteUser').serialize(),
                     success: function (response) {

                         console.log(response)

                         if(response.success == true) {

                             tbh.parents('tr').hide()
                             Swal.fire({
                                 type: "success",
                                 title: 'Deleted!',
                                 text: 'User has been deleted.',
                                 confirmButtonClass: 'btn btn-success',
                               })
                         }
                     }
                 })
             }
             else if (result.dismiss === Swal.DismissReason.cancel) {
                 Swal.fire({
                   title: 'Cancelled',
                   text: 'User not deleted)',
                   type: 'error',
                   confirmButtonClass: 'btn btn-success',
                 })
               }
           })
    })

</script>

@endsection
