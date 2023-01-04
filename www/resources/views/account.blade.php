@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Account Settings</h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        General
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                        <i class="feather icon-info mr-50 font-medium-3"></i>
                                        Software
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                        <i class="feather icon-camera mr-50 font-medium-3"></i>
                                        Social links
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                                        <i class="feather icon-feather mr-50 font-medium-3"></i>
                                        Connections
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                        <i class="feather icon-message-circle mr-50 font-medium-3"></i>
                                        Notifications
                                    </a>
                                </li>   --}}
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">

                                                <hr>
                                                <form novalidate id="submitUser">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Name</label>
                                                                    <input type="text" class="form-control" name="name" id="account-name" placeholder="Name" value="{{ $user->name }}" required data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">E-mail</label>
                                                                    <input type="email" class="form-control" name="email" id="account-e-mail" placeholder="Email" value="{{ $user->email }}" required data-validation-required-message="This email field is required">
                                                                </div>
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

                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="button" id="{{ $user->id }}" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 subUser">Save
                                                                changes</button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form novalidate id="updatePassword">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password">New Password</label>
                                                                    <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="8">
                                                                    <small>Password must be 8 characters long</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="button" id="{{ $user->id }}" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 upPass">Save
                                                                changes</button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                             <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form novalidate id="UpSetting">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="basicInputFile">Software Logo</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="image" id="image">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-website">Invoice Header</label>
                                                                <input type="text" class="form-control" id="account-website" placeholder="" name="invoiceHeader" value="{{ $settings->printer_header }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-website">Shop Name</label>
                                                                <input type="text" class="form-control" id="account-website" placeholder="" name="name" value="{{ $settings->shop_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div>
                                                                    <label for="">Software Theme</label>
                                                                </div>

                                                                <li class="d-inline-block mr-2">
                                                                    <fieldset>
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input" name="customRadio" id="customRadio1" value="nun" {{ $settings->theme == 'nun'? 'checked' : '' }}>
                                                                            <label class="custom-control-label" for="customRadio1">White Theme</label>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                                <li class="d-inline-block mr-2">
                                                                    <fieldset>
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input" name="customRadio" id="customRadio2" value="dark-layout" {{ $settings->theme == 'dark-layout'? 'checked' : '' }}>
                                                                            <label class="custom-control-label" for="customRadio2">Dark Theme</label>
                                                                        </div>
                                                                    </fieldset>
                                                                </li>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="button" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 submitSetting">Save
                                                                changes</button>

                                                        </div>
                                                    </div>
                                                    @permission(['Backup','All'])
                                                    <button type="submit" class="btn btn-warning mr-sm-1 mb-1 mb-sm-0">
                                                        Backup</button>
                                                        @endpermission
                                                </form>
                                            </div>
                                            {{-- <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-twitter">Twitter</label>
                                                                <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-facebook">Facebook</label>
                                                                <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-google">Google+</label>
                                                                <input type="text" id="account-google" class="form-control" placeholder="Add link">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-linkedin">LinkedIn</label>
                                                                <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-instagram">Instagram</label>
                                                                <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="account-quora">Quora</label>
                                                                <input type="text" id="account-quora" class="form-control" placeholder="Add link">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                                changes</button>
                                                            <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                            <strong>Twitter</strong></a>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                        <h6>You are connected to facebook.</h6>
                                                        <span>Johndoe@gmail.com</span>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <a href="javascript: void(0);" class="btn btn-danger">Connect to
                                                            <strong>Google</strong>
                                                        </a>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                        <h6>You are connected to Instagram.</h6>
                                                        <span>Johndoe@gmail.com</span>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                            changes</button>
                                                        <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                                <div class="row">
                                                    <h6 class="m-1">Activity</h6>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch1">
                                                            <label class="custom-control-label mr-1" for="accountSwitch1"></label>
                                                            <span class="switch-label w-100">Email me when someone comments
                                                                onmy
                                                                article</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch2">
                                                            <label class="custom-control-label mr-1" for="accountSwitch2"></label>
                                                            <span class="switch-label w-100">Email me when someone answers on
                                                                my
                                                                form</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="accountSwitch3">
                                                            <label class="custom-control-label mr-1" for="accountSwitch3"></label>
                                                            <span class="switch-label w-100">Email me hen someone follows
                                                                me</span>
                                                        </div>
                                                    </div>
                                                    <h6 class="m-1">Application</h6>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch4">
                                                            <label class="custom-control-label mr-1" for="accountSwitch4"></label>
                                                            <span class="switch-label w-100">News and announcements</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="accountSwitch5">
                                                            <label class="custom-control-label mr-1" for="accountSwitch5"></label>
                                                            <span class="switch-label w-100">Weekly product updates</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="custom-control custom-switch custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                                                            <label class="custom-control-label mr-1" for="accountSwitch6"></label>
                                                            <span class="switch-label w-100">Weekly blog digest</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                            changes</button>
                                                        <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
    $('.subUser').click(function () {

        let form = new FormData($('#submitUser')[0]);

        let id = $(this).attr('id')

        console.log(id)

        $.ajax({
            url:'{{url('/account/update')}}' + '/' + id,
            method:'POST',
            data:form,
            dataType:'JSON',
            cache:false,
            processData:false,
            contentType:false,
            success:function(response) {

                if(response.success == true) {

                    toastr.success('Account updated successfully.', 'Account updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                    setTimeout(function () {
                        location.reload()

                    },2000)

                }else {

                    toastr.danger('Error updating password', 'Error updating password', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
                }
            }

        })

    })

    $('.upPass').click(function () {

        let form = $('#updatePassword').serialize();
        let id = $(this).attr('id')

        console.log(id)

        $.ajax({
            url:'{{url('/password/update')}}' + '/' + id,
            method:'POST',
            data:form,
            success:function(response) {

                if(response.success == true) {

                toastr.success('Password updated successfully.', 'Password updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {
                    location.reload()

                },2000)

            }
            }

        })

    })

    $('.submitSetting').click(function () {

        let form = new FormData($('#UpSetting')[0]);

        let id = 1;

        $.ajax({

            url:'{{url('/settings')}}' + '/' + id,
            method:'POST',
            data:form,
            dataType:'JSON',
            cache:false,
            processData:false,
            contentType:false,
            success:function (response) {

                if(response.success == true) {

                    toastr.success('Software updated successfully.', 'Software updated successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                    setTimeout(function () {
                        location.reload()

                    },2000)

                }
            }

        })
    })
</script>

@endsection
