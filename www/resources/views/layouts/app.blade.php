<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Emmanuel Arthur">
    <title>POS</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href=" {{ URL::asset('app-assets/vendors/css/extensions/shepherd-theme-default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('app-assets/js/summernote/dist/summernote.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('trix/trix.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('daterangepicker/daterangepicker.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <!-- END: Vendor CSS-->



    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/data-list-view.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('picker/css/bootstrap-datepicker.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/pages/dashboard-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/plugins/tour/tour.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/invoice.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('print/print.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('iCheck/all.css') }}">


    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns {{ $setting->theme }} navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->

@include('partial.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
  @include('partial.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content" id="app">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
              @yield('content')

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
   @include('partial.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src=" {{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>


    <!-- BEGIN: Page Vendor JS-->
    <script src=" {{ URL::asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{URL::asset('app-assets/vendors/js/extensions/tether.min.js')}}"></script>
    <script src="{{URL::asset('app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
    <script src="{{URL::asset('app-assets/vendors/js/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{URL::asset('app-assets/vendors/js/input-mask/jquery.inputmask.js')}}"></script>
    {{-- <script src="{{URL::asset('app-assets/vendors/js/input-mask/jquery.inputmask.extentions.js')}}"></script> --}}
    <script src="{{URL::asset('app-assets/vendors/js/input-mask/jquery.inputmask.date.extensions.js')}}"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{URL::asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{URL::asset('app-assets/js/core/app.js')}}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
    <!-- END: Page JS-->
    <script src=" {{ URL::asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/extensions/toastr.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/wizard-steps.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>

    <script src="{{ URL::asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/jqueryNumber/jquery.number.js') }}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/number-input.js') }}"></script>


    <script>
        function DigitalClock () {

            var date = new Date();

            var month = date.getMonth();

            var day = date.getDay();

            var hour = date.getHours() + '';

            var minute = date.getMinutes() + '';

            var second = date.getSeconds() + '';

            if (hour.length < 2 ) {

                hour = '0' + hour ;
            }
            if (minute.length < 2) {

                minute = '0' + minute ;
            }

            if (second.length < 2 ) {

                second = '0' + second ;
            }


            var weekDays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']

            var clock =weekDays[day] + ' ' + hour + ':' + minute + ':' + second;

            document.getElementById('Clock').innerHTML = clock;

            //var date = new Date();
            //document.getElementById('Clock').innerHTML = date;
            }
            DigitalClock();
            setInterval(DigitalClock,1000);
    </script>




    @yield('script')

</body>
<!-- END: Body-->

</html>
