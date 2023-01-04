@extends('layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add  Medicine</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form id="submitMedicine"  class="steps-validation wizard-circle" enctype="multipart/form-data">
                            @csrf
                            <!-- Step 1 -->
                            <h6><i class="step-icon feather icon-home"></i> Step 1</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName3">
                                                Barcode or QrCode
                                            </label>
                                            <input type="text" class="form-control " id="code" name="code" placeholder="Barcode">
                                            <div class="text-danger error-barcode"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName3">
                                              Medicine Name
                                            </label>
                                            <input type="text" class="form-control required" id="name" name="name" placeholder="Name" autofocus='true'>
                                            <div class="text-danger error-name"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Generic Name
                                            </label>
                                            <input type="text" class="form-control " value="N" id="generic" name="generic" placeholder="Generic Name">
                                            <div class="text-danger error-generic"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">
                                                Medincine Strength
                                            </label>
                                            <input type="text" class="form-control required" value="N"  id="strength" name="strength" placeholder="Example 2g">
                                            <div class="text-danger error-strength"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Half Life
                                            </label>
                                            <input type="text" class="form-control required" value="N"  id="halfLife" name="halfLife" placeholder="Example 2hrs">
                                            <div class="text-danger error-halfLife"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">
                                                Manufacture Date
                                            </label>
                                            <input type="date" class="form-control   required" value="{{ date('Y-m-d')}}" id="manDate" name="manDate" placeholder="Manufacture Date">
                                            <div class="text-danger error-manDate"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Expiry Date
                                            </label>
                                            <input type="date" class="form-control  required" value="2022-01-01" id="expDate" name="expDate" placeholder="Expiration Date">
                                            <div class="text-danger error-expDate"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Stock
                                            </label>
                                            <input type="number" class="form-control required" id="stock" name="stock" placeholder="Stock">
                                            <div class="text-danger error-stock"></div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Purchase Price
                                            </label>
                                            <input type="text" class="form-control pp required" id="pprice" name="pprice" placeholder="Purchase Price">
                                            <div class="text-danger error-pprice"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Retail Price
                                            </label>

                                                <input type="checkbox" class="minimal percentage" checked>
                                                  Use Percentage

                                              <div class="col-xs-6" style="padding:0">

                                                <div class="input-group">

                                                  <input type="number" class="form-control input-sm newPercentage" min="0" value="30" required>

                                                </div>

                                              </div>
                                            <input type="text" class="form-control sp required" id="rprice" name="sprice" placeholder="Selling Price">
                                            <div class="text-danger error-sprice"></div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                Whole Sale Price Price
                                            </label>
                                            <input type="checkbox" class="minimal wpercentage" checked>
                                            Use Percentage

                                        <div class="col-xs-6" style="padding:0">

                                          <div class="input-group">

                                            <input type="number" class="form-control input-sm wnewPercentage" min="0" value="10" required>

                                          </div>

                                        </div>
                                            <input type="text" class="form-control sp required" id="wprice" name="wholesale" placeholder="Selling Price">
                                            <div class="text-danger error-sprice"></div>
                                        </div>


                                    </div>

                                </div>

                            </fieldset>

                            <!-- Step 2 -->
                            <h6><i class="step-icon feather icon-briefcase"></i> Step 2</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proposalTitle3">
                                               Manufacurer
                                            </label>
                                            {{ Form::select('manufacture_id',$manufacture,null,['class'=>'custom-select form-control required']) }}
                                            <div class="text-danger error-manufacture_id"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jobTitle5">
                                                Category
                                            </label>
                                            {{ Form::select('category_id',$category,null,['class'=>'custom-select form-control required']) }}
                                            <div class="text-danger error-category_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proposalTitle3">
                                               Supplier
                                            </label>
                                            {{ Form::select('supply_id',$supply,null,['class'=>'custom-select form-control required ']) }}
                                            <div class="text-danger error-supply_id"></div>

                                        </div>
                                        <div class="form-group">
                                            <label for="jobTitle5">
                                                Medicine Type
                                            </label>
                                            {{ Form::select('type_id',$type,null,['class'=>'custom-select form-control required ']) }}
                                            <div class="text-danger error-type_id"></div>


                                        </div>
                                        <div class="form-group">
                                            <label for="jobTitle5">
                                               Unit
                                            </label>
                                            {{ Form::select('unit_id',$unit,null,['class'=>'custom-select form-control required ']) }}
                                            <div class="text-danger error-type_id"></div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInputFile">Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input newPhotp" name="image" id="image">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                        </div>
                                        <p class="help-block">Photo should be maximum of 20mb</p>
                                        <img src="{{ URL::asset('app-assets/images/anonymous.png') }}" class="img-thumbnail previewer" alt="" width="100px">

                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 3 -->
                            <h6><i class="step-icon feather icon-image"></i> Step 3</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="eventName3">
                                                Indicators
                                            </label>
                                            {{--  <textarea  data-plugin="summernote" name="indicator" id="indicator" cols="6" rows="6" class="form-control my-editor"></textarea>  --}}
                                           <input type="hidden" name="indicator" id="indicator">
                                           <trix-editor input="indicator"></trix-editor>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventStatus3">
                                                Dosage
                                            </label>
                                            {{--  <textarea name="dosage" id="dosage" cols="6" rows="6" class="form-control my-editor"></textarea>  --}}
                                            <input type="hidden" name="dosage" id="dosage">
                                           <trix-editor input="dosage"></trix-editor>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="eventLocation3">
                                               Missed Dose
                                            </label>
                                            <input type="hidden" name="misdosage" id="misdosage">
                                            <trix-editor input="misdosage"></trix-editor>
                                            {{--  <textarea name="misdosage" id="misdosage" cols="6" rows="6" class="form-control my-editor"></textarea>  --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="eventLocation3">
                                               Precautions
                                            </label>
                                            <input type="hidden" name="precautions" id="precautions">
                                            <trix-editor input="precautions"></trix-editor>
                                            {{--  <textarea name="precautions" id="precautions" cols="6" rows="6" class="form-control my-editor"></textarea>  --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="eventLocation3">
                                              Side Effect
                                            </label>
                                            <input type="hidden" name="effect" id="effect">
                                            <trix-editor input="effect"></trix-editor>

                                            {{--  <textarea name="effect" id="effect" cols="6" rows="6" class="form-control my-editor"></textarea>  --}}
                                        </div>

                                    </div>
                                    <div class="">
                                        <label>Hide Medicine</label>
                                        <input type="checkbox" name="hidden" class="minimal"  >
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('script')
<script src="{{ URL::asset('app-assets/js/scripts/forms/form-tooltip-valid.js') }}"></script>

<script>
  /*=========================================================================================
    File Name: wizard-steps.js
    Description: wizard steps page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Wizard tabs with numbers setup
$(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Wizard tabs with icons setup
$(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onFinished: function (event, currentIndex) {
        alert("Form submitted.");
    }
});

// Validate steps wizard

// Show form
var form = $(".steps-validation").show();

$(".steps-validation").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        // alert("Submitted!");
        let formSubmit = new FormData($('#submitMedicine')[0]);


        $.ajax({
            url: "{{url('/medicine/')}}",
            method:'POST',
            data:formSubmit,
            dataType:'JSON',
            cache:false,
            processData:false,
            contentType:false,
            success: function (feedback) {

                toastr.success('Medicine created successfully.', 'Medicine created successfully!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

                setTimeout(function () {
                 //   $("#submitMedicine").trigger("reset");
                    location.reload()


                },2000)
            },
            error: (jqXHR,textStatus , errorThrown) => {


                data = jqXHR.responseJSON;
                console.log(data)
                toastr.error('The given data was invalid.', 'The given data was invalid.', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });

            }
        })

    }
});

// Initialize validation
$(".steps-validation").validate({
    ignore: 'input[type=hidden]', // ignore hidden fields
    errorClass: 'danger',
    successClass: 'success',
    highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    rules: {
        email: {
            email: true
        }
    }
});

</script>
<script src="{{URL::asset('trix/trix.js')}}"></script>
<script src="{{URL::asset('trix/trix-core.js')}}"></script>
<script src="{{ URL::asset('iCheck/icheck.min.js') }}"></script>
<script>

    $('.pp').number(true,2);
    $('.sp').number(true,2);




    $('.newPhotp').change(function () {

        var image = this.files[0];

        //Emmanuel Arthur

        if(image['type'] != 'image/jpeg' && image['type'] != 'image/png') {

            $('.newPhotp').val('');
            Swal.fire({
                title: 'Error uploading Image',
                text:'The file you are uploading is not an image',
                animation: false,
                customClass: 'animated shake',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
              })
        }else if(image['size'] > 20000000) {

            $('.newPhotp').val('');

            Swal.fire({
                title: 'Error uploading Image',
                text:'Image size should be less than 2mb',
                animation: false,
                customClass: 'animated shake',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
              })

        }else {

            var dataImage = new FileReader;

            dataImage.readAsDataURL(image);

            $(dataImage).on('load',function (e) {

                var resultImage = e.target.result

                $('.previewer').attr('src',resultImage)
            })
        }
    })

    $('#rprice , #pprice').change(function () {

        if($(".percentage").prop("checked")){

            var valuePercentage = $(".newPercentage").val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#rprice").val(percentage);
            $("#rprice").prop("readonly",true);
        }
    })

    $(".newPercentage").change(function(){

        if($(".percentage").prop("checked")){

            var valuePercentage = $(this).val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#rprice").val(percentage);
		    $("#rprice").prop("readonly",true);

        }


    })

    $(".percentage").change(function(){

        if(this.checked){

            $("#rprice").prop("readonly",true);
        }else{

            $("#rprice").prop("readonly",false);
        }



    })

    $('#wprice , #pprice').change(function () {

        if($(".wpercentage").prop("checked")){

            var valuePercentage = $(".wnewPercentage").val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#wprice").val(percentage);
            $("#wprice").prop("readonly",true);
        }
    })

    $(".wnewPercentage").change(function(){

        if($(".wpercentage").prop("checked")){

            var valuePercentage = $(this).val();
            var percentage = Number(($("#pprice").val()*valuePercentage/100))+Number($("#pprice").val());

            $("#wprice").val(percentage);
		    $("#wprice").prop("readonly",true);

        }


    })

    $(".wpercentage").change(function(){

        if(this.checked){

            $("#wprice").prop("readonly",true);
        }else{

            $("#wprice").prop("readonly",false);
        }



    })





</script>

@endsection
